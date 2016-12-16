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
                    <h1 class="text-center">Modification d'utilisateur</h1>
                    <p class="text-center">
                        Ici, vous pouvez modifier un utilisateur.
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <form method="POST" action="<?php echo HOME.'/user/edit/'.$user->getIdutilisateur(); ?>">
                        <div class="form-group">
                            <label for="prenom" class="control-label">Prénom :</label>
                            <input type="text" class="form-control" id="prenom" name="prenom" value="<?php echo $user->getPrenom(); ?>">
                        </div>
                        <div class="form-group">
                            <label for="nom" class="control-label">Nom :</label>
                            <input type="text" class="form-control" id="nom" name="nom" value="<?php echo $user->getNom(); ?>">
                        </div>
                        <div class="form-group">
                            <label for="courriel" class="control-label">Courriel :</label>
                            <input type="email" class="form-control" id="courriel" name="courriel" value="<?php echo $user->getCourriel(); ?>">
                        </div>
                        <div class="form-group">
                            <label for="nationalite" class="control-label">Nationalité :</label>
                            <select class="form-control" id="nationalite" name="nationalite">
                                <?php
                                    if(strcmp($user->getNationalite(), "France") == 0)
                                    {
                                        echo '<option selected="selected">France</option>';
                                    }
                                    else
                                    {
                                        echo '<option>France</option>';
                                    }
                                    if(strcmp($user->getNationalite(), "Allemagne") == 0)
                                    {
                                        echo '<option selected="selected">Allemagne</option>';
                                    }
                                    else
                                    {
                                        echo '<option>Allemagne</option>';
                                    }
                                    if(strcmp($user->getNationalite(), "Slovaquie") == 0)
                                    {
                                        echo '<option selected="selected">Slovaquie</option>';
                                    }
                                    else
                                    {
                                        echo '<option>Slovaquie</option>';
                                    }
                                    if(strcmp($user->getNationalite(), "République Tcheque") == 0)
                                    {
                                        echo '<option selected="selected">République Tcheque</option>';
                                    }
                                    else
                                    {
                                        echo '<option>République Tcheque</option>';
                                    }
                                    if(strcmp($user->getNationalite(), "Royaume Uni") == 0)
                                    {
                                        echo '<option selected="selected">Royaume Uni</option>';
                                    }
                                    else
                                    {
                                        echo '<option>Royaume Uni</option>';
                                    }
                                    if(strcmp($user->getNationalite(), "Pologne") == 0)
                                    {
                                        echo '<option selected="selected">Pologne</option>';
                                    }
                                    else
                                    {
                                        echo '<option>Pologne</option>';
                                    }
                                    if(strcmp($user->getNationalite(), "Hongrie") == 0)
                                    {
                                        echo '<option selected="selected">Hongrie</option>';
                                    }
                                    else
                                    {
                                        echo '<option>Hongrie</option>';
                                    }
                                    if(strcmp($user->getNationalite(), "Autriche") == 0)
                                    {
                                        echo '<option selected="selected">Autriche</option>';
                                    }
                                    else
                                    {
                                        echo '<option>Autriche</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="groupe" class="control-label">Groupe :</label>
                            <select class="form-control" id="groupe" name="groupe">
                                <?php
                                    if($user->getGroupe() == 'U')
                                    {
                                        echo '<option selected="selected">Utilisateur standard</option>';
                                    }
                                    else
                                    {
                                        echo '<option>Utilisateur standard</option>';
                                    }
                                    if($user->getGroupe() == 'A')
                                    {
                                        echo '<option selected="selected">Administrateur</option>';
                                    }
                                    else
                                    {
                                        echo '<option>Administrateur</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="datedenaissance" class="control-label">Date de naissance :</label>
                            <input type="text" class="form-control" id="datedenaissance" name="datedenaissance" value="<?php echo $user->getDatenaissance(); ?>">
                        </div>
                        <div class="form-group">
                            <label for="identifiant" class="control-label">Identifiant :</label>
                            <input type="text" class="form-control" id="identifiant" name="identifiant" value="<?php echo $user->getIdentifiant(); ?>">
                        </div>
                        <div class="form-group">
                            <label for="motdepasse" class="control-label">Mot de passe :</label>
                            <input type="password" class="form-control" id="motdepasse" name="motdepasse">
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <button type="submit" id="modifier" class="btn btn-success">Sauvegarder</button>
                            </div>
                            <div class="col-lg-6 text-right">
                                <a href="<?php echo HOME.'/user/manage'; ?>" class="btn btn-warning">Abandon</a>
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
            if($("#nom").val().length == 0 || $("#prenom").val().length == 0 || $("#courriel").val().length == 0 || $("#nationalite").val().length == 0 || $("#datedenaissance").val().length == 0 || $("#identifiant").val().length == 0 || $("#motdepasse").val().length == 0) {
                $("#avertissement").html('<div class="alert alert-warning">Veuillez saisir tout les informations demandées!</div>').show().delay(1000).hide(500);
            }
            else {
                $(this).unbind("click");
            }
        });
    });
    $('#datedenaissance').datepicker({
        dateFormat: 'dd.mm.y'
    });

</script>