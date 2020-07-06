<?php
/**
 * CidadeForm Form
 * @author  <André Luiz Ferreira>
 */
class CidadeForm extends TStandardForm
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
        parent::setActiveRecord('Cidade');
        
        // creates the form
        $this->form = new BootstrapFormBuilder('form_Cidade');
        $this->form->setFormTitle('Cidades');

        $id = new TEntry('id');
        $nome_cidade = new TEntry('nome_cidade');
        $ibge_cidade = new TEntry('ibge_cidade');
       // $nome->addValidation('Nome', new TRequiredValidator());
        
        $id->setEditable(false);
        $id->setSize(100);
        $ibge_cidade->setSize('70%');
        $nome_cidade->setSize('70%');
        $id->setEditable(FALSE);
        
        $this->form->addFields([new TLabel('Id:')],[$id]);
        $this->form->addFields([new TLabel('Nome:', '#ff0000')],[$nome_cidade]);
        $this->form->addFields([new TLabel('Codigo Ibge:')],[$ibge_cidade]);

        // create the form actions
        $this->form->addAction('Salvar', new TAction([$this, 'onSave']), 'fa:floppy-o')->addStyleClass('btn-primary');
        $this->form->addAction('Limpar formulário', new TAction([$this, 'onClear']), 'fa:eraser #dd5a43');

        // vertical box container
        $container = new TVBox;
        $container->style = 'width: 100%';
        $container->class = 'form-container';
        $container->add(new TXMLBreadCrumb('menu.xml', 'CidadeList'));
        $container->add($this->form);

        parent::add($container);
    }
    
    public function onShow()
    {

    } 
}