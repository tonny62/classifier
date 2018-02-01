<?php
  require('functions.php');
  require('components.php');
  if(!isset($_GET['page'])){
    $page = 1;
  }else{
    $page = $_GET['page'];
  }
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
          <div class="box">
            <?php if (!isset($_GET['category'])): ?>
              <div class="content">
                <h2>View Database</h2>
                <a href="?category=stem">
                  <button type="button" class="button is-large">View STEM</button>
                </a>
                <a href="?category=other">
                  <button type="button" class="button is-large">View Other</button>
                </a>
              </div>
            <?php elseif($_GET['category'] == 'stem'): ?>
              <!-- stem -->
              <div class="content">
                <h2>STEM Jobs</h2>
              </div>
              <nav class="pagination is-rounded" role="navigation" aria-label="pagination">
                <?php
                  if($page == '1'){
                    echo '<a class="pagination-previous" href="?category=stem&page='.($page - 1).'" disabled>Previous</a>';
                  }else {
                    echo '<a class="pagination-previous" href="?category=stem&page='.($page - 1).'">Previous</a>';
                  }
                  if (count(getstem($page + 1)) > 0) {
                    echo '<a class="pagination-next" href="?category=stem&page='.($page + 1).'">Next page</a>';
                  }else{
                    echo '<a class="pagination-next" href="?category=stem&page='.($page + 1).'" disabled>Next page</a>';
                  }
                 ?>
              </nav>
              <div class="table">
                <table>
                  <thead>
                    <tr>
                      <th>id</th>
                      <th>pos</th>
                      <th>desc</th>
                      <th>retag</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $rows = getstem($page);
                    foreach ($rows as $key => $value) {
                      echo "<tr>";
                      echo "<td>".$value['_id']."</td>";
                      if (isset($value['pos'])) {
                        echo "<td>".$value['pos']."</td>";
                      }else {
                        echo "<td></td>";
                      }
                      if (isset($value['desc'])) {
                        echo "<td>".$value['desc']."</td>";
                      }else {
                        echo "<td></td>";
                      }
                      echo "<td><a href='retag2.php?category=other&id=".$value['_id']."' class='button'>Other</a></td>";
                      echo "</tr>";
                    }
                     ?>
                  </tbody>
                </table>
              </div>
            <?php else: ?>
              <!-- other -->
              <div class="content">
                <h2>Other Jobs</h2>
              </div>
              <nav class="pagination is-rounded" role="navigation" aria-label="pagination">
                <?php
                  if($page == '1'){
                    echo '<a class="pagination-previous" href="?category=other&page='.($page - 1).'" disabled>Previous</a>';
                  }else {
                    echo '<a class="pagination-previous" href="?category=other&page='.($page - 1).'">Previous</a>';
                  }
                  if (count(getother($page + 1)) > 0) {
                    echo '<a class="pagination-next" href="?category=other&page='.($page + 1).'">Next page</a>';
                  }else{
                    echo '<a class="pagination-next" href="?category=other&page='.($page + 1).'" disabled>Next page</a>';
                  }
                 ?>
              </nav>
              <div class="table">
                <table>
                  <thead>
                    <tr>
                      <th>id</th>
                      <th>pos</th>
                      <th>desc</th>
                      <th>retag</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $rows = getother($page);
                    foreach ($rows as $key => $value) {
                      echo "<tr>";
                      echo "<td>".$value['_id']."</td>";
                      if (isset($value['pos'])) {
                        echo "<td>".$value['pos']."</td>";
                      }else {
                        echo "<td></td>";
                      }
                      if (isset($value['desc'])) {
                        echo "<td>".$value['desc']."</td>";
                      }else {
                        echo "<td></td>";
                      }
                      echo "<td><a href='retag2.php?category=stem&id=".$value['_id']."' class='button'>STEM</a></td>";
                      echo "</tr>";
                    }
                     ?>
                  </tbody>
                </table>
              </div>

            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </section>
</body>
