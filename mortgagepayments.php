<?php
// Display message before the output
echo "This is the output of the program:<br><br>";

function validate_input($input) {
  if (!isset($_GET[$input]) || empty($_GET[$input])) {
    return "$input is required.";
  }

  $value = $_GET[$input];
  if (!is_numeric($value) || $value <= 0 || $value >= 1000000000) {
    return "$input must be a number greater than zero and less than one billion.";
  }

  return "";
}

function calculate_payment($principal, $rate, $term) {
  $rate_monthly = ($rate / 100) / 12;
  $term_months = $term * 12;
  $payment = ($principal * $rate_monthly) / (1 - pow(1 + $rate_monthly, -$term_months));
  return round($payment, 2);
}

$errors = array();
$errors[] = validate_input("principal");
$errors[] = validate_input("rate");
$errors[] = validate_input("term");

if (!empty(array_filter($errors))) {
  echo "Errors:<br>";
  foreach ($errors as $error) {
    if (!empty($error)) {
      echo "- $error<br>";
    }
  }
} else {
  $principal = $_GET["principal"];
  $rate = $_GET["rate"];
  $term = $_GET["term"];

  $payment = calculate_payment($principal, $rate, $term);
 // Display input values
 
  echo "Principal: " . $principal . "<br>" . "<br>";
  echo "Rate: " . $rate . "<br>" . "<br>";
  echo "Term: " . $term . "<br>" . "<br>"; 
  echo "Monthly payment: $payment" . "<br>" . "<br>";


if ($payment < 2000) {
    echo "You should get two doggos.";
  } else {
    echo "You should get a doggo.";
  }
  
 echo "Submitted by Shubham Shrivastava";
}
?>
