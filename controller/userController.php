<?php
include("model/User.php");
class userController
{
    public $model;

    public function __construct()
    {
        $this->model = new User();
    }

    public function index()
    {
        $user = $this->model->selectAll();
        print_r($user);
    }
}
?>