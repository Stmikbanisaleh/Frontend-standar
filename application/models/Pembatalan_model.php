<?php

defined('BASEPATH') or exit('No direct scriptz access allowed!');

class Pembatalan_model extends CI_Model
{
    public function getUsulanDitolak()
    {
        $query = "SELECT `msusulan`.*,(SELECT 
                        NAMA_REV
                    FROM
                        msrev
                    WHERE
                        id = `msusulan`.`JENIS_PERUMUSAN`) as JENIS_PERUMUSAN,
                (SELECT 
                        NAMA_REV
                    FROM
                        msrev
                    WHERE
                        id = `msusulan`.`PROSES_USULAN`) as TAHAPAN
                FROM `msusulan`
                WHERE `STATUS` = 101";
        return $this->db->query($query)->result_array();
    }

    public function getUsulan()
    {
        return $this->db->get_where('msusulan', ['STATUS' => 100])->result_array();
    }
}
