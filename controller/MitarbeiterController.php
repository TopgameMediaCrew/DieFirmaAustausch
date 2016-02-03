<?php

class MitarbeiterController {

    public static function doAction($action, &$view, $id) {
        switch ($action) {
            case 'showList':
                $out = Mitarbeiter::getAll();
                $out = self::transform($out);
                break;
            case'showUpdate':
                $out = Mitarbeiter::getById($id);
                $out = self::transformUpdate($out);
                break;
            case'showInsert':
                $out = new Mitarbeiter('', '', '', '', NULL, '', NULL, ''); //um Leerfelder zu erzeugen in der Eingabemaske
                $out = self::transformInsert($out);
                break;
            case'delete':
                $out = Mitarbeiter::delete($id);
                break;
            case'insert':
                $daten = $_POST['daten'];
                $daten = json_decode($daten, FALSE);
                if(!$daten->vorgesetzter)
                {
                    Mitarbeiter::insert(new Mitarbeiter($daten->vorname, $daten->nachname, $daten->geschlecht, $daten->geburtsdatum, Abteilung::getById($daten->abteilung), $daten->stundenlohn, NULL, ''));
                }
                else
                {
                    Mitarbeiter::insert(new Mitarbeiter($daten->vorname, $daten->nachname, $daten->geschlecht, $daten->geburtsdatum, Abteilung::getById($daten->abteilung), $daten->stundenlohn, Mitarbeiter::getVorgesetztenById($daten->vorgesetzter), ''));
                } 
                $out = "Erfolg";
                break;
            case'update':
                $daten = $_POST['daten'];
                $daten = json_decode($daten, FALSE);
                $out = "Erfolg";
                if(!$daten->vorgesetzter)
                {
                    Mitarbeiter::update(new Mitarbeiter($daten->vorname, $daten->nachname, $daten->geschlecht, $daten->geburtsdatum, Abteilung::getById($daten->abteilung), $daten->stundenlohn, NULL, $daten->id));
                }
                else
                {
                    Mitarbeiter::update(new Mitarbeiter($daten->vorname, $daten->nachname, $daten->geschlecht, $daten->geburtsdatum, Abteilung::getById($daten->abteilung), $daten->stundenlohn, Mitarbeiter::getVorgesetztenById($daten->vorgesetzter), $daten->id));
                }    
                break;
            default:
                break;
        }
        return $out;
    }

    private static function transform($out) {
        $returnOut=[];
        $i=0;
        
        foreach ($out as $mitarbeiter) {
            $returnOut[$i]['vorname'] = $mitarbeiter->getVorname();
            $returnOut[$i]['nachname'] = $mitarbeiter->getNachname();
            $returnOut[$i]['bearbeiten'] = HTML::buildButton("bearbeiten", $mitarbeiter->getId(), "editMitarbeiter", 'bearbeiten');
            $returnOut[$i]['loeschen'] = HTML::buildButton("löschen", $mitarbeiter->getId(), "editMitarbeiter", 'löschen');
        $i++;
           
        }
       
        return $returnOut;
    }

