<?php
  require('functions.php');
  require('components.php');
 ?>

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Database</title>
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
              <?php if (!isset($_POST['tag'])): ?>
              <div class="columns">

                <div class="column">

                </div>
                <div class="column">
                  <form class="" action="database.php" method="post">
                    <div class="field">
                      <label class="label">Tag</label>
                      <div class="field has-addons">
                        <div class="select">
                          <select name="tag">
                              <?php
                              $occlist=['','Computer Occupations','Mathematicians','Engineer','Scientists'];
                              for ($i=1; $i < 5; $i++) {
                                  $rows = unserial(getOccupations($i));
                                  echo("<option value='".$i."'>See All ".$occlist[$i]."</option>");
                                  foreach ($rows as $key => $value) {
                                      echo("<option value='".$value['code']."'>".$value['code']." - ".$value['occupation']." ".countoccupation($value['code'])."</option>");
                                  }
                              }
                               ?>
                            </select>
                        </div>
                        <input type="submit" class="button" value="Search">
                      </div>
                    </div>
                  </form>
                  <div class="column">

                  </div>
                </div>
                <div class="column">

                </div>
              </div>
              
                <?php elseif (in_array($_POST['tag'], ['1','2','3','4'])): ?>
                <div class="content">
                  <?php
                        if ($_POST['tag'] == 1) {
                            $occu = 'Computer Occupation';
                        } elseif ($_POST['tag'] == 2) {
                            $occu = 'Mathematicians';
                        } elseif ($_POST['tag'] == 3) {
                            $occu = 'Engineer';
                        } else {
                            $occu = 'Scientists';
                        }
                        $rows = getjobsfromcategory($occu);
                       ?>
                    <h2><?php echo $occu;?></h2>

                    <?php if (count($rows) == 0): ?>
                    <h4>No entry</h4>
                    <?php else: ?>
                    <div class="table">
                      <div class="content">

                      </div>
                      <table>
                        <thead>
                          <th>ID</th>
                          <th>pos</th>
                          <th>desc</th>
                          <th>tag</th>
                          <th>retag</th>
                        </thead>
                        <tbody>
                          <?php
                                 foreach ($rows as $key => $value) {
                                     echo "<tr>";
                                     foreach ($value as $keyin => $valuein) {
                                         if (in_array($keyin, ['_id','pos','desc'])) {
                                             echo "<td>";
                                             echo $valuein;
                                             echo "</td>";
                                         }
                                     }
                                     // var_dump($value);
                                     echo "<td>".getcategoryname($value['code'])."</td>";
                                     echo "<td><a href='retag.php?jobid=".$value['_id']."' class='button is-link'>Retag</a></td>";
                                     echo "</tr>";
                                 }
                               ?>
                        </tbody>
                      </table>
                    </div>
                    <?php endif; ?>

                </div>

                <?php else: ?>
                <div class="content">
                  <?php
                      echo "<h2>".getcategoryname($_POST['tag'])."</h2>";
                      $rows = getjobsfromtag($_POST['tag']);
                     ?>
                    <?php if (count($rows) == 0): ?>
                    <h2>No Entry</h2>

                </div>
                <?php else: ?>
                <div class="table">
                  <div class="content">

                  </div>
                  <table>
                    <thead>
                      <th>ID</th>
                      <th>pos</th>
                      <th>desc</th>
                      <th>retag</th>
                    </thead>
                    <tbody>
                      <?php
                                foreach ($rows as $key => $value) {
                                    echo "<tr>";
                                    foreach ($value as $keyin => $valuein) {
                                        if (in_array($keyin, ['_id','pos','desc'])) {
                                            echo "<td>";
                                            echo $valuein;
                                            echo "</td>";
                                        }
                                    }
                                    // var_dump($value);
                                    echo "<td><a href='retag.php?jobid=".$value['_id']."' class='button is-link'>Retag</a></td>";
                                    echo "</tr>";
                                }
                              ?>
                    </tbody>
                  </table>
                </div>
                <?php endif; ?>


                <?php endif; ?>

              </div>

            </div>
          </div>
        </div>
      </div>
    </section>
  </body>
