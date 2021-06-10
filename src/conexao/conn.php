<?php

    $hostname = "fdb30.awardspace.net";
    $dbname = "3762244_library1";
    $username = "3762244_library1";
    $password = "12345678@m";

    try {
        $pdo = new PDO('mysql:host='.$hostname.';dbname='.$dbname, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch (PDOException $e) {
        echo 'Error: '.$e->getMessage();
    }