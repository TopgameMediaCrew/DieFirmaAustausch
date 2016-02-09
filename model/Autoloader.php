<?php
/**
 * dient zum (Nach-)laden von Klassen, sofern deren Dateien noch nicht eingebunden sind
 * $class ist der Klassenname
 * weitere Verzeichnisse für Klassen sind im Array $pathArr einzutragen 
 */
class Autoloader {
    /**
     * 
     * @param string $class
     * @throws Exception
     */
   public static function load($class) {
       $fileName=$class . '.php';
       // in Array die möglichen Pfade für Klassen eintragen
       $pathArr = ['model','controller','interface','html'];
       $classFound=FALSE;
       foreach($pathArr as $path) {
           if(file_exists($path . DIRECTORY_SEPARATOR . $fileName)) {
               include $path . DIRECTORY_SEPARATOR . $fileName;
               $classFound=TRUE;
               break;
           }
       }
       if ($classFound === FALSE) {
           throw new Exception("class $class not found in Autoloader.");
       }
       
   }
}
