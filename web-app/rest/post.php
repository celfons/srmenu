<?php
function post($location, $parameters)
{
  //  if (!isset($_SERVER['PHP_AUTH_USER'])) {
  //      header('WWW-Authenticate: Basic realm="My Realm"');
  //      header('HTTP/1.0 401 Unauthorized');
  //      throw new Exception('Connection failed');
  //      exit;
  //  } else {
        //       echo "<p>Olá, {$_SERVER['PHP_AUTH_USER']}.</p>";
        //       echo "<p>Você digitou {$_SERVER['PHP_AUTH_PW']} como sua senha.</p>";

     //   if ($_SERVER['PHP_AUTH_USER'] == 'app' && $_SERVER['PHP_AUTH_PW'] == 'app' ) {

            $options = array('http' =>
                array(
                    'method' => 'POST',
                    'header' => 'Content-type: application/x-www-form-urlencoded',
                    'content' => http_build_query($parameters)
                )
            );

            $contexto = stream_context_create($options);
            $conteudo = file_get_contents($location, false, $contexto);

            if ($conteudo) {
                // decodifica retorno JSON
                $retorno = (array)json_decode($conteudo);

                // se retorno é íntegro
                if (json_last_error() == JSON_ERROR_NONE) {
                    // se ocorreu erro lógico no servidor
                    if ($retorno['status'] == 'error') {
                        throw new Exception($retorno['data']);
                    }
                }

                // retorna dados ok
                return $retorno['data'];
            } else {
                // se conexão falhou
                throw new Exception('Connection failed');
            }
    //    } else{
    //        throw new Exception('Connection failed');
     //   }

    //}
}
