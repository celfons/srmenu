<?php
require_once 'post.php';

try
{
    $location = 'https://srmenu.com.br/web-app/rest.php';
    $parameters = array();
    $parameters['class'] = 'PedidoService';
    $parameters['method'] = 'load';
    $parameters['id'] = '4';
    var_dump(post($location, $parameters));
}
catch (Exception $e)
{
    echo 'Error: '. $e->getMessage();
}
