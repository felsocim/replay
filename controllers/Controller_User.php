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
                    $_SESSION['user_id'] = $user->getId();
                    $_SESSION['user_group'] = $user->getGroupe();
                    $_SESSION['authenticated'] = true;

                    header('Location: '.HOME);
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
                $data_array = array('prenom' => $_POST['prenom'], 'nom' => $_POST['nom'], 'courriel' => $_POST['courriel'], 'nationalite' => $_POST['nationalite'], 'datedenaissance' => $_POST['datedenaissance'], 'identifiant' => $_POST['identifiant'], 'motdepasse' => password_hash($_POST['motdepasse'], PASSWORD_DEFAULT));
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
}