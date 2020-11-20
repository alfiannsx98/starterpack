<?php

class model_auth extends CI_Model
{
    function hapus_token($email)
    {
        $hasil = $this->db->query("DELETE FROM token_user WHERE email='$email'");
        return $hasil;
    }
}

?>