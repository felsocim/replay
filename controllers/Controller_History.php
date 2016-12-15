<?php

require_once dirname(__DIR__).'/models/History.php';

class Controller_History
{
    public function remove($id_video, $id_user)
    {
        $entry = History::getHistoryEntry($id_video, $id_user);
        $entry->removeHistoryEntry();
        header("Location: ".HOME.'/video/myhistory/'.$id_user);
    }
}