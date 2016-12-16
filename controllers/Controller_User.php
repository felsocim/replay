<?php

require_once dirname(__DIR__).'/models/User.php';

class Controller_User
{
    public function login()
    {
        if(isauthenticated())
        {
            header('Location: '.HOME);
            exit();
        }

        $server_method = $_SERVER['REQUEST_METHOD'];

        if($server_method == 'POST')
        {
            if(areset(array('identifiant', 'motdepasse')))
            {
                $user = User::getUserByNickName($_POST['identifiant']);

                if($user == null)
                {
                    raise_application_error('L\'utilisateur <strong>'.$_POST['identifiant'].'</strong> n\'existe pas!');
                    perror();
                    include dirname(__DIR__).'/views/login.php';
                }
                else if(password_verify($_POST['motdepasse'], $user->getMotdepasse()))
                {
                    $_SESSION['user_fullname'] = $user->getPrenom().' '.$user->getNom();
                    $_SESSION['user_id'] = $user->getIdutilisateur();
                    $_SESSION['user_group'] = $user->getGroupe();
                    $_SESSION['authenticated'] = true;
                    $user->updateLastConnectionDate();

                    header('Location: '.HOME.'/video/home/'.$user->getIdutilisateur());
                    exit();
                }
                else
                {
                    raise_application_error('Le mot de passe que vous avez saisi ne correspond pas!');
                    perror();
                    include dirname(__DIR__).'/views/login.php';
                }
            }
            else
            {
                http_response_code(400);

                include dirname(__DIR__).'/views/error/bad_request_400.php';
            }
        }
        if($server_method == 'GET')
        {
            include dirname(__DIR__).'/views/login.php';
        }
    }

    public function logout()
    {
        if(isauthenticated())
        {
            unset($_SESSION['user_fullname']);
            unset($_SESSION['user_id']);
            unset($_SESSION['user_group']);
            unset($_SESSION['authenticated']);
        }

        header('Location: '.HOME);
        exit();
    }

    public function signup()
    {
        $server_method = $_SERVER['REQUEST_METHOD'];

        if($server_method == 'POST')
        {
            if(areset(array('prenom', 'nom', 'courriel', 'nationalite', 'datedenaissance', 'identifiant', 'motdepasse')))
            {
                $data_array = array('prenom' => $_POST['prenom'], 'nom' => $_POST['nom'], 'groupe' => 'U', 'courriel' => $_POST['courriel'], 'nationalite' => $_POST['nationalite'], 'datenaissance' => $_POST['datedenaissance'], 'identifiant' => $_POST['identifiant'], 'motdepasse' => password_hash($_POST['motdepasse'], PASSWORD_DEFAULT));
                User::createUser($data_array);

                header('Location: '.USER_LOGIN);
                exit();
            }
            else
            {
                http_response_code(400);

                include dirname(__DIR__).'/views/error/bad_request_400.php';
            }
        }

        if($server_method == 'GET')
        {
            include dirname(__DIR__).'/views/signup.php';
        }
    }

    public function manage()
    {
        if(isadmin())
        {
            $users = User::getAllUsers();
            include dirname(__DIR__).'/views/admin/manusr.php';
        }
        else
        {
            http_response_code(403);

            include dirname(__DIR__).'/views/error/forbidden_403.php';
        }
    }

    public function add()
    {
        if(isadmin())
        {
            $server_method = $_SERVER['REQUEST_METHOD'];
            if($server_method == 'POST')
            {
                if(areset(array('nom', 'prenom', 'courriel', 'nationalite', 'datedenaissance', 'identifiant', 'motdepasse', 'groupe')))
                {
                    if(strcmp($_POST['groupe'], "Administrateur") == 0)
                    {
                        $groupe = 'A';
                    }
                    else
                    {
                        $groupe = 'U';
                    }

                    User::createUser(array('prenom' => $_POST['prenom'], 'nom' => $_POST['nom'], 'courriel' => $_POST['courriel'], 'nationalite' => $_POST['nationalite'], 'datenaissance' => $_POST['datedenaissance'], 'groupe' => $groupe, 'identifiant' => $_POST['identifiant'], 'motdepasse' => password_hash($_POST['motdepasse'], PASSWORD_DEFAULT)));
                    header('Location: '.HOME.'/user/manage');
                    exit();
                }
                else
                {
                    http_response_code(400);

                    include dirname(__DIR__).'/views/error/bad_request_400.php';
                }
            }
            else if($server_method == 'GET')
            {
                include dirname(__DIR__).'/views/admin/addusr.php';
            }
        }
        else
        {
            http_response_code(403);

            include dirname(__DIR__).'/views/error/forbidden_403.php';
        }
    }

