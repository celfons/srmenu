<?php
require_once 'post.php';

try
{
    $location = 'http://localhost/srmenu/rest.php';;
    $parameters = array();
    $parameters['class'] = 'PedidoService';
    $parameters['method'] = 'store';
    $parameters['data'] = [ 'cliente_id'        => $_GET['cliente_id'],
                            'empresa_id'        => $_GET['empresa_id'],
                            'mesa_pedido_id'    => $_GET['mesa_pedido_id'],
                            'estado_pedido_id'  => 1,
                            'dt_pedido'         => '2018-07-11',
                            'valor_total'       => 0,
                            'obs'               => null,
                            'status'            => 'Inicial'];

    post($location, $parameters);
}
catch (Exception $e)
{
    echo 'Error: '. $e->getMessage();
}
