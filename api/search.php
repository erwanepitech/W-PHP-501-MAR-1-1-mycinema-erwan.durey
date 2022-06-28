<?php
// On se connecte à là base de données
require_once('api/connect.php');
connect($db);
require_once('api/pagination.php');
pagination($nbArticles, $pages, $currentPage, $parPage);

if (isset($_GET['search'])) {

    $search = $_GET['search'];

}

if (isset($_GET['filtre'])) {
    
    $filter = $_GET['filtre'];

}

if (isset($_GET['firstname'])) {

    $firstname = $_GET['firstname'];

}

if (isset($_GET['lastname'])) {
    
    $lastname = $_GET['lastname'];

}

if (isset($_GET['filtre']) && $_GET['filtre'] == "title") {

    // On détermine le nombre total d'éléments
    $sql = "SELECT COUNT(*) AS nb_articles FROM `movie` WHERE title LIKE '%$search%';";

    // On prépare la requête
    $query = $db->prepare($sql);

    // On exécute
    $query->execute();

    // On récupère le nombre d'articles
    $result = $query->fetch();

    $nbArticles = (int) $result['nb_articles']; 

    $sql = "SELECT `title`, `duration`, `id`
    FROM movie
    WHERE $filter LIKE '%$search%'
    ORDER BY `title` ASC
    LIMIT :premier, :parpage;";

    sql ($pages, $parPage, $nbArticles, $artNb, $query, $sql, $currentPage, $db, $row);

}

if (isset($_GET['filtre']) && $_GET['filtre'] == "genre" && isset($_GET['genre'])) {
    
    $genre = $_GET['genre'];

    $sql = "SELECT COUNT(*) AS nb_articles
    FROM genre
    INNER JOIN movie_genre ON genre.id = movie_genre.id_genre
    JOIN movie ON movie.id = id_movie
    WHERE name LIKE '%$genre%';";

    // On prépare la requête
    $query = $db->prepare($sql);

    // On exécute
    $query->execute();

    // On récupère le nombre d'articles
    $result = $query->fetch();

    $nbArticles = (int) $result['nb_articles']; 

    $sql = "SELECT `name`, `title`, `duration`, `movie`.`id`
    FROM genre 
    INNER JOIN movie_genre ON genre.id = movie_genre.id_genre
    JOIN movie ON movie.id = id_movie
    WHERE `name` LIKE '%$genre%'
    ORDER BY `title` ASC
    LIMIT :premier, :parpage;";

    sql ($pages, $parPage, $nbArticles, $artNb, $query, $sql, $currentPage, $db, $row);

}


if (isset($_GET['filtre']) && isset($_GET['filtre']) && $_GET['filtre'] == "distributor") {

    $sql = "SELECT COUNT(*) AS nb_articles
    FROM `distributor`
    INNER JOIN `movie` ON distributor.id = movie.id_distributor
    WHERE name LIKE '%$search%';";

    // On prépare la requête
    $query = $db->prepare($sql);

    // On exécute
    $query->execute();

    // On récupère le nombre d'articles
    $result = $query->fetch();

    $nbArticles = (int) $result['nb_articles']; 

    $sql = "SELECT `name`, `title`, `duration`, `movie`.`id`
    FROM `distributor`
    INNER JOIN `movie` ON distributor.id = movie.id_distributor
    WHERE `name` IS NOT NULL
    AND `name` LIKE '%$search%'
    ORDER BY `title` ASC
    LIMIT :premier, :parpage;";

    sql ($pages, $parPage, $nbArticles, $artNb, $query, $sql, $currentPage, $db, $row);

}

