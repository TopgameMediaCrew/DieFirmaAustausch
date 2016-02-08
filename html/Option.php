<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Option {
    // pflicht
    private $value;
    private $label;
    // optional
    private $selected;
    // option nicht zwingend, abwählbar
    private static $nullSelectable;
    // sammlung der einzelnen $option
    private $options = [];
    
    function __construct($value, $label, $selected) {
        $this->value = $value;
        $this->label = $label;
        if ($selected !== NULL) {
            $this->selected=$selected;
        }
    }
    // objects basiert afu GetAll einer Aenderbar Klasse
    public static function fillOptions($objects) {
        foreach ($objects as $object) {
            if ($object->selected === NULL) {
                $selected = NULL;
            } else {
                $selected = $object->getSelected();
            }
            $this->addOption($object->getId(), $object->getName(), $selected);
        }
        if ($object->getNullSelectable()) {
            self::$nullSelectable=TRUE;
        }
    }
    
    public function addOption($value, $label, $selected = NULL) {
        $this->options[$value]=new Option($value, $label, $selected);
    }
    public function setNullSelection($nullSelection) {
        if ($nullSelection) {
            self::$nullSelectable=TRUE;
        }
    }
    public function getAllOptions() {
        return $this;
    }
}

