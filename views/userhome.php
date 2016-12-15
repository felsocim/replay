<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
            <h1 class="text-center">Heureux de vous retrouver <?php echo $_SESSION['user_fullname']; ?></h1>
            <h3 class="text-center">Nouvelles sorties de vos abonnements</h3>
            <?php
            if(!empty($videos_subscriptions))
            {
                foreach ($videos_subscriptions as $video)
                {
                    echo '<div class="panel panel-default">';
                    if(empty($video->getEmission()))
                    {
                        echo '<div class="panel-heading"><a href="'.HOME.'/video/view/'.$video->getIdvideo().'">'.$video->getTitre().'</a></div>';
                    }
                    else
                    {
                        echo '<div class="panel-heading"><a href="'.HOME.'/video/view/'.$video->getIdvideo().'">'.$video->getTitre().' ('.$video->getEmission().')</a></div>';
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
            <h3 class="text-center">Vidéos populaires qui pourraient vous intéresser</h3>
            <?php
            if(!empty($videos_suggestions))
            {
                foreach ($videos_suggestions as $video)
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