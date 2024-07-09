<?php

class HelloController
{
    private $model;

    public function __construct()
    {
        $this->model = new Person();
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'name' => $_POST['name'],
                'fav_colour' => $_POST['fav_colour']
            ];
            $this->model->add($data);
            header('Location: index.php?action=list');
        } 
    }

    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'name' => $_POST['name'],
                'fav_colour' => $_POST['fav_colour']
            ];
            $this->model->edit($data, $id);
            header('Location: index.php?action=list');
        } 
    }

    public function delete($id)
    {
        $this->model->delete($id);
        header('Location: index.php?action=list');
    }

  /*  public function list()
    {
        $persons = $this->model->list();
        include 'view/listPersons.php';
    }*/

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


