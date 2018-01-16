<?php
  function getJobadsCollection(){
    require('vendor/autoload.php');
    require('variables.php');
    $client = new MongoDB\Client($connectionstring);
    $collection = $client->jobadsclone->jobads;
    return $collection;
  }

  function getDocument(){
    $collection = getJobadsCollection();
    $doc = $collection->findOne();
    return $doc;
  }

  function randomrow(){
    $collection = getJobadsCollection();
    $numrow = $collection->count();
    $randrow = rand(0,$numrow);
    $row = $collection->findOne(
      ['status'=>['$ne'=>["locked","done"]]],
      ['skip'=>$randrow]
    );
    $collection->updateOne(["_id" => $row['_id']], ['$set'=> ['status'=>'locked']]);
    return $row;
  }
  function  unserial($mybson){
    $temp = array();
    foreach ($mybson as $key => $value) {
      $temp = $temp+[$key => $value];
    }
    return $temp;
  }
  function getOccupations($occupation){
    require('vendor/autoload.php');
    require('variables.php');
    $client = new MongoDB\Client($connectionstring);
    $collection = $client->jobadsclone->occupations;
    if ($occupation == 1) {
      $occu = 'Computer Occupation';
    }else if($occupation == 2){
      $occu = 'Mathematicians';
    }else if($occupation == 3){
      $occu = 'Engineer';
    }else{
      $occu = 'Scientists';
    }
    $row = $collection->find(['category'=>$occu],['projection'=>['_id'=> 0]]);
    return $row;
  }

 ?>
