<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json; charset=utf-8");

require __DIR__ . "/subscriptions-lib.php";

if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") {
    http_response_code(200);
    exit;
}

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    logMessage("Некоректний метод запиту.");
    echo json_encode(
        ["success" => false, "message" => "Некоректний метод запиту."],
        JSON_UNESCAPED_UNICODE
    );
    exit;
}

$jsonData = file_get_contents("php://input");
$inputData = json_decode($jsonData, true);

if (!is_array($inputData)) {
    logMessage("Помилка розбору JSON.");
    echo json_encode(
        ["success" => false, "message" => "Помилка формату JSON."],
        JSON_UNESCAPED_UNICODE
    );
    exit;
}

$name = trim(htmlspecialchars($inputData["name"] ?? "", ENT_QUOTES, "UTF-8"));
$email = trim($inputData["email"] ?? "");
$location = trim(htmlspecialchars($inputData["location"] ?? "", ENT_QUOTES, "UTF-8"));
$budget = trim(htmlspecialchars($inputData["budget"] ?? "", ENT_QUOTES, "UTF-8"));
$subject = trim(htmlspecialchars($inputData["subject"] ?? "", ENT_QUOTES, "UTF-8"));
$message = trim(htmlspecialchars($inputData["message"] ?? "", ENT_QUOTES, "UTF-8"));

if (!$name || !$email || !$budget || !$subject || !$message) {
    logMessage("Помилка валідації: пропущені обов'язкові поля.");
    echo json_encode(
        ["success" => false, "message" => "Заповніть усі обов'язкові поля."],
        JSON_UNESCAPED_UNICODE
    );
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    logMessage("Помилка валідації: невірний формат email.");
    echo json_encode(
        ["success" => false, "message" => "Невірний формат email."],
        JSON_UNESCAPED_UNICODE
    );
    exit;
}

$subscriptionData = [
    "name" => $name,
    "email" => $email,
    "location" => $location,
    "budget" => $budget,
    "subject" => $subject,
    "message" => $message,
    "timestamp" => date("Y-m-d H:i:s"),
    "user_ip" => $_SERVER["REMOTE_ADDR"] ?? "unknown"
];

addSubscription($subscriptionData);
logMessage("Нова підписка додана для email: {$email}");

echo json_encode(
    ["success" => true, "message" => "Дякуємо за підписку!"],
    JSON_UNESCAPED_UNICODE
);
