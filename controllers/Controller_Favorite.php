<?php

require_once dirname(__DIR__).'/models/Favorite.php';

class Controller_Favorite
{
    public function remove($id_video, $id_user)
    {
        $entry = Favorite::getFavoriteEntry($id_video, $id_user);
        $entry->removeFavoriteEntry();
        header("Location: ".HOME.'/video/myfavorites/'.$id_user);
    }
}