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
                        manometer_2018.latlng,
                        manometer_2018.org_code,
                        manometer_2018.nipam";
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

        if ($cari != null) return $this->listMano($cari);
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

    function listMano($cari)
    {
        $result = (object)[];
        if ($this->sort) $this->db->order_by($this->sort, $this->order);
        else $this->db->order_by($this->defaultOrder);
        $result->rows = $this->db
            ->select($this->select)
            ->from($this->table)
            ->where('id_manometer', $cari)
            ->or_like('nama_manometer', $cari)
            ->or_like('cabang', $cari)
            ->or_like('penanggung_jawab', $cari)
            ->or_like('lokasi', $cari)
            ->limit($this->rows, $this->pos)
            ->get()
            ->result();
        $result->total = $this->db
            ->select('COUNT(manometer_2018.ID) as total')
            ->from($this->table)
            ->where('id_manometer', $cari)
            ->or_like('nama_manometer', $cari)
            ->or_like('cabang', $cari)
            ->or_like('penanggung_jawab', $cari)
            ->or_like('lokasi', $cari)
            ->get()
            ->result()[0]->total;
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
