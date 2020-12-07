<?php


    class AuthController extends Controller
    {
       
    public function __construct() {

        $this->userModel = $this->model('User');
    }
       public function login()
       {
          $this->view('users/login');
       }

       public function register()
       {
          var_dump($_POST['name']);
          $this->view('users/register');
       }

    }
