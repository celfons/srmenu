<?php
/**
 * SystemUnitForm
 *
 * @version    1.0
 * @package    control
 * @subpackage admin
 * @author     André Luiz Ferreira
 * @copyright  Copyright (c) 2006 Adianti Solutions Ltd. (http://www.adianti.com.br)
 * @license    http://www.adianti.com.br/framework-license
 */
class SystemUnitForm extends TStandardForm
{
    protected $form; // form
    
    /**
     * Class constructor
     * Creates the page and the registration form
     */
    function __construct()
    {
        parent::__construct();
        
        $this->setDatabase('permission');              // defines the database
        $this->setActiveRecord('SystemUnit');     // defines the active record
        
        // creates the form
        $this->form = new BootstrapFormBuilder('form_SystemUnit');
        $this->form->setFormTitle(_t('Unit'));
        
        // create the form fields
        $id = new TEntry('id');
        $name = new TEntry('name');
        $razao_social = new TEntry('razao_social');
        $cnpj = new TEntry('cnpj');

        
        // add the fields
        $this->form->addFields( [new TLabel('Id')], [$id] );
        $this->form->addFields( [new TLabel(_t('Name'))], [$name] );
        $this->form->addFields( [new TLabel('Razão Social')], [$razao_social] );
        $this->form->addFields( [new TLabel('Cnpj')], [$cnpj] );
        $id->setEditable(FALSE);
        $id->setSize('22%');
        $name->setSize('70%');
        $name->addValidation( _t('Name'), new TRequiredValidator );

        $razao_social->setSize('70%');
        $razao_social->addValidation(('Razão Social'), new TRequiredValidator );

        $cnpj->setSize('22%');
        $cnpj->setMask('99.999.999/9999-99');
        $cnpj->addValidation(('CNPJ'), new TRequiredValidator );

        
        // create the form actions
        $btn = $this->form->addAction(_t('Save'), new TAction(array($this, 'onSave')), 'fa:floppy-o');
        $btn->class = 'btn btn-sm btn-primary';
        $this->form->addAction(_t('Clear'),  new TAction(array($this, 'onEdit')), 'fa:eraser red');
        $this->form->addAction(_t('Back'),new TAction(array('SystemUnitList','onReload')),'fa:arrow-circle-o-left blue');
        
        // vertical box container
        $container = new TVBox;
        $container->style = 'width: 90%';
        $container->add(new TXMLBreadCrumb('menu.xml', 'SystemUnitList'));
        $container->add($this->form);
        
        parent::add($container);
    }
    public function onShow()
    {

    }
    public function onSave($param = null)
    {
        try
        {
            TTransaction::open('microerp'); // abre transação

            $this->form->validate(); // valida dados

            $data = $this->form->getData(); // dados do form

            $object = new SystemUnit(); // create an empty object
            $object->fromArray( (array) $data); // load the object with data

            $validator = new TCNPJValidator;
            $validator->validate('CNPJ', $data->cnpj);

            $object->store(); // save the object


            $data->id = $object->id;
            $this->form->setData($data); // fill form data
            TTransaction::close(); // close the transaction

            new TMessage('info', AdiantiCoreTranslator::translate('Record saved'));
        }
        catch (Exception $e) // in case of exception
        {
            new TMessage('error', $e->getMessage());
            $this->form->setData( $this->form->getData() );
            TTransaction::rollback();
        }
    }

}
