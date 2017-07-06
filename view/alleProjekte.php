

          <ul class="list-group">
                <?php
                $meinObjekt = new Controller(); // neues Objekt der Klasse Controller instanzieren
                $fuelleList = $meinObjekt->ausgabeAlleProjekte();  //Methode ausgabeAlleProjekte() 
                $fuelleList2 = $meinObjekt->ausgabeAlleAufgaben();
                $max = count($fuelleList);

                for ($i = 0; $i < $max; $i++) {
                    echo "<li class=\"list-group-item list-group-item-success\"><a href=\"#\">" . $fuelleList[$i]["projektname"] . " " . $fuelleList[$i]["gesamtzeit"] . "</a>"
                    . "</li>"; // Dropdown List wird gefüllt
                }
                $max = count($fuelleList2);

                for ($i = 0; $i < $max; $i++) {
                    echo "<li class=\"list-group-item list-group-item-info\"><a href=\"#\">" . $fuelleList2[$i]["projektname"] . " " . $fuelleList2[$i]["aufgabenname"] . " " . $fuelleList2[$i]["nachname"] . " </a>"
                    . "</li>"; // Dropdown List wird gefüllt
                }
                ?>