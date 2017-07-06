<?php
session_start();
require_once '../controller/controller.php';

$meinObjekt = new Controller();

                $aufgaben_name = $_POST['name'];
            
                $aufgaben_status = $_POST['status'];
                $aufgaben_beschreibung = $_POST['beschreibung'];
                $aufgaben_id = $_SESSION["id_mitarbeiter"];
                

if (isset($aufgaben_id)) {
        
  
  $abfrage = $meinObjekt->updateAufgabenData($aufgaben_id, $aufgaben_name, $aufgaben_status, $aufgaben_beschreibung); // neues Projekt in der Datenbanktabelle "Projekt" erstellen 
                       
        echo "1";
    } else {
        echo "0";
    }
    