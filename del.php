<?php
require_once ("classes/__tournament.class.php");
require_once ("inc/__db.php");

$id = $_GET["id"];

$repository = new TournamentRepository();

if (!empty($id) && empty($_GET["confirm"]))
{
    // grab the matching name
    $query = "SELECT `name`
          FROM `tournament`
          WHERE `tournament_id` = ?";

    $statement = $db->prepare($query);
    $statement->execute(array($id));

    $array = $statement->fetchColumn(0);

    // display the warning
    $warning = "Are you sure you want to delete the following tournament: 
            $array?<br/> 
            This action can not be undone.<br/><br/>
            <a href='?id=$id&confirm=1'>Yes</a>&nbsp;<a href='admin.php'>No</a>";
    echo $warning;
}
elseif (!empty($id) && !empty($_GET["confirm"]))
{
    $id = $_GET["id"];

    $tournament = $repository->get($id);
    $repository->del($tournament);
}
elseif (empty($id))
{
    echo "How did you get here?";
}
?>