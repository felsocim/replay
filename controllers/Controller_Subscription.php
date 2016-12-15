<?php

require_once dirname(__DIR__).'/models/Subscription.php';

class Controller_Subscription
{
    public function remove($id_emission, $id_user)
    {
        $entry = Subscription::getSubscriptionEntry($id_emission, $id_user);
        $entry->removeSubscriptionEntry();
        header("Location: ".HOME.'/programme/mysubscriptions/'.$id_user);
    }
}