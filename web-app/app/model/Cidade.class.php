<?php

class Cidade extends TRecord
{
    const TABLENAME  = 'cidade';
    const PRIMARYKEY = 'id';
    const IDPOLICY   = 'max'; // {max, serial}
    
    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('id_estado');
        parent::addAttribute('nome_cidade');
        parent::addAttribute('ibge_cidade');
    }

    public function get_estado()
    {
        // loads the associated object
        if (empty($this->estado))
            $this->estado = new Estado($this->id_estado);

        // returns the associated object
        return $this->estado;
    }
}

