<?php
/**
 * This is the Front Controller.
 * The Front Controller decides which action to run.
 *
 * This particular Front Controller defines a route table, which says
 * which defines which URLs map to which actions.
 *
 * @author Damien Walsh <me@damow.net>
 */
require_once 'vendor/autoload.php';
require_once 'controller/HelloController.php';

// Define the routes table
$routes = array(
    '/\/hello\/(.+)/' => array('HelloController', 'helloAction')
);

// Decide which route to run
foreach ($routes as $url => $action) {

    // See if the route matches the current request
    $matches = preg_match($url, $_SERVER['REQUEST_URI'], $params);

    // If it matches...
    if ($matches > 0) {

        // Run this action, passing the parameters.
        $controller = new $action[0];
        $controller->{$action[1]}($params);

        break;
    }
}
$controller = new HelloController();

/*$action = isset($_GET['action']) ? $_GET['action'] : 'list';
$id = isset($_GET['id']) ? $_GET['id'] : null;*/

switch ($action) {
    case 'add':
        $controller->add();
        break;
    /*case 'edit':
        if ($id) {
            $controller->edit($id);
        } else {
            echo "ID is required for editing.";
        }
        break;*/
    /* case 'delete':
         if ($id) {
             $controller->delete($id);
         } else {
             echo "ID is required for deletion.";
         }
         break;*/
    /* case 'list':
     default:
         $controller->list();
         break;*/
}

