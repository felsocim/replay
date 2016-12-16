<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="text-center">Gestion d'utilisateurs</h1>
                    <p class="text-center">
                        Ici, vous pouvez créer de nouveaux utilisateurs ainsi que modifier ou supprimer les utilisateurs existants.
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="text-center">Ajouter un nouvel utilisateur</h3>
                    <p class="text-center">
                        <a href="<?php echo HOME.'/user/add'; ?>" class="btn btn-success">Ajouter un utilisateur</a>
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="text-center">Modifier ou supprimer un utilisateur</h3>
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
                                Identifiant
                            </th>
                            <th>
                                Nom
                            </th>
                            <th>
                                Prénom
                            </th>
                            <th>
                                Courriel
                            </th>
                            <th>
                                Dernière connexion
                            </th>
                            <th>
                                Groupe
                            </th>
                            <th>
                                Newsletter
                            </th>
                            <th>
                                Nationalité
                            </th>
                            <th colspan="3" class="text-center">
                                Actions
                            </th>

                        </tr>
                        <?php
                            if(!empty($users))
                            {
                                foreach ($users as $user)
                                {
                                    echo '<tr>';
                                    echo '<td>';
                                    echo $user->getIdutilisateur();
                                    echo '</td>';
                                    echo '<td>';
                                    echo $user->getIdentifiant();
                                    echo '</td>';
                                    echo '<td>';
                                    echo $user->getNom();
                                    echo '</td>';
                                    echo '<td>';
                                    echo $user->getPrenom();
                                    echo '</td>';
                                    echo '<td>';
                                    echo $user->getCourriel();
                                    echo '</td>';
                                    echo '<td>';
                                    echo $user->getDatederniereconnexion();
                                    echo '</td>';
                                    echo '<td>';
                                    echo group_verbose($user->getGroupe());
                                    echo '</td>';
                                    echo '<td>';
                                    echo newsletter_verbose($user->getAbonnementnewsletter());
                                    echo '</td>';
                                    echo '<td>';
                                    echo $user->getNationalite();
                                    echo '</td>';
                                    echo '<td>';

                                    if(!issuperuser() && $user->getGroupe() == 'S')
                                    {

                                    }
                                    else
                                    {
                                        echo '<a href="'.HOME.'/user/edit/'.$user->getIdutilisateur().'" class="btn btn-info">Modifier</a>';
                                    }

                                    echo '</td>';
                                    echo '<td>';

                                    if(!issuperuser() && $user->getGroupe() == 'S')
                                    {

                                    }
                                    else
                                    {
                                        echo '<a href="'.HOME.'/user/del/'.$user->getIdutilisateur().'" class="btn btn-danger" style"float: left;">Supprimer</a>';
                                    }

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