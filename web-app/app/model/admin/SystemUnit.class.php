<?php
/**
 * SystemUnit
 *
 * @version    1.0
 * @package    model
 * @subpackage admin
 * @author     <André Luiz Ferreira>
 * @copyright  Copyright (c) 2006 Adianti Solutions Ltd. (http://www.adianti.com.br)
 * @license    http://www.adianti.com.br/framework-license
 */
class SystemUnit extends TRecord
{
    const TABLENAME = 'system_unit';
    const PRIMARYKEY= 'id';
    const IDPOLICY =  'max'; // {max, serial}
    
    use SystemChangeLogTrait;
    
    
    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('system_user_id');
        parent::addAttribute('name');
        parent::addAttribute('razao_social');
        parent::addAttribute('cnpj');
        parent::addAttribute('unidade_fede');
        parent::addAttribute('regime_tributario');
    }
}
