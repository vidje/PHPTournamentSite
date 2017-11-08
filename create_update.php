<?php
require_once("inc/__db.php");
require_once("inc/__functions.php");

$tournament = new CreateEditTournament("tournament-id", "name", "mode", "signup-start", "signup-end", "tournament-start",
                                   "tournament-end", "description-short", "description-long", "rules", "brackets",
                                   "stream-en", "stream-ru", time()
                                  );
try {
  
  // insert tournament info
  $query = "INSERT INTO tournament (tournament_id, name, mode, signup_start, signup_end,
            tournament_start, tournament_end, description_short, description_long,
            rules, brackets, stream_en, stream_ru, date_added)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
  $statement = $db->prepare($query);
  $tournament->execute($statement);
}

// handle exceptions
catch(Exception $e) {
  echo $e->getMessage();
  $db->rollback();
}
?>