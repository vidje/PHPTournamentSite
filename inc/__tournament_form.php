<form action="create_update.php" method="post">
  <label>Tournament ID</label> <input class="tournament-id" id="tournament-id" name="tournament-id" value="<?=$tournament->tournament_id;?>" readonly><br/>
  <label for="name">Tournament name</label> <input id="name" name="name" type="text" value="<?=$tournament->name;?>"><br/>
  <label for="mode">Game mode</label> 
  <select id="mode" name="mode">
    <option>CTF</option>
    <option>Duel</option>
    <option>SAC</option>
    <option>TDM</option>
  </select><br/>
  <label for="signup-start">Signup start</label> <input id="signup-start" name="signup-start" type="text" placeholder="YYYY-MM-DD">
  <label for="signup-end">Signup end</label> <input id="signup-end" name="signup-end" type="text" placeholder="YYYY-MM-DD"><br/>
  <label for="tournament-start">Tournament start</label> <input id="tournament-start" name="tournament-start" type="text" placeholder="YYYY-MM-DD">
  <label for="tournament-end">Tournament end</label> <input id="tournament-end" name="tournament-end" type="text" placeholder="YYYY-MM-DD">
  <label for="description-short">Short description</label> <textarea id="description-short" name="description-short"></textarea><br/>
  <label for="description-long">Long description</label> <textarea id="description-long" name="description-long"></textarea><br/>
  <label for="rules">Rules</label> <textarea id="rules" name="rules"></textarea><br/>
  <label for="brackets">Link to brackets</label> <input id="brackets" name="brackets" type="text"><br/>
  <label for="stream-en">English stream</label> <input id="stream-en" name="stream-en" type="text">
  <label for="stream-ru">Russian stream</label> <input id="stream-ru" name="stream-ru" type="text"><br/>
  <button type="submit" name="submit">
    Create
  </button>
</form>