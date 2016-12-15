<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
            <?php
                if(!empty($videos))
                {
                    foreach ($videos as $video)
                    {
                        echo '<div class="panel panel-default">';

                        echo '<div class="panel-heading">';
                        echo '<div class="row no-padding no-margin">';
                        echo '<div class="col-lg-11 no-margin no-padding">';

                        if(empty($video->getEmission()))
                        {
                            echo '<a href="'.HOME.'/video/view/'.$video->getIdvideo().'">'.$video->getTitre().'</a>';
                        }
                        else
                        {
                            echo '<a href="'.HOME.'/video/view/'.$video->getIdvideo().'">'.$video->getTitre().' ('.$video->getEmission().')</a>';
                        }

                        echo '</div>';
                        echo '<div class="col-lg-1 no-margin no-padding text-right">';

                        if($favoritesRemovalAuthorized)
                        {
                            echo '<a href="'.HOME.'/favorite/remove/'.$video->getIdvideo().'/'.getAuthenticated().'"><span class="glyphicon glyphicon-remove text-red" aria-hidden="true"></span></a>';
                        }
                        if($historyRemovalAuthorized)
                        {
                            echo '<a href="'.HOME.'/history/remove/'.$video->getIdvideo().'/'.getAuthenticated().'"><span class="glyphicon glyphicon-remove text-red" aria-hidden="true"></span></a>';
                        }

                        echo '</div>';
                        echo '</div>';
                        echo '</div>';

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