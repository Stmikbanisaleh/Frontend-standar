
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    public function getUserRole()
    {
        $query = "SELECT `msuserstandar`.*,`msrev`.*
        FROM `msuserstandar` JOIN `msrev`
        ON `msuserstandar`.`role_id` = `msrev`.`id`";
        return $this->db->query($query)->result_array();
    }

    public function getUserById($id)
    {
        $query = "SELECT `msuserstandar`.*,`msrev`.*
        FROM `msuserstandar` JOIN `msrev`
        ON `msuserstandar`.`role_id` = `msrev`.`id`
        WHERE `msuserstandar`.`id` =" . $id;
        return $this->db->query($query)->row_array();
    }

    public function getUserRoleAndStatus()
    {
        $query = "SELECT `msuserstandar`.*,
                    (SELECT 
                            NAMA_REV
                        FROM
                            msrev
                        WHERE
                            id = `msuserstandar`.`role_id`) as role,
                    (SELECT 
                            NAMA_REV
                        FROM
                            msrev
                        WHERE
                            id = `msuserstandar`.`is_active`) as status
                FROM msuserstandar";
        return $this->db->query($query)->result_array();
    }
}
