<?php
require("inc/__db.php");
$statement = $db->prepare("SELECT tournament_id, mode, name, tournament_start, description_short FROM tournament
                           ORDER BY date_added DESC;");
$statement->execute();
$array = $statement->fetchAll();
?>
  <!DOCTYPE html>
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
      <div class="<?=$array['0']['mode'];?>">
        <div class="fw-bg">
          <?php
        $timeStart = date("F j, Y", strtotime($array['0']['tournament_start']) );
        echo "<h1>".$array['0']['name']."</h1>";
        echo "<span class='icon-calendar2'></span> <span class='date'>".$timeStart."</span>";
        echo "<span class='icon-clock2'></span> <span class='date'>18:00CEST</span>";
        echo "<article>".$array['0']['description_short']."</article><br/><br/><br/>";
          ?>

            <div class="button-dropdown">
              <a href="info.php?id=<?=$array['0']['tournament_id'];?>" class="button btn-large">Tournament Page</a>
            </div>
          <hr>
          <span class="sponsors">PRIZE POOL: $1000</span>

        </div>

      </div>

    </div>

    <!--<div class="wrapper">

    <div class="card about">
      <div class="desc">
        <span>Quake ProLeague</span><br/>
        <span>Read all about it</span>
      </div>
    </div>
      
    <div class="card about">
      <div class="desc">
      </div>
    </div>
      
    <div class="card about">
      <div class="desc">
      </div>
    </div>
      
    <div class="card about">
      <div class="desc">
      </div>
    </div>
      
          <div class="card about">
      <div class="desc">
      </div>
    </div>
      
          <div class="card about">
      <div class="desc">
      </div>
    </div>
      
    </div>-->
  </body>

  </html>