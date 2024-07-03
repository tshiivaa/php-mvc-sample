<?php

abstract class AbstractModel
{
    /**
     * This method looks through the associated database table
     * for a row that has a certain value in a certain column.
     *
     * For example, a call to:
     *
     *      Person::findByColumn('name', 'Johnny Greensmith');
     *
     * ...would return a new instance of Person, hydrated with
     * Johnny Greensmith's details.
     *
     * @param string $column The column to search in.
     * @param mixed $value The value to search for.
     * @return bool|object
     */
    public static function findByColumn($column, $value)
    {
        $table = static::$table;
        $db = config::connexion();

        if (!$db) {
            die("Erreur de connexion à la base de données.");
        }

        $stmt = $db->prepare("SELECT * FROM $table WHERE $column = :value");
        $stmt->bindParam(':value', $value);
        $stmt->execute();


        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $instance = new static;
            foreach ($row as $key => $value) {
                $instance->{$key} = $value;
            }
            return $instance;
        }

        return false;
    }

    /**
     * This method persists the current instance to the
     * database table it came from.
     *
     * For example, you could modify Johnny Greensmith's favourite
     * colour with the following code:
     *
     *      $jonny = Person::findByColumn('id', 1);
     *      $johnny->fav_colour = 'Orange';
     *      $johnny->persist();
     *
     * This would update the data stored in the database table.
     */
    public function persist()
    {
        $table = static::$table;
        $db = config::connexion();

        if (!$db) {
            die("Erreur de connexion à la base de données.");
        }
        $properties = get_object_vars($this);
        $setClause = [];
        foreach ($properties as $key => $value) {
            $setClause[] = "$key = :$key";
        }
        $setClause = implode(', ', $setClause);

        $stmt = $db->prepare("UPDATE $table SET $setClause WHERE id = :id");
        foreach ($properties as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }
        $stmt->execute();
    }
}

?>
