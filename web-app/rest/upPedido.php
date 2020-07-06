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
                            'obs'               =>  $_GET['obs'],
                            'estado_pedido_id'  => 1,
                            'valor_total'       =>  $_GET['valor_total'],
                            'dt_pedido'         => date('Y-m-d'),
                            'hora_pedido'       => date('Y-m-d H:i:s'),
                            'hora'              => date('H:i:s'),
                            'status'            => 'Enviado'];

    post($location, $parameters);
}
catch (Exception $e)
{
    echo 'Error: '. $e->getMessage();
}
