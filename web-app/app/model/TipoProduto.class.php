<?php

class TipoProduto extends TRecord
{
    const TABLENAME  = 'tipo_produto';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'max'; // {max, serial}
    
    
    
    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('nome');
        parent::addAttribute('idMenu');
        parent::addAttribute('empresa_id');
    }
}

