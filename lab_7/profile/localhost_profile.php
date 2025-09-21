<?php
$data = json_decode(file_get_contents("data.json"), true);
$users = $data["users"] ?? [];

$userId = (int) ($_GET["id"] ?? 1);
foreach ($users as $user) {
    if ($user["id"] === $userId) {
        $selectedUser = $user;
        break;
    }
}

if (!$selectedUser) {
    header("Location: profile.php");
    exit();
}

require "validation.php";
$errors = validateUserData($selectedUser);
if ($errors) {
    foreach ($errors as $error) {
        echo "<p>$error</p>";
    }
    exit();
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style_profile.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Golos+Text:wght@400..900&display=swap"
        rel="stylesheet"
    />
</head>
<body>
    <div>
        <div>
            <img class="item-img" src="../src/assets/Menu_item_home.png" alt="Домой"> 
            <img class="item-img" src="../src/assets/Menu_Item_profile.png" alt="Профиль"> 
            <img class="item-img" src="../src/assets/Menu_Item_add.png" alt="Добавить"> 
        </div>   
    </div>
    
    <div class="profile">
        <img src="<?= htmlspecialchars(
            $selectedUser["avatar"]
        ) ?>" class="avatar">
        <p class="name"><?= htmlspecialchars($selectedUser["name"]) ?></p>
        <p class="text"><?= htmlspecialchars($selectedUser["bio"]) ?></p>
        <div class="counter">
            <span><?= $selectedUser["posts_count"] ?> постов</span>
        </div>

        <div >
            <?php foreach ($selectedUser["posts"] as $image) { ?>
                <?php
                $post = ["image" => $image];
                include "post-template.php";
                ?>
            <?php } ?>
        </div>
    </div>
</body>
</html> 