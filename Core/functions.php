<?php

function dd($var, $die = true)
{
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
    if ($die)
        die();
}

function base_path($path)
{
    $path = str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $path);
    return BASE_PATH . $path;
}

function view($view, $messages = [])
{
    extract($messages);
    require BASE_PATH . 'view' . DIRECTORY_SEPARATOR . $view;
}

function viewWithUser($view, $currentUser)
{
    require BASE_PATH . 'view' . DIRECTORY_SEPARATOR . $view;
}


function login($userId)
{

    $_SESSION['user'] = $userId;
    session_regenerate_id(true);

}

function logout($userId)
{

    $_SESSION = [];
    session_destroy();

    $params = session_get_cookie_params();
    setcookie(
        'PHPSESSID',
        '',
        time() - 3600,
        $params['path'],
        $params['domain'],
        $params['secure'],
        $params['httponly']
    );
}