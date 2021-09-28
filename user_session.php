<?php


if ((isset($_SESSION['login'])) && ($_SESSION['login'] == true) && (isset($_SESSION['id'])) && ($_SESSION['id'] > 0)) {
    $where = array(
        'id' => $_SESSION['id'],

    );

    $user_data =  $db->select('user_table', 'row', $where);
    // print_r($user_data);
}
