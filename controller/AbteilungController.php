<?php

/**
 * Description of AbteilungController
 *
 * @author Teilnehmer
 */
class AbteilungController implements DoAction {

    public static function doAction($action, $id) {
        switch ($action) {


            /*
             * aus db werden Daten für Ausgabeliste(Tabelle) als String aufgebereitet.
             */

            case 'showList':
                $out = Abteilung::getAll();
                $out = self::transform($out);
                break;
            /*
             *  $out Objekt; $id Integer
             *  Aus der Klasse Abteilung wird die passende Abteilung anhand der übergebenen Id geladen.
             *  Dafür wird die $id an dessen Funktion getById übegeben
             *  das übegebene Object wird in die $out reingeschrieben
             *  $out wird mit der eigenen Funktion transformUpdate bearbeitet
             *  Das heißt html gerechtes Bearbeitungsformular wird mit den Object Daten gefüllt
             *  
             * aus db werden Daten für die UpdatEingabe(Tabelle) als String aufbereitet
             * $id Integer(PK)
             * $out: erst Objekt, dann String(Tabelle)
             */

            case 'showUpdate':
                $out = Abteilung::getById($id);
                $out = self::transformUpdate($out);
                break;
            /*
             * Die Methode wird aufgerufen
             * die fertig erstellten daten werden an §out als string übergeben
             */


            case 'showInsert':
                $out = self::transformUpdate();
                break;

            /*
             * User Daten werden gefiltert
             * ein neues Objekt wird mit $id(PK) angelegt
             * und in db upgedatet
             */


            case 'update':
                $abteilungFiltered = filter_input(INPUT_POST, 'Abteilung', FILTER_SANITIZE_MAGIC_QUOTES);
                $updateabteilungidFiltered = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
                $out = new Abteilung($abteilungFiltered, $updateabteilungidFiltered);
                $out = Abteilung::update($out);
                $out = Abteilung::getAll();
                $out = self::transform($out);
                break;

           

            /*
             * User Daten werden gefiltert
             * ein neues Objekt wird mit $id(PK) angelegt
             * und in db upgedatet
             */

            case 'insert':
                $abteilungFiltered = filter_input(INPUT_POST, 'abteilung', FILTER_SANITIZE_MAGIC_QUOTES);
                $out = new Abteilung($abteilungFiltered, NULL);
                $out = Abteilung::insert($out);
                $out = Abteilung::getAll();
                $out = self::transform($out);
                break;

            /*
             * Übergabe des Primary Keys (über POST(['id'])
             * @example
             * Array
             * (
             * [ajax] => true
             * [action] => delete
             * [area] => Abteilung
             * [view] => listeAbteilung
             * [id] => 13
             * )
             * 
             * danach methodenaufruf (löschen) in der jeweiligen Klasse,
             * und seite neu laden bzw. liste anzeigen.
             * 
             * 
             */

            case 'delete':
                $deleteabteilungidFiltered = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_MAGIC_QUOTES);
                $out = $deleteabteilungidFiltered;
                $out = Abteilung::delete($out);
                $out = Abteilung::getAll();
                $out = self::transform($out);
                break;

            default:
                break;
        }
        return $out;
    }

    
    /*
     * @param Array $out - Array mit Objekten
     * @return string
     * 
     * für Anzeige in ListenForm
     */
    private static function transform($out) {
        $returnOut;
        $i = 0;
        foreach ($out as $abteilung) {
            $returnOut[$i]['abteilungName'] = $abteilung->getName();
            $returnOut[$i]['bearbeiten'] = HTML::buildButton('bearbeiten', $abteilung->getId(), 'bearbeitenAbteilung', 'bearbeiten');
            $returnOut[$i]['loeschen'] = HTML::buildButton('löschen', $abteilung->getId(), 'loeschenAbteilung', 'loeschen');
            $i++;
        }
        return $returnOut;
    }

    /*
     * @param Objekt $out 
     * @return String
     * 
     * für Anzeige in FormularForm
     */
    
    private static function transformUpdate($out = NULL) {
        $returnOut = [];
        $linkeSpalte = [];
        $rechteSpalte = [];

        for ($i = 0; $i < count(Abteilung::getNames()); $i++) {
            array_push($linkeSpalte, Abteilung::getNames()[$i]);
        }

        if ($out !== NULL) {
            array_push($linkeSpalte, HTML::buildInput('hidden', 'id', $out->getId()));
        } else {
            array_push($linkeSpalte, '');
        }

        if ($out !== NULL) {
            $dbWerte = json_decode(json_encode($out), true);
        }

        // überführe $dbWerte in rechte Spalte
        if ($out !== NULL) {
            array_push($rechteSpalte, HTML::buildInput('text', 'name', $dbWerte['name'], NULL, 'abteilung'));
            array_push($rechteSpalte, HTML::buildButton('OK', 'ok', 'updateAbteilung', 'OK'));
        } else {
            array_push($rechteSpalte, HTML::buildInput('text', 'name', '', NULL, 'abteilung'));
            array_push($rechteSpalte, HTML::buildButton('OK', 'ok', 'insertAbteilung', 'OK'));
        }
        $returnOut = HTML::buildFormularTable($linkeSpalte, $rechteSpalte);
        return $returnOut;
    }

}
