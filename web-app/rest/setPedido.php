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
    $parameters['data'] = [ 'cliente_id'        => $_GET['cliente_id'],
                            'empresa_id'        => $_GET['empresa_id'],
                            'mesa_pedido_id'    => $_GET['mesa_pedido_id'],
                            'estado_pedido_id'  => 1,
                            'dt_pedido'         => date('Y-m-d'),
                            'hora_pedido'       => date('Y-m-d H:i:s'),
                            'hora'              => date('H:i:s'),
                            'valor_total'       => 0,
                            'obs'               => null,
                            'status'            => 'Inicial'];

    post($location, $parameters);
}
catch (Exception $e)
{
    echo 'Error: '. $e->getMessage();
}
