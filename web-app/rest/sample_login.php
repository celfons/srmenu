<?php
require_once 'post.php';

try
{
//    $location = 'https://srmenu.com.br/web-app/rest.php';
    $location = 'http://localhost/srmenu/web-app/rest.php';
    $parameters = array();
    $parameters['class']      = 'UserService';
    $parameters['method']     = 'getlogin';
    $parameters['login']      = $_GET['logind'];
    $parameters['password']   = $_GET['password'];
    
    var_dump(post($location, $parameters));
}
catch (Exception $e)
{
    echo 'Error: '. $e->getMessage();
}
