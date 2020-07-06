<?php
require_once 'post.php';

try
{
    //$location = 'http://localhost/srmenu/rest.php';
    $location = 'https://srmenu.com.br/web-app/rest.php';
    $parameters = array();
    $parameters['class'] = 'TipoMenuService';
    $parameters['method'] = 'getTipoMenuList';
    $parameters['fornecedor_id'] = $_GET['fornecedor_id'];

    var_dump(post($location, $parameters));
}
catch (Exception $e)    
{
    echo 'Error: '. $e->getMessage();
}
