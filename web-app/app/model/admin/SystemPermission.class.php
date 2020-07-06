<?php
/**
 * SystemPermission
 *
 * @version    1.0
 * @package    model
 * @subpackage admin
 * @author     <André Luiz Ferreira>
 * @copyright  Copyright (c) 2006 Adianti Solutions Ltd. (http://www.adianti.com.br)
 * @license    http://www.adianti.com.br/framework-license
 */
class SystemPermission
{
    public static function checkPermission($action)
    {
        $programs = TSession::getValue('programs');
        return (isset($programs[$action]) AND $programs[$action]);
    } 
}
