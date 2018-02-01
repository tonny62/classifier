<?php
  function getJobadsCollection(){
    require('vendor/autoload.php');
    require('variables.php');
    $client = new MongoDB\Client($connectionstring);
    $collection = $client->jobads2->jobads;
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
      ['status'=>['$ne'=>["locked","done"]],"code"=>['$ne'=>["skip"]]],
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
    $collection = $client->jobads2->occupations;
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

  function markCategory($id, $occupation){
    // if ($occupation != 5) {
    //   require('vendor/autoload.php');
    //   require('variables.php');
    //   $client = new MongoDB\Client($connectionstring);
    //   $collection = $client->jobads2->occupations;
    //   $row = $collection->find(['code'=>$occupation]);
    //   $row = unserial($row);
    //   $collection = getJobadsCollection();
    //   // print_r($row);
    //   $collection->updateOne(["_id" => $id], ['$set'=> ['status'=>'done','category'=>$row[0]['category'],'code'=>$occupation]]);
    //   // echo $row[0]['category'];
    // }else
    // if ($occupation == 'skip') {
    //   $collection = getJobadsCollection();
    //   $collection->updateOne(["_id" => $id], ['$set'=> ['status'=>'skip']]);
    // }else
    if($occupation == 'stem'){
      $collection = getJobadsCollection();
      $collection->updateOne(["_id" => $id], ['$set'=> ['status'=>'done','category'=>'STEM','timestamp'=>mytimestamp()]]);
    }else if($occupation == 'Other'){
      $collection = getJobadsCollection();
      $collection->updateOne(["_id" => $id], ['$set'=> ['status'=>'done','category'=>'Other','timestamp'=>mytimestamp()]]);
    }else {
      $collection = getJobadsCollection();
      $collection->updateOne(["_id" => $id], ['$set'=> ['status'=>'done','category'=>'Other','timestamp'=>mytimestamp()]]);
    }

  }
  function countDataframe(){
    $collection = getJobadsCollection();
    $jobsource = array('NECTEC','JOBANT','JOBLIST','JOBSAWASDEE','JOBSUGOI','JOBTH','NATIONEJOB','JOBPUB');
    $occupation = array('Computer Occupation','Mathematicians','Engineer','Scientists','Other','STEM');
    $frame = array();
    foreach ($jobsource as $key => $value) {
      foreach ($occupation as $keyin => $valuein) {
        $marked = $collection->find(['_id'=>['$regex'=>$value],'category'=>$valuein]);
        $markedcount = count(unserial($marked));
        $frame[$value][$valuein] = $markedcount;
      }
    }
    foreach ($jobsource as $key => $value) {
      $count = count(unserial($collection->find(['_id'=>['$regex'=>$value]])));
      $frame[$value]['TOTAL'] = $count;
    }
    return $frame;
    // $frame struncture is
    //   [ [NECTEC] => [
    //               [Computer Occupation] => ...,
    //               ... => ...]],
    //   ... => [ ... => ...,
    //   ]
    // ]
  }
  function countskip(){
    $collection = getJobadsCollection();
    $rows = $collection->find(['code'=>'skip']);
    $count = count(unserial($rows));
    return $count;
  }

  function searchdesc($keyword){
    $collection = getJobadsCollection();
    $regx = new MongoDB\BSON\Regex($keyword, 'i');
    $rows = $collection->find(['$or'=>[['desc'=>['$regex'=> $regx]],['req'=>['$regex'=> $regx]],['qual'=>['$regex'=> $regx]]]]);
    $rows = unserial($rows);
    $rowtemp = array();
    foreach ($rows as $key => $value) {
      $rowtemp = $rowtemp + unserial($value);
    }
    return $rows;
  }

  function markcategorynocode($id, $category){
    require('vendor/autoload.php');
    require('variables.php');
    $collection = getJobadsCollection();
    $collection->updateOne(["_id" => $id], ['$set'=> ['status'=>'marked','category'=>$category]]);
  }
  function countoccupation($jobid){
    $collection = getJobadsCollection();
    $rows = $collection->find(['code'=>$jobid]);
    $count = count(unserial($rows));
    return $count;
  }

  function getjobsfromtag($tag){
    if (in_array($tag,['1','2','3','4'])) {
      echo "hi";
    }else {
      $collection = getJobadsCollection();
      $rows = $collection->find(['code'=>$tag]);
      return unserial($rows);
    }
  }
  function getjobsfromjobid($jobid){
    $collection = getJobadsCollection();
    $rows = $collection->findOne(['_id'=>$jobid]);
    return unserial($rows);
  }
  function getcategoryname($code){
    require('vendor/autoload.php');
    require('variables.php');
    $client = new MongoDB\Client($connectionstring);
    $collection = $client->jobads2->occupations;
    $row = $collection->find(['code'=>$code]);
    $row = unserial($row);
    return $row[0]['occupation'];
  }

  function getjobsfromcategory($category){
    $collection = getJobadsCollection();
    $rows = $collection->find(['category'=>$category]);
    return unserial($rows);
  }

  function mytimestamp(){
    date_default_timezone_set('Asia/Bangkok');
    return date("d-m-y H:i:s");
  }
  function getstem($page){
    $collection = getJobadsCollection();
    $rows = $collection->find(['category'=>'STEM']);
    $rows = unserial($rows);
    $offset = ($page - 1)*50;
    return array_slice($rows,$offset,50);
  }
  function getother($page){
    $collection = getJobadsCollection();
    $rows = $collection->find(['category'=>'Other']);
    $rows = unserial($rows);
    $offset = ($page - 1)*50;
    return array_slice($rows,$offset,50);
  }
 ?>
