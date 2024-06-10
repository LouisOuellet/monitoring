<?php

// Display the Router Information
echo "<h1>ROUTER</h1>" . PHP_EOL . "<br>";
echo "Namespace: " . $this->getNamespace() . PHP_EOL . "<br>";
echo "Route: " . $this->getRoute() . PHP_EOL . "<br>";
echo "Label: " . $this->getLabel() . PHP_EOL . "<br>";
echo "Icon: " . $this->getIcon() . PHP_EOL . "<br>";
echo "Color: " . $this->getColor() . PHP_EOL . "<br>";
echo "Location: " . $this->getLocation() . PHP_EOL . "<br>";
echo "View: " . $this->getView() . PHP_EOL . "<br>";
echo "View File: " . $this->getViewFile() . PHP_EOL . "<br>";
echo "Template: " . $this->getTemplate() . PHP_EOL . "<br>";
echo "Template File: " . $this->getTemplateFile() . PHP_EOL . "<br>";
echo PHP_EOL . "<br>";

// If Session is started
if(session_status() == PHP_SESSION_ACTIVE) {
    echo "<h1>SESSION</h1>" . PHP_EOL . "<br>";
    foreach($_SESSION as $key => $value) {
        echo $key . " => " . $value . PHP_EOL . "<br>";
    }
    echo PHP_EOL . "<br>";
}

// if Cookies are set
if(count($_COOKIE) > 0) {
    echo "<h1>COOKIE</h1>" . PHP_EOL . "<br>";
    foreach($_COOKIE as $key => $value) {
        echo $key . " => " . $value . PHP_EOL . "<br>";
    }
    echo PHP_EOL . "<br>";
}

// if POST is set
if(count($_POST) > 0) {
    echo "<h1>POST</h1>" . PHP_EOL . "<br>";
    foreach($_POST as $key => $value) {
        echo $key . " => " . $value . PHP_EOL . "<br>";
    }
    echo PHP_EOL . "<br>";
}

// if GET is set
if(count($_GET) > 0) {
    echo "<h1>GET</h1>" . PHP_EOL . "<br>";
    foreach($_GET as $key => $value) {
        echo $key . " => " . $value . PHP_EOL . "<br>";
    }
    echo PHP_EOL . "<br>";
}

// if FILES is set
if(count($_FILES) > 0) {
    echo "<h1>FILES</h1>" . PHP_EOL . "<br>";
    foreach($_FILES as $key => $value) {
        echo $key . " => " . $value . PHP_EOL . "<br>";
    }
    echo PHP_EOL . "<br>";
}

// if SERVER is set
if(count($_SERVER) > 0) {
    echo "<h1>SERVER</h1>" . PHP_EOL . "<br>";
    foreach($_SERVER as $key => $value) {
        echo $key . " => " . $value . PHP_EOL . "<br>";
    }
    echo PHP_EOL . "<br>";
}

// Display the PHP Info
echo phpinfo();
