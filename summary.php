<?php
  require('functions.php');
  require('components.php');
 ?>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Summary</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.2/css/bulma.min.css">
</head>
<body>
  <?php navbar(); ?>
  <section class="section">
    <div class="container">
      <div class="columns">
        <div class="column is-2">
          <?php sidebar(); ?>
        </div>
        <div class="column is-10">
          <div class="box">
            <?php if (!isset($_GET['category'])): ?>
              <div class="content">
                <h2><u>Summary</u></h2>
                <table class="table">
                  <thead>
                    <tr>
                      <th></th>
                      <th>Computer Occupation</th>
                      <th>Mathematicians</th>
                      <th>Engineer</th>
                      <th>Scientists</th>
                      <th>Other</th>
                      <th>STEM</th>
                      <th>Total Jobs</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $frame = countDataframe();
                      $count = array();
                      foreach ($frame as $key => $value) {
                        echo "<tr>";
                        echo "<td>".$key."</td>";
                        foreach ($value as $keyin => $valuein) {
                          echo "<td>".$valuein."</td>";
                          if (!isset($count[$keyin])) {
                            $count[$keyin] = 0 + $valuein;
                          }else{
                            $count[$keyin] += $valuein;
                          }
                        }
                        echo "</tr>";
                      }
                      echo "<tr><th>TOTAL</th>";
                      $markedcount = 0;
                      foreach ($count as $key => $value) {
                        echo "<td>".$value."</td>";
                        $markedcount += $value;
                      }
                      echo "</tr>";
                      $total = $value;
                      $markedcount = $markedcount - $value;
                     ?>
                  </tbody>
                </table>
                <h4>Progress : <?php echo $markedcount."/".$total; ?></h4>
                <h4>Skipped : <?php echo countskip(); ?></h4>
              </div>
            <?php else: ?>
              <div class="content">
                <table class="table is-bordered">
                  <tr>
                    <th>Category</th>
                    <th>Occupation</th>
                    <th>Description</th>
                    <th>Count</th>
                  </tr>
                  <?php
                  $rows = getOccupations($_GET['category']);
                  foreach ($rows as $key => $value) {
                    echo "<tr>";
                    foreach ($value as $keyin => $valuein) {
                      if($keyin !== 'code'){
                        echo "<td>$valuein</td>";
                      }
                    }
                    echo "<td>".countoccupation($value['code'])."</td>";
                    echo "</tr>";
                  }


                   ?>
                </table>
              </div>
            <?php endif; ?>

          </div>
        </div>
      </div>
    </div>
  </section>
</body>
