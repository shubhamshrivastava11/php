<?php
// Connect to the database.
require_once '/home/ssheaven/exercises.ssheavenmusic.com/finalproject/library/useful-stuff.php';
$gameEntity = '';
$errorMessage = '';
$gameId = getParamFromGet('game_id');
$errorMessage = checkGameId($gameId);
if ($errorMessage == '') {
    // Get game deets.
    $gameEntity = getGameWithId($gameId);
    if (is_null($gameEntity)) {
        $errorMessage = "Sorry, error looking up game $gameId.";
    }
}
if ($errorMessage == '') {
    // Get wombat in the game.
    $wombatsEntities = getWombatForGameWithId($gameId);
    if (is_null($wombatsEntities)) {
        $errorMessage = "Sorry, error looking up wombat in game with id $gameId.";
    }
}
?>
<!doctype html>
<html lang="en">
<?$pageTitle = 'Game';?>
<?php require_once '/home/ssheaven/exercises.ssheavenmusic.com/finalproject/library/page-components/head.php'; ?>
<body>
<div id="top">
    <p is="site-name">Wombats</p>
    <?php require_once '/home/ssheaven/exercises.ssheavenmusic.com/finalproject/library/page-components/top.php'; ?>
</div>
<h1 class="page-title">Game deets</h1>

 <?php
        if ($errorMessage != '') {
            print "<p class='alert-danger text-danger m-2 p-2'>$errorMessage</p>";
        }
        else {
            print "<p>Here are the deets for the game.</p>\n";
            print "<p>Id: {$gameEntity['game_id']}</p>\n";
            print "<p>Name: {$gameEntity['name']}</p>\n";

            if (count($wombatsEntities) == 0) {
                print "<p>No wombats are listed for the game.</p>\n";
            }
            else {
                print "<h3>Wombats</h3>\n";
                print "<ul>\n";
                foreach ($wombatsEntities as $wombatEntity) {
                    $wombatId = $wombatEntity['wombat_id'];
                    $name = $wombatEntity['name'];
                    $weight = $wombatEntity['weight'];
                    $comments = $wombatEntity['comments'];
                    $link = "<a href='showswombats.php?wombat_id=$wombatId'>$name $weight $comments</a>";
                    print "<li>$link</li>\n";
                }
                print "</ul>\n";
            }
        }
        ?>
<?php require_once '/home/ssheaven/exercises.ssheavenmusic.com/finalproject/library/page-components/footer.php'; ?>
</body>
</html>