<?php
const ADMIN_LOGIN = "admin";
const ADMIN_PASSWORD = "admin";

function login(string $login, string $password): bool
{
    if ($login === ADMIN_LOGIN && $password === ADMIN_PASSWORD) {
        session_regenerate_id(true);
        $_SESSION["authorized"] = true;
        $_SESSION["admin_login"] = $login;
        return true;
    }

    return false;
}

function isAuthorized(): bool
{
    return !empty($_SESSION["authorized"]);
}

function logout(): void
{
    session_unset();
    session_destroy();
}
