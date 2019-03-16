<?php

class DefaultController extends KristianController
{
    public function Index($args=null)
    {
        return "welcome to KristianFramework! this framework is not suited for generating html, but instead just focused on making API/webservice/AJAX";
    }

    public function ErrorRouteNotFound($args=null)
    {
        return "route not found";
    }
}
$_CONTROLLER_ALIASES["default"] = "DefaultController";