<?php


class User extends KristianModel
{
    protected $_this_class_name = "User";
    protected $_primary_key = "username";
    protected $_table_fields = array("username", "password");
    protected $_conn_varname = "conn";
    protected $_is_incrementing = false;
    protected $_table_name = "user";

    protected $_relations = array(
        "posts" => array("Posting", "username")
    );
}
$_FACTORY["User"] = new User("STATIC");