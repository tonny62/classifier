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
    <div class="container is-fluid">
      <div class="columns">
        <div class="column is-2">
          <?php sidebar(); ?>
        </div>
        <div class="column is-10">
          <?php if (!isset($_POST['tag'])): ?>
            <!-- no tag -->
            <div class="box">
              <div class="columns">
                <div class="column"></div>
                <div class="column">
                  <form action="database.php" method="post">
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
                            echo("<option value='5'>Other</option>");
                             ?>
                          </select>
                        </div>
                        <input type="submit" value="Search" class="button">
                      </div>
                    </div>
                  </form>
                </div>
                <div class="column"></div>
              </div>
            </div>
          <?php else: ?>
            <!-- selected tag from select -->
            <?php if (in_array($_POST['tag'],['1','2','3','4'])): ?>
              <!-- select large category -->
              <div class="box">
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
                <div class="content">
                  <h2><?php echo $occu;?></h2>
                </div>
                <?php if (count($rows) == 0): ?>
                  <!-- no rows -->
                  <h4>No entry</h4>
                <?php else: ?>
                  <!-- has rows -->
                  <div class="table">
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
                             echo "<td>".$value['_id']."</td>";
                             if (!isset($value['pos'])) {
                               echo "<td></td>";
                             }else {
                               echo "<td>".$value['pos']."</td>";
                             }
                             echo "<td>".$value['desc']."</td>";

                             // foreach ($value as $keyin => $valuein) {
                             //     if (in_array($keyin, ['_id','pos','desc'])) {
                             //         echo "<td>";
                             //         echo $valuein;
                             //         echo "</td>";
                             //     }
                             // }
                             // var_dump($value);

                             if (isset($value['code'])) {
                               echo "<td>".getcategoryname($value['code'])."</td>";
                             }else {
                               echo "<td>Marked</td>";
                             }

                             echo "<td><a href='retag.php?jobid=".$value['_id']."' class='button is-link'>Retag</a></td>";
                             echo "</tr>";
                         }
                       ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              <?php endif; ?>
            <?php elseif($_POST['tag'] == '5'): ?>
              <!-- select other -->
              <div class="box">
                <?php
                  $rows = getjobsfromcategory('Other');
                ?>
                <div class="content">
                  <h2>Other</h2>
                </div>
                <div class="table">
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
                           echo "<td>".$value['_id']."</td>";
                           if (!isset($value['pos'])) {
                             echo "<td></td>";
                           }else {
                             echo "<td>".$value['pos']."</td>";
                           }
                           if (!isset($value['desc'])) {
                             echo "<td></td>";
                           }else {
                             echo "<td>".$value['desc']."</td>";
                           }
                           echo "<td><a href='retag.php?jobid=".$value['_id']."' class='button is-link'>Retag</a></td>";
                           echo "</tr>";
                       }
                     ?>
                    </tbody>
                  </table>
                </div>
              </div>
            <?php else: ?>
              <!-- select occupation -->
              <div class="box">
                <div class="content">
                  <?php
                        echo "<h2>".getcategoryname($_POST['tag'])."</h2>";
                        $rows = getjobsfromtag($_POST['tag']);
                  ?>
                </div>
                <?php if (count($rows) == 0): ?>
                  <!-- no rows -->
                  <h4>No entry</h4>
                <?php else: ?>
                  <!-- rows -->
                  <div class="table">
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
              </div>
            <?php endif; ?>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </section>
</body>
