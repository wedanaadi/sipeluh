<?php
include("Model.php");
class User extends Model 
{
    public function selectAll()
    {
        $sql = "SELECT m_user.*, nama_hak_akses FROM m_user ";
        $sql .= "INNER JOIN m_hak_akses ON(m_hak_akses.id = m_user.hak_akses)";
        return $this->db_query($sql);
    }

    public function getHakAkses($where = null)
    {
        return $this->get("m_hak_akses", $where);
    }

    public function getTeknisi()
    {
        return $this->get("m_teknisi");
    }

    public function cek_same_username($username)
    {
        return count($this->get('m_user',"username = '$username'"));
    }

    public function cek_idbiodata_teknisi($id)
    {
        return count($this->get('m_user',"id_biodata = '$id'"));
    }

    public function insertDB($data)
    {
        return $this->insert('m_user',$data);
    }

    public function findBy($id)
    {
        return $this->get('m_user',$id);
    }

    public function updateDB($data,$id)
    {
        return $this->update('m_user',$data,"id='$id'");
    }
}
?>