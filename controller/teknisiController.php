<?php
include("model/Teknisi.php");
class teknisiController
{
    public $model;

    public function __construct()
    {
        $this->model = new Teknisi();
    }

    public function index()
    {
        $teknisi = $this->model->selectAll();
        include('view/teknisi/view.php');
    }

    public function create()
    {
        $idOtomatis = $this->model->selectMaxKode();
        include("view/teknisi/view_add.php");
    }

    function __destruct(){
    }
}
?>