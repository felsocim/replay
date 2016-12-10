<?php

require_once dirname(__DIR__).'/models/Category.php';

class Controller_Category
{
    public function generateMenu()
    {
        $categories = Category::getAllCategories();
        include dirname(__DIR__).'/views/menu.php';
    }
}