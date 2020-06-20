<?php

$connection = require_once './connection.php';

$connection->deleteNote($_POST['id']);
header('Location: index.php');