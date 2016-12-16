<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="text-center">Gestion de vidéos</h1>
                    <p class="text-center">
                        Ici, vous pouvez créer de nouvelles vidéos ainsi que modifier ou supprimer les vidéos existantes.
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="text-center">Ajouter une nouvelle vidéo</h3>
                    <p class="text-center">
                        <a href="<?php echo HOME.'/video/add'; ?>" class="btn btn-success">Ajouter une vidéo</a>
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="text-center">Modifier ou supprimer une vidéo</h3>
                    <p class="text-center">
                        Choisissez l'action désirée en cliquant sur le bouton correspondant.
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <table class="table table-striped">
                        <tr>
                            <th>
                                #ID
                            </th>
                            <th>
                                Émission
                            </th>
                            <th>
                                Titre
                            </th>
                            <th>
                                Description
                            </th>
                            <th>
                                Durée
                            </th>
                            <th>
                                Première diffusion
                            </th>
                            <th>
                                Origine
                            </th>
                            <th>
                                Date de validité
                            </th>
                            <th colspan="3" class="text-center">
                                Actions
                            </th>

                        </tr>
                        <?php
                            if(!empty($videos))
                            {
                                foreach ($videos as $video)
                                {
                                    echo '<tr>';
                                    echo '<td>';
                                    echo $video->getIdvideo();
                                    echo '</td>';
                                    echo '<td>';
                                    echo $video->getEmission();
                                    echo '</td>';
                                    echo '<td>';
                                    echo $video->getTitre();
                                    echo '</td>';
                                    echo '<td>';
                                    echo $video->getDescription();
                                    echo '</td>';
                                    echo '<td>';
                                    echo $video->getDuree().' min';
                                    echo '</td>';
                                    echo '<td>';
                                    echo $video->getDatepremiere();
                                    echo '</td>';
                                    echo '<td>';
                                    echo $video->getOrigine();
                                    echo '</td>';
                                    echo '<td>';
                                    echo $video->getDatevalidite();
                                    echo '</td>';
                                    echo '<td>';
                                    echo '<a href="'.HOME.'/video/edit/'.$video->getIdvideo().'" class="btn btn-info">Modifier</a>';
                                    echo '</td>';
                                    echo '<td>';
                                    echo '<a href="'.HOME.'/video/newbroadcasting/'.$video->getIdvideo().'" class="btn btn-info">Nouvelle diffusion</a>';
                                    echo '</td>';
                                    echo '<td>';
                                    echo '<a href="'.HOME.'/video/del/'.$video->getIdvideo().'" class="btn btn-danger" style"float: left;">Supprimer</a>';
                                    echo '</td>';
                                    echo '</tr>';
                                }
                            }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>