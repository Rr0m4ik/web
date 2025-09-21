<?php
if (!isset($post["image"])) {
    return;
}

$src = htmlspecialchars($post["image"] ?? "", ENT_QUOTES, "UTF-8");
?>

<div class="photo-img">
    <img src="<?= $src ?>" alt="Пост" class="photo-img">
</div>