<?php

session_start();

require_once(__DIR__ . '/config.php');
require_once(__DIR__ . '/function.php');
require_once(__DIR__ . '/Denpyo.php');

$denpyoApp = new \MyApp\Denpyo();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  try {
    $res = $denpyoApp->post();
    header('Content-type: application/json');
    echo json_encode($res);
    exit;
  } catch (Exception $e) {
    header($_SESSION['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
    echo $e->getMessage();
    exit;
  }
}
