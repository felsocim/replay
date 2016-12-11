<?php

function areset($post_array)
{
    if(!is_array($post_array))
    {
        return false;
    }

    foreach ($post_array as $post)
    {
        if(!isset($_POST[$post]))
        {
            return false;
        }
    }

    return true;
}

function raise_application_error($error_message)
{
    $_SESSION['perror'] = '<div class="alert alert-danger" role="alert">'.$error_message.'</div>';
}

function perror()
{
    if(isset($_SESSION['perror']))
    {
        echo $_SESSION['perror'];
    }
}

function isauthenticated()
{
    if(isset($_SESSION['authenticated']) && $_SESSION['authenticated'])
        return true;

    return false;
}