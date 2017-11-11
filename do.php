<?php
require_once("classes/__tournament.class.php");

$id = $_POST["tournament-id"];

$repository = new TournamentRepository();

if ($id != null)
{
    $tournament = $repository->get($id);
}
else
{
    $tournament = new Tournament();
}

$tournament->name = $_POST["name"];
$tournament->mode = $_POST["mode"];
$tournament->signup_start = $_POST["signup-start"];
$tournament->signup_end = $_POST["signup-end"];
$tournament->tournament_start = $_POST["tournament-start"];
$tournament->tournament_end = $_POST["tournament-end"];
$tournament->description_short = $_POST["description-short"];
$tournament->description_long = $_POST["description-long"];
$tournament->rules = $_POST["rules"];
$tournament->brackets = $_POST["brackets"];
$tournament->stream_en = $_POST["stream-en"];
$tournament->stream_ru = $_POST["stream-ru"];

$repository->save($tournament);

?>