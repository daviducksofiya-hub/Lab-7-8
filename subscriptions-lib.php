<?php
const SUBSCRIPTIONS_FILE = __DIR__ . "/storage/subscriptions.ser";
const LOG_FILE = __DIR__ . "/storage/log.txt";

function allSubscriptions(): array
{
    if (!file_exists(SUBSCRIPTIONS_FILE)) {
        return [];
    }

    $content = file_get_contents(SUBSCRIPTIONS_FILE);
    $subscriptions = unserialize($content);

    return is_array($subscriptions) ? $subscriptions : [];
}

function addSubscription(array $params): void
{
    $subscriptions = allSubscriptions();
    $subscriptions[] = $params;
    file_put_contents(SUBSCRIPTIONS_FILE, serialize($subscriptions), LOCK_EX);
}

function logMessage(string $message): void
{
    file_put_contents(
        LOG_FILE,
        date("Y-m-d H:i:s") . " - " . $message . PHP_EOL,
        FILE_APPEND | LOCK_EX
    );
}
