<?php

class TipoMenu extends TRecord
{
    const TABLENAME  = 'tipo_menu';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'max'; // {max, serial}
    
    
    
    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('nome');
        parent::addAttribute('empresa_id');
        parent::addAttribute('urlImagem');
        parent::addAttribute('imagem_id');
    }
}

