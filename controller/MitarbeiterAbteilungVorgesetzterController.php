<?php
class MitarbeiterAbteilungVorgesetzterController {

    public static function doAction($action, $id) {
        switch ($action) {
             /*
             * Methodenaufruf in der Klasse mit Rückgabewert, 
             * welches an die Liste zurückgegeben wird und 
             * mittels Builder dann in den #content div geladen wird.
             * 
             */
            
            
            case 'showList':
                $out = MitarbeiterAbteilungVorgesetzter::getAll();
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
