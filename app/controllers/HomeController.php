<?php


    class HomeController extends Controller
    {

      public function __construct()

      {
        $this->userModel = $this->model('User');
        $this->productModel = $this->model('Product');
      }

       public function index()
       {
          $data['products'] = $this->productModel->getProducts(6);

          $this->view('home/index', $data);
       }

    }
