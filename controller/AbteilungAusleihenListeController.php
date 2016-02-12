<?php

class AbteilungAusleihenListeController implements DoAction {

    public static function doAction($action, $id) {

        /* spezielle SQL-Abfrage
         * Methodenaufruf in der Klasse mit Rückgabewert, 
         * welches an die Liste zurückgegeben wird .
         * 
         */
        if ($action === 'showList') {
            $out = AbteilungAusleihenListe::getAll();
        } else {
            throw new Exception('falscher Parameter in AbteilungAusleihenListeController::doAction()');
        }
        return $out;
    }

    public static function transform($out) {
        
    }

    public static function transformUpdate($out = NULL) {
        
    }

}