    public function edit($id_user)
    {
        if(isadmin())
        {
            $server_method = $_SERVER['REQUEST_METHOD'];
            if($server_method == 'POST')
            {
                if(areset(array('nom', 'prenom', 'courriel', 'nationalite', 'datedenaissance', 'identifiant', 'motdepasse', 'groupe')))
                {
                    if(strcmp($_POST['groupe'], "Administrateur") == 0)
                    {
                        $groupe = 'A';
                    }
                    else
                    {
                        $groupe = 'U';
                    }

                    $user = User::getUserById($id_user);
                    $user->setNom($_POST['nom']);
                    $user->setPrenom($_POST['prenom']);
                    $user->setCourriel($_POST['courriel']);
                    $user->setNationalite($_POST['nationalite']);
                    $user->setDatenaissance($_POST['datedenaissance']);
                    $user->setGroupe($groupe);
                    $user->setIdentifiant($_POST['identifiant']);
                    $user->setMotdepasse(password_hash($_POST['motdepasse'], PASSWORD_DEFAULT));

                    $user->updateUser();

                    header('Location: '.HOME.'/user/manage');
                    exit();
                }
                else
                {
                    http_response_code(400);

                    include dirname(__DIR__).'/views/error/bad_request_400.php';
                }
            }
            else if($server_method == 'GET')
            {
                $user = User::getUserById($id_user);
                include dirname(__DIR__).'/views/admin/editusr.php';
            }
        }
        else
        {
            http_response_code(403);

            include dirname(__DIR__).'/views/error/forbidden_403.php';
        }
    }

    public function del($id_user)
    {
        if(isadmin())
        {
            $server_method = $_SERVER['REQUEST_METHOD'];
            if($server_method == 'POST')
            {
                $user = User::getUserById($id_user);
                $user->deleteUser();
                header('Location: '.HOME.'/user/manage');
                exit();
            }
            else if($server_method == 'GET')
            {
                $user = User::getUserById($id_user);
                include dirname(__DIR__).'/views/admin/remusr.php';
            }
        }
        else
        {
            http_response_code(403);

            include dirname(__DIR__).'/views/error/forbidden_403.php';
        }
    }

    public function profile($id_user)
    {
        if(isauthenticated())
        {
            $user = User::getUserById($id_user);
            include dirname(__DIR__).'/views/useraccount.php';
        }
        else
        {
            http_response_code(403);

            include dirname(__DIR__).'/views/error/forbidden_403.php';
        }
    }

    public function subscribe($id_user)
    {
        if(isauthenticated())
        {
            if($_SERVER['REQUEST_METHOD'] == 'POST')
            {
                $user = User::getUserById($id_user);
                $user->setAbonnementnewsletter('Y');
                $user->updateNewsletter();

                header('Location: '.HOME.'/user/profile/'.$id_user);
                exit();
            }
        }
        else
        {
            http_response_code(403);

            include dirname(__DIR__).'/views/error/forbidden_403.php';
        }
    }

    public function unsubscribe($id_user)
    {
        if(isauthenticated())
        {
            if($_SERVER['REQUEST_METHOD'] == 'POST')
            {
                $user = User::getUserById($id_user);
                $user->setAbonnementnewsletter('N');
                $user->updateNewsletter();

                header('Location: '.HOME.'/user/profile/'.$id_user);
                exit();
            }
        }
        else
        {
            http_response_code(403);

            include dirname(__DIR__).'/views/error/forbidden_403.php';
        }
    }
}