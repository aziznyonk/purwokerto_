<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model{
  
   function loginMe($username, $password) {
        $this->db->select('BaseTbl.ID, BaseTbl.name, BaseTbl.username, BaseTbl.password, BaseTbl.id_role', 'JoinTbl.role');
        $this->db->from('admin as BaseTbl');
        $this->db->join('role as JoinTbl', 'BaseTbl.id_role=JoinTbl.ID', 'left');
        $this->db->where('BaseTbl.username', $username);
        $query = $this->db->get();

        $admin = $query->row();

        if(!empty($admin)){
            if(md5($password, $admin->password)){
                return $admin;
            } else {
                return array();
            }
        } else {
            return array();
        }
    } 
	
	 /*
	 function loginMe($username, $password) {
        $this->eo->select('BaseTbl.user_id, BaseTbl.username, BaseTbl.p_gis');
        $this->eo->from('sys_user as BaseTbl');
       // $this->eo->join('role as JoinTbl', 'BaseTbl.id_role=JoinTbl.ID', 'left');
        $this->eo->where('BaseTbl.username', $username);
        $query = $this->eo->get();

        $admin = $query->row();

        if(!empty($admin)){
            //if($password, $admin->password){
            if($admin->password){
                return $admin;
            } else {
                return array();
            }
        } else {
            return array();
        }
    }*/
}