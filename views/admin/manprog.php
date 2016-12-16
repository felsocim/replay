<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="text-center">Gestion d'émissions</h1>
                    <p class="text-center">
                        Ici, vous pouvez créer de nouvelles émissions ainsi que modifier ou supprimer les émissions existantes.
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="text-center">Créer une nouvelle émission</h3>
                    <p class="text-center">
                        <a href="<?php echo HOME.'/programme/add'; ?>" class="btn btn-success">Créer une émission</a>
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="text-center">Modifier ou supprimer une émission</h3>
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
                                Catégorie
                            </th>
                            <th>
                                Titre
                            </th>
                            <th>
                                Description
                            </th>
                            <th>
                                Chaîne
                            </th>
                            <th colspan="2" class="text-center">
                                Actions
                            </th>

                        </tr>
                        <?php
                            if(!empty($emissions))
                            {
                                foreach ($emissions as $emission)
                                {
                                    echo '<tr>';
                                    echo '<td>';
                                    echo $emission->getIdemission();
                                    echo '</td>';
                                    echo '<td>';
                                    echo $emission->getCategorie();
                                    echo '</td>';
                                    echo '<td>';
                                    echo $emission->getTitre();
                                    echo '</td>';
                                    echo '<td>';
                                    echo $emission->getDescription();
                                    echo '</td>';
                                    echo '<td>';
                                    echo $emission->getChaine();
                                    echo '</td>';
                                    echo '<td>';
                                    echo '<a href="'.HOME.'/programme/edit/'.$emission->getIdemission().'" class="btn btn-info">Modifier</a>';
                                    echo '</td>';
                                    echo '<td>';
                                    echo '<a href="'.HOME.'/programme/del/'.$emission->getIdemission().'" class="btn btn-danger" style"float: left;">Supprimer</a>';
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