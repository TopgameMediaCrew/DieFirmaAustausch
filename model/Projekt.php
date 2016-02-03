<?php

/**
 * Description of Projekt
 *
 * @author Teilnehmer
 */
class Projekt implements Aenderbar, JsonSerializable {

    private $id;
    private $name;

    public static function getNames() {
        return ['Projekt'];
    }

    public function __construct($name, $id = NULL) {
        $this->name = $name;
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function jsonSerialize() {
        return['id' => $this->id,
            'name' => $this->name];
    }

    public static function delete($id) {
         $pdo = DbConnect::connect();
        $sql = "DELETE FROM projekt WHERE id=:id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
    }

    public static function getAll() {

        $pdo = DbConnect::connect();
        $sql = "SELECT * from projekt";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $projekte = [];

        foreach ($rows as $row) {
            $projekte[$row['id']] = new Projekt($row['name'], $row['id']);
        }
        return $projekte;
    }

    public static function getById($id) {

        $pdo = DbConnect::connect();
        $sql = "SELECT * from projekt WHERE id=:id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return new Projekt($rows[0]['name'], $rows[0]['id']);
    }

    public static function insert($id) {
        $pdo = DbConnect::connect(); 
        $stmt = $pdo->prepare("INSERT INTO bbqfirma.projekt(name) "
                . "VALUES(:name)");
        if ($id->getName() == '') {
            echo 'kein Eintrag';
        } else {
        $stmt->execute([':name' => $id->getName()]);
        } 
    }

    public static function update($id) {
        $pdo = DbConnect::connect();
        $stmt=$pdo->prepare("UPDATE bbqfirma.projekt SET name=:name WHERE id=:id");
        $stmt->execute([':id' => $id->getId(),':name' => $id->getName()]);
    }

}
