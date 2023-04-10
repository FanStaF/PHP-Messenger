<?php

/**
 * Dump and Die(or not)
 * @param mixed $var to be dumped to output.
 * @param bool $die set to falls to not die.
 * @return void
 */
function dd($var, $die = true)
{
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
    if ($die)
        die();
}

/**
 * Returns the base path for the project with correct directory separator for currnet OS.
 * @param string $path
 * @return string
 */
function base_path($path)
{
    $path = str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $path);
    return BASE_PATH . $path;
}

/**
 * Requires the passed view after extracting any errors.
 * @param mixed $view
 * @param mixed $errors
 * @return void
 */
function view($view, $errors = [])
{
    extract($errors);
    require BASE_PATH . 'view' . DIRECTORY_SEPARATOR . $view;
}

/**
 * Requires the passed view and provides acces to the passed User-object.
 * @param mixed $view
 * @param User $currentUser
 * @return void
 */
function viewWithUser($view, $currentUser)
{
     require BASE_PATH . 'view' . DIRECTORY_SEPARATOR . $view;
}

/**
 * Creates a new session for validated user
 * @param int $userID
 * @return void
 */
function login($userID)
{
    $_SESSION['user'] = $userID;
    session_regenerate_id(true);
}

/**
 * Terminate user session and set cockiee to be deleted
 * @param int $userID
 * @return void
 */
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