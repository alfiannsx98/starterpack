<?php
class model_menu extends CI_Model
{

    function edit_menu($id, $menu, $icon)
    {
        $hsl = $this->db->query("UPDATE user_menu SET menu ='$menu', icon='$icon' WHERE id_menu='$id'");
        return $hsl;
    }
    function hapus_menu($id)
    {
        $hasil = $this->db->query("DELETE FROM user_menu WHERE id_menu='$id'");
        return $hasil;
    }
    function edit_submenu($id, $menu_id, $title,  $url, $is_active)
    {
        $hasilSubmenu = $this->db->query("UPDATE submenu_user SET menu_id='$menu_id', title='$title',  url='$url', is_active='$is_active' WHERE id_submenu='$id' ");
        return $hasilSubmenu;
    }
    function hapus_submenu($id)
    {
        $hasilSubMenu1 = $this->db->query("DELETE FROM submenu_user WHERE id_submenu='$id'");
        return $hasilSubMenu1;
    }
    public function getSubMenu()
    {
        $query = "SELECT `submenu_user`.*,`user_menu`.`menu`
            FROM `submenu_user` JOIN `user_menu`
            ON `submenu_user`.`menu_id` = `user_menu`.`id_menu`
        ";
        return    $this->db->query($query)->result_array();
    }
}
