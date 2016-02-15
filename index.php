<?php

define('DEV', TRUE);
include './config.php';
include './model/Autoloader.php';

// benötigte Klassen nachladen
spl_autoload_register(function ($class) {
    Autoloader::load($class);
});

$actionFiltered = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_MAGIC_QUOTES);
$action = ($actionFiltered !== NULL) ? $actionFiltered : 'standard';
$areaFiltered = filter_input(INPUT_POST, 'area', FILTER_SANITIZE_MAGIC_QUOTES);
$area = ($areaFiltered !== NULL) ? $areaFiltered : 'standard';
$viewFiltered = filter_input(INPUT_POST, 'view', FILTER_SANITIZE_MAGIC_QUOTES);
$view = ($viewFiltered !== NULL) ? $viewFiltered : 'standard';
$idFiltered = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
$id = ($idFiltered !== NULL) ? $idFiltered : '0';
error_reporting(E_ALL - E_ERROR);

function meinFehlerbehandler($fehlernummer, $fehlertext, $fehlerdatei, $fehlerzeile) {
    echo"Frag Ossama";
    file_put_contents('fehler.txt', "Dicker Fehler: [$fehlernummer] $fehlertext Fehler in Zeile $fehlerzeile in Datei $fehlerdatei\n", FILE_APPEND);
}

set_error_handler("meinFehlerbehandler");
try {
    $out = BaseController::load($action, $area, $id);
} catch (Exception $exc) {
    $view = 'error';

    file_put_contents('logger' . DIRECTORY_SEPARATOR . 'phplogger.txt', date(DateTime::ATOM) . "\n" . $exc->getTraceAsString(), FILE_APPEND);
}


include 'view' . DIRECTORY_SEPARATOR . $view . '.php';

$ajaxFiltered=filter_input(INPUT_POST, 'ajax', FILTER_SANITIZE_MAGIC_QUOTES);
$ajax = isset($ajaxFiltered) ? $ajaxFiltered : 'false';

if ($ajax == 'false') {
    include './view/frmHaupt.php';
}
?>
