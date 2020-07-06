<?php
require_once 'post.php';

try
{
    //$location = 'http://localhost/srmenu/rest.php';
    $location = 'https://srmenu.com.br/web-app/rest.php';
    $parameters = array();
    $parameters['class'] = 'ProdutoService';
    $parameters['method'] = 'getProdutoList';
    $parameters['fornecedor_id'] = $_GET['fornecedor_id'];
    $parameters['tipo_produto_id'] = $_GET['tipo_produto_id'];


    var_dump(post($location, $parameters));
}
catch (Exception $e)    
{
    echo 'Error: '. $e->getMessage();
}
