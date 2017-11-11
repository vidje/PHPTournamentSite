<?php
require_once("inc/__db.php");

// $_GET['id']
$tid = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_ENCODED);

// grab form input
$tname = $_POST["team-name"];
$player1 = $_POST["p1"];
$cmail = $_POST["contact"];
$player2 = $_POST["p2"];
$player3 = $_POST["p3"];
$player4 = $_POST["p4"];
$date = time();

$player1_id = random_bytes(20);
$player1_id = bin2hex($player1_id);

$player2_id = random_bytes(20);
$player2_id = bin2hex($player2_id);

$player3_id = random_bytes(20);
$player3_id = bin2hex($player3_id);

$player4_id = random_bytes(20);
$player4_id = bin2hex($player4_id);

$team_id = random_bytes(20);
$team_id = bin2hex($team_id);

$token = random_bytes(16);
$token = bin2hex($token);

// transaction start
$db->beginTransaction();

// wrap inside try/catch
// if it errors out, rollback & display error
try
{
    // insert team values
    $query = "INSERT INTO team (team_id, tournament_id, name, signup_date, token) VALUES (?, ?, ?, ?, ?)";
    $statement = $db->prepare($query);
    $statement->execute(array(
        $team_id,
        $tid,
        $tname,
        $date,
        $token
    ));

    // insert player values
    $query = "INSERT INTO player (player_id, team_id, name, contact) VALUES (?, ?, ?, ?)";
    $statement = $db->prepare($query);
    $statement->execute(array(
        $player1_id,
        $team_id,
        $player1,
        $cmail
    ));
    $statement->execute(array(
        $player2_id,
        $team_id,
        $player2,
        NULL
    ));
    $statement->execute(array(
        $player3_id,
        $team_id,
        $player3,
        NULL
    ));
    $statement->execute(array(
        $player4_id,
        $team_id,
        $player4,
        NULL
    ));

    // commit the changes
    $db->commit();
}

// handle exceptions
catch (Exception $e)
{
    echo $e->getMessage();
    $db->rollback();
}
?>