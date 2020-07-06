<?php
require_once 'post.php';

try
{
    //$location = 'http://localhost/srmenu/rest.php';
    $location = 'https://srmenu.com.br/web-app/rest.php';
    $parameters = array();
    $parameters['class'] = 'PedidoItemService';
    $parameters['method'] = 'additempedido';
    $parameters['data'] = [ 'pedido_id'         => $_GET['pedido_id'],
                            'produto_id'        => $_GET['produto_id'],
                            'quantidade'        => $_GET['quantidade'],
                            'status'            => "Enviado",
                            'valor'             => $_GET['valor']];

    var_dump(post($location, $parameters));
}
catch (Exception $e)
{
    echo 'Error: '. $e->getMessage();
}
