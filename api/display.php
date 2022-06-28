<?php
require_once("api/search.php");

function display_movie (&$row, &$search, &$filter, &$artNb, &$nbArticles) {

    if ($_GET && $_GET['filtre'] == "title") {
        echo <<< END_OF_TEXT
        <h4>Nombre de resultats de votre recherche (  $search $filter ) :  $artNb / $nbArticles</h4>

        <table class="table">
        <thead>
            <th>Tirtre</th>
            <th>Durée</th>
            <th>Manage</th>
        </thead>
        <tbody>
        END_OF_TEXT;
        for ($i = 0; $i < count($row); $i++) {
            $id = $row[$i]['id'];
            $title = $row[$i]['title'];
            $duration = $row[$i]['duration'] . " minutes";
            $manage = "<a href=\"session.php?&filtre=title&search=$title&genre=Action&nombre=10&id=$id\">ajouter une séance</a>";
            echo <<< END_OF_TEXT
            <tr>
        
                <td>$title</td>
            END_OF_TEXT;
            if ($duration === " minutes") {
                $duration = "Non renseignée";
            }
            echo <<< END_OF_TEXT
                <td>$duration</td> 
                <td>$manage</td> 
        
            </tr>
            END_OF_TEXT;
        } 
    } elseif ($_GET && $_GET['filtre'] == "distributor") {
            echo <<< END_OF_TEXT
            <h4>Nombre de resultats de votre recherche (  $search $filter ) :  $artNb / $nbArticles</h4>
        <table class="table">
        <thead>
            <th>Tirtre</th>
            <th>Nom du Distributeur</th>
            <th>Durée</th>
            <th>Manage</th>
        </thead>
        <tbody>
        END_OF_TEXT;
        for ($i = 0; $i < count($row); $i++) {
            $id = $row[$i]['id'];
            $name = $row[$i]['name'];
            $title = $row[$i]['title'];
            $duration = $row[$i]['duration'] . " minutes";
            $manage = "<a href=\"session.php?&filtre=title&search=$title&genre=Action&nombre=10&id=$id\">ajouter une séance</a>";
                echo <<< END_OF_TEXT
            <tr>
                <td>$title</td>
                <td>$name</td>
            END_OF_TEXT;
            if ($duration === " minutes") {
                $duration = "Non renseignée";
            }
            echo <<< END_OF_TEXT
                <td>$duration</td>
                <td>$manage</td>
            </tr>
            END_OF_TEXT;
            }
    } elseif ($_GET && $_GET['filtre'] == "genre" && $_GET['genre']) {
            $genre = $_GET['genre'];
            echo <<< END_OF_TEXT
            <h4>Nombre de resultats de votre recherche (  $search $filter : $genre ) :  $artNb / $nbArticles</h4>
            <table class="table">
        <thead>
            <th>Tirtre</th>
            <th>Genre</th>
            <th>Durée</th>
            <th>Manage</th>
        </thead>
        <tbody>
        END_OF_TEXT;
        for ($i = 0; $i < count($row); $i++) {
            $id = $row[$i]['id'];
            $title = $row[$i]['title'];
            $name = $row[$i]['name'];
            $duration = $row[$i]['duration'] . " minutes";
            $manage = "<a href=\"session.php?&filtre=title&search=$title&genre=Action&nombre=10&id=$id\">ajouter une séance</a>";
            echo <<< END_OF_TEXT
            <tr>
            <tr>
                <td>$title</td>
                <td>$name</td>
            END_OF_TEXT;
            if ($duration === " minutes") {
                $duration = "Non renseignée";
            }
            echo <<< END_OF_TEXT
                <td>$duration</td>
                <td>$manage</td>
            </tr>
            END_OF_TEXT;
        }
    } elseif ($_GET && $_GET['filtre'] == "date_begin") {
        echo <<< END_OF_TEXT
        <h4>Nombre de resultats de votre recherche (  $search $filter ) :  $artNb / $nbArticles</h4>
            <table class="table">
        <thead>
            <th>Tirtre</th>
            <th>Salle</th>
            <th>Places</th>
            <th>Etage</th>
            <th>Date de projection</th>
            <th>Durée</th>
            <th>Manage</th>
        </thead>
        <tbody>
        END_OF_TEXT;
        for ($i = 0; $i < count($row); $i++) {
            $title = $row[$i]['title'];
            $project = $row[$i]['date_begin'];
            $duration = $row[$i]['duration'] . " minutes";
            $room = $row[$i]['name'];
            $floor = $row[$i]['floor'];
            $seats = $row[$i]['seats'];
            $id = $row[$i]['id'];
            $manage = "<a href=\"log.php?&room=$room&duration=$duration&floor=$floor&search=$title&seats=$seats&project=$project&id=$id&nombre=10\">ajouter à un historique</a>";
            echo <<< END_OF_TEXT
            <tr>
                <td>$title</td>
                <td>$room</td>
                <td>$seats</td>
                <td>$floor</td>
                <td>$project</td>
            END_OF_TEXT;
            if ($duration === " minutes") {
                $duration = "Non renseigneée";
            }
            echo <<< END_OF_TEXT
                <td>$duration</td>
                <td>$manage</td>
            </tr>
            END_OF_TEXT;
        }
        
    }

    echo <<< END_OF_TEXT
    </tbody>
    </table>
    END_OF_TEXT;

}

