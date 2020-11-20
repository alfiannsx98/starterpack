<?php

class model_admin extends CI_Model
{
    function edit_role($id, $role)
    {
        $hsl = $this->db->query("UPDATE user_role SET role ='$role' WHERE id_role='$id'");
        return $hsl;
    }
    function hapus_role($id)
    {
        $hasil = $this->db->query("DELETE FROM user_role WHERE id_role='$id'");
        return $hasil;
    }
}

?>