<?php
function connect (&$db) {
    try{
        // Connexion à la base
        $db = new PDO('mysql:host=localhost;dbname=cinema', 'root', '');
        $db->exec('SET NAMES "UTF8"');
    } catch (PDOException $e){
        echo 'Erreur : '. $e->getMessage();
        die();
    }
}