function display_user (&$row, &$firstname, &$lastname, &$nbArticles, &$artNb) {

    $nombre = $_GET['nombre'];

    if ($_GET && $_GET['firstname'] && $_GET['lastname']) {
        echo <<< END_OF_TEXT
        <h4>Nombre de resultats de votre recherche ( $firstname $lastname ) : $nbArticles / $artNb </h4>
        <table class="table">
        <thead>
            <th>Prénom</th>
            <th>Nom</th>
            <th>Abonnement</th>
            <th>Historique</th>
            </thead>
        <tbody>
        END_OF_TEXT;
        for ($i = 0; $i < count($row); $i++) {
            $firstname = $row[$i]['firstname'];
            $lastname = $row[$i]['lastname'];
            $subscription = $row[$i]['name'];
            $history = "<a href=\"historique.php?lastname=$lastname&firstname=$firstname&nombre=$nombre\">Historique</a>";
            $manage = "<a href=\"gestion.php?lastname=$lastname&firstname=$firstname&subscription=$subscription&nombre=$nombre\">gérer</a>";
            echo <<< END_OF_TEXT
            <tr>
        
                <td>$firstname </td>
                <td>$lastname </td>
            END_OF_TEXT;
            if ($subscription === NULL) {
                $subscription = "Pas d'abonnement";
                $history = "Pas d'historique";
            }
            echo <<< END_OF_TEXT
                <td>&emsp; $subscription $manage</td> 
                <td>$history</td>
    
            </tr>
            END_OF_TEXT;
        } 
    } elseif ($_GET && $_GET['firstname'] =! "" && $_GET['lastname'] == "") {
            echo <<< END_OF_TEXT
            <h4>Nombre de resultats de votre recherche ( $firstname $lastname ) : $nbArticles / $artNb </h4>
                <table class="table">
                <thead>
                    <th>Prénom</th>
                    <th>Nom</th>
                    <th>Abonnement</th>
                    <th>Historique</th>
                    </thead>
                <tbody>
            END_OF_TEXT;
        for ($i = 0; $i < count($row); $i++) {
            $firstname = $row[$i]['firstname'];
            $lastname = $row[$i]['lastname'];
            $subscription = $row[$i]['name'];
            $history = "<a href=\"historique.php?lastname=$lastname&firstname=$firstname&nombre=$nombre\">Historique</a>";
            $manage = "<a href=\"gestion.php?lastname=$lastname&firstname=$firstname&subscription=$subscription&nombre=$nombre\">gérer</a>";
            echo <<< END_OF_TEXT
            <tr>
        
                <td>$firstname</td>
                <td>$lastname</td>
            END_OF_TEXT;
            if ($subscription === NULL) {
                $subscription = "Pas d'abonnement";
                $history = "Pas d'historique";
            }
            echo <<< END_OF_TEXT
                <td>&emsp; $subscription $manage</td>
                <td>$history</td>
            
            </tr>
            END_OF_TEXT;
        }
    } elseif ($_GET && $_GET['firstname'] == "" && $_GET['lastname'] =! "") {
        echo <<< END_OF_TEXT
        <h4>Nombre de resultats de votre recherche ( $firstname $lastname ) : $nbArticles / $artNb </h4>
            <table class="table">
            <thead>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Abonnement</th>
                <th>Historique</th>
            </thead>
            <tbody>
        END_OF_TEXT;
        $url = $url_parts['path'];
        for ($i = 0; $i < count($row); $i++) {
            $firstname = $row[$i]['firstname'];
            $lastname = $row[$i]['lastname'];
            $subscription = $row[$i]['name'];
            $history = "<a href=\"historique.php?lastname=$lastname&firstname=$firstname&nombre=$nombre\">Historique</a>";
            $manage = "<a href=\"gestion.php?lastname=$lastname&firstname=$firstname&subscription=$subscription&nombre=$nombre\">gérer</a>";
            echo <<< END_OF_TEXT
            <tr>
            
                <td>$lastname</td>
                <td>$firstname</td>
            END_OF_TEXT;
            if ($subscription === NULL) {
                $subscription = "Pas d'abonnement";
                $history = "Pas d'historique";
            }
            echo <<< END_OF_TEXT
                <td>&emsp; $subscription $manage</td>
                <td>$history</td>
            </tr>
            END_OF_TEXT;
        }   
    }

    echo <<< END_OF_TEXT
    </tbody>
    </table>
    END_OF_TEXT;

}

