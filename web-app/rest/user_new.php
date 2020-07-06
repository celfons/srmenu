<?php
require_once 'post.php';

try
{

    //$location = 'http://localhost/srmenu/rest.php';
    $location = 'https://srmenu.com.br/web-app/rest.php';
    $parameters = array();
    $parameters['class'] = 'UserService';
    $parameters['method'] = 'storeUser';
    $parameters['data'] = [ 'name'          => $_GET['nameEntry'],
                            'login'         => $_GET['foneEntry'],
                            'password'      => md5($_GET['senhaEntry']),
                            'email'         => $_GET['emailEntry'],
                            'frontpage_id'  => null,
                            'system_unit_id'  => null,
                            'active'        => 'Y',
                            'user_master'        => null,
                            'useridade'         => $_GET['idadeEntry'],
                            'cpf'         => null];


    post($location, $parameters);
}
catch (Exception $e)
{
    echo 'Error: '. $e->getMessage();
}
