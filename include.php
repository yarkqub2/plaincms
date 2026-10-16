<?php
session_start();
$CLIENT_INDEX_JS = "index-cb2dae3d.js";
$CLIENT_VENDOR_JS = "vendor-48792d42.js";
$CLEINT_RENDERER_JS = "nitro-renderer-493a6bde.js";

$HOST  = "127.0.0.1";
$USER = "root";
$PASS = "password";
$DB = "habborp";
$HOTEL_NAME = "GAME_NAME";
$conn = mysqli_connect($HOST, $USER, $PASS, $DB);
if(!$conn){
    echo "Database connection error!";
}

function e(?string $value): string 
{
    return htmlspecialchars($value ?? '', ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function re($conn, $string)
{
    return mysqli_real_escape_string($conn, $string);
}