<?php
  class Pages extends Controller {
    public function __construct(){
     
    }
    
    public function index(){
      $data = [
        'style' => 'home/style.css',
        'title' => 'Home'
      ];
     
      $this->view('home/index', $data);
    }

    public function phpinfo(){
      $this->view('pages/info');
    }

    public function about(){
      $data = [
        'title' => 'About Us'
      ];

      $this->view('pages/about', $data);
    }
  }