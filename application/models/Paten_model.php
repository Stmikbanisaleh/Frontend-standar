<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Paten_model extends CI_Model
{
    public function getPatenDraft()
    {
        $user = $this->db->get_where('msuser', ['email' =>
        $this->session->userdata('email')])->row_array();
        $userid = $user['id'];
        $role = $user['role_id'];
        if ($role == 18) {
            $query = "SELECT `mspaten`.*,`msrev`.`NAMA_REV`
            FROM `msrev` 
            JOIN `mspaten` ON `msrev`.`ID` = `mspaten`.`UNIT_KERJA`
            WHERE `mspaten`.`status` = 19 AND `mspaten`.`KODE_INPUT` =$userid";
            return $this->db->query($query)->result_array();
        } else {
            $query = "SELECT `mspaten`.*,`msrev`.`NAMA_REV`
            FROM `msrev` 
            JOIN `mspaten` ON `msrev`.`ID` = `mspaten`.`UNIT_KERJA`
            WHERE `mspaten`.`status` = 19";
            return $this->db->query($query)->result_array();
        }
    }

    public function getPatenDiajukan()
    {
        $user = $this->db->get_where('msuser', ['email' =>
        $this->session->userdata('email')])->row_array();
        $userid = $user['id'];
        $role = $user['role_id'];
        if ($role == 18) {
            $query = "SELECT `mspaten`.*,`msrev`.`NAMA_REV`
            FROM `msrev` 
            JOIN `mspaten` ON `msrev`.`ID` = `mspaten`.`UNIT_KERJA`
            WHERE `mspaten`.`status` = 20 AND `mspaten`.`KODE_INPUT` =$userid";
            return $this->db->query($query)->result_array();
        } else {
            $query = "SELECT `mspaten`.*,`msrev`.`NAMA_REV`
            FROM `msrev` 
            JOIN `mspaten` ON `msrev`.`ID` = `mspaten`.`UNIT_KERJA`
            WHERE `mspaten`.`status` = 20";
            return $this->db->query($query)->result_array();
        }
    }

    public function getExportDiajukan()
    {
        $query = "SELECT `mspaten`.*,(SELECT 
                                                NAMA_REV
                                            FROM
                                                msrev
                                            WHERE
                                                id = `mspaten`.`UNIT_KERJA`) as UNIT_KERJA,
                                        (SELECT 
                                                NAMA_REV
                                            FROM
                                                msrev
                                            WHERE
                                                id = `mspaten`.`STATUS`) as STATUS
                FROM `mspaten`
                WHERE `status` = 20";
        return $this->db->query($query)->result_array();
    }

    public function getPatenDisetujui()
    {
        $user = $this->db->get_where('msuser', ['email' =>
        $this->session->userdata('email')])->row_array();
        $userid = $user['id'];
        $role = $user['role_id'];
        if ($role == 18) {
            $query = "SELECT `mspaten`.*,`msrev`.`NAMA_REV`
            FROM `msrev` 
            JOIN `mspaten` ON `msrev`.`ID` = `mspaten`.`UNIT_KERJA`
            WHERE `mspaten`.`status` = 21 AND `mspaten`.`KODE_INPUT` =$userid";
            return $this->db->query($query)->result_array();
        } else {
            $query = "SELECT `mspaten`.*,`msrev`.`NAMA_REV`
            FROM `msrev` 
            JOIN `mspaten` ON `msrev`.`ID` = `mspaten`.`UNIT_KERJA`
            WHERE `mspaten`.`status` = 21";
            return $this->db->query($query)->result_array();
        }
    }

    public function getPatenDitolak()
    {
        $user = $this->db->get_where('msuser', ['email' =>
        $this->session->userdata('email')])->row_array();
        $userid = $user['id'];
        $role = $user['role_id'];
        if ($role == 18) {
            $query = "SELECT `mspaten`.*,`msrev`.`NAMA_REV`
            FROM `msrev` 
            JOIN `mspaten` ON `msrev`.`ID` = `mspaten`.`UNIT_KERJA`
            WHERE `mspaten`.`status` = 22 AND `mspaten`.`KODE_INPUT` =$userid";
            return $this->db->query($query)->result_array();
        } else {
            $query = "SELECT `mspaten`.*,`msrev`.`NAMA_REV`
            FROM `msrev` 
            JOIN `mspaten` ON `msrev`.`ID` = `mspaten`.`UNIT_KERJA`
            WHERE `mspaten`.`status` = 22";
            return $this->db->query($query)->result_array();
        }
    }

    public function getPatenDitangguhkan()
    {

        $user = $this->db->get_where('msuser', ['email' =>
        $this->session->userdata('email')])->row_array();
        $userid = $user['id'];
        $role = $user['role_id'];
        if ($role == 18) {
            $query = "SELECT `mspaten`.*,`msrev`.`NAMA_REV`
            FROM `msrev` 
            JOIN `mspaten` ON `msrev`.`ID` = `mspaten`.`UNIT_KERJA`
            WHERE `mspaten`.`status` = 23 AND `mspaten`.`KODE_INPUT` =$userid";
            return $this->db->query($query)->result_array();
        } else {
            $query = "SELECT `mspaten`.*,`msrev`.`NAMA_REV`
            FROM `msrev` 
            JOIN `mspaten` ON `msrev`.`ID` = `mspaten`.`UNIT_KERJA`
            WHERE `mspaten`.`status` = 23";
            return $this->db->query($query)->result_array();
        }
    }

    public function getPatenDraftDetail($id)
    {
        $query = "SELECT `mspaten`.*,`dpaten`.*, `mspegawai`.*
        FROM `mspaten` 
        JOIN `dpaten` ON `mspaten`.`ID` = `dpaten`.`ID_PATEN`
        JOIN `mspegawai` ON `dpaten`.`NIK` = `mspegawai`.`NIK`
        WHERE `mspaten`.`ID` = $id";
        return $this->db->query($query)->row_array();
    }

    public function getPatenDiajukanDetail($id)
    {
        $query = "SELECT `mspaten`.*,(SELECT 
                        NAMA_REV
                    FROM
                        msrev
                    WHERE
                        id = `mspaten`.`JENIS_PATEN`) as JENISPATEN,
                        (SELECT 
                        NAMA_REV
                    FROM
                        msrev
                    WHERE
                        id = `mspaten`.`UNIT_KERJA`) as UNITKERJA
        FROM `mspaten`
        WHERE `mspaten`.`status` = 20
        AND `mspaten`.`ID` = $id";
        return $this->db->query($query)->row_array();
    }

    public function getAllInventor()
    {
        $query = "SELECT DISTINCT `dpaten`.*,`mspegawai`.`NIK`,`mspegawai`.`NAMA`
        FROM `dpaten`
        JOIN `mspegawai` ON `dpaten`.`NIK` = `mspegawai`.`NIK`
        UNION
        SELECT DISTINCT `dpaten`.*,`msnonpegawai`.`NIK`,`msnonpegawai`.`NAMA`
        FROM `dpaten`
        JOIN `msnonpegawai` ON `dpaten`.`NIK` = `msnonpegawai`.`NIK`
        ";
        return $this->db->query($query)->result_array();
    }

    public function getInventor()
    {
        $query = "SELECT DISTINCT `dpaten`.*,`mspegawai`.`NIK`,`mspegawai`.`NAMA`
        FROM `dpaten`
        JOIN `mspegawai` ON `dpaten`.`NIK` = `mspegawai`.`NIK`
        ";
        return $this->db->query($query)->result_array();
    }

    public function getInventorNon()
    {
        $query = "SELECT DISTINCT `dpaten`.*,`msnonpegawai`.`NIK`,`msnonpegawai`.`NAMA`
        FROM `dpaten`
        JOIN `msnonpegawai` ON `dpaten`.`NIK` = `msnonpegawai`.`NIK`
        ";
        return $this->db->query($query)->result_array();
    }

    public function getInventorById($id)
    {
        $query = "SELECT DISTINCT * FROM `dpaten`
        WHERE `dpaten`.`ID_PATEN` = $id";
        return $this->db->query($query)->result_array();
    }

    public function getInventorExport($id)
    {
        $query = "SELECT  `dpaten`.*,`mspegawai`.`NIK`,`mspegawai`.`NAMA`
        FROM `dpaten`
        JOIN `mspegawai` ON `dpaten`.`NIK` = `mspegawai`.`NIK`
        WHERE `dpaten`.ID_PATEN = $id
        UNION
        SELECT  `dpaten`.*,`msnonpegawai`.`NIK`,`msnonpegawai`.`NAMA`
        FROM `dpaten`
        JOIN `msnonpegawai` ON `dpaten`.`NIK` = `msnonpegawai`.`NIK`
        WHERE `dpaten`.ID_PATEN = $id";
        return $this->db->query($query)->result_array();
    }

    public function getIpmancode($jenis)
    {
        $query = $this->db->query("SELECT KODE,ID_JENIS,NO_URUT FROM msipmancode WHERE ID_JENIS = '" . $jenis . "'");
        $kode = $query->row()->KODE;
        $nourut = sprintf('%04d', $query->row()->NO_URUT);
        $ipm = $kode . '_' . $nourut;

        return $ipm;
    }

    public function getCodePb()
    {
        $query = $this->db->query("SELECT KODE,NO_URUT FROM msipmancode WHERE ID_JENIS = 24");
        $kode = $query->row()->KODE;
        $nourut = sprintf('%04d', $query->row()->NO_URUT);
        $ipm = $kode . '_' . $nourut;
        return $ipm;
    }

    public function getCodePs()
    {
        $query = $this->db->query("SELECT KODE,NO_URUT FROM msipmancode WHERE ID_JENIS = 25");
        $kode = $query->row()->KODE;
        $nourut = sprintf('%04d', $query->row()->NO_URUT);
        $ipm = $kode . '_' . $nourut;
        return $ipm;
    }

    public function getDokumen($code)
    {
        $query = "SELECT `msdokumen`.*,`msjenisdokumen`.*,`msjenisdokumen`.`ID`
        FROM `msdokumen`
        JOIN `msjenisdokumen` ON `msdokumen`.`JENIS_DOKUMEN` = `msjenisdokumen`.`ID`
        WHERE `msdokumen`.`NOMOR_PENDAFTAR` = '$code' AND `msdokumen`.`ROLE` = 1";
        return $this->db->query($query)->result_array();
    }

    public function getDokumenVer($code)
    {
        $query = "SELECT `msdokumen`.*,`msjenisdokumen`.*,`msjenisdokumen`.`ID`
        FROM `msdokumen`
        JOIN `msjenisdokumen` ON `msdokumen`.`JENIS_DOKUMEN` = `msjenisdokumen`.`ID`
        WHERE `msdokumen`.`NOMOR_PENDAFTAR` = '$code' AND `msdokumen`.`ROLE` = 2";
        return $this->db->query($query)->result_array();
    }
}
