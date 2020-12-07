<?php


    class HomeController extends Controller
    {

       public function index()
       {
          if( isLoggedIn() ) {
             redirect('posts');
          }
          $data = [
              'title' => 'PHP MVC Framework',
              'description' => 'Simple social network built using PHP/MVC.'
          ];
          $this->view('pages/index', $data);
       }

    }
