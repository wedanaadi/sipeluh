<?php
include("Model.php");
class Keluhan extends Model
{
    public function selectAll()
    {
        $query = "SELECT t_keluhan.*, m_pelanggan.nama, m_kategori_keluhan.`kategori` FROM t_keluhan
                  INNER JOIN m_pelanggan ON (t_keluhan.`id_pelanggan` = m_pelanggan.`id`)
                  INNER JOIN m_kategori_keluhan ON (m_kategori_keluhan.`id` = t_keluhan.`id_kategori`)
                  WHERE status_keluhan = '0'";
        return $this->db_query($query);
    }

    public function getEdit($id)
    {
        $result = $this->get('t_keluhan',"id='$id'");
        return $result[0];
    }

    public function updateDB($id,$data)
    {
        return $this->update('t_keluhan',$data,"id='$id'");
    }

    public function selectteknisi()
    {
        return $this->get('m_teknisi',"status='0'");
        
    }
}
?>