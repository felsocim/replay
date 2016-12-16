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
                    <h1 class="text-center">Ajout de vidéo</h1>
                    <p class="text-center">
                        Ici, vous pouvez ajouter une vidéo.
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <form method="POST" action="<?php echo HOME.'/video/add'; ?>">
                        <div class="form-group">
                            <label for="emission">Émission</label>
                            <select id="emission" name="emission" class="form-control">
                                <?php
                                    if(!empty($emissions))
                                    {
                                        foreach ($emissions as $emission)
                                        {
                                            echo '<option>'.$emission->getTitre().'</option>';
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="titre">Titre</label>
                            <input type="text" class="form-control" id="titre" name="titre" placeholder="Titre">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="duree">Durée (min)</label>
                            <select id="duree" name="duree" class="form-control">
                                <?php
                                    for($i = 1; $i < VIDEO_MAX_LENGTH; $i++)
                                    {
                                        echo '<option>'.$i.'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="datepremiere">Date de la première diffusion</label>
                            <input type="text" class="form-control" id="datepremiere" name="datepremiere" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="origine">Origine</label>
                            <input type="text" class="form-control" id="origine" name="origine" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="datevalidite">Date de validité</label>
                            <input type="text" class="form-control" id="datevalidite" name="datevalidite" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="embed">Lien EMBED vers la vidéo</label>
                            <textarea class="form-control" id="embed" name="embed"></textarea>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <button type="submit" id="creer" class="btn btn-success">Ajouter la vidéo</button>
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
            if($("#titre").val().length == 0 || $("#description").val().length == 0 || $("#datepremiere").val().length == 0 || $("#origine").val().length == 0 || $("#datevalidite").val().length == 0 || $("#embed").val().length == 0) {
                $("#avertissement").html('<div class="alert alert-warning">Veuillez saisir tout les informations demandées!</div>').show().delay(1000).hide(500);
            }
            else {
                $(this).unbind("click");
            }
        });
    });
    $('#datepremiere').datepicker({
        dateFormat: 'dd.mm.y'
    });
    $('#datevalidite').datepicker({
        dateFormat: 'dd.mm.y',
        minDate: 7
    });
</script>