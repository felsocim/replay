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
                    <h1 class="text-center">Suppression de catégorie</h1>
                    <p class="text-center">
                        Êtes-vous sûr(e) de vouloir supprimer la catégorie <strong><?php echo $category->getTitre(); ?></strong> ?
                        <div class="alert alert-danger">
                            <strong>ATTENTION: </strong>La suppression d'une catégorie provoque également la suppression de toutes les émissions et toutes les vidéos qui lui appartiennent !
                        </div>
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <form method="POST" action="<?php echo HOME.'/category/del/'.$category->getIdcategorie(); ?>">
                        <div class="row">
                            <div class="col-lg-6">
                                <button type="submit" id="supprimer" class="btn btn-danger">Supprimer</button>
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