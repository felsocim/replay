<?php

require_once dirname(__DIR__).'/models/Favorite.php';

class Controller_Favorite
{
    public function remove($id_video, $id_user)
    {
        if(isauthenticated())
        {
            $entry = Favorite::getFavoriteEntry($id_video, $id_user);
            $entry->removeFavoriteEntry();
            header("Location: ".HOME.'/video/myfavorites/'.$id_user);
        }
        else
        {
            http_response_code(403);

            include dirname(__DIR__).'/views/error/forbidden_403.php';
        }
    }
}