<?php

class MesaPedido extends TRecord
{
    const TABLENAME  = 'mesa_pedido';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'max'; // {max, serial}
    
    use SystemChangeLogTrait;
    
    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('empresa_id');
        parent::addAttribute('nome');
        parent::addAttribute('obs');
    }
    /**
     * Method get_empresa
     * Sample of usage: $var->cliente->attribute;
     * @returns SistemUnit instance
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
}

