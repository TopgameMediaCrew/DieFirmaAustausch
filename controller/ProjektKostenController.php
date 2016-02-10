<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProjektKostenController
 *
 * @author Teilnehmer
 */
class ProjektKostenController {
    public static function doAction($action, $id) {
        switch ($action) {
             /*
             * Methodenaufruf in der Klasse mit Rückgabewert, 
             * welches an die Liste zurückgegeben wird und 
             * mittels Builder dann in den #content div geladen wird.
             * 
             */
            case 'showList':
                $out = ProjektKosten::getAll();
//                echo 'mitte';
//                echo '<pre>';
//                print_r($out);
//                echo '</pre>';
                break;
            default:
                break;
        }
        return $out;
    }
}
