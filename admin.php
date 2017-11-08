<?php
require_once("inc/__db.php");
$statement = $db->prepare("SELECT tournament_id, name FROM tournament ORDER BY date_added DESC;");
$statement->execute();
$array = $statement->fetchAll();
$tournament_id = random_bytes(20);
$tournament_id = bin2hex($tournament_id);
?>
<!DOCTYPE>
<html>
  <head>
  <title>Simple tourney system</title>
  <meta charset="utf8">
  <link href="https://fonts.googleapis.com/css?family=Saira+Semi+Condensed:300,600" rel="stylesheet">
  <link rel="stylesheet" href="https://i.icomoon.io/public/temp/fc3e774ad0/UntitledProject/style.css">
  <link href="css/default.css" rel="stylesheet">
</head>

<body>
  <?php 
  include("inc/__header.php");
  ?>
  <div class="admin">
    <div class="overlay">
      <div class="header">
        TOURNAMENT MANAGEMENT
      </div>
    </div>
  </div>
  </div>
  <div class="wrapper">
      <div class="desc">
        <span class="title">Tournament list</span>
        <hr>
        <span><a href="tournament.php?id=new">New tournament</a></span><br/>
        <?php
        $i = 0;
        foreach ($array as $arr) {
          echo "<span>".$array[$i]['name']."</span><span><a href=tournament.php?id=".$array[$i]['tournament_id'].">Edit</a> <a href=tournament.php?drop=".$array[$i]['tournament_id'].">Delete</a></span>";
          $i++;
        }
        //include("inc/__tournament_form.php");
        ?>
      </div>
  </div>
</html>