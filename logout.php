<?php
require_once('include.php');
unset($_SESSION["user"]);
header("Location: login.php");