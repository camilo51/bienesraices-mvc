<?php

    function conectarDB() : mysqli {
        $db = new mysqli($_ENV['DB_HOST'], $_ENV['DB_USER'], $_ENV['DB_PASS'] ?? '', $_ENV['DB_NAME']);
        // debugear($db);
        if(!$db) {
            echo "No se pudo conectar";
            exit;
        }

        return $db;
    }