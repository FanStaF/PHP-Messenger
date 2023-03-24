<?php

// Debugging "Dump & Die"
function dd($var, $die = true)
{
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
    if ($die)
        die();
}

// Returns projcet base path and sets proper directory separator
function base_path($path)
{
    $path = str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $path);
    return BASE_PATH . $path;
}

// Requires view and extracts any errors
function view($view, $errors = [])
{
    extract($errors);
    require BASE_PATH . 'view' . DIRECTORY_SEPARATOR . $view;
}

// Requires view and passes on User object
function viewWithUser($view, $currentUser)
{
     require BASE_PATH . 'view' . DIRECTORY_SEPARATOR . $view;
}

// Create new session for validated user
function login($userID)
{
    $_SESSION['user'] = $userID;
    session_regenerate_id(true);
}

// End user session and set cookie to be deleted
function logout($userID)
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