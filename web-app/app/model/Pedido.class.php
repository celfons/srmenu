<?php

class Pedido extends TRecord
{
    const TABLENAME  = 'pedido';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'max'; // {max, serial}
    
    use SystemChangeLogTrait;
    
    
    private $estado_pedido;
    private $cliente;
    private $mesa;
    
    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('cliente_id');
        parent::addAttribute('empresa_id');
        parent::addAttribute('mesa_pedido_id');
        parent::addAttribute('estado_pedido_id');
        parent::addAttribute('dt_pedido');
        parent::addAttribute('hora_pedido');
        parent::addAttribute('hora');
        parent::addAttribute('valor_total');
        parent::addAttribute('obs');
        parent::addAttribute('status');
        parent::addAttribute('dezporcento');

    }

    /**
     * Method set_estado_pedido
     * Sample of usage: $var->estado_pedido = $object;
     * @param $object Instance of EstadoPedido
     */
    public function set_estado_pedido(EstadoPedido $object)
    {
        $this->estado_pedido = $object;
        $this->estado_pedido_id = $object->id;
    }
    
    /**
     * Method get_estado_pedido
     * Sample of usage: $var->estado_pedido->attribute;
     * @returns EstadoPedido instance
     */
    public function get_estado_pedido()
    {
        
        // loads the associated object
        if (empty($this->estado_pedido))
            $this->estado_pedido = new EstadoPedido($this->estado_pedido_id);
        
        // returns the associated object
        return $this->estado_pedido;
    }

    public function set_mesa_pedido(MesaPedido $object)
    {
        $this->mesa_pedido = $object;
        $this->mesa_pedido_id = $object->id;
    }

    /**
     * Method get_estado_pedido
     * Sample of usage: $var->estado_pedido->attribute;
     * @returns EstadoPedido instance
     */
    public function get_mesa_pedido()
    {

        // loads the associated object
        if (empty($this->mesa_pedido))
            $this->mesa_pedido = new MesaPedido($this->mesa_pedido_id);

        // returns the associated object
        return $this->mesa_pedido;
    }
    
    /**
     * Method set_pessoa
     * Sample of usage: $var->pessoa = $object;
     * @param $object Instance of Pessoa
     */
    public function set_cliente(SystemUser $object)
    {
        $this->cliente = $object;
        $this->cliente_id = $object->id;
    }
    
    /**
     * Method get_cliente
     * Sample of usage: $var->cliente->attribute;
     * @returns Pessoa instance
     */
    public function get_cliente()
    {
        
        // loads the associated object
        if (empty($this->cliente))
            $this->cliente = new SystemUser($this->cliente_id);
        
        // returns the associated object
        return $this->cliente;
    }

    /**
 * Method set_pessoa
 * Sample of usage: $var->pessoa = $object;
 * @param $object Instance of Pessoa
 */
    public function set_empresa(SystemUnit $object)
    {
        $this->empresa = $object;
        $this->empresa_id = $object->id;
    }

    /**
     * Method get_cliente
     * Sample of usage: $var->cliente->attribute;
     * @returns Pessoa instance
     */
    public function get_empresa()
    {

        // loads the associated object
        if (empty($this->empresa))
            $this->empresa = new SystemUnit($this->empresa_id);

        // returns the associated object
        return $this->empresa;
    }

    public function get_mesa()
    {

        // loads the associated object
        if (empty($this->mesa))
            $this->mesa = new MesaPedido($this->mesa_pedido_id);

        // returns the associated object
        return $this->mesa;
    }

    
    /**
     * Pedidos por mês
     */
    public static function getPedidosMes($ano, $userunitid)
    {
        $conn = TTransaction::get();
        $result = $conn->query("SELECT date_format(dt_pedido, '%m'), 
                                      sum(valor_total) 
                                      FROM pedido WHERE date_format(dt_pedido, '%y') = '$ano' 
                                                    AND empresa_id = '$userunitid'
                                      GROUP BY 1 
                                      ORDER BY 1");
        
        $data = [];
        if ($result)
        {
            foreach ($result as $row)
            {
                $mes   = $row[0];
                $valor = $row[1];
                
                $data[ $mes ] = $valor;
            }
        }
        
        return $data;
    }
    
    /**
     * Pedidos por mês
     */
    public static function getPedidosEstado($ano, $userunitid)
    {
        $conn = TTransaction::get();
        $result = $conn->query("SELECT estado_pedido.nome,
                                       sum(valor_total)
                                  FROM pedido, estado_pedido
                                 WHERE pedido.estado_pedido_id = estado_pedido.id
                                       AND date_format(dt_pedido, '%y') = '$ano'
                                       AND empresa_id = '$userunitid' 
                                 GROUP BY 1
                                 ORDER BY 1");
        
        $data = [];
        if ($result)
        {
            foreach ($result as $row)
            {
                $estado = $row[0];
                $valor  = $row[1];
                
                $data[ $estado ] = $valor;
            }
        }
        
        return $data;
    }
    
    /**
     * Pedidos por pessoa
     */
    public static function getTotalPedidosPessoa($cliente_id, $ano)
    {
        $conn = TTransaction::get();
        $result = $conn->query("SELECT sum(valor_total)
                                  FROM pedido
                                 WHERE pedido.cliente_id = '$cliente_id'
                                       AND date_format(dt_pedido, '%Y') = '$ano'");
        
        $data = [];
        if ($result)
        {
            foreach ($result as $row)
            {
                return $row[0];
            }
        }
    }
    public static function get2TotalPedidosPessoa($cliente_id, $ano)
    {
        $conn = TTransaction::get();
        $result = $conn->query("SELECT sum(valor_total)
                                  FROM pedido
                                 WHERE pedido.cliente_id = '$cliente_id'
                                       AND date_format(dt_pedido, '%Y') = '$ano'");

        $data = [];
        if ($result)
        {
            foreach ($result as $row)
            {
                return $row[0];
            }
        }
    }
    
    public function delete($id = NULL)
    {
        $id = isset($id) ? $id : $this->id;
        parent::deleteComposite('PedidoItem', 'pedido_id', $id);
    
        // delete the object itself
        parent::delete($id);
    }
}
