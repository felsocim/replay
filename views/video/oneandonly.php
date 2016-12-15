<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <?php
                        echo $video->getEmbed();
                    ?>
                </div>
                <div class="col-lg-12">
                    <?php
                        echo "<h3 style='margin-bottom: 0;'>".$video->getEmission()." : ".$video->getTitre()."</h3>";
                    ?>
                </div>
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-4">
                            <?php
                                echo "<h4><span class=\"glyphicon glyphicon-eye-open\" aria-hidden=\"true\"></span>&nbsp;".number_format($video->getNbrvisionnages(), 0, ',', ' ')."</h4>";
                            ?>
                        </div>
                        <div class="col-lg-8 text-right">
                            <div class="btn-group" role="group" aria-label="...">
                                <?php
                                    if(isauthenticated())
                                    {
                                        if($video->isFavorite(getAuthenticated()))
                                        {
                                            echo '<button id="favoris" type="button" href="#" class="btn btn-default disabled"><strong><span class="glyphicon glyphicon-star" aria-hidden="true"></span>&nbsp;La vidéo est dajà parmi vos favoris</strong></button>';
                                        }
                                        else
                                        {
                                            echo '<button id="favoris" type="button" href="#" class="btn btn-default"><strong><span class="glyphicon glyphicon-star" aria-hidden="true"></span>&nbsp;Ajouter aux favoris</strong></button>';
                                        }
                                        if($video->isSubscribed(getAuthenticated(), $video->getIdemission()))
                                        {
                                            echo '<button id="suivre" type="button" class="btn btn-default disabled"><strong><span class="glyphicon glyphicon-bullhorn" aria-hidden="true"></span>&nbsp;Vous suivez déjà cette émission</strong></button>';
                                        }
                                        else
                                        {
                                            echo '<button id="suivre" type="button" class="btn btn-default"><strong><span class="glyphicon glyphicon-bullhorn" aria-hidden="true"></span>&nbsp;Suivre cette émission</strong></button>';
                                        }
                                    }
                                    else
                                    {
                                        echo '<button id="favoris" type="button" href="#" class="btn btn-default disabled"><strong><span class="glyphicon glyphicon-star" aria-hidden="true"></span>&nbsp;Ajouter aux favoris</strong></button>';
                                        echo '<button id="suivre" type="button" class="btn btn-default disabled"><strong><span class="glyphicon glyphicon-bullhorn" aria-hidden="true"></span>&nbsp;Suivre cette émission</strong></button>';
                                    }
                                ?>
                                <script>
                                    var idvideo = "<?php echo $video->getIdvideo(); ?>";
                                    var idemission = "<?php echo $video->getIdemission(); ?>";
                                    var iduser = "<?php echo getAuthenticated(); ?>";
                                    var home = "<?php echo HOME; ?>";

                                    $(document).ready(function () {
                                        $("#favoris").on('click', function (e) {
                                            e.preventDefault();
                                            $.ajax({
                                                url: home + "/video/favorite/",
                                                data: {videoid: idvideo, userid: iduser},
                                                method: "POST",
                                                success: function() {
                                                    $("#favoris").html('<strong><span class="glyphicon glyphicon-star" aria-hidden="true"></span>&nbsp;La vidéo a été ajoutée aux favoris</strong>').addClass('disabled');
                                                }
                                            });
                                        });
                                        $("#suivre").on('click', function (e) {
                                            e.preventDefault();
                                            $.ajax({
                                                url: home + "/video/subscribed/",
                                                data: {emissionid: idemission, userid: iduser},
                                                method: "POST",
                                                success: function() {
                                                    $("#suivre").html('<strong><span class="glyphicon glyphicon-bullhorn" aria-hidden="true"></span>&nbsp;Vous êtes désormais abonné(e) à cette emission</strong>').addClass('disabled');
                                                }
                                            });
                                        });
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <?php
                        echo $video->getDescription();
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h4>Autres épisodes de cette émission</h4>
                </div>
            </div>
        </div>
    </div>
</div>
