<?php
require_once 'post.php';
try
{
    $location = 'http://localhost/srmenu/rest.php';
    $parameters = array();
    $parameters['class']      = 'PedidoService';
    $parameters['method']     = 'getTotalPedidosPessoa';
    $parameters['cliente_id'] = $_GET['id'];
    $parameters['ano']        = '2018';
    
    var_dump(post($location, $parameters));
}
catch (Exception $e)
{
    echo 'Error: '. $e->getMessage();
}
