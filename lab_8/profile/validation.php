<?php
function validateUserData($user)
{
    $errors = [];

    if (strlen($user["name"] ?? "") < 3) {
        $errors[] = "Имя должно содержать минимум 3 символа.";
    }

    if (strlen($user["bio"] ?? "") > 200) {
        $errors[] = "Описание не должно превышать 200 символов.";
    }

    if (!is_numeric($user["id"] ?? "")) {
        $errors[] = "ID должен быть числом.";
    }

    return $errors;
}