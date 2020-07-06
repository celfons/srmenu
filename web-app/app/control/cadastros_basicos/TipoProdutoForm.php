<?php
/**
 * TipoProdutoForm Form
 * @author  <André Luiz Ferreira>
 */
class TipoProdutoForm extends TStandardForm
{
    protected $form; // form
    
    /**
     * Form constructor
     * @param $param Request
     */
    public function __construct( $param )
    {
        parent::__construct();
        parent::setDatabase('microerp');
        parent::setActiveRecord('TipoProduto');
        
        // creates the form
        $this->form = new BootstrapFormBuilder('form_TipoProduto');
        $this->form->setFormTitle('Tipos de produto');

        $criteria = new TCriteria();
        $criteria   ->add(new TFilter('empresa_id','=',TSession::getValue('userunitid')));

        $id = new TEntry('id');
        $idMenu = new TDBCombo('idMenu', 'microerp', 'TipoMenu', 'id', '{nome}','', $criteria );
        $nome = new TEntry('nome');

        $idMenu->addValidation('Tipo menu id', new TRequiredValidator());

        $id->setEditable(false);
        $id->setSize(100);
        $nome->setSize('70%');
        $idMenu->setSize('35%');
        $id->setEditable(FALSE);
        
        $this->form->addFields([new TLabel('Id:')],[$id]);
        $this->form->addFields([new TLabel('Nome:')],[$nome]);
        $this->form->addFields([new TLabel('Tipo Menu:')],[$idMenu]);

        // create the form actions
        $this->form->addAction('Salvar', new TAction([$this, 'onSave']), 'fa:floppy-o')->addStyleClass('btn-primary');
        $this->form->addAction('Limpar formulário', new TAction([$this, 'onClear']), 'fa:eraser #dd5a43');

        // vertical box container
        $container = new TVBox;
        $container->style = 'width: 100%';
        $container->class = 'form-container';
        $container->add(new TXMLBreadCrumb('menu.xml', 'TipoProdutoList'));
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

            $object = new TipoProduto(); // create an empty object
            $object->fromArray( (array) $data); // load the object with data

            $object->empresa_id = TSession::getValue('userunitid');

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