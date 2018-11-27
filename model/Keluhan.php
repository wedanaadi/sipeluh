<?php
include("Model.php");
class Keluhan extends Model
{
    public function selectAll($hk_session, $id_session)
    {
        $query = "SELECT t_keluhan.*, m_pelanggan.nama, m_kategori_keluhan.`kategori` FROM t_keluhan
                  INNER JOIN m_pelanggan ON (t_keluhan.`id_pelanggan` = m_pelanggan.`id`)
                  INNER JOIN m_kategori_keluhan ON (m_kategori_keluhan.`id` = t_keluhan.`id_kategori`)
                  WHERE status_keluhan = '0'";
        if($hk_session == 3)
        {
            $query .= " AND id_user = '$id_session'";
        }
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

    public function laporandata()
    {
      $sql = "SELECT `t_keluhan`.`nama_keluhan`, DATE_FORMAT(`tanggal_pencatatan`, '%d/%m/%Y') AS tanggal_pencatatan,
              `m_pelanggan`.`nama`, `m_kategori_keluhan`.`kategori`, `m_teknisi`.`nama_teknisi`,
              DATE_FORMAT(`tanggal_manajemen`, '%d/%m/%Y') AS tanggal_manajemen, `t_keluhan_manajemen`.`status`
              FROM `t_keluhan_manajemen`
              INNER JOIN `t_keluhan` ON `t_keluhan`.`id` = `t_keluhan_manajemen`.`id_keluhan`
              INNER JOIN m_teknisi ON `m_teknisi`.`id` = `t_keluhan_manajemen`.`id_teknisi`
              INNER JOIN m_pelanggan ON `m_pelanggan`.`id` = `t_keluhan`.`id_pelanggan`
              INNER JOIN `m_kategori_keluhan` ON `m_kategori_keluhan`.`id` = `t_keluhan`.`id_kategori`
              ORDER BY  `t_keluhan_manajemen`.`tanggal_manajemen` DESC";
      return $this->db_query($sql);
    }
}
?>
