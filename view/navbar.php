<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="main.php">Start</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="uebersicht_projekte.php">Übersicht Projekte</a></li>
                <li><a href="item_anlegen.php">Projekt anlegen</a></li>
                <li><a href="main.php">Übersicht Aufgaben</a></li>
                <li><a href="aufgabe_anlegen.php">Aufgabe anlegen</a></li>
                <li><a href="uebersicht_Aufgaben.php">alle Aufgaben anzeigen</a></li>
                <li><?php
                    if (!isSet($_SESSION["username"])) {

                        echo"<a href=\"main.php\">login</a>";
                    }
                    ?></a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><?php
                    if (isSet($_SESSION["username"]))
                        echo '<a href="logout.php" tite="Logout">Logout</a></p>';
                    ?></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>