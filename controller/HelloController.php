<?php

class HelloController
{
    /**
     * Say hello to a person.
     * $params will be an array of parameters passed by the Front Controller.
     *
     * For this example, the /hello/<ID> route will pass:
     *
     *      $params[0]  -  The whole route, E.g. /hello/1
     *      $params[1]  -  Just the ID, E.g. 1
     *
     * @param array $params The parameters from the URL.
     */
    public function helloAction($params)
    {
        require_once 'connexion.php';
        $db = config::connexion();
        if (!$db) {
            die("Erreur de connexion");
        }
        $person = Person::findByColumn('id', $params[1]);
        include 'view/helloView.php';
    }
}

?>
