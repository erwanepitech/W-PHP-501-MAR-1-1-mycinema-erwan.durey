<?php
// On se connecte à là base de données
require_once('api/connect.php');
connect($db);
require_once('api/pagination.php');
pagination($nbArticles, $pages, $currentPage, $parPage);
require_once('api/search.php');

if (isset($_GET['firstname']) && isset($_GET['lastname'])) {

    $lastname = $_GET['lastname'];
    $firstname = $_GET['firstname'];

    $sql = "SELECT COUNT(*) AS nb_articles
    FROM membership
    INNER JOIN user 
    ON membership.id_user = user.id 
    JOIN subscription ON subscription.id = membership.id_subscription 
    JOIN membership_log ON membership_log.id_membership = membership.id 
    JOIN movie_schedule ON movie_schedule.id = membership_log.id_session
    JOIN movie ON movie.id = movie_schedule.id_movie
    WHERE lastname LIKE '%$lastname%'
    AND firstname LIKE '%$firstname%';
    ";

    // On prépare la requête
    $query = $db->prepare($sql);

    // On exécute
    $query->execute();

    // On récupère le nombre d'articles
    $result = $query->fetch();

    $nbArticles = (int) $result['nb_articles']; 

    $sql = "SELECT user.lastname, user.firstname, subscription.name, movie.title, user.id, movie_schedule.date_begin
    FROM membership
    INNER JOIN user 
    ON membership.id_user = user.id 
    JOIN subscription ON subscription.id = membership.id_subscription 
    JOIN membership_log ON membership_log.id_membership = membership.id 
    JOIN movie_schedule ON movie_schedule.id = membership_log.id_session
    JOIN movie ON movie.id = movie_schedule.id_movie
    WHERE lastname LIKE '%$lastname%'
    AND firstname LIKE '%$firstname%'
    ORDER BY movie_schedule.date_begin DESC
    LIMIT :premier, :parpage;";

    sql ($pages, $parPage, $nbArticles, $artNb, $query, $sql, $currentPage, $db, $row);

}

if (isset($_GET['lastname']) && isset($_GET['firstname']) && $_GET['firstname'] == "") {

    $lastname = $_GET['lastname'];

    $sql = "SELECT COUNT(*) AS nb_articles
    FROM membership
    INNER JOIN user 
    ON membership.id_user = user.id 
    JOIN subscription ON subscription.id = membership.id_subscription 
    JOIN membership_log ON membership_log.id_membership = membership.id 
    JOIN movie_schedule ON movie_schedule.id = membership_log.id_session
    JOIN movie ON movie.id = movie_schedule.id_movie
    WHERE lastname LIKE '%$lastname%';";

    // On prépare la requête
    $query = $db->prepare($sql);

    // On exécute
    $query->execute();

    // On récupère le nombre d'articles
    $result = $query->fetch();

    $nbArticles = (int) $result['nb_articles']; 


    $sql = "SELECT user.lastname, user.firstname, subscription.name, movie.title, user.id, movie_schedule.date_begin
    FROM membership
    INNER JOIN user 
    ON membership.id_user = user.id 
    JOIN subscription ON subscription.id = membership.id_subscription 
    JOIN membership_log ON membership_log.id_membership = membership.id 
    JOIN movie_schedule ON movie_schedule.id = membership_log.id_session
    JOIN movie ON movie.id = movie_schedule.id_movie
    WHERE lastname LIKE '%$lastname%'
    ORDER BY movie_schedule.date_begin DESC
    LIMIT :premier, :parpage;";

    sql ($pages, $parPage, $nbArticles, $artNb, $query, $sql, $currentPage, $db, $row);

}

if (isset($_GET['lastname']) && isset($_GET['firstname']) && $_GET['lastname'] == "") {

    $firstname = $_GET['firstname'];

    $sql = "SELECT COUNT(*) AS nb_articles
    FROM membership
    INNER JOIN user 
    ON membership.id_user = user.id 
    JOIN subscription ON subscription.id = membership.id_subscription 
    JOIN membership_log ON membership_log.id_membership = membership.id 
    JOIN movie_schedule ON movie_schedule.id = membership_log.id_session
    JOIN movie ON movie.id = movie_schedule.id_movie
    WHERE firstname LIKE '%$firstname%';";

    // On prépare la requête
    $query = $db->prepare($sql);

    // On exécute
    $query->execute();

    // On récupère le nombre d'articles
    $result = $query->fetch();

    $nbArticles = (int) $result['nb_articles']; 


    $sql = "SELECT user.lastname, user.firstname, subscription.name, movie.title, user.id, movie_schedule.date_begin
    FROM membership
    INNER JOIN user 
    ON membership.id_user = user.id 
    JOIN subscription ON subscription.id = membership.id_subscription 
    JOIN membership_log ON membership_log.id_membership = membership.id 
    JOIN movie_schedule ON movie_schedule.id = membership_log.id_session
    JOIN movie ON movie.id = movie_schedule.id_movie
    WHERE firstname LIKE '%$firstname%'
    ORDER BY movie_schedule.date_begin DESC
    LIMIT :premier, :parpage;";

    sql ($pages, $parPage, $nbArticles, $artNb, $query, $sql, $currentPage, $db, $row);

}

require_once('api/close.php');  
?>