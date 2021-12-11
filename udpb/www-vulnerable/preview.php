<?php
   //A4 - trosku blba funkcia, huh?
   $file = $_GET['file'].'.php';
   if(isset($file))
   {
       echo 'serus';
       include("$file");
   }
   else
   {
       include("index.php");
   }
   ?>
