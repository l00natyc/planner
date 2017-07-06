<?php

require_once 'datenbank.php';

class Model {

    //  private $con;


    public function __construct() {
        //  $this->Datenbankverbindung();
    }

//    function Datenbankverbindung() {
//        $this->con = new mysqli('localhost', "root", "", "dreimaleins");
//    }
//    public function datenbankabfrage($name) {
//
//        $selectdata = "SELECT PKMitarbeiterID,vorname FROM mitarbeiter WHERE vorname LIKE '$name%' ";
//
//        $query = mysql_query($selectdata) or die(mysql_error());
//
//        $row = mysql_fetch_array($query);
//
//        return $row;
//    }
//
    public function ausgabeAlleMitarbeiter() {
//
//        $auswahl = "SELECT nachname,vorname,username FROM mitarbeiter";
//
//        $result = $this->con->query($auswahl);
//
//        while ($row = mysqli_fetch_assoc($result)) {
//            $back[] = $row; // 
//        }
//
//        return $back;

        Database::getInstance()->query("SELECT nachname,vorname,username FROM mitarbeiter");

        $back = Database::getInstance()->resultset();

        return $back;
    }

//
    public function ausgabeAlleProjekte() {
//
//        $auswahl = "select SEC_TO_TIME(sum(TIME_TO_SEC(zeit))) as gesamtzeit, 
//            projektname,PKProjektID from projekt,ztaufgpro,aufgaben where projekt.pkprojektid = ztaufgpro.fkprojektid and 
//            aufgaben.pkaufgabenid = ztaufgpro.fkaufgabenid group by PKProjektID order by PKProjektID asc;";
//
//        $result = $this->con->query($auswahl);
//
//        while ($row = mysqli_fetch_assoc($result)) {
//            $back[] = $row;
//        }
//
//        return $back;

        Database::getInstance()->query("select SEC_TO_TIME(sum(TIME_TO_SEC(zeit))) as gesamtzeit, 
            projektname,PKProjektID,deadline from projekt,ztaufgpro,aufgaben where projekt.pkprojektid = ztaufgpro.fkprojektid and 
            aufgaben.pkaufgabenid = ztaufgpro.fkaufgabenid group by PKProjektID order by PKProjektID asc;");

        $back = Database::getInstance()->resultset();

        return $back;
    }

//
    public function ausgabeAlleAufgaben() {
//
//        $auswahl = "select nachname,projektname,aufgabenname,aufgaben.status from mitarbeiter,ztmitpro,projekt,aufgaben,ZtAufgPro 
//         where mitarbeiter.pkmitarbeiterid = ztmitpro.fkmitarbeiterid and projekt.pkprojektid = ztmitpro.fkprojektid 
//         and projekt.pkprojektid = ztaufgpro.fkprojektid and aufgaben.pkaufgabenid = ztaufgpro.fkaufgabenid;";
//
//        $result = $this->con->query($auswahl);
//
//        while ($row = mysqli_fetch_assoc($result)) {
//            $back[] = $row;
//        }
//
//        return $back;

        Database::getInstance()->query("select nachname,projektname,aufgabenname,aufgaben.status from mitarbeiter,ztmitpro,projekt,aufgaben,ZtAufgPro 
         where mitarbeiter.pkmitarbeiterid = ztmitpro.fkmitarbeiterid and projekt.pkprojektid = ztmitpro.fkprojektid 
         and projekt.pkprojektid = ztaufgpro.fkprojektid and aufgaben.pkaufgabenid = ztaufgpro.fkaufgabenid;");

        $back = Database::getInstance()->resultset();

        return $back;
    }

//
    public function ausgabeAlleAufgabendesMitarbeiters($mitID) {
//
//        $auswahl = "select mitarbeiter.PKmitarbeiterID,aufgaben.PKAufgabenID,aufgaben.aufgabenname,aufgaben.status,aufgaben.zeit,aufgaben.beschreibung from mitarbeiter,ZtMitAuf,aufgaben where aufgaben.pkaufgabenid = 
//            ZtMitAuf.fkaufgabenid and mitarbeiter.pkmitarbeiterid = ZtMitAuf.FKMitarbeiterID and mitarbeiter.pkmitarbeiterID = $mitID;";
//
//
//        $result = $this->con->query($auswahl);
//
//        while ($row = mysqli_fetch_assoc($result)) {
//            $back[] = $row;
//        }
//
//        return $back;
        Database::getInstance()->query("select mitarbeiter.PKmitarbeiterID,aufgaben.PKAufgabenID,aufgaben.aufgabenname,aufgaben.status,aufgaben.zeit,aufgaben.beschreibung from mitarbeiter,ZtMitAuf,aufgaben where aufgaben.pkaufgabenid = 
            ZtMitAuf.fkaufgabenid and mitarbeiter.pkmitarbeiterid = ZtMitAuf.FKMitarbeiterID and mitarbeiter.pkmitarbeiterID = :mitID group by PKAufgabenID;");
        Database::getInstance()->bind(':mitID', $mitID);
        $back = Database::getInstance()->resultset();

        return $back;
    }

    public function getBenutzerByUsernameData($username) {

//        $auswahl = "SELECT * FROM mitarbeiter where username = \"$username\" ";
//
//        $result = $this->con->query($auswahl);
//
//        while ($row = mysqli_fetch_assoc($result)) {
//            $back[] = $row;
//        }
//
//        return $back;

        Database::getInstance()->query("SELECT * FROM mitarbeiter where username = :user;");
        Database::getInstance()->bind(':user', $username);
        $back = Database::getInstance()->resultset();

        return $back;
    }

    public function getProjectByIDData($projekt_id) {
//
//        $auswahl = "select projekt.pkprojektid,projekt.projektname,aufgaben.aufgabenname,aufgaben.status,aufgaben.zeit from mitarbeiter,ztmitpro,projekt,aufgaben,ZtAufgPro 
//         where mitarbeiter.pkmitarbeiterid = ztmitpro.fkmitarbeiterid and projekt.pkprojektid = ztmitpro.fkprojektid 
//         and projekt.pkprojektid = ztaufgpro.fkprojektid and aufgaben.pkaufgabenid = ztaufgpro.fkaufgabenid and projekt.pkprojektid = $projekt_id;";
//
//        $result = $this->con->query($auswahl);
//
//        while ($row = mysqli_fetch_assoc($result)) {
//            $back[] = $row;
//        }
//
//        return $back;
        Database::getInstance()->query("select projekt.pkprojektid,projekt.projektname,aufgaben.aufgabenname,aufgaben.status,aufgaben.zeit from mitarbeiter,ztmitpro,projekt,aufgaben,ZtAufgPro 
         where mitarbeiter.pkmitarbeiterid = ztmitpro.fkmitarbeiterid and projekt.pkprojektid = ztmitpro.fkprojektid 
         and projekt.pkprojektid = ztaufgpro.fkprojektid and aufgaben.pkaufgabenid = ztaufgpro.fkaufgabenid and projekt.pkprojektid = :projekt");
        Database::getInstance()->bind(':projekt', $projekt_id);
        $back = Database::getInstance()->resultset();

        return $back;
    }

    public function getAufgabeByIDData($aufgaben_id) {

        Database::getInstance()->query("select * from aufgaben where Aufgaben.pkaufgabenid = :aufgabe");
        Database::getInstance()->bind(':aufgabe', $aufgaben_id);
        $back = Database::getInstance()->resultset(); // bei select ->resultset()!

        return $back;
    }

    public function updateAufgabenData($aufgaben_id, $aufgaben_name, $aufgaben_status, $aufgaben_beschreibung) {
        Database::getInstance()->query("UPDATE Aufgaben SET aufgabenname= :aufgNamne , status= :status, beschreibung= :beschr WHERE PKAufgabenID = :aufgID");
        Database::getInstance()->bind(':aufgNamne', $aufgaben_name);
        Database::getInstance()->bind(':status', $aufgaben_status);
        Database::getInstance()->bind(':beschr', $aufgaben_beschreibung);
        Database::getInstance()->bind(':aufgID', $aufgaben_id);
        $back = Database::getInstance()->execute(); // bei insert,update,delete ->execute()!

        return $back;
    }

    public function updateZeitData($aufgaben_ID, $mitarbeiterID, $zeit) {
        Database::getInstance()->query("INSERT INTO ztmitauf VALUES (NULL,:mitar,:aufgID,:zeit)");
        Database::getInstance()->bind(':zeit', $zeit);
        Database::getInstance()->bind(':mitar', $mitarbeiterID);
        Database::getInstance()->bind(':aufgID', $aufgaben_ID);
        $back = Database::getInstance()->execute(); // bei insert,update,delete ->execute()!

        return $back;
    }

    public function getZeitenSummiertData($mitarbeiterID, $aufgaben_ID) {
        Database::getInstance()->query("select sec_to_time(sum(zeit)) as SummeZeit from ztmitauf where fkmitarbeiterid = :mitar and fkaufgabenid = :aufgID;");
        Database::getInstance()->bind(':mitar', $mitarbeiterID);
        Database::getInstance()->bind(':aufgID', $aufgaben_ID);
        $back = Database::getInstance()->resultset();

        return $back;
    }

//
    public function neuesProjektAnlegen($projekt, $deadline, $erstell, $beschreibung) {
//
//
//        $auswahl = "INSERT INTO Projekt VALUES (NULL,\"$projekt\",\"$deadline\", \"$beschreibung\")";
//
//
//        $result = $this->con->query($auswahl);
        Database::getInstance()->query("INSERT INTO Projekt VALUES (NULL,:projekt,:deadl,:erstell,:beschr)");
        Database::getInstance()->bind(':projekt', $projekt);
        Database::getInstance()->bind(':deadl', $deadline);
        Database::getInstance()->bind(':erstell', $erstell);
        Database::getInstance()->bind(':beschr', $beschreibung);
        $back = Database::getInstance()->execute(); // bei insert,update,delete ->execute()!

        return $back;
    }

    public function neueAufgabeAnlegen($aufgabenname, $status, $beschreibung, $datum) {

        Database::getInstance()->query("INSERT INTO Aufgaben VALUES (NULL,:aufgabenname,NULL,:date,:status,:beschr)");
        Database::getInstance()->bind(':aufgabenname', $aufgabenname);
        Database::getInstance()->bind(':status', $status);
        Database::getInstance()->bind(':beschr', $beschreibung);
        Database::getInstance()->bind(':date', $datum);
        $back = Database::getInstance()->execute(); // bei insert,update,delete ->execute()!

        return $back;
    }

    public function getLetzteIDData() {

        Database::getInstance()->query("select max(pkaufgabenid) as maxID from aufgaben;");
        $back = Database::getInstance()->resultset(); // bei insert,update,delete ->execute()!

        return $back;
    }

    public function getAlleAufgabenData() {

        Database::getInstance()->query("select aufgabenname,fkaufgabenid,username,aufgaben.status,erstelldatum,beschreibung from ztmitauf, aufgaben, mitarbeiter where 
            aufgaben.pkaufgabenid = ztmitauf.fkaufgabenid and mitarbeiter.PKMitarbeiterID = ztmitauf.fkmitarbeiterid group by fkaufgabenid;");
        $back = Database::getInstance()->resultset(); // bei insert,update,delete ->execute()!

        return $back;
    }

}

?>