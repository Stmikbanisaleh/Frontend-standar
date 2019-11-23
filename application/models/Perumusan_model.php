<?php

defined('BASEPATH') or exit('No direct script access allowed!');

class Perumusan_model extends CI_Model
{
    public function getRumusanSNI()
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
                        id = `msusulan`.`KOMITE_TEKNIS`) as KOMTEK
                FROM `msusulan`
                WHERE `JENIS_STANDAR` = 48 AND `PROSES_PERUMUSAN` != 0";
        return $this->db->query($query)->result_array();
    }

    public function getRumusanSL()
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
                        id = `msusulan`.`KOMITE_TEKNIS`) as KOMTEK
                FROM `msusulan`
                WHERE `JENIS_STANDAR` = 49 AND `PROSES_PERUMUSAN` != 0";
        return $this->db->query($query)->result_array();
    }

    public function getProsesPerumusan($proses)
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
                        id = `msusulan`.`KOMITE_TEKNIS`) as KOMTEK,
                (SELECT 
                        NAMA_REV
                    FROM
                        msrev
                    WHERE
                        id = `msusulan`.`PROSES_PERUMUSAN`) as TAHAPAN
                FROM `msusulan`
                WHERE `PROSES_PERUMUSAN` = $proses";
        return $this->db->query($query)->result_array();
    }

    public function getProsesPerumusanByUser($proses, $userid)
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
                        id = `msusulan`.`KOMITE_TEKNIS`) as KOMTEK,
                (SELECT 
                        NAMA_REV
                    FROM
                        msrev
                    WHERE
                        id = `msusulan`.`PROSES_PERUMUSAN`) as TAHAPAN
                FROM `msusulan`
                WHERE `PROSES_PERUMUSAN` = $proses AND `USER_INPUT` = $userid";
        return $this->db->query($query)->result_array();
    }

    public function getDetail($id)
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
                        id = `msusulan`.`JALUR_PERUMUSAN`) as JALUR_PERUMUSAN,
                (SELECT 
                        NAMA_REV
                    FROM
                        msrev
                    WHERE
                        id = `msusulan`.`KOMITE_TEKNIS`) as KOMTEK,
                (SELECT 
                        NAMA_REV
                    FROM
                        msrev
                    WHERE
                        id = `msusulan`.`PROSES_PERUMUSAN`) as TAHAPAN
                FROM `msusulan`
                WHERE `ID` = $id";
        return $this->db->query($query)->row_array();
    }
}
