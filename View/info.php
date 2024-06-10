<?php

echo "<h1>SESSION</h1>" . PHP_EOL . "<br>";
foreach($_SESSION as $key => $value) {
    echo $key . " => " . $value . PHP_EOL . "<br>";
}

echo PHP_EOL . "<br>";

echo "<h1>COOKIE</h1>" . PHP_EOL . "<br>";
foreach($_COOKIE as $key => $value) {
    echo $key . " => " . $value . PHP_EOL . "<br>";
}

echo phpinfo();
