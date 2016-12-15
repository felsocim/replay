<?php

require_once dirname(__DIR__).'/models/Programme.php';

class Controller_Programme
{
    public function mysubscriptions($id_user)
    {
        $emissions = Programme::getSubscriptionsByUserId($id_user);
        $unsubscribtionAuthorized = 1;
        include dirname(__DIR__).'/views/programme/list.php';
    }
}