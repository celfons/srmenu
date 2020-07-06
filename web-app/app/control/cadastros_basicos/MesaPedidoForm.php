<?php
/**
 * EstadoPedidoForm Form
 * @author  <André Luiz Ferreira>
 */
class MesaPedidoForm extends TStandardForm
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
        parent::setActiveRecord('MesaPedido');
        
        // creates the form
        $this->form = new BootstrapFormBuilder('form_MesaPedido');
        $this->form->setFormTitle('Mesa de pedido');

        $id = new TEntry('id');
        $obs = new TEntry('obs');
        $nome = new TEntry('nome');

        $id->setEditable(false);
        $id->setSize(100);
        $nome->setSize('70%');
        $obs->setSize('70%');
        $id->setEditable(FALSE);
        
        $this->form->addFields([new TLabel('Id:')], [$id]);
        $this->form->addFields([new TLabel('Descrição:')], [$nome]);
        $this->form->addFields([new TLabel('Observação:')], [$obs]);
        
        // create the form actions
        $this->form->addAction('Salvar', new TAction([$this, 'onSave']), 'fa:floppy-o')->addStyleClass('btn-primary');
        $this->form->addAction('Limpar formulário', new TAction([$this, 'onClear']), 'fa:eraser #dd5a43');
        
        // vertical box container
        $container = new TVBox;
        $container->style = 'width: 100%';
        $container->class = 'form-container';
        $container->add(new TXMLBreadCrumb('menu.xml', 'MesaPedidoList'));
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

            $object = new MesaPedido(); // create an empty object
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