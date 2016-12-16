<?php

require_once dirname(__DIR__).'/models/Category.php';

class Controller_Category
{
    public function generateMenu()
    {
        $categories = Category::getAllCategories();
        include dirname(__DIR__).'/views/menu.php';
    }

    public function manage()
    {
        if(isadmin())
        {
            $categories = Category::getAllCategories();
            include dirname(__DIR__).'/views/admin/mancat.php';
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
            if($_SERVER['REQUEST_METHOD'] == 'POST')
            {
                if(areset(array('titre', 'description')))
                {
                    Category::createCategory(array('titre' => $_POST['titre'], 'description' => $_POST['description']));
                    header('Location: '.HOME.'/category/manage');
                    exit();
                }
                else
                {
                    http_response_code(400);

                    include dirname(__DIR__).'/views/error/bad_request_400.php';
                }
            }
        }
        else
        {
            http_response_code(403);

            include dirname(__DIR__).'/views/error/forbidden_403.php';
        }
    }

    public function edit($id_cat)
    {
        if(isadmin())
        {
            $server_method = $_SERVER['REQUEST_METHOD'];
            if($server_method == 'GET')
            {
                $category = Category::getCategoryById($id_cat);
                include dirname(__DIR__).'/views/admin/editcat.php';
            }
            else if($server_method == 'POST')
            {
                if(areset(array('titre', 'description')))
                {
                    $category = Category::getCategoryById($id_cat);
                    $category->setTitre($_POST['titre']);
                    $category->setDescription($_POST['description']);
                    $category->updateCatgeory();

                    header('Location: '.HOME.'/category/manage');
                    exit();
                }
                else
                {
                    http_response_code(400);

                    include dirname(__DIR__).'/views/error/bad_request_400.php';
                }
            }
        }
        else
        {
            http_response_code(403);

            include dirname(__DIR__).'/views/error/forbidden_403.php';
        }
    }

    public function del($id_cat)
    {
        if(isadmin())
        {
            $server_method = $_SERVER['REQUEST_METHOD'];
            if($server_method == 'GET')
            {
                $category = Category::getCategoryById($id_cat);
                include dirname(__DIR__).'/views/admin/remcat.php';
            }
            else if($server_method == 'POST')
            {
                $category = Category::getCategoryById($id_cat);
                $category->deleteCatgeory();

                header('Location: '.HOME.'/category/manage');
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