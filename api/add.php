<?php

function check (&$firstname, &$lastname, &$subscription, &$db, &$res, &$query) {

    if ($_POST) {

        require_once('api/connect.php');
        connect($db);
        require_once('api/search.php');

        $firstname = $_GET['firstname'];
        $lastname = $_GET['lastname'];
        $subscription = $_POST['subscription'];

        $check = "SELECT lastname, firstname, name, id_user, id_subscription, membership.id
        FROM `user`
        INNER JOIN `membership` ON user.id = membership.id_user
        INNER JOIN subscription ON subscription.id = membership.id_subscription
        WHERE firstname = '$firstname'
        AND lastname = '$lastname'";

        $query = $db->query($check);
        $res = $query->fetchAll(PDO::FETCH_ASSOC);

        if ($res ==! array() && $subscription ==! "" && $subscription ==! "none") {

            $id_user = $res[0]['id_user'];
            $id = $res[0]['id'];

            $sql = "UPDATE membership
            SET id_subscription = $subscription
            WHERE id_user = $id_user
            AND id = $id;";

            $db->query($sql);

        } elseif ($res == array() || $subscription == "" || $subscription == "none") {

            $id_user = $res[0]['id_user'];
            $id = $res[0]['id'];

            $sql = "INSERT INTO membership (id_user, id_subscription)
            SELECT user.id, subscription.id
            FROM user, subscription
            WHERE firstname = '$firstname'
            AND lastname = '$lastname'
            AND subscription.id = '$subscription';";

            $db->query($sql);

        }

        if ($subscription == "none") {

            $id = $res[0]['id'];
            $sql = "DELETE FROM membership_log WHERE id_membership = $id;";

            $sql1 = "DELETE FROM membership
            WHERE membership.id = $id;";

            $db->query($sql);
            $db->query($sql1);

        }

        require_once('api/close.php');

    }

}

function add_movie (&$db, &$res, &$query) {

    if ($_POST) {

        require_once('api/connect.php');
        connect($db);

        // formating date before insert
        $id_movie = $_GET['id'];
        $id_room = $_POST['room'];
        $d = $_POST['date_begin'];

        $date = date_create($d);
        $date_format = date_format($date, 'Y-m-d H:i:s');

        $sql = "INSERT INTO movie_schedule (id_movie, id_room, date_begin)
        VALUES ('$id_movie',' $id_room', '$date_format');";

        $db->query($sql);

        require_once('api/close.php');

    }

}

function add_history (&$db, &$query) {

    if ($_POST) {

        require_once('api/connect.php');
        connect($db);
    
        $checked_box = $_POST['id_user'];
        $count = count($checked_box);

        for ($i = 0; $i < $count; $i++) {

            $id_sess = $_GET['id'];
            $id_member = $checked_box[$i];

            $sql = "INSERT INTO membership_log (id_membership, id_session)
            VALUES ('$id_member', '$id_sess');";

            $db->query($sql);

        }

        require_once('api/close.php');

    }

}