<?php
include("Model.php");
class KategoriKeluhan extends Model 
{
    public function selectAll()
    {
        return $this->get('m_kategori_keluhan');
    }

    public function insertDB($data)
    {
        return $this->insert('m_kategori_keluhan',$data);
    }

    public function updateDB($data,$id)
    {
        return $this->update('m_kategori_keluhan',$data,"id='$id'");
    }
}
?>