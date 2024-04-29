<?php
/*
   * App Core Class
   * Creates URL & loads core controller
   * URL FORMAT - /controller/method/params
   */
class Core
{
  protected $currentController = 'Pages';
  protected $currentMethod = 'index';
  protected $params = [];

  public function __construct()
  {
    //print_r($this->getUrl());

    $url = $this->getUrl();

    // Check if URL is empty (root page)
    if (empty($url)) {
      require_once '../app/controllers/' . $this->currentController . '.php';

      // Instantiate controller class
      $this->currentController = new $this->currentController;
      // Call the default method
      call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
      return;
    }

    // Look in controllers for first value
    if (isset($url[0]) && file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) {
      // If exists, set as controller
      $this->currentController = ucwords($url[0]);
      // Unset 0 Index
      unset($url[0]);
    } else {
      // Controller doesn't exist, redirect to 404 page
      header("Location: /404.html");
      exit();
    }

    // Require the controller
    require_once '../app/controllers/' . $this->currentController . '.php';

    // Instantiate controller class
    $this->currentController = new $this->currentController;

    // Check for second part of url
    if (isset($url[1])) {
      // Check to see if method exists in controller and is public
      $reflectionClass = new ReflectionClass($this->currentController);
      if ($reflectionClass->hasMethod($url[1]) && $reflectionClass->getMethod($url[1])->isPublic()) {
        $this->currentMethod = $url[1];
        // Unset 1 index
        unset($url[1]);
      } else {
        // Method doesn't exist or is not public, redirect to 404 page
        header("Location: /404.html");
        exit();
      }
    }

    // Get params
    $this->params = $url ? array_values($url) : [];

    // Call a callback with array of params
    call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
  }

  public function getUrl()
  {
    if (isset($_GET['url'])) {
      $url = rtrim($_GET['url'], '/');
      str_replace('\/', ' ', filter_var(str_replace(' ', '\/', $url), FILTER_SANITIZE_URL));
      $url = explode('/', $url);
      return $url;
    }
  }
}
