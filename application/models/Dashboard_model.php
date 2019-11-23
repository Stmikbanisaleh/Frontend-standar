<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_model extends CI_Model
{

    public function JumlahUsulan()
    {
        $usulan = $this->db->get_where('msusulan', ['STATUS>' => 100])->result_array();
        $jumlah = count($usulan);
        return $jumlah;
    }

    public function JumlahUsulanByUser($userid)
    {
        $usulan = $this->db->get_where('msusulan', ['STATUS>' => 100, 'USER_INPUT' => $userid])->result_array();
        $jumlah = count($usulan);
        return $jumlah;
    }

    public function JumlahSNI()
    {
        $SNI = $this->db->get_where('msusulan', ['STATUS' => 102, 'PROSES_PERUMUSAN' => 89])->result_array();
        $jumlah = count($SNI);
        return $jumlah;
    }

    public function JumlahSNIByUser($userid)
    {
        $SNI = $this->db->get_where('msusulan', ['STATUS' => 102, 'PROSES_PERUMUSAN' => 89, 'USER_INPUT' => $userid])->result_array();
        $jumlah = count($SNI);
        return $jumlah;
    }

    public function JumlahSL()
    {
        $SL = $this->db->get_where('msusulan', ['STATUS' => 102, 'PROSES_PERUMUSAN' => 95])->result_array();
        $jumlah = count($SL);
        return $jumlah;
    }

    public function JumlahSLByUser($userid)
    {
        $SL = $this->db->get_where('msusulan', ['STATUS' => 102, 'PROSES_PERUMUSAN' => 95, 'USER_INPUT' => $userid])->result_array();
        $jumlah = count($SL);
        return $jumlah;
    }

    public function JumlahPNPS()
    {
        $SL = $this->db->get_where('msusulan', ['STATUS' => 102, 'PROSES_PERUMUSAN' => 80])->result_array();
        $jumlah = count($SL);
        return $jumlah;
    }

    public function JumlahPNPSByUser($userid)
    {
        $SL = $this->db->get_where('msusulan', ['STATUS' => 102, 'PROSES_PERUMUSAN' => 80, 'USER_INPUT' => $userid])->result_array();
        $jumlah = count($SL);
        return $jumlah;
    }

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

    public function getRumusanSNIByUser($userid)
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
                WHERE `JENIS_STANDAR` = 48 AND `PROSES_PERUMUSAN` != 0 AND `USER_INPUT` = $userid";
        return $this->db->query($query)->result_array();
    }

    public function getRumusanSLByUser($userid)
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
                WHERE `JENIS_STANDAR` = 49 AND `PROSES_PERUMUSAN` != 0 AND `USER_INPUT` = $userid";
        return $this->db->query($query)->result_array();
    }

    public function getSNI()
    {
        $query = "SELECT `msusulan`.*,
                (SELECT 
                        NAMA_REV
                    FROM
                        msrev
                    WHERE
                        id = `msusulan`.`KOMITE_TEKNIS`) as KOMTEK
                FROM `msusulan`
                WHERE `JENIS_STANDAR` = 48 AND `PROSES_PERUMUSAN` = 89";
        return $this->db->query($query)->result_array();
    }

    public function getSNIByUser($userid)
    {
        $query = "SELECT `msusulan`.*,
                (SELECT 
                        NAMA_REV
                    FROM
                        msrev
                    WHERE
                        id = `msusulan`.`KOMITE_TEKNIS`) as KOMTEK
                FROM `msusulan`
                WHERE `JENIS_STANDAR` = 48 AND `PROSES_PERUMUSAN` = 89 AND `USER_INPUT` = $userid";
        return $this->db->query($query)->result_array();
    }
    public function getSL()
    {
        $query = "SELECT `msusulan`.*,
                (SELECT 
                        NAMA_REV
                    FROM
                        msrev
                    WHERE
                        id = `msusulan`.`KOMITE_TEKNIS`) as KOMTEK
                FROM `msusulan`
                WHERE `JENIS_STANDAR` = 49 AND `PROSES_PERUMUSAN` =95";
        return $this->db->query($query)->result_array();
    }

    public function getSLByUser($userid)
    {
        $query = "SELECT `msusulan`.*,
                (SELECT 
                        NAMA_REV
                    FROM
                        msrev
                    WHERE
                        id = `msusulan`.`KOMITE_TEKNIS`) as KOMTEK
                FROM `msusulan`
                WHERE `JENIS_STANDAR` = 49 AND `PROSES_PERUMUSAN` = 95 AND `USER_INPUT` = $userid";
        return $this->db->query($query)->result_array();
    }
}
