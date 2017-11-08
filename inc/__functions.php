<?php
// https://hastebin.com/ivikamumam.xml
class Tournament {
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

class TournamentRepository {
  function get($tournament_id) {
    $db = new PDO('mysql:host=localhost;dbname=tourneys', 'root', '') or die("can't open db");
    $query = "SELECT tournament_id, name, mode, signup_start, signup_end, tournament_start,
              tournament_end, description_short, description_long, rules, brackets, stream_en,
              stream_ru 
              FROM tournament
              WHERE (tournament_id = ?);";
    $statement = $db->prepare($query);
    $statement->execute(array($tournament_id));
    
    $tournament = new Tournament();
    
    $this->tournament_id = $tournament_id;
    $this->name = $statement->fetchColumn(1);
    /*$this->mode = $query(2);
    $this->signup_start = $query(3);
    $this->signup_end = $query(4);
    $this->tournament_start = $query(5);
    $this->tournament_end = $query(6);
    $this->description_short = $query(7);
    $this->description_long = $query(8);
    $this->rules = $query(9);
    $this->brackets = $query(10);
    $this->stream_en = $query(11);
    $this->stream_ru = $query(12);*/
    
    return $tournament;
  }
}

?>