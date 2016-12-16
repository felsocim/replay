<?php

require_once dirname(__DIR__).'/models/Programme.php';
require_once dirname(__DIR__).'/models/Category.php';

class Controller_Programme
{
    public function mysubscriptions($id_user)
    {
        if(isauthenticated())
        {
            $emissions = Programme::getSubscriptionsByUserId($id_user);
            $unsubscribtionAuthorized = 1;
            include dirname(__DIR__).'/views/programme/list.php';
        }
        else
        {
            http_response_code(403);

            include dirname(__DIR__).'/views/error/forbidden_403.php';
        }
    }

    public function manage()
    {
        if(isadmin())
        {
            $emissions = Programme::getAllProgrammes();
            include dirname(__DIR__).'/views/admin/manprog.php';
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
                if(areset(array('categorie', 'titre', 'description', 'chaine')))
                {
                    $find_cat = Category::getCategoryByTitle($_POST['categorie']);
                    Programme::createProgramme(array('idcategorie' => $find_cat->getIdcategorie(), 'titre' => $_POST['titre'], 'description' => $_POST['description'], 'chaine' => $_POST['chaine']));
                    header('Location: '.HOME.'/programme/manage');
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
                $categories = Category::getAllCategories();
                include dirname(__DIR__).'/views/admin/addprog.php';
            }
        }
        else
        {
            http_response_code(403);

            include dirname(__DIR__).'/views/error/forbidden_403.php';
        }
    }

    public function edit($id_emission)
    {
        if(isadmin())
        {
            $server_method = $_SERVER['REQUEST_METHOD'];
            if($server_method == 'POST')
            {
                if(areset(array('categorie', 'titre', 'description', 'chaine')))
                {
                    $find_cat = Category::getCategoryByTitle($_POST['categorie']);
                    $emi = Programme::getProgrammeById($id_emission);
                    $emi->setIdcategorie($find_cat->getIdcategorie());
                    $emi->setTitre($_POST['titre']);
                    $emi->setDescription($_POST['description']);
                    $emi->setChaine($_POST['chaine']);
                    $emi->updateProgramme();
                    header('Location: '.HOME.'/programme/manage');
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
                $categories = Category::getAllCategories();
                $emission = Programme::getProgrammeById($id_emission);
                include dirname(__DIR__).'/views/admin/editprog.php';
            }
        }
        else
        {
            http_response_code(403);

            include dirname(__DIR__).'/views/error/forbidden_403.php';
        }
    }

    public function del($id_emission)
    {
        if(isadmin())
        {
            $server_method = $_SERVER['REQUEST_METHOD'];
            if($server_method == 'GET')
            {
                $emission = Programme::getProgrammeById($id_emission);
                include dirname(__DIR__).'/views/admin/remprog.php';
            }
            else if($server_method == 'POST')
            {
                $emission = Programme::getProgrammeById($id_emission);
                $emission->deleteProgramme();

                header('Location: '.HOME.'/programme/manage');
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