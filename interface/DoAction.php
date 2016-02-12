<?php

/*
 * aus db werden Daten für Ausgabeliste(Tabelle) als String aufbereitet
 * case 'showList':
 * 
 * aus db werden Daten für UpdateEIngabe(Tabelle) als String aufbereitet
 * $id Integer(PK)
 * $out: erst Objekt, dann String(tabelle)
 * case 'showUpdate'
 * 
 * Die Methode wird aufgerufen
 * die fertig erstellten daten werden an $out als string übergeben
 * case 'showInsert'
 * 
 * user-Daten werden gefiltert
 * ein neues Objekt wird mit $id(PK) angelegt
 * und in db upgedatet
 * case 'update'
 * 
 * user-Daten werden gefiltert
 * ein neues Objekt wird ohne $id(PK) angelegt
 * und in db upgedatet
 * case 'insert'
 * 
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
 * danach methodenaufruf (löschen) in der jeweiligen Klasse,
 * und seite neu laden bzw. liste anzeigen.
 * case 'delete'
 */
interface DoAction {
    public static function doAction($action, $id);

}
