<?php


    class AdminController extends Controller
    {

    public function __construct() {

        if(!isLoggedIn()) {
            redirect('auth/login');
         }
         if(isLoggedIn() && $_SESSION['role'] !== 'admin') {
           redirect('');
         }

         $this->userModel = $this->model('User');

    }
       public function index()
       {

          $data = [
              'title' => 'PHP MVC Framework admin',
              'description' => 'Simple social network built using PHP/MVC.'
          ];
          $this->view('admin/home', $data);
       }

       public function users()
       {
         $data['users'] = $this->userModel->getUsers();

         $this->view('users/list', $data);
       }

    }
