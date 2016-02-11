<?php

/**
 * Description of MitarbeiterController
 *
 * @author Teilnehmer
 */
class MitarbeiterController implements DoAction {

    public static function doAction($action, $id) {
        switch ($action) {

            /*
             * Showlist führt Methode getAll in Klasse Mitarbeiter aus
             * und liefert ein array mit objekten zurück.
             * dieses wird umgewandelt in ein Array, welches dann 
             * in der listeMitarbeiter zu einem HTML Statement in den
             * #content div geladen wird.
             * 
             */
            
            case 'showList':
                $out = Mitarbeiter::getAll();
                $out = self::transform($out);
                break;

               /*
             *  $out Objekt; $id Integer
             *  Aus der Klasse Mitarbeiter wird der passende Mitarbeiter anhand der übegebenen ID geladen.
             *  Dafür wird die $id an dessen Funktion getById übegeben
             *  das übegebene Object wird in die $out reingeschrieben
             *  $out wird mit der eigenen Funktion transformUpdate bearbeitet
             *  Das heißt html gerechtes Bearbeitungsformular wird mit den Object Daten gefüllt
             *  
             */
            
            
            
            
            case 'showUpdate':
                $out = Mitarbeiter::getById($id);
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
             * $daten = Array der vom User eigegeben Daten; $out = Objekt
             * $daten wird an die Json Function json_decode übergeben und in eine PHP-Variable kovertiert
             * $vorgesetzter = Int; Es wird abegfragt ob ein Wert in vorgesetzter_id 
             * im Objekt $daten vorhanden ist wenn nicht wird in $vorgesetzter mit NULL beschrieben
             * ansonsten kommt die vorgesetzter_id rein
             * $out wird als "neuer" Mitarbeiter angelegt mit den Daten aus den Array $daten befüllt
             * Mit Fremd IDs z.B. 'abteilung_id=1' werden Inhalte z.B. 'Abteilung::name=Buchhaltung' aus ihren entsprechenden Klassen mit der Funktion getById geladen
             * $out wird an die Funktion update von mitarbeiter geschickt und in die Datenbak geschrieben
             * $out wird mit mitarbeiter Funktion getAll überschieben, sprich mit allen Mitarbeitern
             * $out wird wird mit der Funktion transform html gerecht überarbeitet
             * So dass man nun die Liste allen Mitarbeitern sieht.
             */
            
            
            
            case 'update':
                $vorgesetzter_idFiltered = filter_input(INPUT_POST,'vorgesetzter_id',FILTER_SANITIZE_MAGIC_QUOTES);
                $vornameFiltered = filter_input(INPUT_POST,'vorname',FILTER_SANITIZE_MAGIC_QUOTES);
                $nachnameFiltered = filter_input(INPUT_POST,'nachname',FILTER_SANITIZE_MAGIC_QUOTES);
                $geschlechtFiltered = filter_input(INPUT_POST,'geschlecht',FILTER_SANITIZE_MAGIC_QUOTES);
                $geburtsdatumFiltered = filter_input(INPUT_POST,'geburtsdatum',FILTER_SANITIZE_MAGIC_QUOTES);
                $abteilung_idFiltered = filter_input(INPUT_POST,'abteilung_id',FILTER_SANITIZE_MAGIC_QUOTES);
                $stundenlohnFiltered = filter_input(INPUT_POST,'stundenlohn',FILTER_SANITIZE_MAGIC_QUOTES);
                $updatemitarbeiterherstellerFiltered = filter_input(INPUT_POST,'id',FILTER_SANITIZE_NUMBER_INT);
                
                $vorgesetzter = ($vorgesetzter_idFiltered) ? Mitarbeiter::getById($vorgesetzter_idFiltered) : NULL;        
                $out = new Mitarbeiter($vornameFiltered, $nachnameFiltered, $geschlechtFiltered, HTML::germanToMysql($geburtsdatumFiltered), Abteilung::getById($abteilung_idFiltered), $stundenlohnFiltered, $vorgesetzter, $updatemitarbeiterherstellerFiltered);
                $out = Mitarbeiter::update($out);
                $out = Mitarbeiter::getAll();
                $out = self::transform($out);
                break;

            /*
             * die Daten aus den Inputfeldern werden mit sanitize bearbeitet um Cross-Site Scripting zu unterbinden
             * in $out wird ein neues Objekt von Mitarbeiter als Objekt zugewiesen
             * in Datenbank gespeichert
             * Später wird die Liste der Objekte der Klasse ausgegeben
             */
            
            
            case 'insert':
                $vorgesetzter_idFiltered = filter_input(INPUT_POST,'vorgesetzter_id',FILTER_SANITIZE_MAGIC_QUOTES);
                $vornameFiltered = filter_input(INPUT_POST,'vorname',FILTER_SANITIZE_MAGIC_QUOTES);
                $nachnameFiltered = filter_input(INPUT_POST,'nachname',FILTER_SANITIZE_MAGIC_QUOTES);
                $geschlechtFiltered = filter_input(INPUT_POST,'geschlecht',FILTER_SANITIZE_MAGIC_QUOTES);
                $geburtsdatumFiltered = filter_input(INPUT_POST,'geburtsdatum',FILTER_SANITIZE_MAGIC_QUOTES);
                $abteilung_idFiltered = filter_input(INPUT_POST,'abteilung_id',FILTER_SANITIZE_MAGIC_QUOTES);
                $stundenlohnFiltered = filter_input(INPUT_POST,'stundenlohn',FILTER_SANITIZE_MAGIC_QUOTES);
     
                
                $vorgesetzter = ($vorgesetzter_idFiltered) ? Mitarbeiter::getById($vorgesetzter_idFiltered) : NULL;
                $out = new Mitarbeiter($vornameFiltered, $nachnameFiltered, $geschlechtFiltered, HTML::germanToMysql($geburtsdatumFiltered), Abteilung::getById($abteilung_idFiltered), $stundenlohnFiltered, $vorgesetzter, NULL);
                $out = Mitarbeiter::insert($out);
                $out = Mitarbeiter::getAll();
                $out = self::transform($out);
                break;

            
             /* Übergabe des Primary Keys (über POST('id')
             * danach methodenaufruf (löschen) in der jeweiligen Klasse,
             * und seite neu laden bzw. liste anzeigen.
             */
            case 'delete':
                $deletemitarbeiteridFiltered = filter_input(INPUT_POST,'id',FILTER_SANITIZE_NUMBER_INT);
                $out = $deletemitarbeiteridFiltered;
                $out = Mitarbeiter::delete($out);
                $out = Mitarbeiter::getAll();
                $out = self::transform($out);
                break;

            default:
                break;
        }
        return $out;
    }

