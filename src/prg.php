<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_SERVER['HTTP_REFERER'])) {
        $redirect_url = $_SERVER['HTTP_REFERER'];
    } else {
        $redirect_url = "index.php";
    }

    header("Location: $redirect_url");
    exit();
}