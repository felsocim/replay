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
                    <h1 class="text-center">Modification de vidéo</h1>
                    <p class="text-center">
                        Ici, vous pouvez modifier une vidéo.
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <form method="POST" action="<?php echo HOME.'/video/edit/'.$video->getIdvideo(); ?>">
                        <div class="form-group">
                            <label for="emission">Émission</label>
                            <select id="emission" name="emission" class="form-control">
                                <?php
                                    if(!empty($emissions))
                                    {
                                        foreach ($emissions as $emission)
                                        {
                                            if(strcmp($emission->getTitre(), $video->getEmission()) == 0)
                                            {
                                                echo '<option selected="selected">'.$emission->getTitre().'</option>';
                                            }
                                            else
                                            {
                                                echo '<option>'.$emission->getTitre().'</option>';
                                            }
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="titre">Titre</label>
                            <input type="text" class="form-control" id="titre" name="titre" placeholder="Titre" value="<?php echo $video->getTitre(); ?>">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description"><?php echo $video->getDescription(); ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="duree">Durée (min)</label>
                            <select id="duree" name="duree" class="form-control">
                                <?php
                                    for($i = 1; $i < VIDEO_MAX_LENGTH; $i++)
                                    {
                                        if($i == $video->getDuree())
                                        {
                                            echo '<option selected="selected">'.$i.'</option>';
                                        }
                                        else
                                        {
                                            echo '<option>'.$i.'</option>';
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="datepremiere">Date de la première diffusion</label>
                            <input type="text" class="form-control" id="datepremiere" name="datepremiere" placeholder="" value="<?php echo $video->getDatepremiere(); ?>">
                        </div>
                        <div class="form-group">
                            <label for="origine">Origine</label>
                            <input type="text" class="form-control" id="origine" name="origine" placeholder="" value="<?php echo $video->getOrigine(); ?>">
                        </div>
                        <div class="form-group">
                            <label for="datevalidite">Date de validité</label>
                            <input type="text" class="form-control" id="datevalidite" name="datevalidite" placeholder="" value="<?php echo $video->getDatevalidite(); ?>">
                        </div>
                        <div class="form-group">
                            <label for="embed">Lien EMBED vers la vidéo</label>
                            <textarea class="form-control" id="embed" name="embed"><?php echo $video->getEmbed(); ?></textarea>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <button type="submit" id="modifier" class="btn btn-success">Sauvegarder</button>
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
        $("#modifier").on("click", function (e) {
            e.preventDefault();
            var enddate = new Date($("#datevalidite").datepicker("getDate"));
            var startdate = new Date();
            var difference = new Date(enddate - startdate);
            var daysdifference = difference/1000/60/60/24;

            if($("#titre").val().length == 0 || $("#description").val().length == 0 || $("#datepremiere").val().length == 0 || $("#origine").val().length == 0 || $("#datevalidite").val().length == 0 || $("#embed").val().length == 0) {
                $("#avertissement").html('<div class="alert alert-warning">Veuillez saisir tout les informations demandées!</div>').show().delay(1000).hide(500);
            }
            else if(daysdifference < 7) {
                $("#avertissement").html('<div class="alert alert-warning">La vidéo doit être valide au moins 7 jours!</div>').show().delay(1000).hide(500);
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