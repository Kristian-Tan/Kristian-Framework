<?php


class Posting extends KristianModel
{
    protected $_this_class_name = "Posting";
    protected $_primary_key = "idposting";
    protected $_table_fields = array("idposting", "username", "tanggal", "komen");
    protected $_conn_varname = "conn";
    protected $_is_incrementing = true;
    protected $_table_name = "posting";

    protected $_relation = array(
        "user" => array("User", "username")
    );

    protected $_relations = array(
        "pictures" => array("Gambar", "idposting")
    );
}
$_FACTORY["Posting"] = new Posting("STATIC");