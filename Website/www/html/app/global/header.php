

<!-- -->

<nav class="navbar navbar-inverse" style="height: 50px">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="" ><img src='app/img/travel.png' style="max-height: 50px"></a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li class=""><a href="./index.php">Accueil</a></li>
                <li class="nav-item">
                    <a class="nav-link" href="./index.php?page=categorie&cat=all">Toutes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./index.php?page=categorie&cat=4">Europe</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./index.php?page=categorie&cat=0">Amérique du Nord</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./index.php?page=categorie&cat=1">Amérique du Sud</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./index.php?page=categorie&cat=5">Asie </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./index.php?page=categorie&cat=3">Afrique</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./index.php?page=categorie&cat=6">Océanie</a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">

                <?php
                if ($_SESSION['user']['connected'] == false){
                    echo '<li class="nav-item">';
                    echo    "<a class=\"nav-link\" href=\"./index.php?page=login\">Se connecter</a>";
                    echo "</li>";
                } else {
                    if ($_SESSION['user']['role'] == 'CLIENT'){
                        echo '<li class="nav-item">';
                        echo    "<a class=\"nav-link\" href=\"./index.php?page=espace_perso\"><span class=\"glyphicon glyphicon-user\"></span>".$_SESSION['user']['nom']." ".$_SESSION['user']['prenom']."</a>";
                        echo "</li>";
                    }else{
                        echo '<li class="nav-item">';
                        echo    "<a class=\"nav-link\" href=\"./admin/index.php\"><span class=\"glyphicon glyphicon-user\"></span> ".$_SESSION['user']['nom']." ".$_SESSION['user']['prenom']."</a>";
                        echo "</li>";
                    }
                    echo '<li class="nav-item">';
                    echo    "<a class=\"nav-link\" href=\"./index.php?page=logout\"><span class=\"glyphicon glyphicon-log-out\"></span>"." Deconexion,"."</a>";
                    echo "</li>";
                }
                ?>
            </ul>
        </div>
    </div>
</nav>