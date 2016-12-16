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
                    <h1 class="text-center">Modification d'émission</h1>
                    <p class="text-center">
                        Ici, vous pouvez modifier une émission.
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <form method="POST" action="<?php echo HOME.'/programme/edit/'.$emission->getIdemission(); ?>">
                        <div class="form-group">
                            <label for="categorie">Catégorie</label>
                            <select id="categorie" name="categorie" class="form-control">
                                <?php
                                    if(!empty($categories))
                                    {
                                        foreach ($categories as $category)
                                        {
                                            if(strcmp($category->getTitre(), $emission->getCategorie()) == 0)
                                            {
                                                echo '<option selected="selected">'.$category->getTitre().'</option>';
                                            }
                                            else
                                            {
                                                echo '<option>'.$category->getTitre().'</option>';
                                            }
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="titre">Titre</label>
                            <input type="text" class="form-control" id="titre" name="titre" placeholder="Titre" value="<?php echo $emission->getTitre(); ?>">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description"><?php echo $emission->getDescription(); ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="chaine">Chaîne de diffusion</label>
                            <input type="text" class="form-control" id="chaine" name="chaine" placeholder="" value="<?php echo $emission->getChaine(); ?>">
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <button type="submit" id="modifier" class="btn btn-success">Sauvegarder</button>
                            </div>
                            <div class="col-lg-6 text-right">
                                <a href="<?php echo HOME.'/programme/manage'; ?>" class="btn btn-warning">Abandon</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $("#modifier").on("click", function (e) {
            e.preventDefault();
            if($("#titre").val().length == 0 || $("#description").val().length == 0 || $("#chaine").val().length == 0) {
                $("#avertissement").html('<div class="alert alert-warning">Veuillez saisir tout les informations demandées!</div>').show().delay(1000).hide(500);
            }
            else {
                $(this).unbind("click");
            }
        })
    })
</script>