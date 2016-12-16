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
                    <h1 class="text-center">Modification de catégorie</h1>
                    <p class="text-center">
                        Ici, vous pouvez modifier la catégorie choisie.
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <form method="POST" action="<?php echo HOME.'/category/edit/'.$category->getIdcategorie(); ?>">
                        <div class="form-group">
                            <label for="titre">Titre</label>
                            <input type="text" class="form-control" id="titre" name="titre" placeholder="Titre" value="<?php echo $category->getTitre(); ?>">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description"><?php echo $category->getDescription(); ?></textarea>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <button type="submit" id="modifier" class="btn btn-success">Sauvegarder</button>
                            </div>
                            <div class="col-lg-6 text-right">
                                <a href="<?php echo HOME.'/category/manage'; ?>" class="btn btn-warning">Abandon</a>
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
            if($("#titre").val().length == 0 || $("#description").val().length == 0) {
                $("#avertissement").html('<div class="alert alert-warning">Veuillez saisir tout les informations demandées!</div>').show().delay(1000).hide(500);
            }
            else {
                $(this).unbind("click");
            }
        })
    })
</script>