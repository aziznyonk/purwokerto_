<?php

class CabangModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->eo = $this->load->database("eo", true);
    }
    function showAll()
    {
        $result = $this->eo
            ->select("organization.org_code, organization.org_name")
            ->from("organization")
            ->where("LENGTH(organization.org_code)", 2)
            ->like(["organization.org_code" => 'C'])
            ->get()
            ->result();
        return $result;
        // return $result;
    }
}
