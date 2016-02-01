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
                $out = new Projekt($_POST['projekt'],'');
                $out = Projekt::insert($out);
                $out = Projekt::getAll();
                $out = self::transform($out);
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
            $returnOut[$i]['bearbeiten'] = HTML::buildButton('bearbeiten', $projekt->getId(),'editProjekt','bearbeiten');
            $returnOut[$i]['loeschen'] = HTML::buildButton('löschen', $projekt->getId(),'editProjekt','löschen');
            $i++;
        }
        return $returnOut;
    }

    private static function transformUpdate($out=NULL) {
        if ($out==NULL) {
        $returnOut = [];
        $linkeSpalte = [];
        $rechteSpalte = [];
      
        
        $linkeSpalte = Projekt::getnames();
        array_push($linkeSpalte, HTML::buildInput('hidden','id',''));
       // HTML::buildInput($type, $name, $value, $readonly, $id, $class, $placeholder)
        $rechteSpalte[0]=HTML::buildInput('text', 'name', '',NULL,'name');
        array_push($rechteSpalte, HTML::buildButton('OK','ok', 'insertProjekt','OK'));
        $returnOut=HTML::buildFormularTable($linkeSpalte,$rechteSpalte);
        return $returnOut;
        } else {        
        
        

        for ($i = 0; $i < count(Projekt::getNames()); $i++) {
            array_push($linkeSpalte, Projekt::getNames()[$i]);
        }
        array_push($linkeSpalte, HTML::buildInput('hidden', 'id', $out->getId()));

        $dbWerte = json_decode(json_encode($out), true);
        // überführe $dbWerte in rechte Spalte

        array_push($rechteSpalte, HTML::buildInput('text', 'name', $dbWerte['name']));
        array_push($rechteSpalte, HTML::buildButton('OK', 'ok', NULL, 'OK'));
        
        $returnOut = HTML::buildFormularTable($linkeSpalte, $rechteSpalte);
        return $returnOut;
    }
            
 }
}
