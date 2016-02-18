<?php
    include '../conf/config.php';

    User::logout();

    header('Location: /');
    // URI::redirect('/');