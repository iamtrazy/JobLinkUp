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


    public function aboutus(){
      $data = [
        'style' => 'about/about.css',
        'title' => 'About',
        'header_title'=>'About us',
      ];
     
      $this->view('aboutus/about', $data);
    }
    public function contactus(){
      $data = [
        'style' => 'contactus/contactus.css',
        'title' => 'Contact',
        'header_title'=>'Contact us',
      ];
     
      $this->view('contactus/contactus', $data);
    }
  }