function display_sub (&$row) {

    if ($_GET && $_GET['subscription'] === "Pass Day" || $_GET['subscription'] === "Classic" || $_GET['subscription'] === "GOLD" || $_GET['subscription'] === "VIP") {
        echo <<< END_OF_TEXT
            <table class="table">
            <thead>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Abonnement</th>
            </thead>
            <tbody>
        END_OF_TEXT;
        for ($i = 0; $i < count($row); $i++) {
            $firstname = $row[$i]['firstname'];
            $lastname = $row[$i]['lastname'];
            $subscription = $row[$i]['name'];
            echo <<< END_OF_TEXT
                <tr>

                    <td>$lastname</td>
                    <td>$firstname</td>
            END_OF_TEXT;
                    if ($subscription === NULL) {
                        $subscription = "Pas d'abonnement";
                    }
                    echo <<< END_OF_TEXT
                    <td>$subscription</td>

                </tr>
            END_OF_TEXT;
        }
    }

    echo <<< END_OF_TEXT
    </tbody>
    </table>
    END_OF_TEXT;

}

function display_history (&$row, &$nbArticles, &$artNb, &$lastname, &$firstname) {

    require_once("api/history.php");

    if ($_GET && $_GET['firstname'] && $_GET['lastname']) {
        echo <<< END_OF_TEXT
        <h4>Nombre d'entrée dans l'historique de ( $firstname $lastname ) : $artNb / $nbArticles </h4>
        <table class="table">
        <thead>
            <th>Historique</th>
            <th>date</th>
        </thead>
        <tbody>
        END_OF_TEXT;
        for ($i = 0; $i < count($row); $i++) {
            $firstname = $row[$i]['firstname'];
            $lastname = $row[$i]['lastname'];
            $subscription = $row[$i]['name'];
            $title = $row[$i]['title'];
            $date = $row[$i]['date_begin'];
            echo <<< END_OF_TEXT
            <tr>

                <td>$title</td>
                <td>le : $date</td>
    
            </tr>
            END_OF_TEXT;
        } 
    }
    echo <<< END_OF_TEXT
    </tbody>
    </table>
    <br/>
    END_OF_TEXT;

    require_once("api/pagination.php");
    pagination($nbArticles, $pages, $currentPage, $parPage);

}

function display_add_history (&$row, &$nbArticles, &$artNb, &$lastname, &$firstname) {

    if ($_GET && $_GET['search']) {
        echo <<< END_OF_TEXT
        <br/>
        <table class="table">
        <thead>
            <th>Tirtre</th>
            <th>Salle</th>
            <th>Places</th>
            <th>Etage</th>
            <th>Date de projection</th>
            <th>Durée</th>
        </thead>
        <tbody>
        END_OF_TEXT;
        $title = $_GET['search'];
        $project = $_GET['project'];
        $duration = $_GET['duration'];
        $room = $_GET['room'];
        $floor = $_GET['floor'];
        $seats = $_GET['seats'];
        $id = $_GET['id'];
        echo <<< END_OF_TEXT
        <tr>
            <td>$title</td>
            <td>$room</td>
            <td>$seats</td>
            <td>$floor</td>
            <td>$project</td>
        END_OF_TEXT;
        echo <<< END_OF_TEXT
            <td>$duration</td>
        </tr>
        END_OF_TEXT;
    }
    echo <<< END_OF_TEXT
    </tbody>
    </table>
    <br/>
    END_OF_TEXT;

    require_once("api/pagination.php");
    pagination($nbArticles, $pages, $currentPage, $parPage);

}

