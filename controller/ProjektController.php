<?php

/**
 * Description of ProjektController
 *
 * @author Teilnehmer
 */
class ProjektController {

    public static function doAction($action, &$view, $id) {
        switch ($action) {
            case 'showList':

                $out = Projekt::getAll();
                $out = self::transform($out);
                break;

            case 'showUpdate':
                $out = Projekt::getById($id);
                $out = self::transformUpdate($out);
                break;
            case'showInsert':
                //um Leerfelder zu erzeugen in der Eingabemaske
                $out = self::transformUpdate();
                break;
            case 'insert':
//                echo '<pre>';
//                print_r($_POST);
//                echo '</pre>';
                $out = new Projekt($_POST['projekt'], '');
                $out = Projekt::insert($out);
                $out = Projekt::getAll();
                $out = self::transform($out);
                break;
            case 'update':
                $out = new Projekt($_POST['projekt'], $_POST['id']);
                $out = Projekt::update($out);
                $out = Projekt::getAll();
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
        foreach ($out as $projekt) {
            $returnOut[$i]['projektName'] = $projekt->getName();
            $returnOut[$i]['bearbeiten'] = HTML::buildButton('bearbeiten', $projekt->getId(), 'editProjekt', 'bearbeiten');
            $returnOut[$i]['loeschen'] = HTML::buildButton('löschen', $projekt->getId(), 'editProjekt', 'löschen');
            $i++;
        }
        return $returnOut;
    }

    private static function transformUpdate($out = NULL) {
        $returnOut = [];
        $linkeSpalte = [];
        $rechteSpalte = [];
        if ($out == NULL) {
            $linkeSpalte = Projekt::getnames();
            array_push($linkeSpalte, HTML::buildInput('hidden', 'id', ''));
            $rechteSpalte[0] = HTML::buildInput('text', 'name', '', NULL, 'name');
            array_push($rechteSpalte, HTML::buildButton('OK', 'ok', 'insertProjekt', 'OK'));
        } else {
            for ($i = 0; $i < count(Projekt::getNames()); $i++) {
                array_push($linkeSpalte, Projekt::getNames()[$i]);
            }
            array_push($linkeSpalte, HTML::buildInput('hidden', 'id', $out->getId(), NULL, 'id'));
            $dbWerte = json_decode(json_encode($out), true);
            array_push($rechteSpalte, HTML::buildInput('text', 'name', $dbWerte['name'], NULL, 'name'));
            array_push($rechteSpalte, HTML::buildButton('OK', 'ok', 'updateProjekt', 'OK'));
        }
        $returnOut = HTML::buildFormularTable($linkeSpalte, $rechteSpalte);
        return $returnOut;
    }

}
