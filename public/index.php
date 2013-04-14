<?php

session_start();

$config = require_once('../config.php');
require_once '../MasterController.php';

require_once '../Comment.php';
require_once '../User.php';
require_once '../Story.php';
require_once '../Index.php';

$framework = new MasterController($config);
echo $framework->execute();