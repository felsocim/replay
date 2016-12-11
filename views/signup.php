<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
            <div class="panel panel-success">
                <div class="panel-heading">Inscription</div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="<?php echo HOME.'/user/signup'; ?>">
                        <div class="form-group">
                            <label for="prenom" class="col-sm-2 control-label">Prénom :</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="prenom" name="prenom">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nom" class="col-sm-2 control-label">Nom :</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nom" name="nom">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="courriel" class="col-sm-2 control-label">Courriel :</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="courriel" name="courriel">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nationalite" class="col-sm-2 control-label">Nationalité :</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="nationalite" name="nationalite">
                                    <option>France</option>
                                    <option>Allemagne</option>
                                    <option>Slovaquie</option>
                                    <option>République Tcheque</option>
                                    <option>Royaume Uni</option>
                                    <option>Pologne</option>
                                    <option>Hongrie</option>
                                    <option>Autriche</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="datedenaissance" class="col-sm-2 control-label">Date de naissance :</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="datedenaissance" name="datedenaissance">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="identifiant" class="col-sm-2 control-label">Identifiant :</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="identifiant" name="identifiant">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="motdepasse" class="col-sm-2 control-label">Mot de passe :</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="motdepasse" name="motdepasse">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-default">S'authentifier</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#datedenaissance').datepicker({
        format: 'dd/mm/yyyy'
    })
</script>