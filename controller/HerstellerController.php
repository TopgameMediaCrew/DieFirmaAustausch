<?php

/**
 * Description of HerstellerController
 *
 * @author Teilnehmer
 */
class HerstellerController {

    public static function doAction($action, &$view, $id) {
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
 //               $out = new Hersteller('','');
                $out = self::transformUpdate();
                break;
            case 'insert':
//                echo '<pre>';
//                print_r($_POST);
//                echo '</pre>';
                $out = new Hersteller($_POST['hersteller'],'');
//                echo '<pre>';
//                print_r($out);
//                echo '</pre>';
                $out = Hersteller::insert($out);
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
            $herst[$i]['bearbeiten'] = HTML::buildButton('bearbeiten', $hersteller->getId(),'editHersteller','bearbeiten');
            $herst[$i]['loeschen'] = HTML::buildButton('löschen', $hersteller->getId(),'editHersteller','löschen');
            $i++;
        }
        return $herst;
    }

    private static function transformUpdate($out=NULL) {
        
        if ($out==NULL) {
            $returnOut=[];
            $linkeSpalte=[];
            $rechteSpalte=[];
            $returnOut = [];

        $linkeSpalte = Hersteller::getNames();
        array_push($linkeSpalte, HTML::buildInput('hidden', 'id', ''));
 //       $dbWerte = json_decode(json_encode($out), true);
//        
        // überführe $dbWerte in rechte Spalte
        
        $rechteSpalte[0] = HTML::buildInput('text', 'hersteller', '',NULL, 'name');
        
     //   HTML::buildButton($label, $id, $class, $value)
        array_push($rechteSpalte, HTML::buildButton('OK', 'ok', 'insertHersteller', 'OK'));
        $returnOut = HTML::buildFormularTable($linkeSpalte, $rechteSpalte);
        return $returnOut;
        } else {
        $returnOut = [];

        $linkeSpalte = Hersteller::getNames();
        array_push($linkeSpalte, HTML::buildInput('hidden', 'id', $out->getId()));
        $dbWerte = json_decode(json_encode($out), true);
        
        // überführe $dbWerte in rechte Spalte
        $rechteSpalte[0] = HTML::buildInput('text', 'hersteller', $dbWerte['name']);
        array_push($rechteSpalte, HTML::buildButton('OK', 'ok', NULL, 'OK'));
        $returnOut = HTML::buildFormularTable($linkeSpalte, $rechteSpalte);

        return $returnOut;
    }
//    private static function transformInsert($out) {
//        $returnOut = [];
//
//        $linkeSpalte = Hersteller::getNames();
//        array_push($linkeSpalte, HTML::buildInput('hidden', 'id', $out->getId()));
//        $dbWerte = json_decode(json_encode($out), true);
//        
//        // überführe $dbWerte in rechte Spalte
//        $rechteSpalte[0] = HTML::buildInput('text', 'hersteller', $dbWerte['name']);
//        array_push($rechteSpalte, HTML::buildButton('speichern', 'SHersteller', 'HerstSpeich_btn', 'Speichern'));
//        $returnOut = HTML::buildFormularTable($linkeSpalte, $rechteSpalte);
//
//        return $returnOut;
//    }

    
        }
}
