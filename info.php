<?php
require_once("inc/__db.php");

$statement = $db->prepare("SELECT tournament.name, tournament.mode, tournament.signup_end, tournament.tournament_start, tournament.tournament_end,
                           tournament.description_long, tournament.rules, tournament.brackets, tournament.stream_en,
                           team.name, team.signup_date
                           FROM tournament LEFT JOIN team
                           ON (tournament.tournament_id = team.tournament_id)
                           WHERE tournament.tournament_id = :tournament_id");
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_ENCODED); 
$statement->bindParam(':tournament_id', $id, PDO::PARAM_INT); 
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
        <div class="overlay">
          
          
          <?php
          $current_time = date('F j, Y H:i:s', time());
          $start_time = date('F j, Y H:i:s', strtotime($array['0']['tournament_start']));
          $end_time = date('F j, Y H:i:s', strtotime($array['0']['tournament_end']));
          $sEnd_time = date('F j, Y H:i:s', strtotime($array['0']['signup_end']));
          if ($current_time >= $start_time && $current_time < $end_time) {
            include("inc/__stream.php");
          }
          elseif ($current_time > $end_time) {
            echo "TOURNAMENT FINISHED PAGE GOES HERE (include/results i guess)";
          }
          elseif ($current_time <= $sEnd_time) {
            include("inc/__signup_form.php");
          }
          ?>
          
          <div class="header">
            <?=$array['0']['0'];?>
          </div>

        </div>
      </div>
    </div>
    
    <div class="wrapper">
        <div class="desc">
          <span class="title">Detailed information and rules</span>
          <hr>
          <span>
            <?php
            $timeStart = date("F j, Y", strtotime($array['0']['tournament_start']));
            echo "<span>".$timeStart."</span>";
            echo "<span>".$array['0']['description_long']."</span>";
            echo "<span>".$array['0']['rules']."</span>";
            ?>
          </span>
        </div>
        <div class="desc">
          <span class="title">Participants</span>
          <hr>
          <?php
          $i = 0;
          foreach($array as $arr) {
            echo "<span class='signuplist'>".$array[$i]['name']."</span>";
            $i++;
          }
          ?>
        </div>
        <div class="desc">
          <span class="title">Brackets</span>
          <hr>
          <?php
          if (empty($array['0']['brackets'])) {
            echo "<span>Brackets will be available at tournament start.</span>";
          }
          else {
            echo "<span><iframe src='".$array['0']['brackets']."/module' width='100%' height='500' frameborder='0' scrolling='auto' allowtransparency='true'></iframe></span>";
          }
          ?>
          
        </div>
      </div>
    </div>
  </body>
</html>