<?php
    include('Model.php');
    class Pelanggan extends Model {

        public function selectAll()
        {
            return $this->get('m_pelanggan');
        }

        public function selectMaxKode()
        {
            $kodeArray = $this->get('m_pelanggan',null,'MAX(id) AS kode');
            return $kodeArray[0]['kode'];
        }

        public function insertDB($data)
        {
            return $this->insert('m_pelanggan',$data);
        }

        public function updateDB($id,$data)
        {
            return $this->update('m_pelanggan',$data,"id='$id'");
        }
    }
?>