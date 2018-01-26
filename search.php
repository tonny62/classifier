<?php
  require('components.php');
  require('functions.php');
 ?>

<html>
  <head>
    <meta charset="utf-8">
    <title>Classifier</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.2/css/bulma.min.css">
  </head>
  <body>
    <?php navbar(); ?>
    <section class="section">
      <div class="container is-fluid">

              <div class="content">
                <h2>Search</h2>
              </div>
              <form class="form" action="search.php" method="post">
                <div class="field">
                  <label class="label">Description Contains</label>
                  <div class="field has-addons">
                    <input class="input" type="text" placeholder="Keyword" name="searchkeyword">
                    <input type="submit" class="button" value="Search">
                  </div>
                </div>
              </form>
              <?php if (isset($_POST['searchkeyword'])): ?>
                <div class="columns">

                  <div class="column">
                    <div class="content">
                      <form class="form" action="mark.php" method="post">
                        <table class="table is-fluid">
                          <thead>
                            <tr>
                              <th>Select</th>
                              <th colspan="5">Description/Qualification</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $rows = searchdesc($_POST['searchkeyword']);
                            foreach ($rows as $key => $value) {

                              if (!isset($value['status'])) {
                                echo "<tr>";
                                echo '<td><label class="checkbox"><input type="checkbox" name="markedrow[]" value="'.$value['_id'].'"></label></td>';
                                foreach ($value as $keyin => $valuein) {
                                  if ($keyin=='_id' OR $keyin=='company' OR $keyin=='pos' OR $keyin=='pos1' OR $keyin=='pos2') {
                                    //
                                  }else{
                                    echo "<td>".$valuein."</td>";
                                  }
                                }
                                echo "</tr>";
                              }

                            }
                             ?>
                          </tbody>
                        </table>
                        <div class="columns">
                          <div class="column">

                          </div>
                          <div class="column has-text-centered">
                            <div class="select">
                              <select name="category">
                                <option value="Computer Occupation">Computer Occupation</option>
                                <option value="Mathematicians">Mathematicians</option>
                                <option value="Engineer">Engineer</option>
                                <option value="Scientists">Scientists</option>
                                <option value="Other">Other</option>
                              </select>
                            </div>
                            <input type="submit" value="Submit" class="button">
                          </div>
                          <div class="column">

                          </div>
                        </div>
                      </form>
                    </div>


                  </div>

                </div>
              <?php endif; ?>





      </div>
    </section>
  </body>
</html>
