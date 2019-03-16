# Kristian Framework

## Dependency
- KristianModel: Kristian's self made ORM for php mysqli module
- PHP: minimum version 5.3, mysqli, json

## Configuration
- open file config.php, insert mysql connection string

## Routing
There is no route file, see controllers

## ORM Model
Please refer to KristianModel README.md
```php
<?php
// simple introduction to KristianModel:

$connLocal = new mysqli("localhost", "root", "123", "smallnorthwind");
class Product extends KristianModel
{
    protected $_this_class_name = "Product";
    protected $_primary_key = "ProductID";
    protected $_conn_varname = "connLocal";
    protected $_table_name = "products";
    protected $_relation = array(
        "category" => array("Category", "CategoryID")
    );
    protected $_relations = array(
        "order_details" => array("OrderDetail", "ProductID")
    );
}
class Category extends KristianModel
{
    protected $_this_class_name = "Category";
    protected $_primary_key = "CategoryID";
    protected $_conn_varname = "connLocal";
    protected $_table_name = "categories";
    protected $_relations = array(
        "products" => array("Product", "CategoryID")
    );
}
class Order extends KristianModel
{
    protected $_this_class_name = "Order";
    protected $_primary_key = "OrderID";
    protected $_conn_varname = "connLocal";
    protected $_table_name = "orders";
    protected $_relations = array(
        "order_details" => array("OrderDetail", "OrderID")
    );
}
class OrderDetail extends KristianModel
{
    protected $_this_class_name = "OrderDetail";
    protected $_primary_key = array("OrderID", "ProductID");
    protected $_conn_varname = "connLocal";
    protected $_is_incrementing = false;
    protected $_table_name = "orderdetails";
    protected $_relation = array(
        "product" => array("Product", "ProductID"),
        "order" => array("Order", "OrderID"),
    );
}

var_dump($_FACTORY["Product"]->all()); // get array of all products
$product1 = $_FACTORY["Product"]->find(1); // get specific product
var_dump($product1); // see (object Product) member of product1
var_dump($product1->get("ProductName")); // see (string) name of product1
var_dump($product1->getRelation("category")); // see (object Category) of product1
var_dump($product1->getRelations("order_details")); // see (array of object OrderDetail) of product1
```

## Controllers
Request URL directory will be used to determine which controller are used, then the first subdirectory will be used to determine which method are to be called, then next subdirectories will be supplied to the method as arguments
#### Example: http://localhost/www/kristianframework/UsersController/List/3
##### It will create new UsersController, then call UsersController->List(array(3));
#### Example: http://localhost/www/kristianframework/UsersController
##### It will create new UsersController, then call UsersController->Index(); // because there are no method name specified
#### Example: http://localhost/www/kristianframework
##### It will create new UsersController, then call DefaultController->Index(); // because there are no controller name and method name specified

### Giving alias to controllers
```php
<?php
class UsersController extends KristianController
{ ... }
$_CONTROLLER_ALIASES["users"] = "UsersController";
```
#### Example: http://localhost/www/kristianframework/users/list/3
##### It will create new UsersController, then call UsersController->list(array(3));