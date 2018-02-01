<?php
  require('functions.php');
  if ($_GET['category'] == 'stem') {
    markCategory($_GET['id'],'stem');
    // echo "retag to stem";
  }else{
    markCategory($_GET['id'],'Other');
    // echo "retag to other";
  }
  // echo "<br>redirect to".$_SERVER['HTTP_REFERER'];
  header('Location: ' . $_SERVER['HTTP_REFERER']);
 ?>
