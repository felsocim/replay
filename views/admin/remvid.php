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
                    <h1 class="text-center">Suppression de vidéo</h1>
                    <p class="text-center">
                        Êtes-vous sûr(e) de vouloir supprimer la vidéo <strong><?php echo $video->getTitre(); ?></strong> ?
                        <div class="alert alert-danger">
                            <strong>ATTENTION: </strong>La suppression d'une émission provoque également sa suppression de la liste des épisodes !
                        </div>
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <form method="POST" action="<?php echo HOME.'/video/del/'.$video->getIdvideo(); ?>">
                        <div class="row">
                            <div class="col-lg-6">
                                <button type="submit" id="supprimer" class="btn btn-danger">Supprimer</button>
                            </div>
                            <div class="col-lg-6 text-right">
                                <a href="<?php echo HOME.'/video/manage'; ?>" class="btn btn-warning">Abandon</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>