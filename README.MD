# Basic tournament system

## Features
* on the fly signups
* team signups
* admin panel

# TO DO LIST

- [ ] replace JOIN ON with JOIN USING if possible (e.g., SELECT foo, bar FROM foo INNER JOIN bar USING (id))
- [ ] make setup script
- [ ] create a menu
- [ ] login system for admin 
- [x] remake admin page
    - [x] show all tournaments
    - [x] create tournament
    - [x] delete tournament
    - [x] edit tournament 
- [ ] signup confirmation page (token display, etc)
- [ ] signup removal page
- [ ] results page
- [ ] challonge api
- [ ] database error messages or pages
    - [ ] $db->rollback(); perhaps?

# NEW DB LAYOUT

```
+-----------------+-------------+-------------+
|tournament       |player       |team         |
+-----------------+-------------+-------------+
|tournament_id    |player_id    |team_id      |
|name             |team_id      |tournament_id|
|mode             |name         |name         |
|signup_start     |contact      |signup_date  |
|signup_end       +-------------|token        |
|tournament_start |             +-------------+
|tournament_end   |
|description_short|
|description_long |
|rules            |
|brackets         |
|stream_en        |
|stream_ru        |
|date_added       |
+-----------------+
```

# SQL

```
CREATE TABLE tournament
(
  tournament_id     BINARY(20) UNIQUE PRIMARY KEY,
  name              VARCHAR(255),
  mode              VARCHAR(5),
  signup_start      DATETIME,
  signup_end        DATETIME,
  tournament_start  DATETIME,
  tournament_end    DATETIME,
  description_short TEXT,
  description_long  TEXT,
  rules             TEXT,
  brackets          VARCHAR(255),
  stream_en         VARCHAR(20),
  stream_ru         VARCHAR(20),
  date_added        INT(10) UNSIGNED
);
```
```
CREATE TABLE team
(
  team_id           BINARY(20) UNIQUE PRIMARY KEY,
  tournament_id     BINARY(20),
  name              VARCHAR(30),
  signup_date       INT(10) UNSIGNED,
  token             BINARY(16) UNIQUE,
  
  FOREIGN KEY (tournament_id) REFERENCES tournament (tournament_id)
    ON UPDATE NO ACTION ON DELETE CASCADE
);
```
```
CREATE TABLE player
(
  player_id         BINARY(20) UNIQUE PRIMARY KEY,
  team_id           BINARY(20),
  name              VARCHAR(20),
  contact           VARCHAR(30),
  
  FOREIGN KEY (team_id) REFERENCES team (team_id)
    ON UPDATE NO ACTION ON DELETE CASCADE
);
```
```
CREATE TABLE team_player
(
  team_id    INTEGER UNSIGNED NOT NULL,
  player_id  INTEGER UNSIGNED NOT NULL,

  PRIMARY KEY (team_id, player_id),

  FOREIGN KEY (team_id) REFERENCES team (team_id)
    ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (player_id) REFERENCES player (player_id)
    ON DELETE CASCADE ON UPDATE CASCADE
);
```