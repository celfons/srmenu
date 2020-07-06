<?php
 require_once 'post.php';


    $location = 'http://localhost/srmenu/rest.php';
    $parameters = array();
    $parameters['class'] = 'ProdutoService';
    $parameters['method'] = 'getBetween';
    $parameters['from'] = '1';
    $parameters['to'] = '2';

var_dump(post($location, $parameters));

    //$url = $location . '?' . http_build_query($parameters);

    //var_dump( json_decode( file_get_contents($url) ) );
?>
