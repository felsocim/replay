<div class="container-fluid no-margin no-padding">
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo HOME; ?>"><img src="<?php echo HOME ?>/res/img/arevoir_logo.png" alt="A revoir"></a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="<?php echo HOME; ?>">Accueil</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Catégories <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <?php
                            if(!empty($categories))
                            {
                                foreach ($categories as $category)
                                {
                                    echo '<li><a href="'.HOME.'/video/category/'.$category->getIdcategorie().'">'.$category->getTitre().'</a></li>';
                                }
                            }
                            ?>
                        </ul>
                    </li>
                </ul>
                <form class="navbar-form navbar-left">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Rechercher une vidéo">
                    </div>
                    <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>&nbsp;Chercher</button>
                </form>
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <?php
                            if(isauthenticated())
                            {
                                echo '<a href="'.USER_ACCOUNT.'">'.$_SESSION['user_fullname'].'</a>';
                            }
                        ?>
                    </li>
                    <?php
                        if(isauthenticated())
                        {
                            echo '<li><p class="navbar-button"><a href="'.'/user/logout'.'" class="btn btn-danger"><span class="glyphicon glyphicon-off" aria-hidden="true"></span>&nbsp;Déconnexion</a></p></li>';
                        }
                        else
                        {
                            echo '<li><p class="navbar-button"><a href="'.'/user/login'.'" class="btn btn-info"><span class="glyphicon glyphicon-log-in" aria-hidden="true"></span>&nbsp;&nbsp;Connexion</a></p></li>';
                            echo '<li><p class="navbar-button">&nbsp;<a href="'.'/user/signup'.'" class="btn btn-success"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>&nbsp;&nbsp;Inscription</a></p></li>';
                        }
                    ?>
                </ul>
            </div>
        </div>
    </nav>
</div>