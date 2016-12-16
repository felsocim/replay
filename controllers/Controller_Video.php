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
        if(isauthenticated())
        {
            $videos = Video::getFavoritesByUser($id_user);
            $historyRemovalAuthorized = 0;
            $favoritesRemovalAuthorized = 1;
            include dirname(__DIR__).'/views/video/list.php';
        }
        else
        {
            http_response_code(403);

            include dirname(__DIR__).'/views/error/forbidden_403.php';
        }
    }

    public function myhistory($id_user)
    {
        if(isauthenticated())
        {
            $videos = Video::getHistoryByUser($id_user, USER_HISTORY_PAGE_LIMIT);
            $historyRemovalAuthorized = 1;
            $favoritesRemovalAuthorized = 0;
            include dirname(__DIR__).'/views/video/list.php';
        }
        else
        {
            http_response_code(403);

            include dirname(__DIR__).'/views/error/forbidden_403.php';
        }
    }

    public function favorite()
    {
        if(isauthenticated())
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
        else
        {
            http_response_code(403);

            include dirname(__DIR__).'/views/error/forbidden_403.php';
        }
    }

    public function subscribed()
    {
        if(isauthenticated())
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
        else
        {
            http_response_code(403);

            include dirname(__DIR__).'/views/error/forbidden_403.php';
        }
    }

    public function home($id_user)
    {
        if(isauthenticated())
        {
            $videos_subscriptions = Video::getRecentProgrammeEpisodesByUser($id_user, USER_HOME_VIEW_LIMIT);
            $videos_suggestions = Video::getSuggestionsByUser($id_user, USER_HOME_VIEW_LIMIT);
            include dirname(__DIR__).'/views/userhome.php';
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
            $videos = Video::getAllVideos();
            include dirname(__DIR__).'/views/admin/manvid.php';
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
                if(areset(array('emission', 'titre', 'description', 'duree', 'datepremiere', 'origine', 'datevalidite', 'embed')))
                {
                    $find_emi = Programme::getProgrammeByTitle($_POST['emission']);
                    Video::createVideo(array('idemission' => $find_emi->getIdemission(), 'titre' => $_POST['titre'], 'description' => $_POST['description'], 'duree' => $_POST['duree'], 'datepremiere' => $_POST['datepremiere'], 'origine' => $_POST['origine'], 'datevalidite' => $_POST['datevalidite'], 'embed' => $_POST['embed']));

                    header('Location: '.HOME.'/video/manage');
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
                $emissions = Programme::getAllProgrammes();
                include dirname(__DIR__).'/views/admin/addvid.php';
            }
        }
        else
        {
            http_response_code(403);

            include dirname(__DIR__).'/views/error/forbidden_403.php';
        }
    }

    public function newbroadcasting($id_video)
    {
        if(isadmin())
        {
            $server_method = $_SERVER['REQUEST_METHOD'];
            if($server_method == 'POST')
            {
                if(areset(array('datediffusion')))
                {
                    $video = Video::getVideoById($id_video);
                    $video->addBroadcasting($_POST['datediffusion']);
                    header('Location: '.HOME.'/video/manage');
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
                $video = Video::getVideoById($id_video);
                include dirname(__DIR__).'/views/admin/addbroad.php';
            }
        }
        else
        {
            http_response_code(403);

            include dirname(__DIR__).'/views/error/forbidden_403.php';
        }
    }

    public function edit($id_video)
    {
        if(isadmin())
        {
            $server_method = $_SERVER['REQUEST_METHOD'];
            if($server_method == 'POST')
            {
                if(areset(array('emission', 'titre', 'description', 'duree', 'datepremiere', 'origine', 'datevalidite', 'embed')))
                {
                    $find_emi = Programme::getProgrammeByTitle($_POST['emission']);
                    $video = Video::getVideoById($id_video);
                    $video->setIdemission($find_emi->getIdemission());
                    $video->setTitre($_POST['titre']);
                    $video->setDescription($_POST['description']);
                    $video->setDuree($_POST['duree']);
                    $video->setDatepremiere($_POST['datepremiere']);
                    $video->setOrigine($_POST['origine']);
                    $video->setDatevalidite($_POST['datevalidite']);
                    $video->setEmbed($_POST['embed']);

                    $video->updateVideo();

                    header('Location: '.HOME.'/video/manage');
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
                $emissions = Programme::getAllProgrammes();
                $video = Video::getVideoById($id_video);
                include dirname(__DIR__).'/views/admin/editvid.php';
            }
        }
        else
        {
            http_response_code(403);

            include dirname(__DIR__).'/views/error/forbidden_403.php';
        }
    }

    public function del($id_video)
    {
        if(isadmin())
        {
            $server_method = $_SERVER['REQUEST_METHOD'];
            if($server_method == 'POST')
            {
                $video = Video::getVideoById($id_video);
                $video->deleteVideo();

                header('Location: '.HOME.'/video/manage');
                exit();
            }
            else if($server_method == 'GET')
            {
                $video = Video::getVideoById($id_video);
                include dirname(__DIR__).'/views/admin/remvid.php';
            }
        }
        else
        {
            http_response_code(403);

            include dirname(__DIR__).'/views/error/forbidden_403.php';
        }
    }
}