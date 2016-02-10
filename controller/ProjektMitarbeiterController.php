<?php

/**
 * Description of ProjektMitarbeiterController
 *
 * @author Teilnehmer
 */
class ProjektMitarbeiterController {

    public static function doAction($action, $id) {
        switch ($action) {
            
            case 'showList':
                $out = ProjektMitarbeiter::getAll();
                $out = self::transform($out);
                break;

            case 'showUpdate':
                $out = ProjektMitarbeiter::getById($id);
                $out = self::transformUpdate($out);
                break;

            case 'showInsert':
                $out = self::transformUpdate();
                break;

            case 'update' :
                $ProjektFiltered = filter_input(INPUT_POST,'Projekt',FILTER_SANITIZE_MAGIC_QUOTES);
                $mitarbeiterFiltered = filter_input(INPUT_POST,'mitarbeiter',FILTER_SANITIZE_MAGIC_QUOTES);
                $vonFiltered = filter_input(INPUT_POST,'von',FILTER_SANITIZE_MAGIC_QUOTES);
                $bisFiltered = filter_input(INPUT_POST,'bis',FILTER_SANITIZE_MAGIC_QUOTES);
                $updatemitarbeiterprojektidFiltered = filter_input(INPUT_POST,'id',FILTER_SANITIZE_NUMBER_INT);
            
                
                $out = new ProjektMitarbeiter(Projekt::getById($ProjektFiltered), Mitarbeiter::getById($_POST['mitarbeiter']), HTML::dateAndTimeToDateTime($vonFiltered), HTML::dateAndTimeToDateTime($bisFiltered), $updatemitarbeiterprojektidFiltered);
                $out = ProjektMitarbeiter::update($out);
                $out = ProjektMitarbeiter::getAll();
                $out = self::transform($out);
                break;

            case 'insert' :
                $projektFiltered = filter_input(INPUT_POST,'projekt',FILTER_SANITIZE_MAGIC_QUOTES);
                $mitarbeiterFiltered = filter_input(INPUT_POST,'mitarbeiter',FILTER_SANITIZE_MAGIC_QUOTES);
                $vonFiltered = filter_input(INPUT_POST,'von',FILTER_SANITIZE_MAGIC_QUOTES);
                $bisFiltered = filter_input(INPUT_POST,'bis',FILTER_SANITIZE_MAGIC_QUOTES);
                $out = new ProjektMitarbeiter(Projekt::getById($projektFiltered), Mitarbeiter::getById($mitarbeiterFiltered), HTML::dateAndTimeToDateTime($vonFiltered), HTML::dateAndTimeToDateTime($bisFiltered), NULL);
                $out = ProjektMitarbeiter::insert($out);
                $out = ProjektMitarbeiter::getAll();
                $out = self::transform($out);
                break;

            case 'delete' :
                $deleteprojektmitarbeiteridFiltered = filter_input(INPUT_POST,'id',FILTER_SANITIZE_NUMBER_INT);
                $out = $deleteprojektmitarbeiteridFiltered;
                $out = ProjektMitarbeiter::delete($out);
                $out = ProjektMitarbeiter::getAll();
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
        foreach ($out as $projektmitarbeiter) {
            $returnOut[$i]['projektName'] = $projektmitarbeiter->getProjekt()->getName();
            $returnOut[$i]['mitarbeiterVorname'] = $projektmitarbeiter->getMitarbeiter()->getVorname();
            $returnOut[$i]['mitarbeiterNachname'] = $projektmitarbeiter->getMitarbeiter()->getNachname();
            $returnOut[$i]['projektVon'] = HTML::extractDateFromDateTime($projektmitarbeiter->getVon());
            $returnOut[$i]['projektBis'] = HTML::extractDateFromDateTime($projektmitarbeiter->getBis());
            $returnOut[$i]['bearbeiten'] = HTML::buildButton('bearbeiten', $projektmitarbeiter->getId(), 'bearbeitenProjektMitarbeiter', 'bearbeiten');
            $returnOut[$i]['loeschen'] = HTML::buildButton('löschen', $projektmitarbeiter->getId(), 'loeschenProjektMitarbeiter', 'loeschen');
            $i++;
        }
        return $returnOut;
    }

    private static function transformUpdate($out = NULL) {
        $returnOut = [];
        $linkeSpalte = [];
        $rechteSpalte = [];
        
        for ($i = 0; $i < count(ProjektMitarbeiter::getNames()); $i++) {
            array_push($linkeSpalte, ProjektMitarbeiter::getNames()[$i]);
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
        // options für die vorgesetzten
        $projekte = Projekt::getAll();
        $options = [];

        // zum abwählen
        $options[0] = ['value' => 0, 'label' => ''];
        $hatProjekt = FALSE;
        foreach ($projekte as $o) {
            $options[$o->getId()] = ['value' => $o->getId(), 'label' => $o->getName()];
            if ($out !== NULL) {
                if ($o->getId() === $out->getProjekt()->getId()) {
                    $options[$o->getId()]['selected'] = TRUE;
                    $hatProjekt = TRUE;
                }
            }
        }
        if ($hatProjekt == FALSE) {
            $options[0]['selected'] = TRUE;
        }


        $mitarbeiter = Mitarbeiter::getAll();
        $options2 = [];
        // zum abwählen
        $options2[0] = ['value' => 0, 'label' => ''];
        $hatMitarbeiter = FALSE;
        foreach ($mitarbeiter as $o) {
            $options2[$o->getId()] = ['value' => $o->getId(), 'label' => $o->getVorname() . ' ' . $o->getNachname()];
            if ($out !== NULL) {
                if ($o->getId() === $out->getMitarbeiter()->getId()) {
                    $options2[$o->getId()]['selected'] = TRUE;
                    $hatMitarbeiter = TRUE;
                }
            }
        }
        if ($hatMitarbeiter == FALSE) {
            $options2[0]['selected'] = TRUE;
        }
     
        if ($out !== NULL) {
            array_push($rechteSpalte, HTML::buildDropDown('projekt', '1', $options, NULL, 'projekt'));
            array_push($rechteSpalte, HTML::buildDropDown('mitarbeiter', '1', $options2, NULL, 'mitarbeiter'));
            array_push($rechteSpalte, HTML::buildInput('text', 'vonTag', HTML::extractDateFromDateTime($dbWerte['von']),NULL, 'vonTag'));
            array_push($rechteSpalte, HTML::buildInput('text', 'vonZeit', HTML::extractTimeFromDateTime($dbWerte['von'])));
            array_push($rechteSpalte, HTML::buildInput('text', 'bisTag', HTML::extractDateFromDateTime($dbWerte['bis']),NULL, 'bisTag'));
            array_push($rechteSpalte, HTML::buildInput('text', 'bisZeit', HTML::extractTimeFromDateTime($dbWerte['bis'])));
            array_push($rechteSpalte, HTML::buildButton('OK', 'ok', 'updateProjektMitarbeiter', 'OK'));
        } else {
            array_push($rechteSpalte, HTML::buildDropDown('projekt', '1', $options, NULL, 'projekt'));
            array_push($rechteSpalte, HTML::buildDropDown('mitarbeiter', '1', $options2, NULL, 'mitarbeiter'));
            array_push($rechteSpalte, HTML::buildInput('text', 'vonTag', '', NULL, 'vonTag', NULL, 'TT.MM.JJJJ'));
            array_push($rechteSpalte, HTML::buildInput('text', 'vonZeit', '', NULL, 'vonZeit', NULL, 'HH:MM'));
            array_push($rechteSpalte, HTML::buildInput('text', 'bisTag', '', NULL, 'bisTag', NULL, 'TT.MM.JJJJ'));
            array_push($rechteSpalte, HTML::buildInput('text', 'bisZeit', '', NULL, 'bisZeit', NULL, 'HH:MM'));
            array_push($rechteSpalte, HTML::buildButton('OK', 'ok', 'insertProjektMitarbeiter', 'OK'));
        }
        $returnOut = HTML::buildFormularTable($linkeSpalte, $rechteSpalte);
        return $returnOut;
    }

}
