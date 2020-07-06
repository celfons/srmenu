<?php
/**
 * SystemGroupProgram
 *
 * @version    1.0
 * @package    model
 * @subpackage admin
 * @author     <André Luiz Ferreira>
 * @copyright  Copyright (c) 2006 Adianti Solutions Ltd. (http://www.adianti.com.br)
 * @license    http://www.adianti.com.br/framework-license
 */
class SystemGroupProgram extends TRecord
{
    const TABLENAME = 'system_group_program';
    const PRIMARYKEY= 'id';
    const IDPOLICY =  'max'; // {max, serial}
    
    use SystemChangeLogTrait;
    
    /**
     * Constructor method
     */
    public function __construct($id = NULL)
    {
        parent::__construct($id);
        parent::addAttribute('system_group_id');
        parent::addAttribute('system_program_id');
    }
}
