<!DOCTYPE html>
<html>
<head>
    <title>Pokemon Evolutions</title>
</head>
<body>
<h1>Pokemon Evolutions</h1>
<form method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="pokemon">Select a Pokemon:</label>
    <select id="pokemon" name="pokemon">
        <option value="Bulbasaur">Bulbasaur</option>
        <option value="Charmander">Charmander</option>
        <option value="Squirtle">Squirtle</option>
        <option value="Pikachu">Pikachu</option>
        <option value="Nidorina">Nidorina</option>
        <option value="Geodude">geodude</option>
     
    </select>
    <input type="submit" value="Show Evolutions">
</form>
<?php
// Define an array of evolutions for each Pokemon
$evolutions = array(
    'Bulbasaur' => array('Ivysaur', 'Venusaur'),
    'Charmander' => array('Charmeleon', 'Charizard'),
    'Squirtle' => array('Wartortle', 'Blastoise'),
    'Pikachu' => array('Raichu'),
    "Nidorina"=>array('Nidorino,Nidoqueen'),
    "Geodude"=>array('Golem','Onyx')
);

// Get the selected Pokemon from the form
if (isset($_GET['pokemon'])) {
    $selectedPokemon = $_GET['pokemon'];
    // Check if the selected Pokemon exists in the evolutions array
    if (array_key_exists($selectedPokemon, $evolutions)) {
        // Display the evolutions for the selected Pokemon
        echo "<h2>Evolutions for $selectedPokemon:</h2>";
        echo "<ul>";
        foreach ($evolutions[$selectedPokemon] as $evolution) {
            echo "<li>$evolution</li>";
        }
        echo "</ul>";
    } else {
        // Display an error message if the selected Pokemon doesn't have any evolutions
        echo "<p>$selectedPokemon doesn't have any evolutions!</p>";
    }
}
?>
</body>
</html>
