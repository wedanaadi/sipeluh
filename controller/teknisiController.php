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

    function __destruct(){
    }
}
?>