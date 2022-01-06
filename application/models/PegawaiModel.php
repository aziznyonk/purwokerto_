<?php

class PegawaiModel extends CI_Model
{
    protected $select = "employee.emp_code AS nipam,
                        emp_profile.emp_name AS nama,
                        position.pos_id AS pos_id,
                        position.pos_parent AS pos_parent,
                        organization.org_code,
                        organization.org_name AS org_name";
    protected $table = "employee";
    protected $joinProfile = "emp_profile.emp_profile_id = employee.emp_profile_id";
    protected $joinPosition = "position.pos_id = employee.emp_pos_id";
    protected $joinOrganization = "position.pos_org_id = organization.org_id";
    protected $joinSysUser = "sys_user.user_login = employee.emp_code";

    function __construct()
    {
        parent::__construct();
        $this->eo = $this->load->database('eo', true);
    }

    public function cari($org_code = null)
    {
        $result = $this->eo
            ->select($this->select)
            ->from($this->table)
            ->join('emp_profile', $this->joinProfile)
            ->join('position', $this->joinPosition)
            ->join('organization', $this->joinOrganization)
            ->join('sys_user', $this->joinSysUser)
            ->where('organization.org_code', $org_code . ".4")
            ->where('employee.emp_work_status', 6)
            ->order_by('position.pos_level', 'ASC')
            ->order_by('emp_profile.emp_name', 'ASC')
            ->get()
            ->result();
        // ->get_compiled_select();
        // echo $this->eo->last_query();
        return $result;
    }
}
