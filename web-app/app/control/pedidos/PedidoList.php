<?php
/**
 * PedidoList Listing
 * @author  <André Luiz Ferreira>
 */
class PedidoList extends TStandardList
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
        parent::setActiveRecord('Pedido');
        parent::addFilterField('id', '=', 'id');
        //parent::addFilterField('user_id', '=', 'user_id');
        parent::addFilterField('mesa_pedido_id', '=', 'mesa_pedido_id');
        parent::addFilterField('empresa_id', '=', 'empresa_id');
        parent::addFilterField('status', 'like', 'status');
        parent::addFilterField('dt_pedido', '>=', 'dt_pedido_ini');
        parent::addFilterField('dt_pedido', '<=', 'dt_pedido_ate');
        parent::setDefaultOrder('id', 'desc');
        
        $this->form = new BootstrapFormBuilder('form_Pedido');
        $this->form->setFormTitle('Pedidos');

        $criteria = new TCriteria();
        $criteria   ->add(new TFilter('empresa_id','=',TSession::getValue('userunitid')));

        
        $id = new TEntry('id');
        //$estado_pedido_id = new TDBCombo('user_id', 'microerp', 'SystemUser', 'id', '{nome}','id asc'  );
        $mesa_pedido_id = new TDBCombo('mesa_pedido_id', 'microerp', 'MesaPedido', 'id', '{nome}','', $criteria );

        // verifica se o a usuario master, para dar permissão para seleção de empresa.
        if (strcmp(TSession::getValue('user_master'), "master") == 0){
            $empresa_id = new TDBCombo('empresa_id', 'microerp', 'SystemUnit', 'id', 'name','id asc'  );
        }else{
            // Regra para trazer apenas os produdos da empresa vinculada ao usuario em questão
            $criteria->add(new TFilter('status','not like','Inicial'));
            parent::setCriteria($criteria);
        }

        $dt_pedido_ini = new TDate('dt_pedido_ini');
        $dt_pedido_ate = new TDate('dt_pedido_ate');


        $dt_pedido_ini->setDatabaseMask('yyyy-mm-dd');
        $dt_pedido_ate->setDatabaseMask('yyyy-mm-dd');

        $dt_pedido_ini->setMask('dd/mm/yyyy');
        $dt_pedido_ate->setMask('dd/mm/yyyy');
        
        $id->setSize(100);

        $dt_pedido_ini->setSize(110);
        $dt_pedido_ate->setSize(120);
        //$estado_pedido_id->setSize('35%');
        $mesa_pedido_id->setSize('35%');
        if (strcmp(TSession::getValue('user_master'), "master") == 0) {
            $empresa_id->setSize('35%');
        }


        $this->form->addFields([new TLabel('Id:')],[$id]);
        if (strcmp(TSession::getValue('user_master'), "master") == 0) {
            $this->form->addFields([new TLabel('Fornecedor:')], [$empresa_id]);
        }
        //$this->form->addFields([new TLabel('Estado pedido:')],[$estado_pedido_id]);
        $this->form->addFields([new TLabel('Mesa:')],[$mesa_pedido_id]);
        $this->form->addFields([new TLabel('Dt pedido (de):')],[$dt_pedido_ini],[new TLabel('Dt pedido (até):')],[$dt_pedido_ate]);

        // mantém o form preenhido com os valores buscados
        $this->form->setData( TSession::getValue(__CLASS__.'_filter_data') );

        $this->form->addAction('Buscar', new TAction([$this, 'onSearch']), 'fa:search')->addStyleClass('btn-primary');
    //    if (strcmp(TSession::getValue('user_master'), "master") != 0) {
    //        $this->form->addAction('Cadastrar', new TAction(['PedidoForm', 'onClear']), 'fa:plus #69aa46');
    //    }

    //    TScript::create("window.setTimeout(function(){
    //                         __adianti_load_page('index.php?class=PedidoList');
    //                     },5000);");


        $script = new TElement('script');
        $script->type = 'text/javascript';
        $script->add("$(document).ready(function(){
      window.setTimeout(function(){ 
        var results = new RegExp('[\\?&]class=([^&#]*)').exec(window.location.href);
        if('".__CLASS__."' == results[1] )
        __adianti_load_page('engine.php?class=PedidoList&method=onReload');
      }, 15000);
   });
   ");


        // creates a Datagrid
        $this->datagrid = new BootstrapDatagridWrapper(new TDataGrid);
        $this->datagrid->style = 'width: 100%';
        
        $column_id           = new TDataGridColumn('id', 'Id', 'left' , '124px');
        $column_cliente_nome = new TDataGridColumn('cliente->name', 'Nome', 'left');
        $column_mesa_pedido_nome = new TDataGridColumn('mesa_pedido->nome', 'Local', 'left');
        $column_dt_pedido    = new TDataGridColumn('dt_pedido', 'Dt pedido', 'center');
        $column_hora    = new TDataGridColumn('hora', 'Hora', 'center');
        $column_stats    = new TDataGridColumn('status', 'Status', 'center');
        $column_valor_total  = new TDataGridColumn('valor_total', 'Valor total', 'right');
        
        $column_valor_total->setTransformer(function($value, $object, $row) {
            if (!$value) {
                $value = 0;
            }
            return "R$ " . number_format($value, 2, ",", ".");
        });

        parent::add($script);

        $this->datagrid->addColumn($column_id);
        $this->datagrid->addColumn($column_cliente_nome);
        $this->datagrid->addColumn($column_mesa_pedido_nome);
        $this->datagrid->addColumn($column_dt_pedido);
        $this->datagrid->addColumn($column_hora);
        $this->datagrid->addColumn($column_stats);
        $this->datagrid->addColumn($column_valor_total);

        // inibir a opção de edição e deleção para o user master
        if (strcmp(TSession::getValue('user_master'), "master") != 0) {

            $action_edit = new TDataGridAction(array('PedidoFormView', 'onShow'));
            $action_edit->setButtonClass('btn btn-default btn-sm');
            $action_edit->setLabel('Visualizar');
            $action_edit->setImage('fa:search #478fca');
            $action_edit->setField('id');
            $this->datagrid->addAction($action_edit);

            $action_delete = new TDataGridAction(array('PedidoList', 'onDelete'));
            $action_delete->setButtonClass('btn btn-default btn-sm');
            $action_delete->setLabel('Excluir');
            $action_delete->setImage('fa:trash-o #dd5a43');
            $action_delete->setField('id');
            $this->datagrid->addAction($action_delete);
        }

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
