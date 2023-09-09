<?php
//$dbName = 'ssheaven_wombat';
//$dbUserName = 'ssheaven_ssheaven';
//$dbPassword = 'oakland@1234';

// Connect to the database.
require_once '/home/ssheaven/exercises.ssheavenmusic.com/finalproject/library/useful-stuff.php';
$errorMessage = '';
$wombatEntity = '';
$wombatId = getParamFromGet('wombat_id');
$errorMessage = checkWombatId($wombatId);
if ($errorMessage == '') {
    // Get data about the wombat.
    $wombatEntity = getWombatWithId($wombatId);
    if (is_null($wombatEntity)) {
        $errorMessage = "Sorry, error looking up wombats $wombatId.";
    }
}
if ($errorMessage == '') {
    // Lookup the games with that wombat.
    $gameEntities = getGamesForWombatsWithId($wombatId);
    if (is_null($gameEntities)) {
        $errorMessage = "Sorry, error looking up games for wombat $wombatId.";
    }
}
?>
<!doctype html>
<html lang="en">
<? $pageTitle = 'Wombat';?>
<?php require_once '/home/ssheaven/exercises.ssheavenmusic.com/finalproject/library/page-components/head.php'; ?>
<body>
<div id="top">
<p is="site-name">Wombats</p>
    <?php require_once '/home/ssheaven/exercises.ssheavenmusic.com/finalproject/library/page-components/top.php'; ?>
</div>
<h1 class="page-title">Wombat deets</h1>
<?php
if ($errorMessage != '') {
    print "<p class='alert-danger text-danger m-2 p-2'>$errorMessage</p>";
}
else {
    print "<p>Wombat deets.</p>\n";
    print "<p>Id: {$wombatEntity['wombat_id']}</p>\n";
    print "<p>Name: {$wombatEntity['name']}</p>\n";
    print "<p>Weight: {$wombatEntity['weight']}</p>\n";
    print "<p>Comments: {$wombatEntity['comments']}</p>\n";
    print "<h3>Games</h3>\n";
    if (count($gameEntities) == 0) {
        print "<p>The wombat does not play any game.</p>\n";
    }
    else {
        print "<ul>\n";
        foreach ($gameEntities as $gameEntity) {
            $gameId = $gameEntity['game_id'];
            $name = $gameEntity['name'];
            $link = "<a href='show-games.php?game_id=$gameId'> $name</a>";
            print "<li>$link</li>\n";
        }
        print "</ul>\n";
    }
}
?>
<?php include '/home/ssheaven/exercises.ssheavenmusic.com/finalproject/library/page-components/footer.php'; ?>
</body>
</html>
