<?php
namespace Adianti\Database;

/**
 * Base class for TCriteria and TFilter (composite pattern implementation)
 *
 * @version    5.0
 * @package    database
 * @author     André Luiz Ferreira
 * @copyright  Copyright (c) 2006 Adianti Solutions Ltd. (http://www.adianti.com.br)
 * @license    http://www.adianti.com.br/framework-license
 */
abstract class TExpression
{
    // logic operators
    const AND_OPERATOR = 'AND ';
    const OR_OPERATOR  = 'OR ';
    
    // force method rewrite in child classes
    abstract public function dump();
}
