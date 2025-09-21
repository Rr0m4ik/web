<?php

function validateUser($user)
{
    return isset($user["id"]) &&
        is_int($user["id"]) &&
        isset($user["name"]) &&
        is_string($user["name"]) &&
        strlen($user["name"]) >= 3;
}

function validatePost($post)
{
    return isset($post["id"]) &&
        is_int($post["id"]) &&
        isset($post["user_id"]) &&
        is_int($post["user_id"]) &&
        isset($post["likes"]) &&
        is_int($post["likes"]) &&
        isset($post["timestamp"]) &&
        is_numeric($post["timestamp"]) &&
        isset($post["content"]) &&
        is_string($post["content"]) &&
        strlen($post["content"]) >= 1;
}