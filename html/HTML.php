<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of HTML
 *
 * @author rolfhaeckel
 */
class HTML {

    public static function buildListTable(Array $tableHead, Array $tableBody) {
        if (is_object($tableBody[0])) {
            $tableBody = json_decode(json_encode($tableBody), true);
        }
//        echo '<pre>';
//            print_r($id);
//        echo '</pre>';
//         echo '<pre>';
//         print_r($tableBody);
//         echo '</pre>';
//         echo 'th: ' . count($tableHead) . '<br>';
//         echo 'tb: ' . count($tabelBody) . '<br>';
        if (count($tableHead) !== count($tableBody[0])) {
            throw new Exception('Spaltenanzahl von Tablehead stimmt nicht mit Spaltenanzahl Tablebody überein');
        }
        $html = '<table>';
        $html .= '<thead>';
        $html .= '<tr>';
        foreach ($tableHead as $columnName) {
            $html .= '<th>' . $columnName . '</th>';
        }
        $html .= '</tr>';
        $html .= '</thead>';
        $html .= '<tbody>';
        foreach ($tableBody as $tableRow) {
            $html .= '<tr>';
            foreach ($tableRow as $tableData) {
                $html .= '<td>';
                $html .= $tableData;
                $html .= '</td>';
            }
            $html .= '</tr>';
        }
        $html .= '</tbody>';
        return $html;
    }

    public static function buildFormularTable(Array $linkeSpalte, Array $rechteSpalte) {
//        echo '<pre>';
//        print_r($rowValues);
//        echo '</pre>';
        if (count($linkeSpalte) !== count($rechteSpalte)) {
            throw new Exception('Übergabe_arrays in HTML::buildformularTable sind nicht gleich groß');
        } $html = '<table><tbody>' . "\n";
        for ($i = 0; $i < count($linkeSpalte); $i++) {
            $html .= '<tr>';
            $html .= '<td>' . $linkeSpalte[$i] . '</td>';
            $html .= '<td>' . $rechteSpalte[$i] . '</td>';

            $html .= '</tr>' . "\n";
        }

        $html .= '</tbody></table>';
        return $html;
    }

// falls $tableBody ein Array mit Objekten ist, wird jedes Objekt in ein asso-Array gewandelt
//        $rowValues = json_decode(json_encode($rowValues), true);
//        if (count($rowValues) !== count($rowValues[0])) {
//            throw new Exception('Zeilenanzahl von linker Spalte: label, stimmt nicht mit Zeilenanzahl rechter Spalte: Werte überein');
//        }
//        $html = '<table><tbody>';
//        
//        // key ist der schlüssel (index), label = name von der rowlabel
//        foreach ($rowLabels as $key => $label) {
//            $html .= '<tr>';
//            $html .= '<td>' . $label . '</td>';
//            $html .= '<td>' . $rowValues[$key][1] . '</td>';
//            $html .= '<td>' . $rowValues[1][1] . '</td>';
//            $html .= '</tr>';
//        }
//        $html .= '</tbody></table>';
//        
//        return $html;


    public static function buildButton($label, $id = NULL, $class = NULL, $value = NULL) {

        return '<button type="button" id="' . $id . '" class="' . $class . '" value="' . $value . '" >' . $label . '</button>';
    }

    public static function buildInput($type, $name, $value, $readonly = NULL, $id = NULL, $class = NULL, $placeholder = NULL) {
        $html = '<input type="';
        $html.=$type;
        $html.='" name="';
        $html.=$name;
        $html.='" value="';
        $html.=$value;
        $html.='"';
        if ($readonly !== NULL) {
            $html.=' readonly = "readonly"';
        }
        if ($id !== NULL) {
            $html.='id="' . $id . '"';
        }
        if ($class !== NULL) {
            $html.=' class = "' . $class . '"';
        }
        if ($placeholder !== NULL) {
            $html.=' placeholder = "' . $placeholder . '"';
        }
        $html.="/>";
        return $html;
    }

    public static function buildDropDown($name, $size, Array $options, $multiple = NULL, $id = NULL, $class = NULL) {
        $html = '<select size="' . $size . '" name="' . $name . '"';
        if ($multiple !== NULL) {
            $html.=' multiple = "multiple"';
        }
        if ($id !== NULL) {
            $html.='id="' . $id . '"';
        }
        if ($class !== NULL) {
            $html.=' class = "' . $class . '"';
        }
        $html.='>';
        foreach ($options as $option) {
            $html.=' <option';
            if (isset($option['value'])) {
                $html.=' value="' . $option['value'] . '"';
            }
            if (isset($option['selected'])) {
                $html.=' selected';
            }
            $html.=">\n";
            $html.=$option['label'];
        }
        $html.='</select>';
        return $html;
    }

    // $options besteht aus Array mit Arrays vom Typ (value, checked, label
    public static function buildRadio($groupname, Array $options, $buttonLeft = TRUE) {
        $html = '';
        foreach ($options as $option) {
            if ($buttonLeft === FALSE) {
                $html .= ' ' . $option['label'] . ' ';
            }

            $html .= '<input type="radio" name="' . $groupname . '" value="';
            $html .= $option['value'] . '"';
            if (isset($option['checked'])) {
                $html .= ' checked="checked"';
            }
            $html .= ' />';
            if ($buttonLeft === TRUE) {
                $html .= ' ' . $option['label'] . ' ' . "\n";
            }
            $html .= "\n";
//            $html .= ' ' . $option['label'] . ' ' . "\n";
        }
        return $html;
    }

    // array 2014-12-24 wird durch explode zu array[2014][12][24], dann umgedreht, dann wieder mit . zusammengefügt
    public static function mysqlToGerman($date) {
        return implode('.', array_reverse(explode('-', $date)));
    }

    public static function germanToMySQL($date) {
        return implode('-', array_reverse(explode('.', $date)));
    }

    public static function dateTimeToDateAndTime($date) {
        $datum = array_reverse(explode(' ', $date));
        $datum[1] = implode('.', array_reverse(explode('-', $datum[1])));
        return $datum[1] . ' ' . $datum[0];
    }

    public static function dateTimeToDate($date) {
        $datum = array_reverse(explode(' ', $date));
        $datum[1] = implode('.', array_reverse(explode('-', $datum[1])));
        return $datum[1];
    }

    public static function dateTimeToTime($date) {
        $datum = array_reverse(explode(' ', $date));
        $datum[1] = implode('.', array_reverse(explode('-', $datum[1])));
        return $datum[0];
    }

    public static function dateAndTimeToDateTime($date, $time) {
        $dateTime = array_reverse(explode(' ', ($date . ' ' . $time)));
        $dateTime = implode('-', array_reverse(explode('.', $dateTime[1]))) . ' ' . $dateTime[0];
        return $dateTime;
    }

}

?>