<?php
session_start();
require __DIR__ . "/auth.php";

logout();
header("Location: index.php");
exit;
