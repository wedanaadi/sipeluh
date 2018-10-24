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
}
?>