function display_select_member (&$row, &$nbArticles, &$artNb, &$lastname, &$firstname, &$db) {

    require_once('api/connect.php');
    connect($db);
    require_once('api/pagination.php');
    pagination($nbArticles, $pages, $currentPage, $parPage);

    $sql = "SELECT COUNT(*) AS nb_articles
    FROM `user`
    INNER JOIN `membership` ON user.id = membership.id_user
    INNER JOIN subscription ON subscription.id = membership.id_subscription;";

    // On prépare la requête
    $query = $db->prepare($sql);
    
    // On exécute
    $query->execute();
    
    // On récupère le nombre d'articles
    $result = $query->fetch();
    
    $nbArticles = (int) $result['nb_articles']; 

    $sql = "SELECT lastname, firstname, membership.id
    FROM `user`
    INNER JOIN `membership` ON user.id = membership.id_user
    INNER JOIN subscription ON subscription.id = membership.id_subscription
    ORDER BY firstname
    LIMIT :premier, :parpage;";

    require_once("api/search.php");
    sql ($pages, $parPage, $nbArticles, $artNb, $query, $sql, $currentPage, $db, $row);

    echo <<< END_OF_TEXT

    <form action="" method="post">
    <table class="table">
            <thead>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Select</th>
            </thead>
            <tbody>
    END_OF_TEXT;
    for ($i = 0; $i < count($row); $i++) {
        $firstname = $row[$i]['firstname'];
        $lastname = $row[$i]['lastname'];
        $id_user = $row[$i]['id'];
        echo <<< END_OF_TEXT
            <tr>
            <td>$lastname</td>
            <td>$firstname</td>
            <td><input type="checkbox" name="id_user[]" value="$id_user"></td>
            
            </tr>
        END_OF_TEXT;
    }
    echo <<< END_OF_TEXT
    </tbody>
    </table>
    <br/>
    <div class="main">
        <input type="submit" value="ajouter" />
    </div>
    </form>
    <br/>
    END_OF_TEXT;

    pagination($nbArticles, $pages, $currentPage, $parPage);

    require_once("api/close.php");
}

function select_sub () {

    require_once('api/connect.php');
    connect($db);
    $sql = "SELECT name, id FROM subscription";
    $query = $db->prepare($sql);
    $query->execute();
    $slq = $query->fetchAll(PDO::FETCH_ASSOC);
    for ($i = 0; $i < count($slq); $i++) {
        $subscription = $slq[$i]['name'];
        $id_subscription = $slq[$i]['id'];
        echo <<< END_OF_TEXT
    
        <option value="$id_subscription">$subscription</option>
    
    END_OF_TEXT;
    }
    require_once("api/close.php");

}

function select_room () {

    require_once('api/connect.php');
    connect($db);
    $sql = "SELECT id, name FROM room";
    $query = $db->prepare($sql);
    $query->execute();
    $slq = $query->fetchAll(PDO::FETCH_ASSOC);
    for ($i = 0; $i < count($slq); $i++) {
        $room = $slq[$i]['name'];
        $id_room = $slq[$i]['id'];
        echo <<< END_OF_TEXT
    
        <option value="$id_room">$room</option>
    
    END_OF_TEXT;
    }
    require_once("api/close.php");

}

function select_genre () {

    require_once('api/connect.php');
    connect($db);
    $sql = "SELECT name FROM genre";
    $query = $db->prepare($sql);
    $query->execute();
    $slq = $query->fetchAll(PDO::FETCH_ASSOC);
    for ($i = 0; $i < count($slq); $i++) {
        $genre = $slq[$i]['name'];
        echo <<< END_OF_TEXT
    
        <option value="$genre">$genre</option>
    
    END_OF_TEXT;
    }
    require_once("api/close.php");
}