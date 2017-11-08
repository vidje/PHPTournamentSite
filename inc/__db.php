<?php
//ini_set('display_errors', 1);
//error_reporting(E_ALL | E_STRICT);

  try {
    $db = new PDO('mysql:host=localhost;dbname=tourneys', 'root', '') or die("can't open db");
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
    //var_dump($db);
  }
  catch(PDOException $e) {
    echo $e->getMessage();
  }
?>
