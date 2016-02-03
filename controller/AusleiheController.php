<?php

/**
 * Description of AusleiheController
 *
 * @author Teilnehmer
 */
class AusleiheController {

    public static function doAction($action, $view, $id) {
        switch ($action) {
            case 'showList':

                $out = Ausleihe::getAll();
                $out = self::transform($out);
                break;
            case 'showUpdate':
                $out = Ausleihe::getById($id);              
                $out = self::transformUpdate($out);
                break;
            case 'update':
                $out = self::update();
                Ausleihe::update($out);
//                echo '<pre>';
//                print_r($out);
//                echo '</pre>';
                $out = Ausleihe::getAll();
                $out = self::transform($out);
                break;
            case 'showInput':
                $out = self::input();
//                Ausleihe::insert($out);
                break;
            case'insert':
                $auto_Id = isset($_POST['autoId']) ? $_POST['autoId'] : '';
                $mitarbeiter_Id = isset($_POST['mitarbeiterId']) ? $_POST['mitarbeiterId'] : '';
                $von = isset($_POST['dateVon']) ? $_POST['dateVon'] : '00.00.0000';
                $vonStunde = isset($_POST['vonStunde']) ? $_POST['vonStunde'] : '00:00:00';
                $bis = isset($_POST['dateBis']) ? $_POST['dateBis'] : '00.00.0000';
                $bisStunde = isset($_POST['bisStunde']) ? $_POST['bisStunde'] : '00:00:00';
//                new Ausleihe(Auto::getById($auto_Id), Mitarbeiter::getById($mitarbeiter_Id), HTML::dateAndTimeToDateTime($von, $vonStunde), HTML::dateAndTimeToDateTime($bis, $bisStunde));
                Ausleihe::insert(new Ausleihe(Auto::getById($auto_Id), Mitarbeiter::getById($mitarbeiter_Id), HTML::dateAndTimeToDateTime($von, $vonStunde), HTML::dateAndTimeToDateTime($bis, $bisStunde)));
                $out = Ausleihe::getAll();
                $out = self::transform($out);
                
                break;
            case 'delete':
                $id = isset($_POST['id']) ? $_POST['id'] : 'NichtLeerString';
//                echo '<pre>';
//                print_r($id);
//                echo '</pre>';
                Ausleihe::delete($id);
                $out = Ausleihe::getAll();
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
        foreach ($out as $ausleihe) {
            $returnOut[$i]['herstellerName'] = $ausleihe->getAuto()->getHersteller()->getName();
            $returnOut[$i]['modell'] = $ausleihe->getAuto()->getName();
            $returnOut[$i]['kennzeichen'] = $ausleihe->getAuto()->getKennzeichen();
            $returnOut[$i]['nachname'] = $ausleihe->getMitarbeiter()->getVorname();
            $returnOut[$i]['vorname'] = $ausleihe->getMitarbeiter()->getNachname();
            $returnOut[$i]['von'] = HTML::dateTimeToDateAndTime($ausleihe->getVon());
            $returnOut[$i]['bis'] = HTML::dateTimeToDateAndTime($ausleihe->getBis());
            $returnOut[$i]['bearbeiten'] = HTML::buildButton('bearbeiten', $ausleihe->getId(), 'editAusleihe', 'bearbeiten');
            $returnOut[$i]['loeschen'] = HTML::buildButton('löschen', $ausleihe->getId(), 'editAusleihe', 'loeschen');
            $i++;
        }
        return $returnOut;
    }

    private static function transformUpdate($out) {
        $returnOut = [];
        $linkeSpalte = [];
        $rechteSpalte = [];
//        $options = [];
//        $autoOptions = [];
//        echo '<pre>';
//        print_r($out);
//        echo '</pre>';
        for ($i = 0; $i < count(Ausleihe::getNames()); $i++) {
            array_push($linkeSpalte, Ausleihe::getNames()[$i]);
        }
        array_push($linkeSpalte, HTML::buildInput('hidden', 'id', $out->getId(), NULL, 'id'));

        $dbWerte = json_decode(json_encode($out), true);
        // überführe $dbWerte in rechte Spalte
        // dropdownMenü $options erstellen
//        $herst = Hersteller::getAll();
//        // @todo wenn Hersteller gelöscht wurde funktioniert Vergleich nicht mehr
//        foreach ($herst as $hersteller) {
//            $option = [];
//            $option['value'] = $hersteller->getId();
//            if ($out->getAuto()->getHersteller()->getId() == count($options) + 1) {
//                $option['selected'] = TRUE;
//            }
//            $option['label'] = $hersteller->getName();
//            array_push($options, $option);
//        }
//         auto $options erstellen
//        $auto = Auto::getAll();
//        foreach ($auto as $modell) {
//            $option = [];
//            $option['value'] = $modell->getId();
//            if ($out->getAuto()->getId() == count($autoOptions) + 1) {
//                $option['selected'] = TRUE;
//            }
//            $option['label'] = $modell->getName();
//            array_push($autoOptions, $option);
//        }
        $auto = Auto::getById($out->getAuto()->getId());
        $autos = Auto::getAll();
        $options = [];
        //zum Abwählen einer vorgeben option
        $options[0] = ['value' => 0, 'label' => ''];
        foreach ($autos as $aut) {
            $options[$aut->getId()] = ['value' => $aut->getId(), 'label' => $aut->getHersteller()->getName() . ' ' . $aut->getName() . ' ' . $aut->getKennzeichen()];
            if ($aut->getId() === $auto->getId()) {
                $options[$aut->getId()]['selected'] = TRUE;
            }
        }
//        echo '<pre>';
//        print_r($options);
//        echo '</pre>';
        //MitarbeiterOptions erstellen
        $mitarbeiter = Mitarbeiter::getById($out->getMitarbeiter()->getId());
        $mitarbeiterer = Mitarbeiter::getAll();

        $mitarbeiterOptions = [];
        //zum Abwählen einer vorgeben option
        $mitarbeiterOptions[0] = ['value' => 0, 'label' => ''];
        foreach ($mitarbeiterer as $mit) {
            $mitarbeiterOptions[$mit->getId()] = ['value' => $mit->getId(), 'label' => $mit->getVorname() . ' ' . $mit->getNachname()];
            
            if ($mit->getId() === $mitarbeiter->getId()) {
                
                $mitarbeiterOptions[$mit->getId()]['selected'] = TRUE;
            }
        }
//        echo '<pre>';
//        print_r($mitarbeiterOptions);
//        echo '</pre>';
        array_push($rechteSpalte, HTML::buildDropDown('auto', '1', $options, NULL, 'autoId'));
//        array_push($rechteSpalte, HTML::buildDropDown('hersteller', '1', $options));
//        array_push($rechteSpalte, HTML::buildDropDown('auto', '1', $autoOptions));
//        array_push($rechteSpalte, HTML::buildInput('text', 'kennzeichen', $dbWerte['auto']['kennzeichen']));
        array_push($rechteSpalte, HTML::buildDropDown('mitarbeiter', '1', $mitarbeiterOptions, NULL, 'mitarbeiterId'));
//        array_push($rechteSpalte, HTML::buildInput('text', 'vorname', $dbWerte['mitarbeiter']['vorname']));
//        array_push($rechteSpalte, HTML::buildInput('text', 'nachname', $dbWerte['mitarbeiter']['nachname']));
        array_push($rechteSpalte, HTML::buildInput('text', 'von', HTML::dateTimeToDate($dbWerte['von']), NULL, 'dateVon'));
        array_push($rechteSpalte, HTML::buildInput('text', 'vonStunde', HTML::dateTimeToTime($dbWerte['von']), NULL, 'vonStunde'));
        array_push($rechteSpalte, HTML::buildInput('text', 'bis', HTML::dateTimeToDate($dbWerte['bis']), NULL, 'dateBis'));
        array_push($rechteSpalte, HTML::buildInput('text', 'bisStunde', HTML::dateTimeToTime($dbWerte['bis']), NULL, 'bisStunde'));
        array_push($rechteSpalte, HTML::buildButton('OK', $dbWerte['id'], 'updateAusleihe', 'OK'));
        $returnOut = HTML::buildFormularTable($linkeSpalte, $rechteSpalte);
        return $returnOut;
    }

    private static function update() {
        $auto_Id = isset($_POST['autoId']) ? $_POST['autoId'] : '';
        $mitarbeiter_Id = isset($_POST['mitarbeiterId']) ? $_POST['mitarbeiterId'] : '';
        $von = isset($_POST['dateVon']) ? $_POST['dateVon'] : '00.00.0000';
        $vonStunde = isset($_POST['vonStunde']) ? $_POST['vonStunde'] : '00:00:00';
        $bis = isset($_POST['dateBis']) ? $_POST['dateBis'] : '00.00.0000';
        $bisStunde = isset($_POST['bisStunde']) ? $_POST['bisStunde'] : '00:00:00';
        $id = isset($_POST['id']) ? $_POST['id'] : 'NichtLeerString';
//        echo $auto_Id . '<br>';
//        echo $mitarbeiter_Id . '<br>';
//        echo $von . '<br>';
////        echo $vonStunde . '<br>';
//        echo $bis . '<br>';
////        echo $bisStunde . '<br>';
        $vonDateTime = HTML::dateAndTimeToDateTime($von, $vonStunde);
        $bisDateTime = HTML::dateAndTimeToDateTime($bis, $bisStunde);
//        echo $id . '<br>';
        return new Ausleihe(Auto::getById($auto_Id), Mitarbeiter::getById($mitarbeiter_Id), $vonDateTime, $bisDateTime, $id);
    }

    private static function input() {
        $returnOut = [];
        $linkeSpalte = [];
        $rechteSpalte = [];
        for ($i = 0; $i < count(Ausleihe::getNames()); $i++) {
            array_push($linkeSpalte, Ausleihe::getNames()[$i]);
        }
        array_push($linkeSpalte, HTML::buildInput('hidden', 'id', NULL, NULL, 'id'));
        $autos = Auto::getAll();
        $options = [];
        //zum Abwählen einer vorgeben option
        $options[0] = ['value' => 0, 'label' => ''];
        foreach ($autos as $aut) {
            $options[$aut->getId()] = ['value' => $aut->getId(), 'label' => $aut->getHersteller()->getName() . ' ' . $aut->getName() . ' ' . $aut->getKennzeichen()];
        }
        //MitarbeiterOptions erstellen
        $mitarbeiterer = Mitarbeiter::getAll();
        $mitarbeiterOptions = [];
        $mitarbeiterOptions[0] = ['value' => 0, 'label' => ''];
        foreach ($mitarbeiterer as $mit) {
            $mitarbeiterOptions[$mit->getId()] = ['value' => $mit->getId(), 'label' => $mit->getVorname() . ' ' . $mit->getNachname()];
        }
        array_push($rechteSpalte, HTML::buildDropDown('auto', '1', $options, NULL, 'autoId'));
        array_push($rechteSpalte, HTML::buildDropDown('mitarbeiter', '1', $mitarbeiterOptions, NULL, 'mitarbeiterId'));
        array_push($rechteSpalte, HTML::buildInput('text', 'dateVon', NULL, NULL, 'dateVon', NULL, 'tt.mm.jjjj'));
        array_push($rechteSpalte, HTML::buildInput('text', 'vonStunde', NULL, NULL, 'vonStunde', NULL, 'hh:mm:ss'));
        array_push($rechteSpalte, HTML::buildInput('text', 'dateBis', NULL, NULL, 'dateBis', NULL, 'tt.mm.jjjj'));
        array_push($rechteSpalte, HTML::buildInput('text', 'bisStunde', NULL, NULL, 'bisStunde', NULL, 'hh:mm:ss'));
        array_push($rechteSpalte, HTML::buildButton('OK', 'ok', 'inputAusleihe', 'OK'));
        $returnOut = HTML::buildFormularTable($linkeSpalte, $rechteSpalte);
        return $returnOut;
    }

}
?>

