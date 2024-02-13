<?php

require_once('lemmino.php');
session_destroy();
header("Location: index.php");
die();

?>