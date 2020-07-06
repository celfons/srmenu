<?php
/**
 * GrupoForm Form
 * @author  <André Luiz Ferreira>
 */
class GrupoForm extends TStandardForm
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
        parent::setActiveRecord('Grupo');
        
        // creates the form
        $this->form = new BootstrapFormBuilder('form_Grupo');
        $this->form->setFormTitle('Grupo');

        $id = new TEntry('id');
        $nome = new TEntry('nome');

        $id->setEditable(false);
        $id->setSize(100);
        $nome->setSize('70%');
        $id->setEditable(FALSE);
        
        $this->form->addFields([new TLabel('Id:')],[$id]);
        $this->form->addFields([new TLabel('Nome:')],[$nome]);

        // create the form actions
        $this->form->addAction('Salvar', new TAction([$this, 'onSave']), 'fa:floppy-o')->addStyleClass('btn-primary');
        $this->form->addAction('Limpar formulário', new TAction([$this, 'onClear']), 'fa:eraser #dd5a43');

        // vertical box container
        $container = new TVBox;
        $container->style = 'width: 100%';
        $container->class = 'form-container';
        $container->add(new TXMLBreadCrumb('menu.xml', 'GrupoList'));
        $container->add($this->form);

        parent::add($container);
    }
    
    public function onShow()
    {

    } 
}