    private static function transform($out) {
        $returnOut;
        $i = 0;
        foreach ($out as $mitarbeiter) {
            $returnOut[$i]['vorname'] = $mitarbeiter->getVorname();
            $returnOut[$i]['nachname'] = $mitarbeiter->getNachname();
            $returnOut[$i]['bearbeiten'] = HTML::buildButton('bearbeiten', $mitarbeiter->getId(), 'bearbeitenMitarbeiter', 'bearbeiten');
            $returnOut[$i]['loeschen'] = HTML::buildButton('löschen', $mitarbeiter->getId(), 'loeschenMitarbeiter', 'loeschen');
            $i++;
        }
        return $returnOut;
    }

    private static function transformUpdate($out = NULL) {
        $returnOut = [];
        $linkeSpalte = [];
        $rechteSpalte = [];

        for ($i = 0; $i < count(Mitarbeiter::getNames()); $i++) {
            array_push($linkeSpalte, Mitarbeiter::getNames()[$i]);
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
        //options für die abteilungen   
//        $abt = Abteilung::getAll();
//        $options = [];
//
//        // zum abwählen
//        $options[0] = ['value' => 0, 'label' => ''];
//        $hatAbteilung = FALSE;
//        foreach ($abt as $o) {
//            $options[$o->getId()] = ['value' => $o->getId(), 'label' => $o->getName()];
//            if ($out !== NULL) {
//                if ($o->getId() === $out->getAbteilung()->getId()) {
//                    $options[$o->getId()]['selected'] = TRUE;
//                    $hatAbteilung = TRUE;
//                }
//            }
//        }
//        if ($hatAbteilung == FALSE) {
//            $options[0]['selected'] = TRUE;
//        }
//
//        // options für die vorgesetzten
//        $vorgesetzte = Mitarbeiter::getAll();
//        
//        $options2 = Option::fillOptions(Mitarbeiter::getAll());
////        echo '<pre>';
////        print_r($options2);
////        echo '</pre>';
//        $options2 = [];
        $selected=NULL;
        if ($out !== NULL) {
            if ($out->getAbteilung() !== NULL) {
                $selected = $out->getAbteilung()->getId(); // Foreign Key
            }
        }
        $options=Option::buildOptions('Abteilung', $selected);
        
        
//        echo '<pre>';
//        print_r($out);
//        echo '</pre>';
        $selected=NULL;
        if ($out !== NULL) {
            if ($out->getVorgesetzter() !== NULL) {
                $selected = $out->getVorgesetzter()->getId();
            }
        }
        $options2=Option::buildOptions('Mitarbeiter', $selected, TRUE);
        // zum abwählen
//        $options2[0] = ['value' => 0, 'label' => ''];
//        $hatVorgesetzte = FALSE;
//        foreach ($vorgesetzte as $o) {
//            $options2[$o->getId()] = ['value' => $o->getId(), 'label' => $o->getVorname() . ' ' . $o->getNachname()];
//            if ($out !== NULL) {
//                if ($out->getVorgesetzter() !== NULL) {
//                    if ($o->getId() === $out->getVorgesetzter()->getId()) {
//                        $options2[$out->getVorgesetzter()->getId()]['selected'] = TRUE;
//                        $hatVorgesetzte = TRUE;
//                    }
//                } else {
//                    $options2[0]['selected'] = TRUE;
//                }
//            }
//        }
//        if ($hatVorgesetzte == FALSE) {
//            $options2[0]['selected'] = TRUE;
//        }

        // radio $options erstellen
        $radioOptions = [];
        $radioOption = [];

        if ($out !== Null) {
            $radioOption['label'] = 'weibl.';
            if ($out->getGeschlecht() === 'w') {
                $radioOption['checked'] = TRUE;
            }
            $radioOption['value'] = 'w';
            array_push($radioOptions, $radioOption);

            $radioOption = [];
            $radioOption['label'] = 'männl.';
            if ($out->getGeschlecht() === 'm') {
                $radioOption['checked'] = TRUE;
            }
            $radioOption['value'] = 'm';
            array_push($radioOptions, $radioOption);
        } else {
            $radioOption['label'] = 'weibl.';
            $radioOption['checked'] = TRUE;
            $radioOption['value'] = 'w';
            array_push($radioOptions, $radioOption);
            $radioOption['label'] = 'männl.';
            $radioOption['checked'] = NULL;
            $radioOption['value'] = 'm';
            array_push($radioOptions, $radioOption);
        }


        if ($out !== NULL) {
            array_push($rechteSpalte, HTML::buildInput('text', 'vorname', $dbWerte['vorname'], NULL, 'vorname'));
            array_push($rechteSpalte, HTML::buildInput('text', 'nachname', $dbWerte['nachname'], NULL, 'nachname'));
            array_push($rechteSpalte, HTML::buildRadio('geschlecht', $radioOptions, FALSE));
            array_push($rechteSpalte, HTML::buildInput('text', 'geburtsdatum', HTML::mysqlToGerman($dbWerte['geburtsdatum']), NULL, 'geburtsdatum'));
            array_push($rechteSpalte, HTML::buildDropDown('abteilung', '1', $options, NULL, 'abteilung'));
            array_push($rechteSpalte, HTML::buildInput('text', 'stundenlohn', $dbWerte['stundenlohn'], NULL, 'stundenlohn'));
            array_push($rechteSpalte, HTML::buildDropDown('vorgesetzter', '1', $options2, NULL, 'vorgesetzter'));
            array_push($rechteSpalte, HTML::buildButton('OK', 'ok', 'updateMitarbeiter', 'OK'));
        } else {
            array_push($rechteSpalte, HTML::buildInput('text', 'vorname', '', NULL, 'vorname'));
            array_push($rechteSpalte, HTML::buildInput('text', 'nachname', '', NULL, 'nachname'));
            array_push($rechteSpalte, HTML::buildRadio('geschlecht', $radioOptions, FALSE));
            array_push($rechteSpalte, HTML::buildInput('text', 'geburtsdatum', '', NULL, 'geburtsdatum', NULL, 'TT.MM.JJJJ'));
            array_push($rechteSpalte, HTML::buildDropDown('abteilung', '1', $options, NULL, 'abteilung'));
            array_push($rechteSpalte, HTML::buildInput('text', 'stundenlohn', '', NULL, 'stundenlohn'));
            array_push($rechteSpalte, HTML::buildDropDown('vorgesetzter', '1', $options2, NULL, 'vorgesetzter'));
            array_push($rechteSpalte, HTML::buildButton('OK', 'ok', 'insertMitarbeiter', 'OK'));
        }
        $returnOut = HTML::buildFormularTable($linkeSpalte, $rechteSpalte);
        return $returnOut;
    }

}
