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

                $out = new Hersteller($_POST['hersteller'],'');
                $out = Hersteller::insert($out);
                $out = Hersteller::getAll();
                $out = self::transform($out);
                break;
            case 'update': 
                $out = new Hersteller ($_POST['hersteller'], $_POST['id']);
                $out = Hersteller::update($out);
                $out = Hersteller::getAll();
                $out = self::transform($out);
                break;
            case 'delete':
               
                $out = $_POST['id'];
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
        $herst=[]; // hersteller array
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
       $returnOut=[];
       $linkeSpalte = [];
       $rechteSpalte=[];
       for ($i = 0; $i < count(Hersteller::getNames()); $i++) {
            array_push($linkeSpalte, Hersteller::getNames()[$i]);
        }
        if ($out !== NULL) {
 
            array_push($linkeSpalte, HTML::buildInput('hidden', 'id', $out->getId(),NULL, 'id'));
            $dbWerte = json_decode(json_encode($out), true);
            $rechteSpalte[0] = HTML::buildInput('text', 'hersteller', $dbWerte['name'], NULL, 'name');
            array_push($rechteSpalte, HTML::buildButton('OK', 'ok', 'updateHersteller', 'OK'));
            
        } else {
            array_push($linkeSpalte, '');
            $rechteSpalte[0] = HTML::buildInput('text', 'hersteller', '', NULL, 'name');
            array_push($rechteSpalte, HTML::buildButton('OK', 'ok', 'insertHersteller', 'OK'));
            
        }
        $returnOut = HTML::buildFormularTable($linkeSpalte, $rechteSpalte);
//        echo '<pre>';
//        print_r($returnOut);
//        echo '</pre>';
        return $returnOut;
    }

    
        
}

