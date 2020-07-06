<?php
require_once 'post.php';

try
{
    //$location = 'http://localhost/srmenu/rest.php';
    $location = 'https://srmenu.com.br/web-app/rest.php';
    $parameters = array();
    $parameters['class'] = 'PedidoService';
    $parameters['method'] = 'getPididoList';
    $parameters['cliente_id'] = $_GET['cliente_id'];
    $parameters['empresa_id'] = $_GET['empresa_id'];
    $parameters['mesa_pedido_id'] = $_GET['mesa_pedido_id'];
    var_dump(post($location, $parameters));
}
catch (Exception $e)    
{
    echo 'Error: '. $e->getMessage();
}
