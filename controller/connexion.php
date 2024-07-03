<?php

class config
{
    public static $conn = null;

    public static function connexion()
    {
        if (self::$conn === null) {
            $servername = 'localhost';
            $username = 'root';
            $password = '';
            $dbname = 'bludb'; // Ajout du nom de la base de données

            try {
                self::$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                // On définit le mode d'erreur de PDO sur Exception
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                /*echo 'Connexion réussie';*/
            } catch (PDOException $e) {
                echo "Erreur : " . $e->getMessage();
            }
        }

        return self::$conn;
    }
}

?>
