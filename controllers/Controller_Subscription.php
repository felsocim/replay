<?php

require_once dirname(__DIR__).'/models/Subscription.php';

class Controller_Subscription
{
    public function remove($id_emission, $id_user)
    {
        if(isauthenticated())
        {
            $entry = Subscription::getSubscriptionEntry($id_emission, $id_user);
            $entry->removeSubscriptionEntry();
            header("Location: ".HOME.'/programme/mysubscriptions/'.$id_user);
        }
        else
        {
            http_response_code(403);

            include dirname(__DIR__).'/views/error/forbidden_403.php';
        }
    }
}