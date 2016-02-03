<?php

class Ausleihe implements Aenderbar, Zeitmessbar, JsonSerializable {

    private $id;
    private $auto;
    private $mitarbeiter;
    private $von;
    private $bis;

    public static function getNames() {
        return ['Auto', 'Mitarbeiter', 'Von', 'vonStunde', 'Bis', 'bisStunde'];
    }

    function __construct(Auto $auto, Mitarbeiter $mitarbeiter, $von, $bis, $id = NULL) {
        $this->id = $id;
        $this->auto = $auto;
        $this->mitarbeiter = $mitarbeiter;
        $this->von = $von;
        $this->bis = $bis;
    }

    public function jsonSerialize() {
        return['id' => $this->id,
            'auto' => $this->auto,
            'mitarbeiter' => $this->mitarbeiter,
            'von' => $this->von,
            'bis' => $this->bis];
    }

    public static function delete($id) {

        $pdo = DbConnect::connect();
        //DELETE FROM `bbqfirma`.`ausleihe` WHERE `ausleihe`.`id` = 9
        $sql = "DELETE FROM bbqfirma.ausleihe WHERE id=:id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
    }

    public static function getById($id) {
        $pdo = DbConnect::connect();
        $sql = "SELECT * from ausleihe WHERE id=:id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return new Ausleihe(Auto::getById($rows[0]['auto_id']), Mitarbeiter::getById($rows[0]['mitarbeiter_id']), $rows[0]['von'], $rows[0]['bis'], $rows[0]['id']);
    }

    public static function insert($object) {
        $pdo = DbConnect::connect();
        //INSERT INTO `bbqfirma`.`ausleihe` (`id`, `auto_id`, `mitarbeiter_id`, `von`, `bis`) VALUES (NULL, '4', '4', '2016-02-01 08:00:00', '2016-02-17 18:00:00');
        $sql = "INSERT INTO bbqfirma.ausleihe (auto_id,mitarbeiter_id,von,bis,id) VALUES(:auto_id,:mitarbeiter_id,:von,:bis,:id)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['auto_id' => $object->getAuto()->getId(), 'mitarbeiter_id' => $object->getMitarbeiter()->getId(), 'von' => $object->getVon(), 'bis' => $object->getBis(), 'id' => $object->getId()]);
    }

    public static function update($object) {
//        echo '<pre>';
//        print_r($object);
//        echo '</pre>';
//        echo $object->getId();
//        echo $object->getAuto()->getId();
//        echo $object->getMitarbeiter()->getId();
//        echo $object->getVon();
//        echo $object->getBis();
//        die();
        $pdo = DbConnect::connect();
        $sql = "UPDATE bbqfirma.ausleihe SET auto_id=:auto_id,mitarbeiter_id=:mitarbeiter_id,von=:von,bis=:bis WHERE id=:id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $object->getId(), 'auto_id' => $object->getAuto()->getId(), 'mitarbeiter_id' => $object->getMitarbeiter()->getId(), 'von' => $object->getVon(), 'bis' => $object->getBis()]);
//        $stmt->execute();
//        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getAll() {
        $pdo = DbConnect::connect();
        $sql = "SELECT * from ausleihe";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $ausleihe = [];

        foreach ($rows as $row) {
            $ausleihe[$row['id']] = new Ausleihe(Auto::getById($row['auto_id']), Mitarbeiter::getById($row['mitarbeiter_id']), $row['von'], $row['bis'], $row['id']);
        }
        return $ausleihe;
    }

    public function getDauer() {
        
    }

    function getId() {
        return $this->id;
    }

    function getAuto() {
        return $this->auto;
    }

    function getMitarbeiter() {
        return $this->mitarbeiter;
    }

    function getVon() {
        return $this->von;
    }

    function getBis() {
        return $this->bis;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setAuto($auto) {
        $this->auto = $auto;
    }

    function setMitarbeiter($mitarbeiter) {
        $this->mitarbeiter = $mitarbeiter;
    }

    function setVon($von) {
        $this->von = $von;
    }

    function setBis($bis) {
        $this->bis = $bis;
    }

}
?>

