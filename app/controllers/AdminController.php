<?php


    class AdminController extends Controller
    {
       
    public function __construct() {

        if(!isLoggedIn()) {
            redirect('login');
         }

    }
       public function index()
       {
         
          $data = [
              'title' => 'PHP MVC Framework admin',
              'description' => 'Simple social network built using PHP/MVC.'
          ];
          $this->view('admin/index', $data);
       }

    }
