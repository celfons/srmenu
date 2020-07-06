<?php
/**
 * PessoaList Listing
 * @author  <André Luiz Ferreira>
 */
class PessoaList extends TStandardList
{
    protected $form; // form
    protected $datagrid; // listing
    protected $pageNavigation;

    /**
     * Class constructor
     * Creates the page, the form and the listing
     */
    public function __construct()
    {
        parent::__construct();
        
        parent::setDatabase('microerp');
        parent::setActiveRecord('Pessoa');
        parent::addFilterField('id', '=', 'id');
        parent::addFilterField('nome', 'like', 'nome');
        parent::addFilterField('documento', 'like', 'documento');
        parent::addFilterField('fone', 'like', 'fone');
        parent::addFilterField('email', 'like', 'email');
        parent::addFilterField('bairro', 'like', 'bairro');
        parent::addFilterField('cidade_id', '=', 'cidade_id');
        parent::setDefaultOrder('id', 'desc');
        
        // creates the form
        $this->form = new BootstrapFormBuilder('list_Pessoa');

        // define the form title
        $this->form->setFormTitle('Pessoas');

        $id = new TEntry('id');
        $nome = new TEntry('nome');
        $documento = new TEntry('documento');
        $fone = new TEntry('fone');
        $email = new TEntry('email');
        $bairro = new TEntry('bairro');
        $cidade_id = new TDBCombo('cidade_id', 'microerp', 'Cidade', 'id', '{nome}','id asc'  );

        $id->setSize(100);
        $nome->setSize('72%');
        $fone->setSize('72%');
        $email->setSize('72%');
        $bairro->setSize('72%');
        $documento->setSize('72%');
        $cidade_id->setSize('72%');

        $this->form->addFields([new TLabel('Id:')],[$id]);
        $this->form->addFields([new TLabel('Nome:')],[$nome],[new TLabel('Documento:')],[$documento]);
        $this->form->addFields([new TLabel('Fone:')],[$fone],[new TLabel('Email:')],[$email]);
        $this->form->addFields([new TLabel('Bairro:')],[$bairro],[new TLabel('Cidade:')],[$cidade_id]);

        // keep the form filled during navigation with session data
        $this->form->setData( TSession::getValue(__CLASS__.'_filter_data') );

        $this->form->addAction('Buscar', new TAction([$this, 'onSearch']), 'fa:search')->addStyleClass('btn-primary');
        $this->form->addAction('Cadastrar', new TAction(['PessoaForm', 'onEdit']), 'fa:plus #69aa46');

        // creates a Datagrid
        $this->datagrid = new BootstrapDatagridWrapper(new TDataGrid);
        $this->datagrid->style = 'width: 100%';
        // $this->datagrid->datatable = 'true';

        $column_id = new TDataGridColumn('id', 'Id', 'center' , '50');
        $column_nome = new TDataGridColumn('nome', 'Nome', 'left');
        $column_fone = new TDataGridColumn('fone', 'Fone', 'left');
        $column_email = new TDataGridColumn('email', 'Email', 'left');
        $column_cidade_nome = new TDataGridColumn('cidade->nome', 'Cidade', 'left');

        $this->datagrid->addColumn($column_id);
        $this->datagrid->addColumn($column_nome);
        $this->datagrid->addColumn($column_fone);
        $this->datagrid->addColumn($column_email);
        $this->datagrid->addColumn($column_cidade_nome);

        $action_onEdit = new TDataGridAction(array('PessoaForm', 'onEdit'));
        $action_onEdit->setButtonClass('btn btn-default btn-sm');
        $action_onEdit->setLabel('Editar');
        $action_onEdit->setImage('fa:pencil-square-o blue');
        $action_onEdit->setField('id');

        $this->datagrid->addAction($action_onEdit);

        $action_onDelete = new TDataGridAction(array($this, 'onDelete'));
        $action_onDelete->setButtonClass('btn btn-default btn-sm');
        $action_onDelete->setLabel('Excluir');
        $action_onDelete->setImage('fa:trash-o red');
        $action_onDelete->setField('id');

        $this->datagrid->addAction($action_onDelete);

        // create the datagrid model
        $this->datagrid->createModel();

        // creates the page navigation
        $this->pageNavigation = new TPageNavigation;
        $this->pageNavigation->setAction(new TAction(array($this, 'onReload')));
        $this->pageNavigation->setWidth($this->datagrid->getWidth());

        $panel = new TPanelGroup;
        $panel->add($this->datagrid);
        $panel->addFooter($this->pageNavigation);

        // vertical box container
        $container = new TVBox;
        $container->style = 'width: 100%';
        $container->add(new TXMLBreadCrumb('menu.xml', __CLASS__));
        $container->add($this->form);
        $container->add($panel);

        parent::add($container);
    }
}

