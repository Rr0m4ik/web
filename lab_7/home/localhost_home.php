<?php
require_once "validation.php";

$data = json_decode(file_get_contents("data.json"), true);
$users = $data["users"] ?? [];
$posts = $data["posts"] ?? [];

if (empty($users) || empty($posts)) {
    die("Ошибка: Неверная структура JSON");
}

foreach ($users as $user) {
    if (!validateUser($user)) {
        die("Ошибка валидации пользователя: " . json_encode($user));
    }
}

foreach ($posts as $post) {
    if (!validatePost($post)) {
        die("Ошибка валидации поста: " . json_encode($post));
    }
}

$userId = $_GET["id"] ?? null;
$selectedUser = null;

if ($userId) {
    $userId = (int) $userId;
    foreach ($users as $user) {
        if ($user["id"] === $userId) {
            $selectedUser = $user;
            $posts = array_filter($posts, function ($post) {
                global $userId;
                return $post["user_id"] === $userId;
            });
            break;
        }
    }
    if (!$selectedUser) {
        header("Location: home.php");
        exit();
    }
}

function getUser($userId)
{
    global $users;
    foreach ($users as $user) {
        if ($user["id"] === $userId) {
            return $user;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style_home.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Golos+Text:wght@400..900&display=swap"
        rel="stylesheet"
    />
</head>
<body>
    <div>
        <div class="item-img">
            <img src="../src/assets/Menu_Item_home.png" alt="Домой"> 
            <img src="../src/assets/Menu_Item_profile.png" alt="Профиль">
            <img src="../src/assets/Menu_Item_add.png" alt="Добавить"> 
        </div>

    <?php foreach ($posts as $post) {
        $user = getUser($post["user_id"]);
        include "post-template.php";
    } ?>   
</body>
</html>