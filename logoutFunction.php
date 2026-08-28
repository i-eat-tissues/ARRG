<?php

require_once 'includes/config_session.inc.php';

$_SESSION = [];

session_destroy();

header('Location: index.php');
die();