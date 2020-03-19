<?php

class M_api extends CI_Model
{
    public function getApiKuk()
    {
        $kuk = $this->db->get('tb_master_kuk')->result_array();
        return $json = json_encode($kuk);
    }
}