    private static function transformUpdate($out) {
        $returnOut = [];
        $linkeSpalte=Mitarbeiter::getNames();
        array_push($linkeSpalte, HTML::buildInput('hidden','id',$out->getId()));
        $dbWerte = json_decode(json_encode($out), true);
        
        $options = [];
        $abteilungen=Abteilung::getALL();
        $option['value']='';
        $option['label']='';
        array_push($options, $option);
        foreach ($abteilungen as $abteilung) {
            $option=[];
            $option['value']=$abteilung->getId();
            if($out->getAbteilung() !== NULL)
            {   
                if($out->getAbteilung()->getId() === $abteilung->getId())
                {
                    $option['selected']=TRUE;
                }
            }
            $option['label']=$abteilung->getName();
            array_push($options,$option);
        }
        
        
        // vorgesetzter $vorgesetzteroptions erstellen
        $vorgesetzteroptions = [];
        $vorgesetzte = Mitarbeiter::getAll();
        $option['value']='';
        $option['label']='';
        array_push($vorgesetzteroptions, $option);
        foreach ($vorgesetzte as $vorgesetzter) {
            $option = [];
            $option['value'] = $vorgesetzter->getId();
            // wenn options gleich 0 (also nur 1 zur auswahl), dann setze count auf +1, da count 0
            if ($out->getVorgesetzter() !== NULL) {
                 if ($out->getVorgesetzter()->getId() == $vorgesetzter->getId()) {
                $option['selected'] = TRUE;
                 }
            }
            $option['label'] = $vorgesetzter->getVorname(). ' ' . $vorgesetzter->getNachname();
            array_push($vorgesetzteroptions, $option);
        }
        
        // radio options erstellen
        
        $radioOptions = [];
        $radioOption = [];
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
        
        $rechteSpalte = [];

        array_push($rechteSpalte, HTML::buildInput('text', 'vorname', $dbWerte['vorname']));
        array_push($rechteSpalte, HTML::buildInput('text', 'nachname', $dbWerte['nachname']));
        array_push($rechteSpalte, HTML::buildRadio('geschlecht', $radioOptions, FALSE));
        array_push($rechteSpalte, HTML::buildInput('text', 'geburtsdatum', HTML::mysqlToGerman($dbWerte['geburtsdatum'])));
        array_push($rechteSpalte, HTML::buildDropDown('abteilung', '1', $options));
        array_push($rechteSpalte, HTML::buildInput('text', 'stundenlohn', $dbWerte['stundenlohn']));
        array_push($rechteSpalte, HTML::buildDropDown('vorgesetzter', '1', $vorgesetzteroptions));
        array_push($rechteSpalte, HTML::buildButton('OK', 'ok', 'updateMitarbeiter', 'ok'));
//        echo '<pre>';
//        print_r($rechteSpalte);
//        echo '</pre>';
        
        return $returnOut = HTML::buildFormularTable($linkeSpalte, $rechteSpalte);
    }
    
    private static function transformInsert($out) {
        $returnOut = [];
        $linkeSpalte=Mitarbeiter::getNames();
        array_push($linkeSpalte, HTML::buildInput('hidden','id',$out->getId()));
        $dbWerte = json_decode(json_encode($out), true);
        
        $options = [];
        $abteilungen=Abteilung::getALL();
        $option['value']='';
        $option['label']='';
        array_push($options, $option);
        foreach ($abteilungen as $abteilung) {
            $option=[];
            $option['value']=$abteilung->getId();
            if($out->getAbteilung() !== NULL)
            {   
                if($out->getAbteilung()->getId() === $abteilung->getId())
                {
                    $option['selected']=TRUE;
                }
            }
            $option['label']=$abteilung->getName();
            array_push($options,$option);
        }
        
        
        // vorgesetzter $vorgesetzteroptions erstellen
        $vorgesetzteroptions = [];
        $vorgesetzte = Mitarbeiter::getAll();
        $option['value']='';
        $option['label']='';
        array_push($vorgesetzteroptions, $option);
        foreach ($vorgesetzte as $vorgesetzter) {
            $option = [];
            $option['value'] = $vorgesetzter->getId();
            // wenn options gleich 0 (also nur 1 zur auswahl), dann setze count auf +1, da count 0
            if ($out->getVorgesetzter() !== NULL) {
                 if ($out->getVorgesetzter()->getId() == $vorgesetzter->getId()) {
                $option['selected'] = TRUE;
                 }
            }
            $option['label'] = $vorgesetzter->getVorname(). ' ' . $vorgesetzter->getNachname();
            array_push($vorgesetzteroptions, $option);
        }
        
        // radio options erstellen
        
        $radioOptions = [];
        $radioOption = [];
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
        
        $rechteSpalte = [];

        array_push($rechteSpalte, HTML::buildInput('text', 'vorname', $dbWerte['vorname']));
        array_push($rechteSpalte, HTML::buildInput('text', 'nachname', $dbWerte['nachname']));
        array_push($rechteSpalte, HTML::buildRadio('geschlecht', $radioOptions, FALSE));
        array_push($rechteSpalte, HTML::buildInput('text', 'geburtsdatum', HTML::mysqlToGerman($dbWerte['geburtsdatum'])));
        array_push($rechteSpalte, HTML::buildDropDown('abteilung', '1', $options));
        array_push($rechteSpalte, HTML::buildInput('text', 'stundenlohn', $dbWerte['stundenlohn']));
        array_push($rechteSpalte, HTML::buildDropDown('vorgesetzter', '1', $vorgesetzteroptions));
        array_push($rechteSpalte, HTML::buildButton('OK', 'ok', 'insertMitarbeiter', 'ok'));
//        echo '<pre>';
//        print_r($rechteSpalte);
//        echo '</pre>';
        
        return $returnOut = HTML::buildFormularTable($linkeSpalte, $rechteSpalte);
    }

}
