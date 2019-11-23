<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pengajuan_model extends CI_Model
{

    public function getUsulanDraft()
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
                        id = `msusulan`.`PROSES_USULAN`) as TAHAPAN
                FROM `msusulan`
                WHERE `STATUS` = 99";
        return $this->db->query($query)->result_array();
    }

    public function getUsulanDiajukan()
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
                        id = `msusulan`.`PROSES_USULAN`) as TAHAPAN
                FROM `msusulan`
                WHERE `STATUS` = 100";
        return $this->db->query($query)->result_array();
    }

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
                        id = `msusulan`.`KOMITE_TEKNIS`) as KOMTEK
                FROM `msusulan`
                WHERE `STATUS` = 101";
        return $this->db->query($query)->result_array();
    }

    public function getUsulanDiterima()
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
                WHERE `STATUS` = 102";
        return $this->db->query($query)->result_array();
    }

    public function getUsulanDraftByUser($userid)
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
                        id = `msusulan`.`PROSES_USULAN`) as TAHAPAN
                FROM `msusulan`
                WHERE `STATUS` = 99 AND `USER_INPUT`=$userid";
        return $this->db->query($query)->result_array();
    }

    public function getUsulanDiajukanByUser($userid)
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
                        id = `msusulan`.`PROSES_USULAN`) as TAHAPAN
                FROM `msusulan`
                WHERE `STATUS` = 100 AND `USER_INPUT`=$userid";
        return $this->db->query($query)->result_array();
    }

    public function getUsulanDitolakByUser($userid)
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
                        id = `msusulan`.`PROSES_USULAN`) as TAHAPAN
                FROM `msusulan`
                WHERE `STATUS` = 101 AND `USER_INPUT`=$userid";
        return $this->db->query($query)->result_array();
    }

    public function getUsulanDiterimaByUser($userid)
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
                        id = `msusulan`.`PROSES_USULAN`) as TAHAPAN
                FROM `msusulan`
                WHERE `STATUS` = 102 AND `USER_INPUT`=$userid";
        return $this->db->query($query)->result_array();
    }

    public function getUsulanDraftDetail($id)
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
                WHERE `STATUS` = 99 AND `ID`=$id";
        return $this->db->query($query)->row_array();
    }

    public function getUsulanDetail($id)
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
                WHERE `STATUS` = 100 AND `ID`=$id";
        return $this->db->query($query)->row_array();
    }

    public function getUsulanById($id)
    {
        return $this->db->get_where('msusulan', array('ID' => $id))->row_array();
    }

    public function getEmailByUsulan($id)
    {
        $query = "SELECT `msuserstandar`.EMAIL
        FROM `msusulan`
        JOIN `msuserstandar` ON `msuserstandar`.ID = `msusulan`.USER_INPUT
        WHERE `msusulan`.ID = $id
        ";
        return $this->db->query($query)->row_array();
    }

    public function getPerbaikanById($id)
    {
        return $this->db->get_where('d_perbaikan', array('ID_USULAN' => $id))->row_array();
    }

    public function getJenisStandar()
    {
        return $this->db->get_where('msrev', array('GOLONGAN' => 14))->result_array();
    }

    public function getKomiteTeknis()
    {
        return $this->db->get_where('msrev', array('GOLONGAN' => 15))->result_array();
    }

    public function getJenisPerumusan()
    {
        return $this->db->get_where('msrev', array('GOLONGAN' => 16))->result_array();
    }

    public function getJalurPerumusan()
    {
        return $this->db->get_where('msrev', array('GOLONGAN' => 17))->result_array();
    }

    public function getJenisAdopsi()
    {
        return $this->db->get_where('msrev', array('GOLONGAN' => 18))->result_array();
    }

    public function getMetodeAdopsi()
    {
        return $this->db->get_where('msrev', array('GOLONGAN' => 19))->result_array();
    }

    public function getProsesUsulanSNI()
    {
        return $this->db->get_where('msrev', array('GOLONGAN' => 20))->result_array();
    }

    public function getProsesUsulanSL()
    {
        return $this->db->get_where('msrev', array('GOLONGAN' => 21))->result_array();
    }

    public function getPerumusanSNI()
    {
        return $this->db->get_where('msrev', array('GOLONGAN' => 22))->result_array();
    }

    public function getPerumusanSL()
    {
        return $this->db->get_where('msrev', array('GOLONGAN' => 23))->result_array();
    }

    public function getStatus()
    {
        return $this->db->get_where('msrev', array('GOLONGAN' => 25))->result_array();
    }

    public function getKonseptor()
    {
        return $this->db->get('mskonseptor')->result_array();
    }

    public function getDKonseptorUtama($id)
    {
        return $this->db->get_where('d_konseptor_utama', array('ID_USULAN' => $id))->row_array();
    }

    public function getDKonseptor($id)
    {
        return $this->db->get_where('d_konseptor', array('ID_USULAN' => $id))->result_array();
    }

    public function getDBerkepentingan($id)
    {
        return $this->db->get_where('d_pihak_berkepentingan', array('ID_USULAN' => $id))->result_array();
    }

    public function getDManfaat($id)
    {
        return $this->db->get_where('d_manfaat', array('ID_USULAN' => $id))->result_array();
    }
    public function getDRegulasi($id)
    {
        return $this->db->get_where('d_regulasi', array('ID_USULAN' => $id))->result_array();
    }
    public function getDSNI($id)
    {
        return $this->db->get_where('d_acuan_sni', array('ID_USULAN' => $id))->result_array();
    }
    public function getDNonSNI($id)
    {
        return $this->db->get_where('d_acuan_nonsni', array('ID_USULAN' => $id))->result_array();
    }
    public function getDBibliografi($id)
    {
        return $this->db->get_where('d_bibliografi', array('ID_USULAN' => $id))->result_array();
    }
    public function getDLpk($id)
    {
        return $this->db->get_where('d_lpk', array('ID_USULAN' => $id))->result_array();
    }

    public function getDetailKonseptor($nik)
    {
        return $this->db->get_where('mskonseptor', array('NIK' => $nik))->result();
    }

    public function getInstansiKonseptor($nik)
    {
        return $this->db->get_where('mskonseptor', array('NIK' => $nik))->result();
    }

    public function getDataUser($id)
    {
        return $this->db->get_where('msuserstandar', array('ID' => $id))->row_array();
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
