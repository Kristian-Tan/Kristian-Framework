<?php

// load config
require_once("config.php");
$conn = new mysqli($_CONFIG["database"]["host"], $_CONFIG["database"]["user"], $_CONFIG["database"]["pass"], $_CONFIG["database"]["dbnm"]);

// load all models
require_once("libraries/KristianModel.php");
foreach (glob("models/*") as $modelFileName)
{
    require_once($modelFileName);
}

// load all controllers
require_once("libraries/KristianController.php");
foreach (glob("controllers/*") as $controllerFileName)
{
    require_once($controllerFileName);
}



//echo $_SERVER['PATH_INFO'];
//function aa($bb, $cc) { echo $bb; }

if(!isset($_SERVER["PATH_INFO"]))
{
    $controller = new DefaultController();
    echo $controller->Index(); // cth: server.com/
}
else
{
    $arrPathInfo = explode("/", $_SERVER["PATH_INFO"]);
    if($arrPathInfo[0] == "")
    {
        array_shift($arrPathInfo);
    }
    //var_dump($arrPathInfo);

    $controllerName = $arrPathInfo[0];
    if( in_array($controllerName, $_CONTROLLER_ALIASES))
    {
        $controller = new $_CONTROLLER_ALIASES[$controllerName]();
    }
    else if(class_exists($controllerName))
    {
        $controller = new $controllerName();
    }
    else
    {
        $controller = new DefaultController();
        echo $controller->ErrorRouteNotFound();
        exit();
    }


    if( count($arrPathInfo) == 1 )
    {
        echo $controller->Index(); // cth: server.com/users
    }
    else if( count($arrPathInfo) >= 2 )
    {
        $methodName = $arrPathInfo[1];
        $controllerArgs = array();
        for($i=2; $i<count($arrPathInfo); $i++)
        {
            $controllerArgs[] = $arrPathInfo[$i];
        }
        echo $controller->$methodName($controllerArgs);
        // cth: server.com/users/list/1 akan memanggil controller User, method list, dengan argument $args=[1]
        // cth: server.com/users/list/1/edit akan memanggil controller User, method list, dengan argument $args=[1,"edit"]
    }
}