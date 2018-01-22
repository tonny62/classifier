<?php
  require('functions.php');
  session_start();
  session_destroy();
  if (isset($_GET['code'])) {
    if($_GET['code'] == 'skip'){
      markCategory($_GET['id'],'skip');
      header('Location: index.php');
    }
  }else{
    header('Location: index.php');
  }
 ?>
