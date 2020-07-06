<?php
require_once 'post.php';

try
{
    //$location = 'http://localhost/srmenu/rest.php';
    $location = 'https://srmenu.com.br/web-app/rest.php';
    $parameters = array();
    $parameters['class'] = 'MesaService';
    $parameters['method'] = 'getMesaList';
    $parameters['empresa_id'] = $_GET['empresa_id'];
    var_dump(post($location, $parameters));
}
catch (Exception $e)    
{
    echo 'Error: '. $e->getMessage();
}
