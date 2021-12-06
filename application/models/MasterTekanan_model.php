<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class MasterTekanan_model extends CI_Model
{
    protected $select = "tekanan_manometer.id, 
                        tekanan_manometer.id_, 
                        tekanan_manometer.username,
                        `user`.nama, 
                        tekanan_manometer.kd_mano, 
                        tekanan_manometer.merk_mano, 
                        tekanan_manometer.lokasi_mano, 
                        tekanan_manometer.tgl_pasang_mano, 
                        tekanan_manometer.tgl_input, 
                        tekanan_manometer.jam_input, 
                        tekanan_manometer.kondisi_mano, 
                        tekanan_manometer.elevasi_mano, 
                        tekanan_manometer.tekanan";
    protected $joinUser = "tekanan_manometer.username = user.username";
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
        $kd_mano = isset($body->kd_mano) ? $body->kd_mano : null;
        $lokasi_mano = isset($body->lokasi_mano) ? $body->lokasi_mano : null;
        $username = isset($body->username) ? $body->username : null;

        if ($kd_mano != null) return $this->listMano($kd_mano);
        if ($lokasi_mano != null) return $this->listLokasi($lokasi_mano);
        if ($username != null) return $this->listPetugas($username);
        return $this->listDefault();
    }

    function listDefault()
    {
        $result = (object)[];
        if ($this->sort) $this->db->order_by($this->sort, $this->order);
        $result->rows = $this->db
            ->select($this->select)
            ->from('tekanan_manometer')
            ->join('user', $this->joinUser)
            ->order_by('tekanan_manometer.tgl_input', 'DESC')
            ->limit($this->rows, $this->pos)
            ->get()
            ->result();
        $result->total = $this->db
            ->select('COUNT(tekanan_manometer.id) as total')
            ->from('tekanan_manometer')
            ->join('user', $this->joinUser)
            ->get()
            ->result()[0]->total;
        return $result;
    }

    function listMano($kd_mano)
    {
        $result = (object)[];
        if ($this->sort) $this->db->order_by($this->sort, $this->order);
        $result->rows = $this->db
            ->select($this->select)
            ->from('tekanan_manometer')
            ->where('kd_mano', $kd_mano)
            ->join('user', $this->joinUser)
            ->order_by('tekanan_manometer.tgl_input', 'DESC')
            ->limit($this->rows, $this->pos)
            ->get()
            ->result();
        $result->total = $this->db
            ->select('COUNT(tekanan_manometer.id) as total')
            ->from('tekanan_manometer')
            ->where('kd_mano', $kd_mano)
            ->join('user', $this->joinUser)
            ->get()
            ->result()[0]->total;
        return $result;
    }

    function listLokasi($lokasi_mano)
    {
        $result = (object)[];
        if ($this->sort) $this->db->order_by($this->sort, $this->order);
        $result->rows = $this->db
            ->select($this->select)
            ->from('tekanan_manometer')
            ->like('lokasi_mano', $lokasi_mano)
            ->join('user', $this->joinUser)
            ->order_by('tekanan_manometer.tgl_input', 'DESC')
            ->limit($this->rows, $this->pos)
            ->get()
            ->result();
        $result->total = $this->db
            ->select('COUNT(tekanan_manometer.id) as total')
            ->from('tekanan_manometer')
            ->like('lokasi_mano', $lokasi_mano)
            ->join('user', $this->joinUser)
            ->get()
            ->result()[0]->total;
        return $result;
    }

    function listPetugas($username)
    {
        $result = (object)[];
        if ($this->sort) $this->db->order_by($this->sort, $this->order);
        $result->rows = $this->db
            ->select($this->select)
            ->from('tekanan_manometer')
            ->where('tekanan_manometer.username', $username)
            ->or_like('user.nama', $username)
            ->join('user', $this->joinUser)
            ->order_by('tekanan_manometer.tgl_input', 'DESC')
            ->limit($this->rows, $this->pos)
            ->get()
            ->result();
        $result->total = $this->db
            ->select('COUNT(tekanan_manometer.id) as total')
            ->from('tekanan_manometer')
            ->where('tekanan_manometer.username', $username)
            ->or_like('user.nama', $username)
            ->join('user', $this->joinUser)
            ->get()
            ->result()[0]->total;
        return $result;
    }

    public function Find($id)
    {
        $result = $this->db
            ->select($this->select)
            ->from('tekanan_manometer')
            ->where('tekanan_manometer.id', $id)
            ->join('user', $this->joinUser)
            ->get()
            ->row();
        return $result;
    }

    public function Update($id)
    {
        $body = (object) $this->input->post();
        $data = [
            "tgl_input" => $body->tgl_input,
            "lokasi_mano" => $body->lokasi_mano,
            "tekanan" => $body->tekanan,
        ];
        if ($id != $body->id) return ["code" => 304, "message" => "Gagal Mengupdate Data!, Sepertinya ada yang salah!"];
        $this->db->trans_start();
        $this->db->set($data)->where('id', $id)->update('tekanan_manometer');
        $this->db->trans_complete();

        if ($this->db->trans_status() === false) return ["code" => 304, "message" => 'Gagal Mengupdate Data!, Sepertinya ada yang salah!'];
        return ["code" => 201, "message" => "Data berhasil diupdate"];
    }
}
