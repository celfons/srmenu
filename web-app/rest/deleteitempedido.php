<?php
require_once 'post.php';

try
{
    //$location = 'http://localhost/srmenu/rest.php';
    $location = 'https://srmenu.com.br/web-app/rest.php';
    $parameters = array();
    $parameters['class'] = 'PedidoItemService';
    $parameters['method'] = 'deleteitempedido';
    $parameters['id'] = $_GET['id'];
    $parameters['pedido_id'] = $_GET['pedido_id'];
    $parameters['produto_id'] = $_GET['produto_id'];
    $parameters['quantidade'] = $_GET['quantidade'];

    var_dump(post($location, $parameters));
}
catch (Exception $e)
{
    echo 'Error: '. $e->getMessage();
}
