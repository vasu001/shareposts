<!-- Require all the necessary files [like libraries] we need -->

<?php

  // Load Config
  require_once 'config/config.php';

  // Load helper functions
  require_once 'helpers/url_helper.php';
  require_once 'helpers/session_helper.php';

  // Load Libraries
  // Autoload Core Libraries from Libraries Folder
  spl_autoload_register(function($className){
    require_once 'libraries/' . $className .'.php';
  });

  $init = new Core;
