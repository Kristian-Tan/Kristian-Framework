<?php


class Gambar extends KristianModel
{
    protected $_this_class_name = "Gambar";
    protected $_primary_key = "idgambar";
    protected $_table_fields = array("idgambar", "idposting", "extention");
    protected $_conn_varname = "conn";
    protected $_is_incrementing = true;
    protected $_table_name = "gambar";

    protected $_relation = array(
        "post" => array("Posting", "idposting")
    );
}
$_FACTORY["Gambar"] = new Gambar("STATIC");