<?php
  /*
   * Base Controller
   * loads the models and views
   */
    class Controller {
      
     // load model
      public function model($model) {
        // Require model file
        require_once '../app/models/' . $model . '.php';
        // Instatiate model
        return new $model;
      }

      // load view
      public function view($view, $data = []) {
        // check for the view file
        if (file_exists('../app/views/'. $view . '.php')) {
          require_once '../app/views/' . $view . '.php';
        } else {
          // view does not exist
          die('View does not exist');
        }
      }
   }