<?php
include('Model.php');
class Teknisi extends Model 
{
    public function selectAll()
    {
        return $this->get('m_teknisi','status != 0');
    }
}
?>