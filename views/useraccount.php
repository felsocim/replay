<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
            <div class="panel panel-info">
                <div class="panel-heading">
                    Mon profil
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-10 col-lg-offset-2">
                            <span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;<strong><?php echo $user->getPrenom().' '.$user->getNom(); ?></strong>&nbsp;<em></em><?php echo $user->getIdentifiant(); ?>
                        </div>
                        <div class="col-lg-10 col-lg-offset-2">
                            <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>&nbsp;<em><?php echo $user->getCourriel(); ?></em>
                        </div>
                        <div class="col-lg-10 col-lg-offset-2">
                            <span class="glyphicon glyphicon-star" aria-hidden="true"></span>&nbsp;<strong><?php echo $user->getDatenaissance(); ?></strong>&nbsp;<em>(<?php echo $user->getNationalite(); ?>)</em>
                        </div>
                        <div class="col-lg-10 col-lg-offset-2">
                            Vous vous êtes inscrit(e) le : <strong><?php echo $user->getDateinscription(); ?></strong>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Adhésion à notre Newsletter
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-10 col-lg-offset-2">
                            <?php
                                if($user->getAbonnementnewsletter() == 'N')
                                {
                                    echo '<p>Vous n\'êtes pas encore abonné(e) à notre newsletter. Voulez-vous vous inscrire ?</p>';
                                    echo '<form method="POST" action="'.HOME.'/user/subscribe/'.$user->getIdutilisateur().'">';
                                    echo '<button type="submit" class="btn btn-success">S\'abonner</button>';
                                    echo '</form>';
                                }
                                else
                                {
                                    echo '<p>Vous êtes déjà abonné(e) à notre newsletter. Si vous le souhaitez, vous pouvez vous désabonner à tout moment en cliquant sur le bouton ci-dessous :</p>';
                                    echo '<form method="POST" action="'.HOME.'/user/unsubscribe/'.$user->getIdutilisateur().'">';
                                    echo '<button type="submit" class="btn btn-danger">Se désabonner</button>';
                                    echo '</form>';
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>