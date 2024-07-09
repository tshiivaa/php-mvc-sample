<?php
require_once 'AbstractModel.php';
require_once 'C:/Users/INFOKOM/Documents/github/php-mvc-sample/controller/connexion.php';

class Person extends AbstractModel
{
    protected static $table = 'person';

    public static function getTableName()
    {
        return self::$table;
    }

    public function add($data): bool
    {
        $table = self::getTableName();
        $sql = "INSERT INTO $table (name, fav_colour) VALUES (:name, :fav_colour)";
        $db = config::connexion();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':fav_colour', $data['fav_colour']);
        return $stmt->execute();
    }
}

?>
