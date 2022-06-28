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
                    <li><a href="session.php">Session</a></li>
                    <li><a class="active" href="historique.php">Historique</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <br>
    <div class="main">
        <label for="element-select">nombre de resultat par page :</label>
        <select id="nbr_filter" name="nombre">
                <option value="10">default</option>
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="30">30</option>
                <option value="40">40</option>
                <option value="50">50</option>
        </select>
    </div>
        <div class="row">
            <?php
            require_once("api/display.php");
            display_history ($row, $nbArticles, $artNb, $lastname, $firstname);
            ?>
        </div>
    </div>
    <footer>
    </br>
    </footer>
</body>
</html>