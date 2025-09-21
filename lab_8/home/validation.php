<?php
function validateUser($user)
{
    return isset($user["id"], $user["username"], $user["avatar_src"]) &&
        is_numeric($user["id"]) &&
        strlen($user["username"]) >= 3;
}

function validatePost($post)
{
    return isset($post["id"], $post["user_id"], $post["description"]) &&
        is_numeric($post["id"]) &&
        is_numeric($post["user_id"]) &&
        strlen($post["description"]) >= 1;
}