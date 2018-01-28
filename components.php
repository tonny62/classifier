<?php
  function navbar(){
    echo '<nav class="navbar" role="navigation" aria-label="main navigation">
      <div class="navbar-menu">
        <div class="navbar-end">
          <div class="navbar-item">
            <a href="summary.php">Summary</a>
          </div>
          <div class="navbar-item">
            <a href="index.php">Classifier</a>
          </div>
        </div>
      </div>
    </nav>';
  }

  function sidebar(){
    echo '<aside class="menu">
      <p class="menu-label">Menu</p>
      <ul class="menu-list">
        <li><a href="summary.php">Summary</a></li>
          <li><ul>
            <li><a href="summary.php?category=1">Computer Occupations</a></li>
            <li><a href="summary.php?category=2">Mathematicians</a></li>
            <li><a href="summary.php?category=3">Engineer</a></li>
            <li><a href="summary.php?category=4">Scientists</a></li>
          </ul></li>
        <li><a href="database.php">View Database</a></li>
        <li><a href="search.php">Search</a></li>
      </ul>
    </aside>';
  }

 ?>
