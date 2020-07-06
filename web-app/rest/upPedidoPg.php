<?php
require_once 'post.php';
date_default_timezone_set('America/Sao_Paulo');
try
{
    //$location = 'http://localhost/srmenu/rest.php';
    $location = 'https://srmenu.com.br/web-app/rest.php';

    $parameters = array();
    $parameters['class'] = 'PedidoService';
    $parameters['method'] = 'store';
    $parameters['data'] = [ 'id'                =>  $_GET['mesa_pedido_id'],
                            'status'            => 'Pago'];

    post($location, $parameters);
}
catch (Exception $e)
{
    echo 'Error: '. $e->getMessage();
}
