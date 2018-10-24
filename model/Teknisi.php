<?php
include('Model.php');
class Teknisi extends Model 
{
    public function selectAll()
    {
        return $this->get('m_teknisi');
    }

    public function selectMaxKode()
    {
        $kodeArray = $this->get('m_teknisi',null,'MAX(id) AS kode');
        return $kodeArray[0]['kode'];
    }

    public function insertDB($data)
    {
        return $this->insert('m_teknisi',$data);
    }

    public function updateDB($data,$id)
    {
        return $this->update('m_teknisi',$data,"id='$id'");
    }
}
?>