if (isset($_GET['filtre']) && $_GET['filtre'] == "date_begin") {

    $sql = "SELECT COUNT(*) AS nb_articles
    FROM movie 
    INNER JOIN movie_schedule ON movie.id = movie_schedule.id_movie
    JOIN room ON movie_schedule.id_room = room.id
    WHERE date_begin LIKE '%$search%';";

    // On prépare la requête
    $query = $db->prepare($sql);

    // On exécute
    $query->execute();

    // On récupère le nombre d'articles
    $result = $query->fetch();

    $nbArticles = (int) $result['nb_articles']; 

    $sql = "SELECT `title`, `duration`, `name`, `date_begin`, `floor`, `seats`, `movie_schedule`.`id`
    FROM movie 
    INNER JOIN movie_schedule ON movie.id = movie_schedule.id_movie
    JOIN room ON movie_schedule.id_room = room.id
    WHERE `date_begin` LIKE '%$search%'
    ORDER BY date_begin DESC
    LIMIT :premier, :parpage;";

    sql ($pages, $parPage, $nbArticles, $artNb, $query, $sql, $currentPage, $db, $row);

}

if (isset($_GET['firstname']) && isset($_GET['lastname'])) {

    $lastname = $_GET['lastname'];
    $firstname = $_GET['firstname'];

    $sql = "SELECT COUNT(*) AS nb_articles
    FROM user
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

    $sql = "SELECT lastname, firstname, name
    FROM `user`
    LEFT JOIN `membership` ON user.id = membership.id_user
    LEFT JOIN subscription ON subscription.id = membership.id_subscription
    WHERE lastname LIKE '%$lastname%'
    AND firstname LIKE '%$firstname%'
    LIMIT :premier, :parpage;";

    sql ($pages, $parPage, $nbArticles, $artNb, $query, $sql, $currentPage, $db, $row);

}

if (isset($_GET['lastname']) && isset($_GET['firstname']) && $_GET['firstname'] == "") {

    $lastname = $_GET['lastname'];

    $sql = "SELECT COUNT(*) AS nb_articles
    FROM user
    WHERE lastname LIKE '%$lastname%';";

    // On prépare la requête
    $query = $db->prepare($sql);

    // On exécute
    $query->execute();

    // On récupère le nombre d'articles
    $result = $query->fetch();

    $nbArticles = (int) $result['nb_articles']; 


    $sql = "SELECT lastname, firstname, name
    FROM `user`
    LEFT JOIN `membership` ON user.id = membership.id_user
    LEFT JOIN subscription ON subscription.id = membership.id_subscription
    WHERE lastname LIKE '%$lastname%'
    ORDER BY lastname
    LIMIT :premier, :parpage;";

    sql ($pages, $parPage, $nbArticles, $artNb, $query, $sql, $currentPage, $db, $row);

}

if (isset($_GET['lastname']) && isset($_GET['firstname']) && $_GET['lastname'] == "") {

    $firstname = $_GET['firstname'];

    $sql = "SELECT COUNT(*) AS nb_articles
    FROM user
    WHERE firstname LIKE '%$firstname%';";

    // On prépare la requête
    $query = $db->prepare($sql);

    // On exécute
    $query->execute();

    // On récupère le nombre d'articles
    $result = $query->fetch();

    $nbArticles = (int) $result['nb_articles']; 


    $sql = "SELECT lastname, firstname, name
    FROM `user`
    LEFT JOIN `membership` ON user.id = membership.id_user
    LEFT JOIN subscription ON subscription.id = membership.id_subscription
    WHERE firstname LIKE '%$firstname%'
    ORDER BY firstname
    LIMIT :premier, :parpage;";

    sql ($pages, $parPage, $nbArticles, $artNb, $query, $sql, $currentPage, $db, $row);
}


function sql (&$pages, &$parPage, &$nbArticles, &$artNb, &$query, &$sql, &$currentPage, &$db, &$row) {
    
    // On calcule le nombre de pages total
    $pages = ceil($nbArticles / $parPage);

    // Calcul du 1er article de la page
    $premier = (($currentPage-1)*$parPage);

    // On prépare la requête
    $query = $db->prepare($sql);

    $query->bindValue(':premier', $premier, PDO::PARAM_INT);
    $query->bindValue(':parpage', $parPage, PDO::PARAM_INT);

    // On exécute
    $query->execute();

    $row = $query->fetchAll(PDO::FETCH_ASSOC);

    $artNb = ($parPage*$currentPage);

    if ($artNb > $nbArticles) {
        $artNb = $nbArticles;
    }

}
require_once('api/close.php');  
?>