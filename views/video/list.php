<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
            <?php
                if(!empty($videos))
                {
                    foreach ($videos as $video)
                    {
                        echo '<div class="panel panel-default">';
                        echo '<div class="panel-heading">'.$video->getTitre().'('.$video->getEmission().')</div>';
                        echo '<div class="panel-body">'.$video->getDescription().'</div>';
                        echo '<div class="panel-footer">Date de sortie: '.$video->getDatepremiere().' - Nombre de vues: '.$video->getNbrvisionnages().'</div>';
                        echo '</div>';
                    }
                }
            ?>
        </div>
    </div>
</div>