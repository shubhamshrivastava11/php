<?php
// Load DB secrets from outside the web root.
require_once '/home/ssheaven/exercises.ssheavenmusic.com/secret-stuff/dbconnectgames.php';

/**
 * Get a value for parameter in the GET array.
 * @param string $paramName Name of the parameter.
 * @return string|null Value, or null if not found.
 */
function getParamFromGet(string $paramName) {
    $returnValue = null;
    if (isset($_GET[$paramName])) {
        $returnValue = $_GET[$paramName];
        if ($returnValue == '') {
            $returnValue = null;
        }
    }
    return $returnValue;
}

/**
 * Check the wombat id.
 * @param mixed $id Id.
 * @return string Error message, MT if OK.
 */
function checkWombatId($id) {
    global $dbConnection;
    $errorMessage = '';
    if (is_null($id)) {
        $errorMessage = 'Sorry, wombat id is missing.';
    }
    if ($errorMessage == '') {
        if (! is_numeric($id)) {
            $errorMessage = 'Sorry, wombat id must be a number.';
        }
    }
    if ($errorMessage == '') {
        if ($id < 1) {
            $errorMessage = 'Sorry, wombat id must be one or more.';
        }
    }
    if ($errorMessage == '') {
        // Prepare SQL.
        $sql = "
            SELECT *
            FROM wombats
            WHERE wombat_id = :id;
         ";
        $stmt = $dbConnection->prepare($sql);
        // Run it.
        $isWorked = $stmt->execute(['id' => $id]);
        if (!$isWorked) {
            $errorMessage = "Sorry, a problem connecting to the database.";
        }
    }
    if ($errorMessage == '') {
        // Anything returned?
        if ($stmt->rowCount() == 0) {
            $errorMessage = "Sorry, no wombats with an id of $id.";
        }
    }
    // Return results.
    return $errorMessage;
}

/**
 * Get wombat entity with a given id.
 * @param int $wombatId The id.
 * @return array|null Entity, null if a problem.
 */
function getWombatWithId(int $wombatId) {
    global $dbConnection;
    $result = null;
    // Prepare SQL.
    $sql = "
        SELECT *
        FROM wombats 
        WHERE wombat_id = :id;
    ";
    $stmt = $dbConnection->prepare($sql);
    // Run it.
    $isWorked = $stmt->execute(['id' => $wombatId]);
    if ($isWorked) {
        $result = $stmt->fetch();
    }
    return $result;
}

/**
 * Get the shows for the wombat with the given id.
 * @param int $wombatId The wombat's id.
 * @return array|null The shows.
 */
function getGamesForWombatsWithId(int $wombatId) {
    global $dbConnection;
    $result = null;
    $sql = "
        select 
            games.game_id as game_id, 
            games.name as name
        from
            wombats, plays, games  
        where
            wombats.wombat_id = :wombat_id_to_show
            and plays.wombat_id = wombats.wombat_id
            and games.game_id = plays.game_id
        order by name;
    ";
    /** @var PDO $dbConnection */
    $stmnt = $dbConnection->prepare($sql);
    $isWorked = $stmnt->execute([':wombat_id_to_show' => $wombatId]);
    if ($isWorked) {
        $result = $stmnt->fetchAll();
    }
    return $result;
}

/**
 * Check the game id.
 * @param mixed $id Id.
 * @return string Error message, MT if OK.
 */
function checkGameId($id) {
    global $dbConnection;
    $errorMessage = '';
    if (is_null($id)) {
        $errorMessage = 'Sorry, game id is missing.';
    }
    if ($errorMessage == '') {
        if (! is_numeric($id)) {
            $errorMessage = 'Sorry, game id must be a number.';
        }
    }
    if ($errorMessage == '') {
        if ($id < 1) {
            $errorMessage = 'Sorry, game id must be one or more.';
        }
    }
    if ($errorMessage == '') {
        // Prepare SQL.
        $sql = "
            SELECT *
            FROM games 
            WHERE game_id = :id;
         ";
        $stmt = $dbConnection->prepare($sql);
        // Run it.
        $isWorked = $stmt->execute(['id' => $id]);
        if (!$isWorked) {
            $errorMessage = "Sorry, a problem connecting to the database.";
        }
    }
    if ($errorMessage == '') {
        // Anything returned?
        if ($stmt->rowCount() == 0) {
            $errorMessage = "Sorry, no game with an id of $id.";
        }
    }
    // Return results.
    return $errorMessage;
}

/**
 * Get game entity with a given id.
 * @param int $gameId The id.
 * @return array|null Entity, null if a problem.
 */
function getGameWithId(int $gameId) {
    global $dbConnection;
    $result = null;
    // Prepare SQL.
    $sql = "
        SELECT *
        FROM games
        WHERE game_id = :id;
    ";
    $stmt = $dbConnection->prepare($sql);
    // Run it.
    $isWorked = $stmt->execute(['id' => $gameId]);
    if ($isWorked) {
        $result = $stmt->fetch();
    }
    return $result;
}

/**
 * Get the wombats for the game with the given id.
 * @param int $gameId The games id.
 * @return array|null The shows.
 */
function getWombatForGameWithId(int $gameId) {
    global $dbConnection;
    $result = null;
    $sql = "
        select 
            wombats.wombat_id as wombat_id, 
            wombats.name as name,
            wombats.weight as weight,
            wombats.comments as comments
        from
            wombats, plays, games  
        where
            games.game_id = :game_id_to_show
            and plays.game_id = :games.game_id
            and wombats.wombat_id = :plays.wombat_id
        order by name;
    ";
    /** @var PDO $dbConnection */
    $stmnt = $dbConnection->prepare($sql);
    $isWorked = $stmnt->execute([':game_id_to_show' => $gameId]);
    if ($isWorked) {
        $result = $stmnt->fetchAll();
    }
    return $result;
}