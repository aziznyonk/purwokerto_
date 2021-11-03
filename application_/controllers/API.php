<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class API extends CI_Controller {

    // function __construct() {
    //     // Construct the parent class
    //     parent::__construct();
    public function __construct($config = 'rest') {
        parent::__construct($config);

        $this->load->model('db_model');
        $this->load->helper(array('form', 'url'));
        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['insertSr_Mbr']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['getAllSr_mbr']['limit'] = 50; // 50 requests per hour per user/key

        $this->methods['loginMe']['limit'] = 100;
    }

    public function index(){
        echo "Welcome to Rest API page";
    }
    public function xcel(){

    }
    public function loginMe(){
        $this->load->library('form_validation');

        $this->form_validation->set_rules('username', 'Username', 'required|max_length[32]|min_length[3]');
        $this->form_validation->set_rules('password', 'Password', 'required|max_length[32]|min_length[3]');

        if($this->form_validation->run() == FALSE){
            $data['status']='failed';
            $data['message']='Login Gagal (username password tidak cocok)';
        } else{
            $username = $this->input->post('username');
            $password = $this->input->post('password');
           //$result = $this->db_model->loginMe($username, md5($password));
            $result = $this->db_model->loginMe($username, $password);

            if(!empty($result)){
                $data['data']=$result;
                $data['status']='success';
                $data['message']='Login data succsess';

            }else {
                $data['data']=$result;
                $data['status']='failed';
                $data['message']='Login data failed - Tidak ada data.';
            }
        }
        echo json_encode($data);
    }

    /*methods for SR MBR */

    public function insertSr_Mbr()
    {
        /*rule upload foto*/
        $config['upload_path']          = './application/uploads/sr_mbr/';
        $config['allowed_types']        = 'gif|jpg|png|JPG|PNG|jpeg';
        $config['max_size']             = 2000;

        $this->load->library('upload', $config);
        $this->load->library('form_validation');
        /*rule form inpu data*/
        $this->form_validation->set_rules('ID_', 'ID_', 'trim|required|numeric');
        $this->form_validation->set_rules('username', 'Username', 'trim|required|max_length[50]|min_length[1]');
        $this->form_validation->set_rules('nama', 'Nama', 'trim|required|max_length[30]|min_length[1]');
        $this->form_validation->set_rules('pekerjaan', 'Pekerjaan', 'trim|required|max_length[30]|min_length[3]');
        $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required|max_length[255]');
        $this->form_validation->set_rules('almt_dipasang', 'Almt_dipasang','trim|required|max_length[255]');
        $this->form_validation->set_rules('latlng', 'Latlng','trim|required|max_length[255]');
        $this->form_validation->set_rules('ktp', 'Ktp', 'trim|required|numeric');
        $this->form_validation->set_rules('telfon', 'Telfon', 'trim|required|numeric');
        $this->form_validation->set_rules('daya_listrik', 'Daya_listrik', 'trim|required|max_length[20]');
        $this->form_validation->set_rules('rt_biasa', 'Rt_biasa', 'trim|required|max_length[50]');
        $this->form_validation->set_rules('jml_penghuni', 'Jml_penghuni', 'trim|required|numeric');
        $this->form_validation->set_rules('smbr_skrg', 'Smbr_skrg', 'trim|required|max_length[25]');
        $this->form_validation->set_rules('jarak', 'Jarak', 'trim|required|max_length[20]');
        $this->form_validation->set_rules('lebar_jln', 'Lebar_jln', 'trim|required|max_length[20]');
        $this->form_validation->set_rules('jaringan_distri', 'Jaringan_distri', 'trim|required|max_length[20]');


        if($this->form_validation->run() == FALSE)
        {
            $data['status']='failed';
            $data['message']='Insert data failed - data is invalid ';
        }else{
            $ID_                = $this->input->post('ID_');
            $upd            = $this->input->post('upd');
            $check = $this->db_model->getMbrPelangganByID($ID_);//check ID pelnggan
            if(!empty($check) && $upd == ""){
                $data['status']     = 1;
                $data['message']    = 'Data sudah ada, perbarui?';
                echo json_encode($data);
                exit;
            }
            $username           = $this->input->post('username');
            $nama               = $this->input->post('nama');
            $alamat             = $this->input->post('alamat');
            $almt_dipasang      = $this->input->post('almt_dipasang');
            $latlng             = $this->input->post('latlng');
            $ktp                = $this->input->post('ktp');
            $pekerjaan          = $this->input->post('pekerjaan');
            $telfon             = $this->input->post('telfon');
            $daya_listrik       = $this->input->post('daya_listrik');
            $rt_biasa           = $this->input->post('rt_biasa');
            $jml_penghuni       = $this->input->post('jml_penghuni');
            $smbr_skrg          = $this->input->post('smbr_skrg');
            $jarak              = $this->input->post('jarak');
            $lebar_jln          = $this->input->post('lebar_jln');
            $jaringan_distri    = $this->input->post('jaringan_distri');
            $tgl                = date('Y-m-d');
            /*upload foto*/
            if ( !$this->upload->do_upload('foto'))
            {
                $file = array('error' => $this->upload->display_errors());

            }
            else
            {
                $file = array($this->upload->data('file_name'));
            }
            $foto = implode($file);//file nama foto

//            $check = $this->db_model->getOneSr_mbrByID($ID_);//check ID pelnggan

            if(!empty($check))
            {
                $sr_mbrInfo = array('username'=>$username ,'nama'=>$nama, 'alamat'=>$alamat, 'almt_dipasang'=>$almt_dipasang, 'latlng'=>$latlng, 'ktp'=>$ktp, 'pekerjaan'=>$pekerjaan,
                    'telfon'=>$telfon, 'daya_listrik'=>$daya_listrik, 'rt_biasa'=>$rt_biasa, 'jml_penghuni'=>$jml_penghuni,
                    'smber_skrg'=>$smbr_skrg, 'jarak'=>$jarak, 'lebar_jln'=>$lebar_jln, 'jaringan_distri'=>$jaringan_distri, 'foto'=>$foto, 'date'=>$tgl
                );
                $result = $this->db_model->update_Mbr($sr_mbrInfo, $ID_);
                
                if(!empty($result)){
                   $data['data']       = $result;
                   $data['sr_mbr']     = $sr_mbrInfo;
                   $data['status']     = 'success';
                   $data['message']    = 'Update data succsess';
               }else {
                   $data['data']       = $result;
                   $data['k_pelanggan']     = $sr_mbrInfo;
                   $data['status']     = 'failed';
                   $data['message']    = 'Update data failed';
               }
           }else{
            $sr_mbrInfo = array('ID_'=>$ID_, 'username'=>$username ,'nama'=>$nama, 'alamat'=>$alamat, 'almt_dipasang'=>$almt_dipasang, 'latlng'=>$latlng, 'ktp'=>$ktp, 'pekerjaan'=>$pekerjaan,
                'telfon'=>$telfon, 'daya_listrik'=>$daya_listrik, 'rt_biasa'=>$rt_biasa, 'jml_penghuni'=>$jml_penghuni,
                'smber_skrg'=>$smbr_skrg, 'jarak'=>$jarak, 'lebar_jln'=>$lebar_jln, 'jaringan_distri'=>$jaringan_distri, 'foto'=>$foto, 'date'=>$tgl
            );
            $result = $this->db_model->insertSr_Mbr($sr_mbrInfo);

            if(!empty($result)){
                $data['data']       = $result;
                $data['sr_mbr']     = $sr_mbrInfo;
                $data['status']     = 'success';
                $data['message']    = 'Insert data succsess';

            }else {
                $data['data']       = $result;
                $data['sr_mbr']     = $sr_mbrInfo;
                $data['status']     = 'failed';
                $data['message']    = 'Insert data failed';
            }
        }
    }
    echo json_encode($data);
}

public function getAllSr_mbr()
{
    $result = $this->db_model->getAllSr_Mbr();
    if(!empty($result)){
        $data['data']           = $result;
        $data['status']         = 'success';
        $data['message']        = 'data succsess';

    }else {
        $data['data']           = $result;
        $data['status']         = 'failed null';
        $data['message']        = 'data is empty';
    }
    echo json_encode($data);

}
public function excel()
{


}
public function getCountAllSr_mbrByUser()
{
    $this->load->library('form_validation');
    /*rule form inpu data*/
    $this->form_validation->set_rules('ID_', 'ID_', 'trim|required|numeric');

    $ID_ = $this->input->post('ID_');

    if($this->form_validation->run() == FALSE)
    {
        $data['status']='failed';
        $data['message']='data invalid - id user is empty ';
    }else{
        if(strlen($ID_)<2)
        {
            $ID_='0'.$ID_;
        }
        $result = $this->db_model->getCountAllSr_MbrByUser($ID_);
        if(!empty($result)){
            $data['data']           = $result;
            $data['status']         = 'success';
            $data['message']        = 'data succsess';

        }else {
            $data['data']           = $result;
            $data['status']         = 'failed null';
            $data['message']        = 'data is empty';
        }
    }

    echo json_encode($data);

}
public function getCountAllSr_mbr()
{
    $result = $this->db_model->getCountAllSr_mbr();
    if(!empty($result)){
        $data['data']           = $result;
        $data['status']         = 'success';
        $data['message']        = 'data succsess';

    }else {
        $data['data']           = $result;
        $data['status']         = 'failed null';
        $data['message']        = 'data is empty';
    }
    echo json_encode($data);
}
public function searchSr_mbr()
{
    $this->load->library('form_validation');
    $this->form_validation->set_rules('search', 'Search', 'trim|required');

    if($this->form_validation->run() == FALSE)
    {
        $data['status']='failed';
        $data['message']='searching is invalid - null data';
    }else{
        $search = $this->input->post('search');
        $result = $this->db_model->searchSr_mbr($search);

        if(!empty($result)){
            $data['data']           = $result;
            $data['search input']   = $search;
            $data['status']         = 'success';
            $data['message']        = 'Search data succsess';

        }else {
            $data['data']           = $result;
            $data['search input']   = $search;
            $data['status']         = 'failed null';
            $data['message']        = 'Search data is empty';
        }

    }
    echo json_encode($data);
}

/*method FOR pipa*/
public function getAllPipa()
{
    $result = $this->db_model->getAllPipa();
    if(!empty($result)){
        echo json_encode($result);
    }
}
public function insertPipaDetails()
{
    $this->load->library('form_validation');

    $this->form_validation->set_rules('gid__2', 'Gid__2', 'trim|required|numeric');
    $this->form_validation->set_rules('panjang', 'Panjang', 'trim|required');
    $this->form_validation->set_rules('diameter', 'Diameter', 'trim|required|numeric');
    $this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required|max_length[255]');
    $this->form_validation->set_rules('lokasi', 'Lokasi', 'trim|required|max_length[255]');
    $this->form_validation->set_rules('latlng', 'Latlng', 'trim|required');
    $this->form_validation->set_rules('cabang', 'Cabang', 'trim|required|max_length[255]');
    $this->form_validation->set_rules('username', 'Username', 'trim|required|max_length[255]|min_length[1]');

    if($this->form_validation->run() == FALSE)
    {
        $gid__2     = $this->input->post('gid__2');
        $panjang    = $this->input->post('panjang');
        $diameter   = $this->input->post('diameter');
        $keterangan = $this->input->post('keterangan');
        $lokasi     = $this->input->post('lokasi');
        $latlng     = $this->input->post('latlng');
        $cabang     = $this->input->post('cabang');
        $username	= $this->input->post('username');
        $date		= date('Y-m-d');

        $pipaDetails = array('gid__2'=>$gid__2, 'panjang'=>$panjang, 'diameter'=>$diameter, 'keterangan'=>$keterangan, 'lokasi'=>$lokasi,'latlng'=>$latlng, 'cabang'=>$cabang, 'username'=>$username, 'tgl_input'=>$date);

        $data['pipa detail']    = $pipaDetails;
        $data['status']='failed';
        $data['message']='Insert data failed - data is invalid ';
    }else{
        $gid__2     = $this->input->post('gid__2');
        $panjang    = $this->input->post('panjang');
        $diameter   = $this->input->post('diameter');
        $keterangan = $this->input->post('keterangan');
        $lokasi     = $this->input->post('lokasi');
        $latlng     = $this->input->post('latlng');
        $cabang     = $this->input->post('cabang');
        $username	= $this->input->post('username');
        $date		= date('Y-m-d');

        $pattern        = '/^[0-9]+$/';
        $replacement    = '';
        $panjang        = preg_replace($pattern, $replacement, $panjang);

        $pipaDetails = array('gid__2'=>$gid__2, 'panjang'=>$panjang, 'diameter'=>$diameter, 'keterangan'=>$keterangan, 'lokasi'=>$lokasi,
            'latlng'=>$latlng, 'cabang'=>$cabang, 'username'=>$username, 'tgl_input'=>$date);
        $result = $this->db_model->insertPipaDetails($pipaDetails);

        if(!empty($result)){
            $data['data']           = $result;
            $data['pipa detail']    = $pipaDetails;
            $data['status']         = 'success';
            $data['message']        = 'Insert data succsess';

        }else {
            $data['data']           = $result;
            $data['pipa detail']    = $pipaDetails;
            $data['status']         = 'failed';
            $data['message']        = 'Insert data failed';
        }
    }
    echo json_encode($data);

}

/*method FOR pelanggan*/
public function insertKoorPelanggan()
{
  /*rule upload foto*/
  $config['upload_path']          = './application/uploads/pelanggan/';
  $config['allowed_types']        = 'gif|jpg|png|JPG|PNG|jpeg';
  $config['max_size']             = 2000;

  $this->load->library('upload', $config);
  $this->load->library('form_validation');

  $this->form_validation->set_rules('id_', 'Id_','trim|required|numeric');
  $this->form_validation->set_rules('nama', 'Nama', 'trim|required|min_length[1]');
  $this->form_validation->set_rules('nomor_pela', 'Nomor_pela','trim|required|numeric');
  $this->form_validation->set_rules('alamat', 'Alamat','trim|required');
  $this->form_validation->set_rules('latlng', 'Latlng','trim|required');
  $this->form_validation->set_rules('klasifikasi', 'Klasifikasi', 'trim|required|min_length[1]');
  $this->form_validation->set_rules('status', 'Status', 'trim|required|min_length[1]');
  $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[1]');

  if($this->form_validation->run() == FALSE)
  {
     $nomor_pela     = $this->input->post('nomor_pela');
     $upd            = $this->input->post('upd');
     $ID_			= $this->input->post('id_');
     $id_survey		= '0000';
     $nama           = $this->input->post('nama');
     $nomor_pela     = $this->input->post('nomor_pela');
     $alamat         = $this->input->post('alamat');
     $klasifikasi    = $this->input->post('klasifikasi');
     $status         = $this->input->post('status');
     $username		= $this->input->post('username');
     $latlng         = $this->input->post('latlng');
     $date			=  date('Y-m-d');
     /*upload foto*/
     if ( !$this->upload->do_upload('foto'))
     {
        $file = array('error' => $this->upload->display_errors());

    }
    else
    {
        $file = array($this->upload->data('file_name'));
    }
            $foto = implode($file);//file nama foto

            $k_pelangganInfo    = array(
              'nama'=>$nama, 
              'id_survey'=>$id_survey,
              'nomor_pela'=>$nomor_pela, 
              'alamat'=>$alamat, 
              'latlng'=>$latlng, 
              'klasifikasi'=>$klasifikasi, 
              'status'=>$status, 
              'foto'=>$foto,
              'username'=>$username, 
              'tgl_input'=>$date, 
              'ID_'=>$ID_
          );

            $data['k_pelanggan']    = $k_pelangganInfo;
            $data['status']         = 'failed';
            $data['message']        ='Insert data failed - data is invalid ';


        }else{
            $nomor_pela     = $this->input->post('nomor_pela');
            $upd            = $this->input->post('upd');
            $check = $this->db_model->getOnePelangganByID($nomor_pela);//check ID pelnggan
            if(!empty($check) && $upd == ""){
                $data['status']     = 1;
                $data['message']    = 'Data sudah ada, perbarui?';
                echo json_encode($data);
                exit;
            }
            $nama           = $this->input->post('nama');
            $id_survey		= '0000';
            $alamat         = $this->input->post('alamat');
            $latlng         = $this->input->post('latlng');
            $klasifikasi    = $this->input->post('klasifikasi');
            $status         = $this->input->post('status');
            $ID_			= $this->input->post('id_');
            $username		= $this->input->post('username');
            $date			= date('Y-m-d');
            /*upload foto*/
            if ( !$this->upload->do_upload('foto'))
            {
                $file = array('error' => $this->upload->display_errors());

            }
            else
            {
                $file = array($this->upload->data('file_name'));
            }
            $foto = implode($file);//file nama foto


            if(!empty($check)){
                $k_pelangganInfo    = array(
                  'nama'=>$nama, 
                  'id_survey'=>$id_survey,
                  'nomor_pela'=>$nomor_pela, 
                  'alamat'=>$alamat, 
                  'latlng'=>$latlng, 
                  'klasifikasi'=>$klasifikasi, 
                  'status'=>$status, 
                  'foto'=>$foto,
                  'username'=>$username, 
                  'tgl_input'=>$date, 
                  'ID_'=>$ID_
              );
                $result = $this->db_model->updateK_Pelanggan($k_pelangganInfo, $nomor_pela);

                if(!empty($result)){
                   $data['data']       	= $result;
                   $data['k_pelanggan']    = $k_pelangganInfo;
                   $data['status']     	= 'success';
                   $data['message']    	= 'Update data succsess';

               }else {
                   $data['data']       	= $result;
                   $data['k_pelanggan']    = $k_pelangganInfo;
                   $data['status']     	= 'failed';
                   $data['message']    	= 'Update data failed';
               }
           }else{
            $k_pelangganInfo    = array(
              'nama'=>$nama, 
              'id_survey'=>$id_survey,
              'nomor_pela'=>$nomor_pela, 
              'alamat'=>$alamat, 
              'latlng'=>$latlng, 
              'klasifikasi'=>$klasifikasi, 
              'status'=>$status, 
              'foto'=>$foto,
              'username'=>$username, 
              'tgl_input'=>$date, 
              'ID_'=>$ID_
          );
            $result = $this->db_model->insertK_Pelanggan($k_pelangganInfo);

            if(!empty($result)){
               $data['data']       	= $result;
               $data['k_pelanggan']    = $k_pelangganInfo;
               $data['status']     	= 'success';
               $data['message']    	= 'Insert data succsess';

           }else {
               $data['data']       	= $result;
               $data['k_pelanggan']    = $k_pelangganInfo;
               $data['status']     	= 'failed';
               $data['message']    	= 'Insert data failed';
           }
       }
   }
   echo json_encode($data);
}

public function searchPelanggan(){
  $this->load->library('form_validation');
  $this->form_validation->set_rules('search', 'Search', 'trim|required|numeric');

  if($this->form_validation->run() == FALSE)
  {
    $data['status']='failed';
    $data['message']='searching is invalid - null data';
}else{
    $search = $this->input->post('search');
    $result = $this->db_model->searchPelanggan($search);

    if(!empty($result)){
        $data['data']           = $result;
        $data['search input']   = $search;
        $data['status']         = 'success';
        $data['message']        = 'Search data succsess';

    }else {
        $data['data']           = $result;
        $data['search input']   = $search;
        $data['status']         = 'failed null';
        $data['message']        = 'Search data is empty';
    }

}
echo json_encode($data);
}

public function insertPengawas() {
    /*rule upload foto*/
    $config['upload_path']          = './application/uploads/pengawas/';
    $config['allowed_types']        = 'gif|jpg|png|JPG|PNG|jpeg';
    $config['max_size']             = 2000;

    $this->load->library('upload', $config);
    $this->load->library('form_validation');

    //$this->form_validation->set_rules('id', 'Id_','trim|required|numeric');
    $this->form_validation->set_rules('namaPelanggan_', 'Nama', 'trim|required|min_length[1]');
    $this->form_validation->set_rules('noWm_', 'Nomor_pelanggan','trim|required|numeric');
    $this->form_validation->set_rules('alamat_', 'Alamat','trim|required|min_length[1]');
    //$this->form_validation->set_rules('latlng_', 'Latlng','trim|required');
    //$this->form_validation->set_rules('desa_', 'Desa', 'trim|required|min_length[1]');
    $this->form_validation->set_rules('tanggal_', 'tanggal_', 'trim|required|min_length[1]');
    $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[1]');

    $this->form_validation->set_rules('clampSaddle_', 'clampSaddle', 'trim|required|min_length[1]');
    $this->form_validation->set_rules('pipaHdpe_', 'pipaHdpe', 'trim|required|min_length[1]');
    $this->form_validation->set_rules('ElbowCompress_', 'ElbowCompress', 'trim|required|min_length[1]');
    $this->form_validation->set_rules('landasan_', 'landasan', 'trim|required|min_length[1]');
    $this->form_validation->set_rules('galian_tanah_', 'galian_tanah', 'trim|required|min_length[1]');
    $this->form_validation->set_rules('galian_paving_', 'galian_paving', 'trim|required|min_length[1]');
    $this->form_validation->set_rules('galian_floor_', 'galian_floor', 'trim|required|min_length[1]');
    $this->form_validation->set_rules('galian_aspal_', 'galian_aspal', 'trim|required|min_length[1]');


    if($this->form_validation->run() == FALSE) {
        if ( !$this->upload->do_upload('foto')) {
            $file = array('error' => $this->upload->display_errors());
        } 

        $data['status']        = 'failed';
        $data['message']       ='Gagal Menyimpan data.. Masih ada kolom yang kosong.! ';

    } else {
        $noWm     = $this->input->post('noWm_');
        $upd      = $this->input->post('upd');
        $check    = $this->db_model->getOnePengawasByID($noWm);//check ID pelnggan
        if(!empty($check) && $upd == ""){
            $data['status']     = 1;
            $data['message']    = 'Data sudah ada, perbarui?';
            echo json_encode($data);
            exit;
        }
        $upd            = $this->input->post('upd');
        $namaPelanggan  = $this->input->post('namaPelanggan_');
        $noWm           = $this->input->post('noWm_');
        $alamat         = $this->input->post('alamat_');
        $idBaseline     =  $this->input->post('idBaseline_');
        $latlng         = $this->input->post('latlng_');
        $tanggal        =  $this->input->post('tanggal_');
        $username       = $this->input->post('username');
        $date           =  date('Y-m-d h:i:s');

        $clampSaddle     =  $this->input->post('clampSaddle_');
        $clampSaddleVal  =  $this->input->post('clampSaddleVal_');
        $maleAdaptor     =  $this->input->post('maleAdaptor_');
        $pipaHdpe        =  $this->input->post('pipaHdpe_');
        $ElbowCompress      =  $this->input->post('ElbowCompress_');
        $ElbowFemale      =  $this->input->post('ElbowFemale_');
        $pipaGip      =  $this->input->post('pipaGip_');
        $bochGip20      =  $this->input->post('bochGip20_');
        $reducerGip      =  $this->input->post('reducerGip_');
        $doubleNeple      =  $this->input->post('doubleNeple_');
        $plughKran      =  $this->input->post('plughKran_');
        $wm      =  $this->input->post('wm_');
        $stopKran      =  $this->input->post('stopKran_');
        $katupSearah      =  $this->input->post('katupSearah_');
        $bochGip12      =  $this->input->post('bochGip12_');
        $pipaGip12      =  $this->input->post('pipaGip12_');
        $knie      =  $this->input->post('knie_');
        $tee      =  $this->input->post('tee_');
        $kran      =  $this->input->post('kran_');
        $plughCi      =  $this->input->post('plughCi_');
        $sealtape      =  $this->input->post('sealtape_');
        $kartu      =  $this->input->post('kartu_');
        $landasan      =  $this->input->post('landasan_');
        $boxMeter           =  $this->input->post('boxMeter_');
        $galian_tanah      =  $this->input->post('galian_tanah_');
        $galian_paving     =  $this->input->post('galian_paving_');
        $galian_floor      =  $this->input->post('galian_floor_');
        $galian_aspal      =  $this->input->post('galian_aspal_');
        // $jenisGalian      =  $this->input->post('jenisGalian_');
        // $panjangGalian      =  $this->input->post('panjangGalian_');
        $catatan      =  $this->input->post('catatan_');


        /*upload foto*/
        if ( !$this->upload->do_upload('foto')){
            $file = array('error' => $this->upload->display_errors());
        } else {
            $file = array($this->upload->data('file_name'));
        }
            $foto = implode($file);//file nama foto

            if(!empty($check)){
                $k_pengawasInfo    = array(
                 'namaPelanggan_'=>$namaPelanggan, 
                 'noWm_'=>$noWm,
                 'alamat_'=>$alamat, 
                 'no_rab_'=>$idBaseline,
                 'latlng_'=>$latlng, 
                 'tanggal_'=>$tanggal, 
                 'foto'=>$foto,
                 'username'=>$username, 
                 'tgl_input'=>$date,

                 'clampSaddle_'=>$clampSaddle,
                 'clampSaddleVal_'=>$clampSaddleVal,
                 'maleAdaptor_'=>$maleAdaptor,
                 'pipaHdpe_'=>$pipaHdpe,
                 'ElbowCompress_'=>$ElbowCompress,
                 'ElbowFemale_'=>$ElbowFemale,
                 'pipaGip_'=>$pipaGip,
                 'bochGip20_'=>$bochGip20,
                 'reducerGip_'=>$reducerGip,
                 'doubleNeple_'=>$doubleNeple,
                 'plughKran_'=>$plughKran,
                 'wm_'=>$wm,
                 'stopKran_'=>$stopKran,
                 'katupSearah_'=>$katupSearah,
                 'bochGip12_'=>$bochGip12,
                 'pipaGip12_'=>$pipaGip12,
                 'knie_'=>$knie,
                 'tee_'=>$tee,
                 'kran_'=>$kran,
                 'plughCi_'=>$plughCi,
                 'sealtape_'=>$sealtape,
                 'kartu_'=>$kartu,
                 'landasan_'=>$landasan,
                 'boxMeter_'=>$boxMeter,
                   // 'jenisGalian_'=>$jenisGalian,
                   // 'panjangGalian_'=>$panjangGalian,
                 'galian_tanah_'=>$galian_tanah,
                 'galian_paving_'=>$galian_paving,
                 'galian_floor_'=>$galian_floor,
                 'galian_aspal_'=>$galian_aspal,
                 'catatan_'=>$catatan,
                 'path'=>'http://103.25.210.61:81/purwokerto/application/uploads/pengawas/',
             );
                $result = $this->db_model->updateK_Pengawas($k_pengawasInfo, $noWm);

                if(!empty($result)){
                    $data['data']           = $result;
                    $data['k_pelanggan']    = $k_pengawasInfo;
                    $data['status']         = 'success';
                    $data['message']        = 'Update data succsess';

                }else {
                    $data['data']           = $result;
                    $data['k_pelanggan']    = $k_pelangganInfo;
                    $data['status']         = 'failed';
                    $data['message']        = 'Update data failed';
                }
            } else {
                $k_pengawasInfo    = array(
                 'namaPelanggan_'=>$namaPelanggan, 
                 'noWm_'=>$noWm,
                 'alamat_'=>$alamat, 
                 'latlng_'=>$latlng, 
                 'tanggal_'=>$tanggal, 
                 'foto'=>$foto,
                 'username'=>$username, 
                 'tgl_input'=>$date,
                 'no_rab_'=>$idBaseline,

                 'clampSaddle_'=>$clampSaddle,
                 'clampSaddleVal_'=>$clampSaddleVal,
                 'maleAdaptor_'=>$maleAdaptor,
                 'pipaHdpe_'=>$pipaHdpe,
                 'ElbowCompress_'=>$ElbowCompress,
                 'ElbowFemale_'=>$ElbowFemale,
                 'pipaGip_'=>$pipaGip,
                 'bochGip20_'=>$bochGip20,
                 'reducerGip_'=>$reducerGip,
                 'doubleNeple_'=>$doubleNeple,
                 'plughKran_'=>$plughKran,
                 'wm_'=>$wm,
                 'stopKran_'=>$stopKran,
                 'katupSearah_'=>$katupSearah,
                 'bochGip12_'=>$bochGip12,
                 'pipaGip12_'=>$pipaGip12,
                 'knie_'=>$knie,
                 'tee_'=>$tee,
                 'kran_'=>$kran,
                 'plughCi_'=>$plughCi,
                 'sealtape_'=>$sealtape,
                 'kartu_'=>$kartu,
                 'landasan_'=>$landasan,
                 'boxMeter_'=>$boxMeter,
                    // 'jenisGalian_'=>$jenisGalian,
                   // 'panjangGalian_'=>$panjangGalian,
                 'galian_tanah_'=>$galian_tanah,
                 'galian_paving_'=>$galian_paving,
                 'galian_floor_'=>$galian_floor,
                 'galian_aspal_'=>$galian_aspal,
                 'catatan_'=>$catatan,
                 'path'=>'http://103.25.210.61:81/purwokerto/application/uploads/pengawas/',
             );
                $result = $this->db_model->insertK_Pengawas($k_pengawasInfo);

                if(!empty($result)){
                    $data['data']           = $result;
                    $data['k_pengawas']    = $k_pengawasInfo;
                    $data['status']         = 'success';
                    $data['message']        = 'Data Berhasil Disimpan Bro.';

                }else {
                    $data['data']           = $result;
                    $data['k_pengawas']    = $k_pengawasInfo;
                    $data['status']         = 'failed';
                    $data['message']        = 'Insert data failed';
                }
            }
        }
        echo json_encode($data);
    }

    public function searchPengawas(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('search', 'Search', 'trim|required|numeric');

        if($this->form_validation->run() == FALSE)
        {
            $data['status']='failed';
            $data['message']='searching is invalid - null data';
        }else{
            $search = $this->input->post('search');
            $result = $this->db_model->searchPengawas($search);

            if(!empty($result)){
                $data['data']           = $result;
                $data['search input']   = $search;
                $data['status']         = 'success';
                $data['message']        = 'Search data succsess';

            }else {
                $data['data']           = $result;
                $data['search input']   = $search;
                $data['status']         = 'failed null';
                $data['message']        = 'Search data is empty';
            }

        }
        echo json_encode($data);
    }

    /*Manometer*/
    public function getAllManometer()
    {
      $result = $this->db_model->getAllManometer();
      if(!empty($result)){
        $data['count']	= $count;
    }else{
     $data	= null;
 }
 echo json_encode($data);
}

public function searchManometer(){
    $this->load->library('form_validation');
    $this->form_validation->set_rules('search', 'Search', 'trim|required|numeric');

    if($this->form_validation->run() == FALSE)
    {
        $data['status']='failed';
        $data['message']='searching is invalid - null data';
    }else{
        $search = $this->input->post('search');
        $result = $this->db_model->searchManometer($search);

        if(!empty($result)){
            $data['data']           = $result;
            $data['search input']   = $search;
            $data['status']         = 'success';
            $data['message']        = 'Search data succsess';

        }else {
            $data['data']           = $result;
            $data['search input']   = $search;
            $data['status']         = 'failed null';
            $data['message']        = 'Search data is empty';
        }

    }
    echo json_encode($data);
}

// public function searchManometer() {
//   $this->load->library('form_validation');
//   $this->form_validation->set_rules('id', 'Id', 'trim|required');
//   $this->form_validation->set_rules('id_', 'Id_', 'trim|required|numeric');

//   if($this->form_validation->run() == FALSE) {
//     $search = $this->input->post('id');
//     $data['search input']   = $search;
//     $data['status']='failed';
//     $data['message']='searching is invalid - null data';
// }else{
//     $search = $this->input->post('id');
//     $id_user = $this->input->post('id');

//     $result = $this->db_model->searchManometer($search);
//     $count	= $this->db_model->getAllManometer($id_user);

//     if(!empty($result)){
//         $data['data']           = $result;
//         $data['search input']   = $search;
//         $data['count']   		= $count;
//         $data['status']         = 'success';
//         $data['message']        = 'Search data succsess';

//     }else {
//         $data['data']           = $result;
//         $data['search input']   = $search;
//         $data['count']   		= null;
//         $data['status']         = 'failed';
//         $data['message']        = 'Search data is empty';
//     }

// }
// echo json_encode($data);
// }

public function insertManometer() {
    /*rule upload foto*/
    $config['upload_path']          = './application/uploads/input_manometer/';
    $config['allowed_types']        = 'gif|jpg|png|JPG|PNG|jpeg';
    $config['max_size']             = 2000;

    $this->load->library('upload', $config);
    $this->load->library('form_validation');

    $this->form_validation->set_rules('id_manometer', 'Kode', 'trim|required|min_length[1]');
    $this->form_validation->set_rules('nama_manometer', 'nama','trim|required|min_length[1]');
    $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[1]');
    $this->form_validation->set_rules('kondisi', 'kondisi', 'trim|required|min_length[1]');
    $this->form_validation->set_rules('tekanan', 'tekanan', 'trim|required|min_length[1]');
   // $this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required|min_length[1]');

    if($this->form_validation->run() == FALSE) {
        if ( !$this->upload->do_upload('foto')) {
            $file = array('error' => $this->upload->display_errors());
        } 

        $data['status']        = 'failed';
        $data['message']       ='Gagal Menyimpan data.. Masih ada kolom yang kosong.! ';

    } else {
        $kode     = $this->input->post('id_manometer');
        $upd      = $this->input->post('upd');
        $check    = $this->db_model->getOneManometerByID($kode);//check ID manometer
        if(!empty($check) && $upd == ""){
            $data['status']     = 1;
            $data['message']    = 'Data sudah ada, perbarui?';
            echo json_encode($data);
            exit;
        }
        $upd            = $this->input->post('upd');
        $id_manometer   = $this->input->post('id_manometer');
        $nama_manometer = $this->input->post('nama_manometer');
        $lokasi         = $this->input->post('lokasi');
        $latlng         = $this->input->post('latlng');
        $kondisi        = $this->input->post('kondisi');
        $tekanan        = $this->input->post('tekanan');
        $keterangan     = $this->input->post('keterangan');
        $username       = $this->input->post('username');
        $date           =  date('Y-m-d h:i:s');

        /*upload foto*/
        if ( !$this->upload->do_upload('foto')){
            $file = array('error' => $this->upload->display_errors());
        } else {
            $file = array($this->upload->data('file_name'));
        }
            $foto = implode($file);//file nama foto

            if(!empty($check)){
                $k_manometerInfo    = array(
                  'id_manometer'=>$id_manometer,
                  'nama_manometer'=>$nama_manometer, 
                  'lokasi'=>$lokasi, 
                  'latlng'=>$latlng, 
                  'username'=>$username, 
                  'kondisi'=>$kondisi,
                  'tekanan'=>$tekanan, 
                  'keterangan'=>$keterangan, 
                  'tgl_baca_s'=>$date,


                  'path'=>'http://103.25.210.61:81/purwokerto/application/uploads/input_manometer/'.$foto,
              );
                $result = $this->db_model->updateK_Manometer($k_manometerInfo, $id_manometer);

                if(!empty($result)){
                    $data['data']           = $result;
                    $data['k_manometer']    = $k_manometerInfo;
                    $data['status']         = 'success';
                    $data['message']        = 'Update data succsess';

                }else {
                    $data['data']           = $result;
                    $data['k_manometer']    = $k_manometerInfo;
                    $data['status']         = 'failed';
                    $data['message']        = 'Update data failed';
                }
            } else {
               $k_manometerInfo    = array(
                'id_manometer'=>$id_manometer,
                'nama_manometer'=>$nama_manometer, 
                'lokasi'=>$lokasi, 
                'latlng'=>$latlng, 
                'username'=>$username, 
                'kondisi'=>$kondisi,
                'tekanan'=>$tekanan, 
                'keterangan'=>$keterangan, 
                'tgl_baca_s'=>$date,

                'path'=>'http://103.25.210.61:81/purwokerto/application/uploads/input_manometer/'.$foto,
            );
               $result = $this->db_model->insertK_Manometer($k_manometerInfo);

               if(!empty($result)){
                $data['data']           = $result;
                $data['k_manometer']    = $k_manometerInfo;
                $data['status']         = 'success';
                $data['message']        = 'Insert data succsess';

            }else {
                $data['data']           = $result;
                $data['k_manometer']    = $k_manometerInfo;
                $data['status']         = 'failed';
                $data['message']        = 'Insert data failed';
            }
        }
    }
    echo json_encode($data);
}


public function insertTekananManometer() {
  $this->load->library('form_validation');

  $this->form_validation->set_rules('id_','Id_','trim|required|numeric');
  $this->form_validation->set_rules('username','Username','trim|required|max_length[255]|min_length[1]');
  $this->form_validation->set_rules('id_manometer','Id_manometer','trim|required');
  $this->form_validation->set_rules('merk_mano','Merk_mano','trim|max_length[255]');
  $this->form_validation->set_rules('lokasi','Lokasi','trim|max_length[255]');
  $this->form_validation->set_rules('tgl_pasang','Tgl_pasang','trim');
  $this->form_validation->set_rules('tgl_input','Tgl_input','trim|required');
  $this->form_validation->set_rules('jam_input','Jam_input','trim|required');
  $this->form_validation->set_rules('kondisi','Kondisi','trim|max_length[255]');
  $this->form_validation->set_rules('elevasi','Elevasi','trim|numeric');
  $this->form_validation->set_rules('tekanan','Tekanan','trim|required|numeric');

  if($this->form_validation->run() == FALSE)
  {
     $data['status']='failed';
     $data['message']='Input is invalid - null data';
 }else{
     $id_ 				= $this->input->post('id_');
     $username 			= $this->input->post('username');
     $id_mano 			= $this->input->post('id_manometer');
     $merk_mano 			= $this->input->post('merk_mano');
     $lokasi_mano 		= $this->input->post('lokasi');
     $tgl_pasang_mano 	= $this->input->post('tgl_pasang');
     $tgl_input 			= $this->input->post('tgl_input');
     $jam_input 			= $this->input->post('jam_input');
     $kondisi_mano 		= $this->input->post('kondisi');
     $elevasi_mano 		= $this->input->post('elevasi');
     $tekanan 			= $this->input->post('tekanan');

     $tekanan_mano = array('id_'=>$id_, 'username'=>$username, 'kd_mano'=>$id_mano, 'merk_mano'=>$merk_mano, 'lokasi_mano'=>$lokasi_mano, 'tgl_pasang_mano'=>$tgl_pasang_mano, 'tgl_input'=>$tgl_input, 'jam_input'=>$jam_input, 'kondisi_mano'=>$kondisi_mano, 'elevasi_mano'=>$elevasi_mano, 'tekanan'=>$tekanan);

     $result = $this->db_model->insertTekananManometer($tekanan_mano);

     if(!empty($result))
     {
        $data['data']       	= $result;
        $data['tekanan_mano']   = $tekanan_mano;
        $data['status']     	= 'success';
        $data['message']    	= 'Insert data succsess';
    }else{
        $data['data']       	= $result;
        $data['tekanan_mano']   = $tekanan_mano;
        $data['status']     	= 'success';
        $data['message']    	= 'Insert data succsess';
    }		
}
echo json_encode($data);
}

/*Meter Induk*/
public function searchMeterinduk()
{
  $this->load->library('form_validation');
  $this->form_validation->set_rules('id', 'Id', 'trim|required');
  $this->form_validation->set_rules('id_', 'Id_', 'trim|required|numeric');

  if($this->form_validation->run() == FALSE)
  {
    $search = $this->input->post('id');
    $data['search input']   = $search;
    $data['status']='failed';
    $data['message']='searching is invalid - null data';
}else{
    $search 	= $this->input->post('id');
    $id_user 	= $this->input->post('id_');
    $result 	= $this->db_model->searchMeterInduk($search);
    $count		= $this->db_model->getAllMeterinduk($id_user);

    if(!empty($result)){
        $data['data']           = $result;
        $data['search input']   = $search;
        $data['count']   		= $count;
        $data['status']         = 'success';
        $data['message']        = 'Search data succsess';

    }else {
        $data['data']           = $result;
        $data['search input']   = $search;
        $data['count']   		= $count;
        $data['status']         = 'failed null';
        $data['message']        = 'Search data is empty';
    }

}
echo json_encode($data);
}

public function insertDebitMeterinduk()
{
  $this->load->library('form_validation');

  $this->form_validation->set_rules('id_','Id_','trim|required|numeric');
  $this->form_validation->set_rules('username','Username','trim|required|max_length[255]|min_length[1]');
  $this->form_validation->set_rules('id_meterinduk','Id_meterinduk','trim|required|numeric');
  $this->form_validation->set_rules('merk_meter','Merk_meter','trim|max_length[255]');
  $this->form_validation->set_rules('lokasi','Lokasi','trim|max_length[255]');
  $this->form_validation->set_rules('tgl_pasang','Tgl_pasang','trim');
  $this->form_validation->set_rules('tgl_input','Tgl_input','trim|required');
  $this->form_validation->set_rules('jam_input','Jam_input','trim|required');
  $this->form_validation->set_rules('kondisi','Kondisi','trim|max_length[255]');
  $this->form_validation->set_rules('elevasi','Elevasi','trim|numeric');
  $this->form_validation->set_rules('debit','Debit','trim|required|numeric');

  if($this->form_validation->run() == FALSE)
  {
     $data['status']='failed';
     $data['message']='Input is invalid - null data';
 }else{
     $id_ 				= $this->input->post('id_');
     $username 			= $this->input->post('username');
     $id_meter 			= $this->input->post('id_meterinduk');
     $merk_meter 		= $this->input->post('merk_meter');
     $lokasi_meter 		= $this->input->post('lokasi');
     $tgl_pasang_meter 	= $this->input->post('tgl_pasang');
     $tgl_input 			= $this->input->post('tgl_input');
     $jam_input 			= $this->input->post('jam_input');
     $kondisi_meter 		= $this->input->post('kondisi');
     $elevasi_meter 		= $this->input->post('elevasi');
     $tekanan 			= $this->input->post('debit');

     $debit_meter = array('id_'=>$id_, 'username'=>$username, 'kd_meterinduk'=>$id_meter, 'merk_meterinduk'=>$merk_meter, 'lokasi_meterinduk'=>$lokasi_meter, 'tgl_pasang_meterinduk'=>$tgl_pasang_meter, 'tgl_input'=>$tgl_input, 'jam_input'=>$jam_input, 'kondisi_meterinduk'=>$kondisi_meter, 'elevasi_meterinduk'=>$elevasi_meter, 'debit'=>$tekanan);

     $result = $this->db_model->insertDebitMeterinduk($debit_meter);

     if(!empty($result))
     {
        $data['data']       	= $result;
        $data['debit_meter']   = $debit_meter;
        $data['status']     	= 'success';
        $data['message']    	= 'Insert data succsess';
    }else{
        $data['data']       	= $result;
        $data['debit_meter']   = $debit_meter;
        $data['status']     	= 'success';
        $data['message']    	= 'Insert data succsess';
    }		
}
echo json_encode($data);
}

/*SLider*/
public function getHotNews()
{
  $result = $this->db_model->getNews();
  if(!empty($result)){
    $data = $result;
}else{
 $data = null;
}
echo json_encode($data);
}
public function getTekananMano()
{
  $this->load->library('form_validation');
  $this->form_validation->set_rules('id_mano','Id_mano','trim|required');

  if($this->form_validation->run() == FALSE)
  {
     $data = null;
 }else{
     $kd_mano = $this->input->post('id_mano');

     $result = $this->db_model->getTekananMano($kd_mano);
     if(!empty($result)){
        $data = $result;
    }else{
        $data = null;
    }
}
echo json_encode($data);
}
public function getDebitMeter()
{
  $this->load->library('form_validation');
  $this->form_validation->set_rules('id_meter','Id_meter','trim|required');

  if($this->form_validation->run() == FALSE)
  {
     $data = null;
 }else{
     $id_meter = $this->input->post('id_meter');

     $result = $this->db_model->getDebitMeter($id_meter);
     if(!empty($result)){
        $data = $result;
    }else{
        $data = null;
    }
}
echo json_encode($data);
}
// public function insertAssets()
// {
//     $this->load->library('form_validation');

//     $this->form_validation->set_rules('kategori', 'Kategori', 'trim|required');
//     $this->form_validation->set_rules('sub_kategori', 'Sub_kategori', 'trim|required');
//     $this->form_validation->set_rules('kd_asset', 'Kd_asset', 'trim|required');
//     $this->form_validation->set_rules('nm_asset', 'Nm_asset', 'trim|required');
//     $this->form_validation->set_rules('lokasi', 'Lokasi', 'trim|required');
//     $this->form_validation->set_rules('latlng', 'Latlng', 'trim|required');
//     $this->form_validation->set_rules('keterangan', 'Keterangan', 'trim');

//     if($this->form_validation->run() == FALSE){
//         $data['status']     = 'failed';
//         $data['message']    = 'Input data is invalid';
//     }else{
//         $kategori       = $this->input->post('kategori');
//         $sub_kategori   = $this->input->post('sub_kategori');
//         $kd_asset       = $this->input->post('kd_asset');
//         $nm_asset       = $this->input->post('nm_asset');
//         $lokasi         = $this->input->post('lokasi');
//         $latlng         = $this->input->post('latlng');
//         $keterangan     = $this->input->post('keterangan');
//         date_default_timezone_set("Asia/Jakarta");
//         $tgl_input      = date('Y-m-d');
//         $username       = $this->input->post('username');

//         $check          = $this->db_model->getOneAssetByKode($kd_asset);
//         if($check > 0){
//             $data['status']     = 'failed';
//             $data['message']    = 'Insert data failed - kode asset already exist ';
//         }else{

//             $assetInfo  = array('kategori'=>$kategori, 'sub_kategori'=>$sub_kategori, 'kd_asset'=>$kd_asset, 'nm_asset'=>$nm_asset, 'lokasi'=>$lokasi,'latlng'=>$latlng, 'keterangan'=>$keterangan, 'tgl_input'=>$tgl_input, 'username'=>$username);
//             $result     = $this->db_model->insertAsset($assetInfo);

//             if(!empty($result)){
//                 $data['data']       = $result;
//                 $data['status']     = 'success';
//                 $data['message']    = 'Insert data succsess';

//             }else {
//                 $data['data']       = $result;
//                 $data['status']     = 'failed';
//                 $data['message']    = 'Insert data failed';
//             }
//         }
//     }
//     echo json_encode($data);
// }


}