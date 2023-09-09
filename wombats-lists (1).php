<?php
// Connect to the database.
require_once '/home/ssheaven/exercises.ssheavenmusic.com/finalproject/library/useful-stuff.php';
$errorMessage = '';
$comments = '';
$sql = "
    SELECT wombat_id, name , weight, comments
    FROM wombats
    ORDER BY name;";
/** @var PDO $dbConnection */
$stmnt = $dbConnection->prepare($sql);
$stmnt->execute();
// Found any records?
if ($stmnt->rowCount() == 0) {
    $errorMessage = "Sorry, couldn't find any wombats in the database.";
}
else {
    $rows = $stmnt->fetchAll();
}
?>

<!doctype html>
<html lang="en">
<?$pageTitle = 'Wombat list';?>
<?php require_once '/home/ssheaven/exercises.ssheavenmusic.com/finalproject/library/page-components/head.php'; ?>
<body>
<div id="top">
    <p is="site-name">Wombats</p>
    <?php require_once '/home/ssheaven/exercises.ssheavenmusic.com/finalproject/library/page-components/top.php'; ?>
</div>
<h1 class="page-title">Wombat list</h1>
<p>Here are the wombats.</p>
<?php require_once '/home/ssheaven/exercises.ssheavenmusic.com/finalproject/library/page-components/top.php'; ?>

<?php
if ($errorMessage != '') {
    print "<p class='alert-danger text-danger m-2 p-2'>$errorMessage</p>";
}
else {
print "<ul>\n";
foreach ($rows as $row) {
    $id = $row['wombat_id'];
    $name = $row['name'];
    $weight = $row['weight'];
    $link = "<a href='showswombats.php?wombat_id=$id'>$name</a>";
    print "<li>$link</li>\n";
}
print "</ul>\n";
    }
?>
<?php include '/home/ssheaven/exercises.ssheavenmusic.com/finalproject/library/page-components/footer.php'; ?>
</body>
</html>
