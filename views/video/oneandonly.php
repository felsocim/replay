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
                        echo "<h3 style='margin-bottom: 0;'>".$video->getTitre()."</h3>";
                    ?>
                </div>
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6">
                            <?php
                                echo "<h4><span class=\"glyphicon glyphicon-eye-open\" aria-hidden=\"true\"></span>&nbsp;".number_format($video->getNbrvisionnages(), 0, ',', ' ')."</h4>";
                            ?>
                        </div>
                        <div class="col-lg-6 text-right">
                            <div class="btn-group" role="group" aria-label="...">
                                <?php
                                    if(isauthenticated())
                                    {
                                        echo '<a href="#" class="btn btn-default"><strong><span class="glyphicon glyphicon-star" aria-hidden="true"></span>&nbsp;Ajouter aux favoris</strong></a>';
                                        echo '<a href="#" class="btn btn-default"><strong><span class="glyphicon glyphicon-bullhorn" aria-hidden="true"></span>&nbsp;Suivre cette émission</strong></a>';
                                    }
                                    else
                                    {
                                        echo '<button type="button" href="#" class="btn btn-default disabled"><strong><span class="glyphicon glyphicon-star" aria-hidden="true"></span>&nbsp;Ajouter aux favoris</strong></button>';
                                        echo '<button type="button" class="btn btn-default disabled"><strong><span class="glyphicon glyphicon-bullhorn" aria-hidden="true"></span>&nbsp;Suivre cette émission</strong></button>';
                                    }
                                ?>


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