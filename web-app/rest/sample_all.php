<?php
require_once 'post.php';
try
{
    $location = 'https://srmenu.com.br/web-app/rest.php';
    $parameters = array();
    $parameters['class']   = 'ProdutoService';
    $parameters['method']  = 'loadAll';

    var_dump(post($location, $parameters));
}
catch (Exception $e)
{
    echo 'Error: '. $e->getMessage();
}
