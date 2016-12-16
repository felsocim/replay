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

function isadmin()
{
    if(isauthenticated() && ($_SESSION['user_group'] == 'A' || $_SESSION['user_group'] == 'S'))
        return true;

    return false;
}

function issuperuser()
{
    if(isauthenticated() && $_SESSION['user_group'] == 'S')
        return true;

    return false;
}

function getAuthenticated()
{
    return $_SESSION['user_id'];
}

function group_verbose($grp)
{
    switch($grp)
    {
        case 'U':
            return 'Utilisateur standard';
        case 'A':
            return 'Administrateur';
        case 'S':
            return 'Superutilisateur';
        default:
            return 'Groupe inconnu';
    }
}

function newsletter_verbose($rep)
{
    switch($rep)
    {
        case 'N':
            return 'Non';
        case 'Y':
            return 'Oui';
        default:
            return 'Indisponible';
    }
}