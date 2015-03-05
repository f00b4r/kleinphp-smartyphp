<?php

// Register router/service autoloader
spl_autoload_register(function ($class) {
    $filename = "$class.php";

    if (file_exists(__DIR__ . '/router/' . $filename)) {
        include __DIR__ . '/router/' . $filename;
    } else if (file_exists(__DIR__ . '/service/' . $filename)) {
        include __DIR__ . '/service/' . $filename;
    }
});