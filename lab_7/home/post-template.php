<?php
if (!isset($post, $user)) {
    return;
} ?>

<div class="post">
    <div>
        <img src="<?= htmlspecialchars(
            $user["avatar"] ?? ""
        ) ?>" class="avatar">
        <p><?= htmlspecialchars($user["name"] ?? "") ?></p>
    </div>

    <img src="<?= htmlspecialchars(
        $post["image"] ?? ""
    ) ?>" class="photo" alt="Пост">

    <div class="likes">
        <img src="../src/assets/Reaction.png" alt="Like">
        <span><?= htmlspecialchars($post["likes"] ?? 0) ?></span>
    </div>

    <p><?= nl2br(htmlspecialchars($post["content"] ?? "")) ?></p>
    <span class="dop-text">...еще</span>
    <p class="time"><?= htmlspecialchars(
        date("d M Y", $post["timestamp"] ?? 0)
    ) ?></p>
</div>