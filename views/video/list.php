<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
            <?php
                if(!empty($videos))
                {
                    foreach ($videos as $video)
                    {
                        echo '<div class="panel panel-default">';
                        if(empty($video->getEmission()))
                        {
                            echo '<div class="panel-heading"><a href="'.HOME.'/video/view/'.$video->getIdvideo().'">'.$video->getTitre().'</a></div>';
                        }
                        else
                        {
                            echo '<div class="panel-heading"><a href="'.HOME.'/video/view/'.$video->getIdvideo().'">'.$video->getTitre().'('.$video->getEmission().')</a></div>';
                        }
                        echo '<div class="panel-body">'.$video->getDescription().'</div>';
                        echo '<div class="panel-footer">Date de sortie: '.$video->getDatepremiere().' - Nombre de vues: '.$video->getNbrvisionnages().'</div>';
                        echo '</div>';
                    }
                }
                else
                {
                    echo '<p class="text-center">Aucune vidéo correspondante.</p>';
                }
            ?>
        </div>
    </div>
</div>