<?php
include('Model.php');
class Teknisi extends Model 
{
    public function selectAll()
    {
        return $this->get('m_teknisi','status != 0');
    }

    public function selectMaxKode()
    {
        $kodeArray = $this->get('m_teknisi',null,'MAX(id) AS kode');
        return $kodeArray[0]['kode'];
    }
}
?>