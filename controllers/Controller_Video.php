<?php

require_once dirname(__DIR__).'/models/Video.php';
require_once dirname(__DIR__).'/models/Programme.php';
require_once dirname(__DIR__).'/models/History.php';

class Controller_Video
{
    public function all()
    {
        $videos = Video::getAllVideos();
        $historyRemovalAuthorized = 0;
        $favoritesRemovalAuthorized = 0;
        include dirname(__DIR__).'/views/video/list.php';
    }

    public function category($id_cat)
    {
        $videos = Video::getVideosByCategory($id_cat);
        $historyRemovalAuthorized = 0;
        $favoritesRemovalAuthorized = 0;
        include dirname(__DIR__).'/views/video/list.php';
    }

    public function view($id_video)
    {
        $video = Video::getVideoById($id_video);
        include dirname(__DIR__).'/views/video/oneandonly.php';
        $videos = Video::getAllEpisodesByVideo($id_video);
        $historyRemovalAuthorized = 0;
        $favoritesRemovalAuthorized = 0;
        include dirname(__DIR__).'/views/video/list.php';

        if(isauthenticated())
        {
            History::addHistoryEntry($id_video, getAuthenticated());
        }
    }

    public function myfavorites($id_user)
    {
        $videos = Video::getFavoritesByUser($id_user);
        $historyRemovalAuthorized = 0;
        $favoritesRemovalAuthorized = 1;
        include dirname(__DIR__).'/views/video/list.php';
    }

    public function myhistory($id_user)
    {
        $videos = Video::getHistoryByUser($id_user, USER_HISTORY_PAGE_LIMIT);
        $historyRemovalAuthorized = 1;
        $favoritesRemovalAuthorized = 0;
        include dirname(__DIR__).'/views/video/list.php';
    }

    public function favorite()
    {
        $server_method = $_SERVER['REQUEST_METHOD'];

        if($server_method == 'POST')
        {
            if(areset(array('videoid', 'userid')))
            {
                Video::setVideoFavorite($_POST['videoid'], $_POST['userid']);

                exit();
            }
            else
            {
                http_response_code(400);

                include dirname(__DIR__).'/views/error/bad_request_400.php';
            }
        }
    }

    public function subscribed()
    {
        $server_method = $_SERVER['REQUEST_METHOD'];

        if($server_method == 'POST')
        {
            if(areset(array('userid', 'emissionid')))
            {
                Programme::setProgrammeSubscribed($_POST['userid'], $_POST['emissionid']);

                exit();
            }
            else
            {
                http_response_code(400);

                include dirname(__DIR__).'/views/error/bad_request_400.php';
            }
        }
    }

    public function home($id_user)
    {
        $videos_subscriptions = Video::getRecentProgrammeEpisodesByUser($id_user, USER_HOME_VIEW_LIMIT);
        $videos_suggestions = Video::getSuggestionsByUser($id_user, USER_HOME_VIEW_LIMIT);
        include dirname(__DIR__).'/views/userhome.php';
    }
}