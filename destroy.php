<?php
  require('functions.php');
  session_start();
  session_destroy();
  if (isset($_GET['code'])) {
    if($_GET['code'] == 'skip'){
      // original skip
      markCategory($_GET['id'],'skip');
      header('Location: index.php');
    }elseif($_GET['code'] == 'stem'){
      // stem occupation
      markCategory($_GET['id'],'stem');
      header('Location: index.php');
    }elseif($_GET['code'] == 'other'){
      // other
      markCategory($_GET['id'],'Other');
      header('Location: index.php');
    }
  }else{
    header('Location: index.php');
  }
 ?>
