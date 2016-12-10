<?php

require_once dirname(__DIR__).'/models/Video.php';

class Controller_Video
{
    public function all()
    {
        $videos = Video::getAllVideos();
        include dirname(__DIR__).'/views/video/list.php';
    }

    public function category($id_cat)
    {
        $videos = Video::getVideosByCategory($id_cat);
        include dirname(__DIR__).'/views/video/list.php';
    }
}