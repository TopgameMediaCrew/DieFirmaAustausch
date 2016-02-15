<?php

/**
 * Description of HerstellerController
 *
 * @author Teilnehmer
 */
class HerstellerController implements DoAction {

    public static function doAction($action, $id) {
        switch ($action) {

            case 'showList':
                $out = Hersteller::getAll();
                $out = self::transform($out);
                break;

            case 'showUpdate':
                $out = Hersteller::getById($id);
                $out = self::transformUpdate($out);
                break;

            case 'showInsert':
                $out = self::transformUpdate();
                break;

            case 'update' :
                $herstellerFiltered = filter_input(INPUT_POST, 'Hersteller', FILTER_SANITIZE_MAGIC_QUOTES);
                $updateherstelleridFiltered = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

                $out = new Hersteller($herstellerFiltered, $updateherstelleridFiltered);
                $out = Hersteller::update($out);
                $out = Hersteller::getAll();
                $out = self::transform($out);
                break;

            case 'insert' :
                $herstellerFiltered = filter_input(INPUT_POST, 'hersteller', FILTER_SANITIZE_MAGIC_QUOTES);
                $out = new Hersteller($herstellerFiltered, NULL);
                $out = Hersteller::insert($out);
                $out = Hersteller::getAll();
                $out = self::transform($out);
                break;

            case 'delete' :
                $deleteherstelleridFiltered = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
                $out = $deleteherstelleridFiltered;
                $out = Hersteller::delete($out);
                $out = Hersteller::getAll();
                $out = self::transform($out);
                break;

            default:
                break;
        }
        return $out;
    }

    private static function transform($out) {
        $herst; // hersteller array
        $i = 0;
        foreach ($out as $hersteller) {
            $herst[$i]['hersteller'] = $hersteller->getName();
            $herst[$i]['bearbeiten'] = HTML::buildButton('bearbeiten', $hersteller->getId(), 'bearbeitenHersteller', 'bearbeiten');
            $herst[$i]['loeschen'] = HTML::buildButton('löschen', $hersteller->getId(), 'loeschenHersteller', 'loeschen');
            $i++;
        }
        return $herst;
    }

    private static function transformUpdate($out = NULL) {
        $returnOut = [];
        $linkeSpalte = [];
        $rechteSpalte = [];

        for ($i = 0; $i < count(Hersteller::getNames()); $i++) {
            array_push($linkeSpalte, Hersteller::getNames()[$i]);
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
            $rechteSpalte[0] = HTML::buildInput('text', 'hersteller', $dbWerte['name'], NULL, 'name');
            array_push($rechteSpalte, HTML::buildButton('OK', 'ok', 'updateHersteller', 'OK'));
        } else {
            $rechteSpalte[0] = HTML::buildInput('text', 'hersteller', '', NULL, 'name');
            array_push($rechteSpalte, HTML::buildButton('OK', 'ok', 'insertHersteller', 'OK'));
        }
        $returnOut = HTML::buildFormularTable($linkeSpalte, $rechteSpalte);
        return $returnOut;
    }

}
