<?php
require_once '/home/ssheaven/exercises.ssheavenmusic.com/finalproject/library/useful-stuff.php';
$gameEntities = '';
$errorMessage = '';
$sql = "
    SELECT game_id, name 
    FROM games
    ORDER BY name;";
/** @var PDO $dbConnection */
$stmnt = $dbConnection->prepare($sql);
$stmnt->execute();
// Found any records?
if ($stmnt->rowCount() == 0) {
    $errorMessage = "Sorry, couldn't find games in the database.";
}
else {
    $gameEntities = $stmnt->fetchAll();
}
?>

<!doctype html>
<html lang="en">
<?$pageTitle = 'Game list';?>
<?php require_once '/home/ssheaven/exercises.ssheavenmusic.com/finalproject/library/page-components/top.php'; ?>
<body>
<div id="top">
    <p is="site-name">Wombats</p>
    <?php require_once '/home/ssheaven/exercises.ssheavenmusic.com/finalproject/library/page-components/top.php'; ?>
</div>
<h1 class="page-title">Game list</h1>
<p>Here are the games.</p>

<?php
if ($errorMessage != '') {
    print "<p class='alert-danger text-danger m-2 p-2'>$errorMessage</p>";
}
else {
    print "<ul>\n";
    foreach ($gameEntities as $gameEntity) {
        $id = $gameEntity['game_id'];
        $name = $gameEntity['name'];
        $link = "<a href='show-games.php?game_id=$id'>$name</a>";
        print "<li>$link</li>\n";
    }
    print "</ul>\n";
}
?>
<?php include '/home/ssheaven/exercises.ssheavenmusic.com/finalproject/library/page-components/footer.php'; ?>
</body>
</html>
