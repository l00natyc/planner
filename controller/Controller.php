<?php

include_once("../model/Model.php");

class Controller extends Model {

    private $model;

    public function getBenutzer() {
        return $this->model->ausgabeAlleMitarbeiter();
    }

    public function getBenutzerByUsername($username) {
        return $this->getBenutzerByUsernameData($username);
    }

    public function getProjekte() {
        return $this->model->ausgabeAlleProjekte();
    }

    public function getProjectByID($projekt_id) {
        return $this->getProjectByIDData($projekt_id);
    }

    public function getAufgaben() {
        return $this->model->ausgabeAlleAufgaben();
    }

    public function getAufgabenDerMitarbeiter($mitID) {
        return $this->model->ausgabeAlleAufgabendesMitarbeiters($mitID);
    }

    public function getAufgabeByID($aufgaben_id) {
        return $this->getAufgabeByIDData($aufgaben_id);
    }

    public function updateAufgaben($aufgabenID) {
        return $this->model->updateAufgabenData($aufgabenID);
    }

    public function updateZeit($aufgabenID, $mitarbeiterID, $zeit) {
        return $this->updateZeitData($aufgabenID, $mitarbeiterID, $zeit);
    }

    public function getNeuesProjekt($projekt, $deadline, $erstell, $beschreibung) {
        return $this->neuesProjektAnlegen($projekt, $deadline, $erstell, $beschreibung);
    }

    public function getNeueAufgabe($aufgabenname, $status, $beschreibung, $datum) {
        return $this->neueAufgabeAnlegen($aufgabenname, $status, $beschreibung, $datum);
    }

    public function getZeitenSummiert($id, $aufgabenNR) {
        return $this->getZeitenSummiertData($id, $aufgabenNR);
    }

    public function getLetzteID() {
        return $this->getLetzteIDData();
    }

    public function getAlleAufgaben() {
        return $this->getAlleAufgabenData();
    }

}

?>