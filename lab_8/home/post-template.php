<?php
if (!isset($post, $user)) {
    return;
} ?>

<div class="posts">
    <div >
        <img src="<?= htmlspecialchars(
            $user["avatar_src"] ?? ""
        ) ?>" class="avatar">
        <p><?= htmlspecialchars($user["username"] ?? "") ?></p>
    </div>

    <img src="<?= htmlspecialchars(
        $post["image"] ?? ""
    ) ?>" class="post-img" alt="Пост">

    <div class="likes">
        <img src="../src/assets/Reaction.png" alt="Like">
        <span><?= htmlspecialchars($post["like_count"] ?? 0) ?></span>
    </div>

    <p><?= nl2br(htmlspecialchars($post["description"] ?? "")) ?></p>
    <span class="more">...еще</span>
    <p class="time"><?= htmlspecialchars(
        date("d M Y", strtotime($post["created_at"] ?? 0))
    ) ?></p>
</div>