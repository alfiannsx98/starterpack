<?php
class M_user extends CI_Model
{
    function edit_user($id)
    {
        $data = array(

        );
        $this->db->where('id_user', $id);
        $this->db->update('user', $data);
    }

    function select_user()
    {
        $query = "SELECT `user`.*, `user_role`.`role`
        FROM `user` JOIN `user_role`
        ON `user`.`role_id` = `user_role`.`id_role`
        ";
        return $this->db->query($query)->result_array();
    }

    function status($id, $status)
    {
        $data = array(
            'is_active' => $status
        );
        $this->db->where('id_user', $id);
        $this->db->update('user', $data);
    }
}