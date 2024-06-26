<?php
// session_start();
require_once './config/global.php';

$request = $_SERVER['REQUEST_URI'];
$request = parse_url($request, PHP_URL_PATH);
$segments = explode('/', trim($request, '/'));
// echo "hola";


function home()
{
    http_response_code(404);
    require_once ROOT_DIR . '/views/home.php';
    exit;
}
function login()
{
    session_destroy();
    http_response_code(404);
    require ROOT_DIR . '/views/login/login.php';
    exit;
}
function error404()
{
    http_response_code(404);
    require_once ROOT_DIR . '/views/home.php';
    exit;
}
function verificarlogin()
{
    if (!isset($_SESSION['login']["cod_admin"])) {
        echo '<script>window.location.href ="' . HTTP_BASE . '/login/login"</script>';
        login();
    }
}

if ($segments[0] === 'crudAlimentos') {
    switch ($segments[1] ?? '') {
        case 'login':
            switch ($segments[2] ?? '') {
                case 'login':
                    require ROOT_DIR . '/views/login/login.php';
                    break;
                case 'logout':
                    session_destroy();
                    echo '<script>window.location.href ="' . HTTP_BASE . '/login/login"</script>';
                    break;
                case 'register':
                    require ROOT_DIR . '/views/login/register.php';
                    break;
                default:
                    error404();
                    break;
            }
            break;
        
            break;
        case 'admin':
            verificarlogin();
            switch ($segments[2] ?? '') {
                case 'login':
                    login();
                    break;
                case 'register':
                    break;
                case 'forgot':
                    break;
                case 'recovery':
                    break;
                case 'lock':
                    break;
                default:
                    break;
            }
            break;
        case 'crud':
            // verificarlogin();
            switch($segments[2] ?? ''){
                case 'crud_user':
                    switch($segments[3] ?? ''){
                        case 'create':
                            require_once ROOT_DIR . "/view/crud/crud_user/create.php";
                            break;
                        case 'list':
                            require_once ROOT_DIR . "/view/crud/crud_user/list.php";
                            break;
                    }
                    break;
            }
            break;
        case 'con':
            verificarlogin();
            break;
        default:
            verificarlogin();
            home();
            break;
    }
} else {
    error404();
}
