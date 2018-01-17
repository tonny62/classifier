<?php
  session_start();
  require('functions.php');
  if (!isset($_SESSION['doc'])) {
    $_SESSION['doc'] = unserial(randomrow());
  }
  $doc = $_SESSION['doc'];
  // var_dump($doc);

 ?>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Classifier</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.2/css/bulma.min.css">

</head>

<body>
  <section class="section">
    <div class="container">
      <div class="columns">
        <div class="column">
          <div class="box">
            <div class="table is-bordered">
              <div class="content">
                <table class="table">
                  <h2>Job Details</h2>
                  <?php
                    foreach ($doc as $key => $value) {
                      echo "<tr>";
                        echo "<th>".$key."</h>";
                        echo "<td>";
                        if (strpos($value,'\n') !== false) {
                          $vals = explode('\n', $value);
                          foreach ($vals as $keyin => $valuein) {
                            echo $valuein."<br>";
                          }
                          echo "</td>";
                        }else {
                          echo $value."</td>";
                        }
                      echo "</tr>";
                    }

                   ?>
                </table>
                </div>
              </div>
              <div class="columns is-centered">
                <div class="column">
                </div>
                <div class="column has-text-centered">
                  <?php
                  // echo "<a href='index.php/record.php?id=".$_SESSION['doc']['_id']."&code=PASS' class='button'>PASS</a>";
                  ?>
                </div>
                <div class="column">

                </div>
            </div>
          </div>


        </div>

        <!-- <div class="column">
          <div class="box">
            <div class="content">
              <h2>Search</h2>
            </div>
            <div class="field">
              <label class="label">Description</label>
              <div class="control">
                <nav class="level">
                  <form action="index.php" method="post">
                    <div class="level-item">
                        <input class="input" type="text" placeholder="eg. bioinformatics">
                        <input type="submit" class="button" name="" value="Go">
                    </div>
                </form>
                </nav>
              </div>
            </div>
          </div>


          </div> -->
        </div>
        <div class="box">
          <div class="content">
            <h2>In which category this job belongs to?</h2>
            <nav class="level">
              <div class="level-item has-text-centered">
                <div>
                  <p class="heading">1</p>
                  <p class="title"><a href="index.php?class=1" class="button">Computer Occupation</a></p>
                </div>
              </div>
              <div class="level-item has-text-centered">
                <div>
                  <p class="heading">2</p>
                  <p class="title"><a href="index.php?class=2" class="button">Mathematicians</a></p>
                </div>
              </div>
              <div class="level-item has-text-centered">
                <div>
                  <p class="heading">3</p>
                  <p class="title"><a href="index.php?class=3" class="button">Engineer</a></p>
                </div>
              </div>
              <div class="level-item has-text-centered">
                <div>
                  <p class="heading">4</p>
                  <p class="title"><a href="index.php?class=4" class="button">Scientists</a></p>
                </div>
              </div>
              <div class="level-item has-text-centered">
                <div>
                  <p class="heading">5</p>
                  <p class="title"><a href="index.php?class=5" class="button">Other</a></p>
                </div>
              </div>
            </nav>
          </div>
              <hr>
              <?php if (isset($_GET['class'])): ?>
                <?php if ($_GET['class'] == 5): ?>
                  <div class="columns">
                    <div class="column">
                    </div>
                    <div class="column has-text-centered">
                      <div class="field">
                        <h2>Mark this job as Other?</h2>
                      </div>
                      <a href="#" class="button is-link">Confirm</a>
                    </div>
                    <div class="column">
                    </div>
                  </div>
                <?php else: ?>
                  <div class="content">
                    <table class="table is-bordered">
                      <tr>
                        <th>Category</th>
                        <th>Occupation</th>
                        <th>Description</th>
                        <th>Select</th>
                      </tr>
                      <?php
                      $rows = getOccupations($_GET['class']);
                      foreach ($rows as $key => $value) {
                        echo "<tr>";
                        foreach ($value as $keyin => $valuein) {
                          if($keyin !== 'code'){
                            echo "<td>".$valuein."</td>";
                          }else{
                            $code = $valuein;
                          }
                        }
                        echo "<td><a href='record.php?id=".$_SESSION['doc']['_id']."&code=".$value['code']."' class='button is-link'>Select</a></td>";
                        echo "</tr>";
                      }


                       ?>
                    </table>
                  </div>
                <?php endif; ?>
              <?php endif; ?>

        </div>
      </div>


    </div>
  </section>
  <a href="destroy.php" class="button">DESTROY</a>
</body>

</html>
