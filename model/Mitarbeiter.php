<?php

class Mitarbeiter implements Aenderbar, JsonSerializable {

    private $id;
    private $vorname;
    private $nachname;
    private $geschlecht;
    private $geburtsdatum;
    private $abteilung;
    private $stundenlohn;
    private $vorgesetzter;

    function __construct($vorname, $nachname, $geschlecht, $geburtsdatum, Abteilung $abteilung = NULL, $stundenlohn, Mitarbeiter $vorgesetzter = NULL, $id = NULL) {
        $this->id = $id;
        $this->vorname = $vorname;
        $this->nachname = $nachname;
        $this->geschlecht = $geschlecht;
        $this->geburtsdatum = $geburtsdatum;
        $this->abteilung = $abteilung;
        $this->stundenlohn = $stundenlohn;
        $this->vorgesetzter = $vorgesetzter;
    }

    public static function getNames() {
        return ['Vorname', 'Nachname', 'Geschlecht', 'Geburtsdatum', 'Abteilung', 'Stundenlohn', 'Vorgesetzter'];
    }

    public static function delete($id) {
        
        $pdo = DbConnect::connect();
        $sql = "DELETE FROM mitarbeiter WHERE id=:id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);

        return "Der Mitarbeiter wurde gelöscht";
    }

    public static function getById($id) {
        $pdo = DbConnect::connect();
        $sql = "SELECT * FROM mitarbeiter WHERE id=:id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return new Mitarbeiter($rows[0]['vorname'], $rows[0]['nachname'], $rows[0]['geschlecht'], $rows[0]['geburtsdatum'], Abteilung::getById($rows[0]['abteilung_id']), $rows[0]['stundenlohn'], Mitarbeiter::getVorgesetztenById($rows[0]['vorgesetzter_id']), $rows[0]['id']);
    }

    public static function getVorgesetztenById($id) {
        if ($id !== NULL) {
            $pdo = DbConnect::connect();
            $sql = "SELECT * FROM mitarbeiter WHERE id=:id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':id' => $id]);
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return new Mitarbeiter($rows[0]['vorname'], $rows[0]['nachname'], $rows[0]['geschlecht'], $rows[0]['geburtsdatum'], Abteilung::getById($rows[0]['abteilung_id']), $rows[0]['stundenlohn'], NULL, $rows[0]['id']);
        } else {
            return NULL;
        }
    }

    public static function insert($object) {
        global $db;
        $pdo = DbConnect::connect();
        if($object->getVorgesetzter() == NULL) { $vorgesetzter = NULL; }
        else { $vorgesetzter = $object->getVorgesetzter()->getId();}
        
        $stmt = $pdo->prepare('INSERT INTO bbqfirma.mitarbeiter (vorname, nachname, geschlecht, geburtsdatum, abteilung_id, stundenlohn, vorgesetzter_id) VALUES(:vorname, :nachname, :geschlecht, :geburtsdatum, :abteilung_id, :stundenlohn, :vorgesetzter_id)');
        if ($stmt->execute(['vorname' => $object->getVorname(), 'nachname' => $object->getNachname(), 'geschlecht' => $object->getGeschlecht(), 'geburtsdatum' => HTML::germanToMySQL($object->getGeburtsdatum()), 'abteilung_id' => $object->getAbteilung()->getId(), 'stundenlohn' => $object->getStundenlohn(), 'vorgesetzter_id' => $vorgesetzter]))
        {
            echo "Der neue Mitarbeiter wurde hinzugefügt.";
        }
        
    }

    public static function update($object) {
        global $db;
        $pdo = DbConnect::connect();
        if ($object->getVorgesetzter() == NULL) { $vorgesetzter = NULL; }
        else { $vorgesetzter = $object->getVorgesetzter()->getId(); }
        
        $stmt = $pdo->prepare("UPDATE mitarbeiter SET vorname=:vorname, nachname=:nachname, geschlecht=:geschlecht, geburtsdatum=:geburtsdatum, abteilung_id=:abteilung_id, stundenlohn=:stundenlohn, vorgesetzter_id=:vorgesetzter_id WHERE id=:id");
        if ($stmt->execute(['vorname' => $object->getVorname(), 'nachname' => $object->getNachname(), 'geschlecht' => $object->getGeschlecht(), 'geburtsdatum' => HTML::germanToMySQL($object->getGeburtsdatum()), 'abteilung_id' => $object->getAbteilung()->getId(), 'stundenlohn' => $object->getStundenlohn(), 'vorgesetzter_id' => $vorgesetzter, 'id' => $object->getId()])) 
        {
            echo "Die Daten wurden geändert.";
        }
        
    }

    public static function getAll() {

        $pdo = DbConnect::connect();
        $sql = "SELECT * FROM mitarbeiter";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $mit = [];

        foreach ($rows as $row) {
            $mit[$row['id']] = new Mitarbeiter($row['vorname'], $row['nachname'], $row['geschlecht'], $row['geburtsdatum'], Abteilung::getById($row['abteilung_id']), $row['stundenlohn'], Mitarbeiter::getVorgesetztenById($row['vorgesetzter_id']), $row['id']);
        }
//        echo '<pre>';
//        print_r($mitarbeiter);
//        echo '</pre>';

        return $mit;
    }

    function getId() {
        return $this->id;
    }

    function getVorname() {
        return $this->vorname;
    }

    function getNachname() {
        return $this->nachname;
    }

    function getGeschlecht() {
        return $this->geschlecht;
    }

    function getGeburtsdatum() {
        return $this->geburtsdatum;
    }

    function getAbteilung() {
        return $this->abteilung;
    }

    function getStundenlohn() {
        return $this->stundenlohn;
    }

    function getVorgesetzter() {
        return $this->vorgesetzter;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setVorname($vorname) {
        $this->vorname = $vorname;
    }

    function setNachname($nachname) {
        $this->nachname = $nachname;
    }

    function setGeschlecht($geschlecht) {
        $this->geschlecht = $geschlecht;
    }

    function setGeburtsdatum($geburtsdatum) {
        $this->geburtsdatum = $geburtsdatum;
    }

    
    function setStundenlohn($stundenlohn) {
        $this->stundenlohn = $stundenlohn;
    }
    
    public function jsonSerialize() {
        return['id' => $this->id, 'vorname' => $this->vorname, 'nachname' => $this->nachname, 'geschlecht' => $this->geschlecht,'geburtsdatum' => $this->geburtsdatum, 'abteilung' => $this->abteilung, 'stundenlohn' => $this->stundenlohn, 'vorgesetzter' => $this->vorgesetzter];
    }

}
?>

