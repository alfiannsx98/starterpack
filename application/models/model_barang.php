<?php
class model_barang extends CI_Model
{

    function edit_barang($id_brg, $nama_brg, $id_ktg, $harga_brg, $stok_brg)
    {
        $hsl = $this->db->query("UPDATE dt_brg SET nama_brg ='$nama_brg', id_ktg='$id_ktg', harga_brg='$harga_brg', stok='$stok_brg' WHERE id_brg='$id_brg'");
        return $hsl;
    }
    function hapus_barang($id_brg)
    {
        $hasil = $this->db->query("DELETE FROM dt_brg WHERE id_brg='$id_brg'");
        return $hasil;
    }
    function get_barang()   
    {
        $query = "SELECT `dt_brg`.*, `kategori`.`kategori`
            FROM `dt_brg` JOIN `kategori`
            ON `dt_brg`.`id_ktg` = `kategori`.`id_kategori`
        ";
        return $this->db->query($query)->result_array();
    }
    function hapus_kategori($id_kategori)
    {
        $hasil = $this->db->query("DELETE FROM kategori WHERE id_kategori='$id_kategori'");
        return $hasil;
    }
}
