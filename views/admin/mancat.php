<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
            <div class="row">
                <div class="col-lg-12">
                    <div id="avertissement"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="text-center">Gestion de catégories</h1>
                    <p class="text-center">
                        Ici, vous pouvez créer de nouvelles catégories ainsi que modifier ou supprimer les catégories existantes.
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="text-center">Créer une nouvelle catégorie</h3>
                    <p class="text-center">
                        Pour créer une catégorie, entrez les informations demandées et cliquez sur le bouton vert en dessous du formulaire.
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <form method="POST" action="<?php echo HOME.'/category/add'; ?>">
                        <div class="form-group">
                            <label for="titre">Titre</label>
                            <input type="text" class="form-control" id="titre" name="titre" placeholder="Titre">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description"></textarea>
                        </div>
                        <button type="submit" id="creer" class="btn btn-success">Créer la catégorie</button>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="text-center">Modifier ou supprimer une catégorie</h3>
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
                                Titre
                            </th>
                            <th>
                                Description
                            </th>
                            <th colspan="2" class="text-center">
                                Actions
                            </th>

                        </tr>
                        <?php
                            if(!empty($categories))
                            {
                                foreach ($categories as $category)
                                {
                                    echo '<tr>';
                                    echo '<td>';
                                    echo $category->getIdcategorie();
                                    echo '</td>';
                                    echo '<td>';
                                    echo $category->getTitre();
                                    echo '</td>';
                                    echo '<td>';
                                    echo $category->getDescription();
                                    echo '</td>';
                                    echo '<td>';
                                    echo '<a href="'.HOME.'/category/edit/'.$category->getIdcategorie().'" class="btn btn-info">Modifier</a>';
                                    echo '</td>';
                                    echo '<td>';
                                    echo '<a href="'.HOME.'/category/del/'.$category->getIdcategorie().'" class="btn btn-danger" style"float: left;">Supprimer</a>';
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
<script>
    $(document).ready(function () {
        $("#creer").on("click", function (e) {
            e.preventDefault();
            if($("#titre").val().length == 0 || $("#description").val().length == 0) {
                $("#avertissement").html('<div class="alert alert-warning">Veuillez saisir tout les informations demandées!</div>').show().delay(1000).hide(500);
            }
            else {
                $(this).unbind("click");
            }
        })
    })
</script>