<?php



function dump($data)
{
    echo "<pre>";

        var_dump($data);

    echo "</pre>";
}

function print_arr($data)
{
    echo "<pre>";

        print_r($data);

    echo "</pre>";
}

function dd($data)
{
    dump($data);
    die;
}

function abort($code = 404, $title ='404 - Not found')
{
    http_response_code($code);
    require VIEWS . "/errors/{$code}.tpl.php";
    die;
}

function load($fillable =[])   //функция чтобы нам не приходили лишние заполненные поля, только те которые мы создали 
{
    $data = [];

    foreach ($_POST as $k=> $v){         //пробегаемся по массиву берем ключ и значение
        if (in_array($k,$fillable)){     //есть ли такой ключик в массиве филлэбл
            $data[$k] = trim($v);
        }
    }
    return $data;
}

function old($fieldname)
{
    return isset($_POST[$fieldname])? h($_POST[$fieldname]):'';
}

function h($str)
{
    return htmlspecialchars($str,ENT_QUOTES);
}


function redirect($url = '')
{
    if($url){
        $redirect = $url;
    } else {
        $redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : PATH;
    }

    header("Location: {$redirect}");
    die;
}

function get_alerts()
{
    if (!empty($_SESSION['success'])){
        require_once VIEWS . '/incs/alert_success.php';
        unset($_SESSION['success']);
    }
    if (!empty($_SESSION['error'])){
        require_once VIEWS . '/incs/alert_error.php';
        unset($_SESSION['error']);
    }
}

function db(): \myfrm\Db
{
    return \myfrm\App::get('\myfrm\Db');
}