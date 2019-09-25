<?php
namespace _24k;
require_once "io.php";
require_once "html.php";

$h = new html("example.html");

$h->begin();

$what = $_POST["what"];

echo
"<h1>Your input:</h1>",
"<p>$what</p>";

$h->end();

?>
