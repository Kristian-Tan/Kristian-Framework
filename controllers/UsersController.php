<?php


class UsersController extends KristianController
{
    public function List($args=null)
    {
        return "displaying all users...";
    }
    public function Detail($args=null)
    {
        return "user".$args[0]." selected ...";
    }
}
$_CONTROLLER_ALIASES["users"] = "UsersController";