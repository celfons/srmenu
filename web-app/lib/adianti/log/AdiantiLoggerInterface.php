<?php
namespace Adianti\Log;

/**
 * Log Interface
 *
 * @version    5.0
 * @package    log
 * @author     <André Luiz Ferreira>
 * @copyright  Copyright (c) 2006 Adianti Solutions Ltd. (http://www.adianti.com.br)
 * @license    http://www.adianti.com.br/framework-license
 */
interface AdiantiLoggerInterface
{
    function write($message);
}
