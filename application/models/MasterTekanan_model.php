<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class MasterTekanan_model extends CI_Model
{
    protected $table = "manometer_2018";
    protected $select = "manometer_2018.ID, 
                        manometer_2018.id_, 
                        manometer_2018.id_manometer, 
                        manometer_2018.nama_manometer, 
                        manometer_2018.penanggung_jawab, 
                        manometer_2018.lokasi, 
                        manometer_2018.cabang, 
                        manometer_2018.koneksi_pipa, 
                        manometer_2018.latlng";
    protected $joinUser = "tekanan_manometer.username = user.username";
    protected $defaultOrder = 'manometer_2018.cabang ASC,
                                manometer_2018.penanggung_jawab ASC,
                                manometer_2018.nama_manometer ASC';
    protected $rows = null;
    protected $page = null;
    protected $pos = null;
    protected $sort = null;
    protected $order = null;

    public function listTekanan()
    {
        $body = (object)$this->input->post();
        $this->rows = $body->rows;
        $this->page = $body->page;
        $this->pos = ($this->page - 1) * $this->rows;
        $this->sort = isset($body->sort) ? $body->sort : null;
        $this->order = isset($body->order) ? $body->order : null;
        $cari = isset($body->cari) ? $body->cari : null;
        $lokasi_mano = isset($body->lokasi_mano) ? $body->lokasi_mano : null;
        $username = isset($body->username) ? $body->username : null;

        if ($cari != null) return $this->listCari($cari);
        return $this->listDefault();
    }

    function listDefault()
    {
        $result = (object)[];
        if ($this->sort) $this->db->order_by($this->sort, $this->order);
        else $this->db->order_by($this->defaultOrder);
        $result->rows = $this->db
            ->select($this->select)
            ->from($this->table)
            ->limit($this->rows, $this->pos)
            ->get()
            ->result();
        $result->total = $this->db
            ->select('COUNT(manometer_2018.ID) as total')
            ->from($this->table)
            ->get()
            ->result()[0]->total;
        return $result;
    }

    function listCari($cari)
    {
        $result = (object)[];
        $id_manometer = $this->result_generator('where', 'id_manometer', $cari);
        $total_id_manometer = $this->result_total('where', 'id_manometer', $cari);
        $nama_manometer = $this->result_generator('like', 'nama_manometer', $cari);
        $total_nama_manometer = $this->result_total('like', 'nama_manometer', $cari);
        $cabang = $this->result_generator('like', 'cabang', $cari);
        $total_cabang = $this->result_total('like', 'cabang', $cari);
        $penanggung_jawab = $this->result_generator('like', 'penanggung_jawab', $cari);
        $total_penanggung_jawab = $this->result_total('like', 'penanggung_jawab', $cari);
        $lokasi = $this->result_generator('like', 'lokasi', $cari);
        $total_lokasi = $this->result_total('like', 'lokasi', $cari);
        if ($id_manometer) {
            $result->rows = $id_manometer;
            $result->total = $total_id_manometer;
        }
        if ($nama_manometer) {
            $result->rows = $nama_manometer;
            $result->total = $total_nama_manometer;
        }
        if ($cabang) {
            $result->rows = $cabang;
            $result->total = $total_cabang;
        }
        if ($penanggung_jawab) {
            $result->rows = $penanggung_jawab;
            $result->total = $total_penanggung_jawab;
        }
        if ($lokasi) {
            $result->rows = $lokasi;
            $result->total = $total_lokasi;
        }
        return $result;
    }

    function result_generator($method, $field, $value)
    {
        if ($this->sort) $this->db->order_by($this->sort, $this->order);
        if ($method == "where") $this->db->where($field, $value);
        else $this->db->like($field, $value);
        $this->db
            ->select(
                "manometer_2018.ID, 
                manometer_2018.id_, 
                manometer_2018.id_manometer, 
                manometer_2018.nama_manometer, 
                manometer_2018.penanggung_jawab, 
                manometer_2018.lokasi, 
                manometer_2018.cabang, 
                manometer_2018.koneksi_pipa, 
                manometer_2018.latlng"
            )
            ->from("manometer_2018")
            ->order_by(
                'manometer_2018.cabang ASC,
                manometer_2018.penanggung_jawab ASC,
                manometer_2018.nama_manometer ASC'
            )
            ->limit($this->rows, $this->pos);
        $result = $this->db
            ->get()
            ->result();
        return $result;
    }

    function result_total($method, $field, $value)
    {
        if ($method == "where") $this->db->where($field, $value);
        else $this->db->like($field, $value);
        $this->db
            ->select('count(manometer_2018.ID) as total')
            ->from("manometer_2018");
        $result = $this->db
            ->get()
            ->result()[0]
            ->total;
        return $result;
    }

    public function Find($id)
    {
        $result = $this->db
            ->select($this->select)
            ->from($this->table)
            ->where($this->table . '.ID', $id)
            ->get()
            ->row();
        return $result;
    }

    public function Update($id)
    {
        $body = (object) $this->input->post();
        $data = [
            "id_" => $body->id_,
            "id_manometer" => $body->id_manometer,
            "nama_manometer" => $body->nama_manometer,
            "penanggung_jawab" => $body->penanggung_jawab,
            "lokasi" => $body->lokasi,
            "cabang" => $body->cabang,
            "koneksi_pipa" => $body->koneksi_pipa,
            "latlng" => $body->latlng
        ];
        // print_r($where);
        if ($id != $body->ID) return ["code" => 304, "message" => "Gagal Mengupdate Data!, Sepertinya ada yang salah!"];
        $this->db->trans_start();
        $this->db->set($data)->where('id', $id)->update('manometer_2018');
        $this->db->trans_complete();

        if ($this->db->trans_status() === false) return ["code" => 304, "message" => 'Gagal Mengupdate Data!, Sepertinya ada yang salah!'];
        return ["code" => 201, "message" => "Data berhasil diupdate"];
    }
}
