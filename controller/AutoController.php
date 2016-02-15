<?php

/**
 * Description of AutoController
 *
 * @author Teilnehmer
 */
class AutoController implements DoAction {

    public static function doAction($action, $id) {
        switch ($action) {

            case 'showList':
                $out = Auto::getAll();
                $out = self::transform($out);
                break;

            case 'showUpdate':
                $out = Auto::getById($id);
                $out = self::transformUpdate($out);
                break;

            case 'showInsert':
                $out = self::transformUpdate();
                break;

            case 'update' :
                $autoFiltered = filter_input(INPUT_POST, 'Auto', FILTER_SANITIZE_MAGIC_QUOTES);
                $hersteller_idFiltered = filter_input(INPUT_POST, 'hersteller_id', FILTER_SANITIZE_MAGIC_QUOTES);
                $kennzeichenFiltered = filter_input(INPUT_POST, 'kennzeichen', FILTER_SANITIZE_MAGIC_QUOTES);
                $updateautoidFiltered = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);


                $out = new Auto($autoFiltered, Hersteller::getById($hersteller_idFiltered), $kennzeichenFiltered, $updateautoidFiltered);
                $out = Auto::update($out);
                $out = Auto::getAll();
                $out = self::transform($out);
                break;

            case 'insert' :
                $autoFiltered = filter_input(INPUT_POST, 'Auto', FILTER_SANITIZE_MAGIC_QUOTES);
                $hersteller_idFiltered = filter_input(INPUT_POST, 'hersteller_id', FILTER_SANITIZE_MAGIC_QUOTES);
                $kennzeichenFiltered = filter_input(INPUT_POST, 'kennzeichen', FILTER_SANITIZE_MAGIC_QUOTES);


                $out = new Auto($autoFiltered, Hersteller::getById($hersteller_idFiltered), $kennzeichenFiltered, NULL);
                $out = Auto::insert($out);
                $out = Auto::getAll();
                $out = self::transform($out);
                break;

            case 'delete' :
                $deleteautoidFiltered = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
                $out = $deleteautoidFiltered;
                $out = Auto::delete($out);
                $out = Auto::getAll();
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
        foreach ($out as $auto) {
            $returnOut[$i]['herstellerName'] = $auto->getHersteller()->getName();
            $returnOut[$i]['autoName'] = $auto->getName();
            $returnOut[$i]['autoKennzeichen'] = $auto->getKennzeichen();
            $returnOut[$i]['bearbeiten'] = HTML::buildButton('bearbeiten', $auto->getId(), 'bearbeitenAuto', 'bearbeiten');
            $returnOut[$i]['loeschen'] = HTML::buildButton('löschen', $auto->getId(), 'loeschenAuto', 'loeschen');
            $i++;
        }
        return $returnOut;
    }

    private static function transformUpdate($out = NULL) {
        $returnOut = [];
        $linkeSpalte = [];
        $rechteSpalte = [];

        for ($i = 0; $i < count(Auto::getNames()); $i++) {
            array_push($linkeSpalte, Auto::getNames()[$i]);
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
        $selected = NULL;
        if ($out !== NULL) {
            if ($out->getAuto() !== NULL) {
                $selected = $out->getAuto()->getId(); // Foreign Key
            }
        }
        $options = Option::buildOptions('Auto', $selected);

        if ($out !== NULL) {
            array_push($rechteSpalte, HTML::buildDropDown('herstellerName', '1', $options, NULL, 'hersteller'));
            array_push($rechteSpalte, HTML::buildInput('text', 'autoName', $dbWerte['name'], NULL, 'autoName'));
            array_push($rechteSpalte, HTML::buildInput('text', 'kennzeichen', $dbWerte['kennzeichen'], NULL, 'kennzeichen'));
            array_push($rechteSpalte, HTML::buildButton('OK', 'ok', 'updateAuto', 'OK'));
        } else {
            array_push($rechteSpalte, HTML::buildDropDown('herstellerName', '1', $options, NULL, 'hersteller'));
            array_push($rechteSpalte, HTML::buildInput('text', 'autoName', '', NUll, 'autoName'));
            array_push($rechteSpalte, HTML::buildInput('text', 'kennzeichen', '', NULL, 'kennzeichen'));
            array_push($rechteSpalte, HTML::buildButton('OK', 'ok', 'insertAuto', 'OK'));
        }
        $returnOut = HTML::buildFormularTable($linkeSpalte, $rechteSpalte);
        return $returnOut;
    }

}
