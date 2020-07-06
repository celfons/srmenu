<?php

class Pessoa extends TRecord
{
    const TABLENAME  = 'pessoa';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'max'; // {max, serial}
    
    
    private $cidade;
    
    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('nome');
        parent::addAttribute('documento');
        parent::addAttribute('fone');
        parent::addAttribute('email');
        parent::addAttribute('rua');
        parent::addAttribute('numero');
        parent::addAttribute('bairro');
        parent::addAttribute('complemento');
        parent::addAttribute('cep');
        parent::addAttribute('obs');
        parent::addAttribute('cidade_id');
    }

    /**
     * Method set_cidade
     * Sample of usage: $var->cidade = $object;
     * @param $object Instance of Cidade
     */
    public function set_cidade(Cidade $object)
    {
        $this->cidade = $object;
        $this->cidade_id = $object->id;
    }
    
    /**
     * Method get_cidade
     * Sample of usage: $var->cidade->attribute;
     * @returns Cidade instance
     */
    public function get_cidade()
    {
        
        // loads the associated object
        if (empty($this->cidade))
            $this->cidade = new Cidade($this->cidade_id);
        
        // returns the associated object
        return $this->cidade;
    }
}

