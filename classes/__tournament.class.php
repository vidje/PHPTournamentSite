<?php

class Tournament
{
    var $tournament_id;
    var $name;
    var $mode;
    var $signup_start;
    var $signup_end;
    var $tournament_start;
    var $tournament_end;
    var $description_short;
    var $description_long;
    var $rules;
    var $brackets;
    var $stream_en;
    var $stream_ru;
    var $date_added;
}

class TournamentRepository
{

    // get tournament method
    function get($tournament_id)
    {
        // connect to db
        require("inc/__db.php");

        // match tournament_id with db
        try
        {
            $query = "SELECT `tournament_id`, 
                             `name`, 
                             `mode`, 
                             `signup_start`, 
                             `signup_end`, 
                             `tournament_start`, 
                             `tournament_end`, 
                             `description_short`, 
                             `description_long`, 
                             `rules`, 
                             `brackets`, 
                             `stream_en`, 
                             `stream_ru` 
                      FROM `tournament` 
                      WHERE `tournament_id` = ?;";

            $statement = $db->prepare($query);
            $statement->execute(array($tournament_id));

            // grab the array
            $array = $statement->fetch(PDO::FETCH_ASSOC);
        }

        catch (Exception $e)
        {
            // error message
        }

        $tournament = new Tournament();

        // assign matching array values
        $tournament->tournament_id = $array["tournament_id"];
        $tournament->name = $array["name"];
        $tournament->mode = $array["mode"];
        $tournament->signup_start = $array["signup_start"];
        $tournament->signup_end = $array["signup_end"];
        $tournament->tournament_start = $array["tournament_start"];
        $tournament->tournament_end = $array["tournament_end"];
        $tournament->description_short = $array["description_short"];
        $tournament->description_long = $array["description_long"];
        $tournament->rules = $array["rules"];
        $tournament->brackets = $array["brackets"];
        $tournament->stream_en = $array["stream_en"];
        $tournament->stream_ru = $array["stream_ru"];

        return $tournament;
    }

    // save tournament method
    function save($tournament)
    {
        // connect to db
        require("inc/__db.php");

        // edit record query
        $queryE = "UPDATE `tournament`
                  SET `name` = ?,
                      `mode` = ?,
                      `signup_start` = ?,
                      `signup_end` = ?,
                      `tournament_start` = ?,
                      `tournament_end` = ?,
                      `description_short` = ?,
                      `description_long` = ?,
                      `rules` = ?,
                      `brackets` = ?,
                      `stream_en` = ?,
                      `stream_ru` = ?
                  WHERE `tournament_id` = ?";

        // create record query
        $queryC = "INSERT INTO `tournament`
                               (`tournament_id`,
                               `name`,
                               `mode`,
                               `signup_start`,
                               `signup_end`,
                               `tournament_start`,
                               `tournament_end`,
                               `description_short`,
                               `description_long`,
                               `rules`,
                               `brackets`,
                               `stream_en`,
                               `stream_ru`,
                               `date_added`)
                   VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        // edit record array
        $arrayE = array(
            $tournament->name,
            $tournament->mode,
            $tournament->signup_start,
            $tournament->signup_end,
            $tournament->tournament_start,
            $tournament->tournament_end,
            $tournament->description_short,
            $tournament->description_long,
            $tournament->rules,
            $tournament->brackets,
            $tournament->stream_en,
            $tournament->stream_ru,
            $tournament->tournament_id
        );

        // create record array
        $arrayC = array(
            $tournament->tournament_id,
            $tournament->name,
            $tournament->mode,
            $tournament->signup_start,
            $tournament->signup_end,
            $tournament->tournament_start,
            $tournament->tournament_end,
            $tournament->description_short,
            $tournament->description_long,
            $tournament->rules,
            $tournament->brackets,
            $tournament->stream_en,
            $tournament->stream_ru,
            $tournament->date_added
        );

        // update the record
        if ($tournament->tournament_id != null)
        {
            try
            {
                $statement = $db->prepare($queryE);
                $statement->execute($arrayE);
            }
            catch (Exception $e)
            {
                // error message
            }
        }

        // create a new record
        else
        {
            // assign tournament_id and date_added values
            $tournament->tournament_id = random_bytes(20);
            $tournament->tournament_id = bin2hex($tournament->tournament_id);
            $tournament->date_added = time();

            // replace null values in the array
            $arrayC[0] = $tournament->tournament_id;
            $arrayC[13] = $tournament->date_added;

            try
            {
                $statement = $db->prepare($queryC);
                $statement->execute($arrayC);
            }
            catch (Exception $e)
            {
                // error message
                echo $e->getMessage();
            }
        }
    }

    // delete tournament method
    function del($tournament)
    {
        // connect to db
        require ("inc/__db.php");

        // grab tournament id
        $id = $_GET["id"];

        // create and execute the delete query
        $query = "DELETE FROM `tournament`
                  WHERE `tournament_id` = ?";

        try
        {
            $statement = $db->prepare($query);
            $statement->execute(array($id));
        }
        catch (Exception $e)
        {
            // error message
            echo $e->getMessage();
        }
    }
}

?>