<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Cinema</title>
    <link rel="stylesheet" href="style/style.css">
    <script src="script/script.js"></script>
</head>
<body>
    <header>
        <div class="nav">
            <nav class="menu">
                <ul>
                    <li><a href="films.php">Films</a></li>
                    <li><a href="member.php?lastname=&firstname=&subscription=&nombre=10">Client</a></li>
                    <li><a class="active" href="gestion.php">Gestion</a></li>
                    <li><a href="session.php">Session</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <?php
        require_once("api/search.php");
    ?>

    <div class="main">
        <h4>recherche d'utilisateur :</h4>
        <form action="" method="get">
                <div class="filter">
                    <input type="text" name="lastname" placeholder="nom"/>
                    <input type="text" name="firstname" placeholder="prenom"/>
                </div>
            <label for="element-select">nombre de resultat par page :</label>
            <select id="nbr_filter" name="nombre">
                    <option value="10">default</option>
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="30">30</option>
                    <option value="40">40</option>
                    <option value="50">50</option>
            </select>
            <br/>
            <input type="submit" value="recherche" />
            <br/>
        </form>
    </div>

    <div class="row">
            <?php
                require_once("api/display.php");
                display_user($row, $firstname, $lastname, $artNb, $nbArticles);
            ?>
        </div>
    <br/>
    <div class="search">
                <div id="subscription">
                    <form action="" method="post">
                    <label for="subscription">abonnement :</label>
                    <select name="subscription">
                    <option value="none">Aucun</option>
                    <?php
                        require_once("api/display.php");
                        select_sub ();
                    ?>
                    </select>
                    <input type="submit" value="Confirmer" />
                    <div class="filter">
                    <?php
                        require_once('api/add.php');
                        check ($firstname, $lastname, $subscription, $db, $res, $query);
                    ?>
                    </div>
                    <br/>
                </div>
            <br/>
        </form>
    </div>
    <br/>
    <div class="row">
        <?php
            require_once("api/pagination.php");
            pagination($nbArticles, $pages, $currentPage, $parPage);
        ?>
    </div>
    <footer>
    </br>
    </footer>
</body>
</htmml>