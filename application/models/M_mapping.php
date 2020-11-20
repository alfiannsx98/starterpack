<?php
class M_mapping extends CI_Model
{

    function edit_mapping($id_cabang, $nama_cabang, $alamat, $status_cabang, $pemilik_cabang, $latitude, $longitude, $keterangan)
    {
        $hsl = $this->db->query("UPDATE cabang SET nama_cabang = '$nama_cabang', alamat = '$alamat', status_cabang = '$status_cabang', pemilik_cabang = '$pemilik_cabang', latitude = '$latitude', longitude = '$longitude', keterangan = '$keterangan' WHERE id_cabang='$id_cabang'");
        return $hsl;
    }
    function hapus_mapping($id)
    {
        $hasil = $this->db->query("DELETE FROM cabang WHERE id_cabang='$id'");
        return $hasil;
    }
    public function detail($id_cabang)
    {
        $this->db->select('*');
        $this->db->from('cabang');
        $this->db->where('id_cabang', $id_cabang);
        return $this->db->get()->row();
    }
}
