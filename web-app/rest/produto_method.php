<?php
require_once 'post.php';

try
{
    $location = 'http://localhost/srmenu/rest.php';
    $parameters = array();
    $parameters['class'] = 'ProdutoService';
    $parameters['method'] = 'getProdutoFornecedor';
    $parameters['fornecedor_id'] = $_GET['fornecedor_id'];

    var_dump(post($location, $parameters));
}
catch (Exception $e)    
{
    echo 'Error: '. $e->getMessage();
}
