<?php

/**
 * Description of AbteilungController
 *
 * @author Teilnehmer
 */
class AbteilungController {

    public static function doAction($action, &$view, $id) {
        switch ($action) {
            case 'showList':

                $out = Abteilung::getAll();
                $out = self::transform($out);
                break;

            case 'showUpdate':
                $out = Abteilung::getById($id);
                $out = self::transformUpdate($out);
                break;

            case 'showInsert':
                $out = self::transformUpdate();
                break;
            case 'insert':
                echo '<pre>';
                print_r($_POST);
                echo '</pre>';
                $out = new Abteilung($_POST['abteilung'],'');
                $out = Abteilung::insert($out);
                $out = Abteilung::getAll();
                $out = self::transform($out);
            default:
                break;
        }
        return $out;
    }

    private static function transform($out) {
        $returnOut;
        $i = 0;
        foreach ($out as $abteilung) {
            $returnOut[$i]['abteilungName'] = $abteilung->getName();
            $returnOut[$i]['bearbeiten'] = HTML::buildButton('bearbeiten', $abteilung->getId());
            $returnOut[$i]['loeschen'] = HTML::buildButton('löschen', $abteilung->getId());
            $i++;
        }
        return $returnOut;
    }

    private static function transformUpdate($out=NULL) {
        
        if ($out==NULL) {
            $returnOut=[];
            $linkeSpalte=[];
            $rechteSpalte=[];
            $returnOut = [];
            
        $linkeSpalte=Abteilung::getNames();
        array_push($linkeSpalte, HTML::buildInput('hidden','id',''));
        $rechteSpalte[0]=HTML::buildInput('text','abteilung','',NULL,'name');
        array_push($rechteSpalte, HTML::buildButton('OK','ok', 'OK','OK'));
        $returnOut = HTML::buildFormularTable($linkeSpalte, $rechteSpalte);
        return $returnOut;
        }else{
        
        
        $returnOut = [];
        $linkeSpalte = [];
        $rechteSpalte = [];
        $options = [];

        for ($i = 0; $i < count(Abteilung::getNames()); $i++) {
            array_push($linkeSpalte, Abteilung::getNames()[$i]);
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
