<?php


    class HomeController extends Controller
    {

       public function index()
       {
          $data = [
              'title' => 'PHP MVC Framework',
              'description' => 'Simple social network built using PHP/MVC.'
          ];
          $this->view('home/index', $data);
       }

    }
