<?php

  function redirect($page) {
    header('Location: '. URLROOT . '/' . $page);
  }