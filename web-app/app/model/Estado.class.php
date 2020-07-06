<?php

class Estado extends TRecord
{
    const TABLENAME  = 'estado';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'max'; // {max, serial}
    
    
    
    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('nome_estado');
        parent::addAttribute('uf_estado');
        parent::addAttribute('codigo_estado');
    }
}

