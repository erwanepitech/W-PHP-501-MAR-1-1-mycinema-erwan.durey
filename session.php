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
                    <li><a class="active" href="session.php">Session</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <div class="search">
    <h4>recherche de films :</h4>
        <form action="" method="get">
            <div>
            <label for="filtre">filtre :</label>
            <select name="filtre">
                <option id="title" value="title">titre</option>
                <option id="distributor" value="distributor">distributeur</option>
                <option id="date_begin" value="date_begin">date de projection</option>
                <option id="genre" value="genre">genre</option>
            </select>
            </div>
            <div id="search">
                <label for="search">Recherche :</label>
                <input type="text" name="search" />
                <br/>
            </div>
            <div id="select">
                <label for="genre">genre :</label>
                <select id="select" name="genre">
                <?php
                    require_once("api/display.php");
                    select_genre ();
                ?>
                </select>
                <br/>
            </div>
            <label for="element-select">nombre de resultat par page :</label>
            <select id="nbr_filter" name="nombre">
                    <option value="10" selected>default</option>
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
            display_movie($row, $search, $filter, $artNb, $nbArticles);
        ?>

    </div>
    <br/>
    <div class="search">
        <form action="" method="post">
            <label for="room">Salle :</label>
            <select name="room">
                <?php
                    require_once("api/display.php");
                    select_room ();
                ?>
            </select>
            <br/>
            <label for="search">Date et heure de scéence :</label>
                <input type="text" name="date_begin" placeholder="J-M-A&emsp;H:M:S"/>
            <input type="submit" value="Ajouter" />
            <?php
                require_once('api/add.php');
                add_movie ($db, $res, $query);
            ?>
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
</html>