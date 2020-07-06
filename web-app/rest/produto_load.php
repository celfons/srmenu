<?php
require_once 'post.php';

try
{
    $location = 'http://localhost/srmenu/rest.php';
    $parameters = array();
    $parameters['class'] = 'ProdutoService';
    $parameters['method'] = 'load';
    $parameters['id'] = $_GET['id'];
    var_dump(post($location, $parameters));
}
catch (Exception $e)
{
    echo 'Error: '. $e->getMessage();
}
