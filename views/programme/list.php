<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
            <?php
            if(!empty($emissions))
            {
                foreach ($emissions as $emission)
                {
                    echo '<div class="panel panel-default">';

                    echo '<div class="panel-heading">';
                    echo '<div class="row no-padding no-margin">';
                    echo '<div class="col-lg-11 no-margin no-padding">';

                    echo '<a href="'.HOME.'/video/emission/'.$emission->getIdemission().'">'.$emission->getTitre().'</a>';

                    echo '</div>';
                    echo '<div class="col-lg-1 no-margin no-padding text-right">';

                    if($unsubscribtionAuthorized)
                    {
                        echo '<a href="'.HOME.'/subscription/remove/'.$emission->getIdemission().'/'.getAuthenticated().'"><span class="glyphicon glyphicon-remove text-red" aria-hidden="true"></span></a>';
                    }

                    echo '</div>';
                    echo '</div>';
                    echo '</div>';

                    echo '<div class="panel-body">'.$emission->getDescription().'</div>';
                    echo '<div class="panel-footer">Diffusée sur <strong>'.$emission->getChaine().'</strong></div>';
                    echo '</div>';
                }
            }
            else
            {
                echo '<p class="text-center">Aucune émission correspondante.</p>';
            }
            ?>
        </div>
    </div>
</div>