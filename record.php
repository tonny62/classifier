<?php
  if (isset($_GET['code']) AND isset($_GET['id'])) {
    require('functions.php');
    markCategory($_GET['id'],$_GET['code']);
  }else{
    header('Location: index.php');
  }
 ?>

 <!DOCTYPE html>
 <html>
   <head>
     <meta charset="utf-8">
     <title>Record</title>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.2/css/bulma.min.css">
   </head>
   <body>
     <section class="section">
       <div class="container">
         <div class="box has-text-centered">
           <div class="field">
             <h2>Done</h2>
           </div>
           <a href="destroy.php" class="button is-link">Return to index</a>
         </div>
       </div>
     </section>


   </body>
 </html>
