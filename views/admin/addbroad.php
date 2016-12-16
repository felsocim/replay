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
                    <h1 class="text-center">Ajout de diffusion d'une vidéo</h1>
                    <p class="text-center">
                        Ici, vous pouvez ajouter une nouvelle diffusion.
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <form method="POST" action="<?php echo HOME.'/video/newbroadcasting/'.$video->getIdvideo(); ?>">
                        <div class="form-group">
                            <label for="datediffusion">Date de la prochaine diffusion</label>
                            <input type="text" class="form-control" id="datediffusion" name="datediffusion" placeholder="">
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <button type="submit" id="creer" class="btn btn-success">Ajouter la diffusion</button>
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
<script>
    $(document).ready(function () {
        $("#creer").on("click", function (e) {
            e.preventDefault();
            if($("#datediffusion").val().length == 0) {
                $("#avertissement").html('<div class="alert alert-warning">Veuillez saisir tout les informations demandées!</div>').show().delay(1000).hide(500);
            }
            else {
                $(this).unbind("click");
            }
        });
    });
    $('#datediffusion').datepicker({
        dateFormat: 'dd.mm.y',
        minDate: 0
    });
</script>