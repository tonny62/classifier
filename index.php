<?php
    require('vendor/autoload.php');
    require('variables.php');
    $client = new MongoDB\Client($connectionstring);  // cloud deploy
    $collection = $client->jobadsclone->collection1;
    $result = $collection->findOne();
    var_dump($result);


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
                  <tbody>

                  </tbody>
                </table>
                </div>
              </div>
              <div class="columns is-centered">
                <div class="column">

                </div>
                <div class="column">
                  <a href="#" class="button">GET JOB</a>
                </div>
                <div class="column">

                </div>
            </div>
          </div>

        </div>

        <div class="column">
          <div class="box">
            <div class="content">
              <div class="field">
                <p><strong>Path :</strong> A -> B -> C</p>
              </div>
              <div class="field">
                <div class="label">
                  <label>Question</label>
                </div>
              </div>
              <div class="box">
                <p>Does the job need interaction with human?</p>
              </div>
              <div class="field">
                <div class="label">
                  <label>Answer</label>
                </div>
              </div>

              <form action="#" method="POST">
                <div class="box">
                  <div class="field">
                    <div class="control">
                      <label class="radio">
                        <input type="radio" name="answer" value="1">
                        Yes
                      </label>
                      <label class="radio">
                        <input type="radio" name="answer" value="2">
                        No
                      </label>
                    </div>
                  </div>
                </div>
                <div class="level">
                  <div class="level-left">
                    <div class="level-item">
                      <a href="" class="button">Previous</a>
                    </div>
                  </div>
                  <div class="level-right">
                    <div class="level-item">
                      <input type="submit" name="" value="Submit" class="button">
                    </div>
                  </div>
                </div>
              </form>


            </div>

          </div>
        </div>
      </div>


    </div>
  </section>
  <a href="session_destroy.php" class="button">DESTROY</a>
</body>

</html>
