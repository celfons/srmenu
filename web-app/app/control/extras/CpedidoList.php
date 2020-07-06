<?php


/**
 * PedidoList Listing
 * @author  <André Luiz Ferreira>
 */


class CpedidoList extends TStandardList
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

        $script = new TElement('script');
        $script->type = 'text/javascript';
        $script->add("$(document).ready(function(){
        window.setTimeout(function(){ 
        var results = new RegExp('[\\?&]class=([^&#]*)').exec(window.location.href);
        if('".__CLASS__."' == results[1] )
        __adianti_load_page('engine.php?class=CpedidoList&method=onReload');
        }, 5000);
        });
        ");

        parent::setDatabase('microerp');
        parent::setActiveRecord('Pedido');
        parent::addFilterField('id', '=', 'id');
     //   parent::addFilterField('user_id', '=', 'user_id');
        parent::addFilterField('mesa_pedido_id', '=', 'mesa_pedido_id');
        parent::addFilterField('empresa_id', '=', 'empresa_id');
        parent::addFilterField('status', 'like', 'status');
        parent::addFilterField('dt_pedido', '>=', 'dt_pedido_ini');
        parent::addFilterField('dt_pedido', '<=', 'dt_pedido_ate');
        parent::setDefaultOrder('id', 'desc');
        
        $this->form = new BootstrapFormBuilder('form_Pedido');
        $this->form->setFormTitle('Pedidos');

        $criteria = new TCriteria();
        $criteria->add(new TFilter('empresa_id','=',TSession::getValue('userunitid')));
        
     //   $id = new TEntry('id');
     //   $estado_pedido_id = new TDBCombo('user_id', 'microerp', 'SystemUser', 'id', '{nome}','id asc'  );
        $mesa_pedido_id = new TDBCombo('mesa_pedido_id', 'microerp', 'MesaPedido', 'id', '{nome}','',$criteria );
        if (strcmp(TSession::getValue('user_master'), "master") == 0){
            $empresa_id = new TDBCombo('empresa_id', 'microerp', 'SystemUnit', 'id', 'name','id asc'  );
        }else{
            $criteria = new TCriteria();
            $criteria->add(new TFilter('empresa_id','=',TSession::getValue('userunitid')));
            $criteria->add(new TFilter('status','like','Enviado'));
            parent::setCriteria($criteria);
        }

    //    $dt_pedido_ini = new TDate('dt_pedido_ini');
    //    $dt_pedido_ate = new TDate('dt_pedido_ate');


    //    $dt_pedido_ini->setDatabaseMask('yyyy-mm-dd');
//        $dt_pedido_ate->setDatabaseMask('yyyy-mm-dd');

  //      $dt_pedido_ini->setMask('dd/mm/yyyy');
    //    $dt_pedido_ate->setMask('dd/mm/yyyy');
        
    //    $id->setSize(100);

   //     $dt_pedido_ini->setSize(110);
    //    $dt_pedido_ate->setSize(120);
    //    $estado_pedido_id->setSize('35%');
        $mesa_pedido_id->setSize('35%');
        if (strcmp(TSession::getValue('user_master'), "master") == 0) {
            $empresa_id->setSize('35%');
        }


    //    $this->form->addFields([new TLabel('Id:')],[$id]);
        if (strcmp(TSession::getValue('user_master'), "master") == 0) {
            $this->form->addFields([new TLabel('Fornecedor:')], [$empresa_id]);
        }
  //      $this->form->addFields([new TLabel('Estado pedido:')],[$estado_pedido_id]);
        $this->form->addFields([new TLabel('Mesa:')],[$mesa_pedido_id]);
  //      $this->form->addFields([new TLabel('Dt pedido (de):')],[$dt_pedido_ini],[new TLabel('Dt pedido (até):')],[$dt_pedido_ate]);

        // mantém o form preenhido com os valores buscados
        $this->form->setData( TSession::getValue(__CLASS__.'_filter_data') );

        $this->form->addAction('Buscar', new TAction([$this, 'onSearch']), 'fa:search')->addStyleClass('btn-primary');
        
        // creates a Datagrid
        $this->datagrid = new BootstrapDatagridWrapper(new TDataGrid);
        $this->datagrid->style = 'width: 100%';
        
        $column_id           = new TDataGridColumn('id', 'Id', 'left' , '124px');
        $column_cliente_nome = new TDataGridColumn('cliente->name', 'Nome', 'left');
        $column_mesa_pedido_nome = new TDataGridColumn('mesa_pedido->nome', 'Local', 'left');
        $column_dt_pedido    = new TDataGridColumn('dt_pedido', 'Dt pedido', 'center');
        $column_stats    = new TDataGridColumn('status', 'Status', 'center');
        $column_valor_total  = new TDataGridColumn('valor_total', 'Valor total', 'right');
        $column_hora  = new TDataGridColumn('hora', 'Hora', 'right');
        $column_image = new TDataGridColumn('Image',  'Cliente',    'center', '15%');

        $column_valor_total->setTransformer(function($value, $object, $row) {
            if (!$value) {
                $value = 0;
            }
            return "R$ " . number_format($value, 2, ",", ".");
        });
        
        $this->datagrid->addColumn($column_id);
        $this->datagrid->addColumn($column_cliente_nome);
        $this->datagrid->addColumn($column_mesa_pedido_nome);
        $this->datagrid->addColumn($column_dt_pedido);
        $this->datagrid->addColumn($column_hora);
        $this->datagrid->addColumn($column_stats);
        $this->datagrid->addColumn($column_image);

//        $column_image = new TImage('img/staus_pedido/feliz.png');
//        $column_image = 'img/staus_pedido/feliz.png';

        if (strcmp(TSession::getValue('user_master'), "master") != 0) {

            $action_edit = new TDataGridAction(array('CpedidoFormView', 'onShow'));
            $action_edit->setButtonClass('btn btn-default btn-sm');
            $action_edit->setLabel('Visualizar');
            $action_edit->setImage('fa:search #478fca');
            $action_edit->setField('id');
            $this->datagrid->addAction($action_edit);

            $action_pronto = new TDataGridAction(array('CpedidoList', 'onEdit'));
            $action_pronto->setButtonClass('btn btn-default btn-sm');
            $action_pronto->setLabel('Pronto');
            $action_pronto->setImage('fa:pencil-square-o #dd5a43');
            $action_pronto->setField('id');
            $this->datagrid->addAction($action_pronto);

        }

        // create the datagrid model
        $this->datagrid->createModel();

        // creates the page navigation
        $this->pageNavigation = new TPageNavigation;
        $this->pageNavigation->setAction(new TAction(array($this, 'onReload')));
        $this->pageNavigation->setWidth($this->datagrid->getWidth());
     //   $this->Image = 'img/staus_pedido/feliz.png';

        // define the transformer method over image
        $column_image->setTransformer( function($image) {
            return new TImage($image);
        });

        $column_image->width = '1px';
        $column_image ->height = '1px';



        $panel = new TPanelGroup;
        $panel->add($this->datagrid);
        $panel->addFooter($this->pageNavigation);

        // vertical box container
        $container = new TVBox;
        $container->style = 'width: 100%';
        $container->add(new TXMLBreadCrumb('menu.xml', __CLASS__));
        $container->add($this->form);
        $container->add($panel);

        parent::add($script);

        parent::add($container);
    }


    public function onEdit( $param )
    {
        try
        {
                TTransaction::open('microerp');

                $object = Pedido::find($param['key']);

                //           $object->cliente_id = TSession::getValue('userid');
                //           $object->empresa_id = TSession::getValue('userunitid');
                $object->status = "Pronto";
                $object->estado_pedido_id = 2;

                //$this->form->setData($object);
               // $this->onReload();
                $object->store();

                PedidoItem::upStaus($param['key']);

                TTransaction::close();

                new TMessage('info', TAdiantiCoreTranslator::translate('Record saved'), new TAction(array('CpedidoList', 'onReload')));

        }
        catch (Exception $e)
        {
            new TMessage('error', $e->getMessage());
            TTransaction::rollback();
        }
    }
    public function onReload($param = NULL)
    {
        try
        {
            if (empty($this->database))
            {
                throw new Exception(AdiantiCoreTranslator::translate('^1 was not defined. You must call ^2 in ^3', AdiantiCoreTranslator::translate('Database'), 'setDatabase()', AdiantiCoreTranslator::translate('Constructor')));
            }

            if (empty($this->activeRecord))
            {
                throw new Exception(AdiantiCoreTranslator::translate('^1 was not defined. You must call ^2 in ^3', 'Active Record', 'setActiveRecord()', AdiantiCoreTranslator::translate('Constructor')));
            }

            // open a transaction with database
            TTransaction::open($this->database);

            // instancia um repositório
            $repository = new TRepository($this->activeRecord);
            $limit = isset($this->limit) ? ( $this->limit > 0 ? $this->limit : NULL) : 10;
            // creates a criteria
            $criteria = isset($this->criteria) ? clone $this->criteria : new TCriteria;
            if ($this->order)
            {
                $criteria->setProperty('order',     $this->order);
                $criteria->setProperty('direction', $this->direction);
            }
            $criteria->setProperties($param); // order, offset
            $criteria->setProperty('limit', $limit);

            if ($this->formFilters)
            {
                foreach ($this->formFilters as $filterKey => $filterField)
                {
                    if (TSession::getValue($this->activeRecord.'_filter_'.$filterField))
                    {
                        // add the filter stored in the session to the criteria
                        $criteria->add(TSession::getValue($this->activeRecord.'_filter_'.$filterField));
                    }
                }
            }

            // load the objects according to criteria
            $objects = $repository->load($criteria, FALSE);

            if (is_callable($this->transformCallback))
            {
                call_user_func($this->transformCallback, $objects, $param);
            }

            $this->datagrid->clear();
            if ($objects)
            {
                // iterate the collection of active records
                foreach ($objects as $object)
                {
                    $datetime1 = new DateTime(date('Y-m-d H:i:s'));
                    $datetime2 = new DateTime($object->hora_pedido);
                    $interval = $datetime1->diff($datetime2);
                    $minutos = $interval->format('%i');
                    $horas  = $interval->format('%h');
                    $dias  = $interval->format('%d');

                    if (( $horas >= 1)||($dias > 0 ))
                    {
                        $object->Image = 'app/images/staus_pedido/bravo.png';
                    }
                    else if ($minutos <= 30)
                    {
                                $object->Image = 'app/images/staus_pedido/feliz.png';
                    }
                    else if ($minutos > 30 & $minutos <=60)
                    {
                                $object->Image = 'app/images/staus_pedido/triste.png';
                    }


                    $this->datagrid->addItem($object);
                }
            }

            // reset the criteria for record count
            $criteria->resetProperties();
            $count= $repository->count($criteria);

            if (isset($this->pageNavigation))
            {
                $this->pageNavigation->setCount($count); // count of records
                $this->pageNavigation->setProperties($param); // order, page
                $this->pageNavigation->setLimit($limit); // limit
            }

            if ($this->totalRow)
            {
                $tfoot = new TElement('tfoot');
                $tfoot->{'class'} = 'tdatagrid_footer';
                $row = new TElement('tr');
                $tfoot->add($row);
                $this->datagrid->add($tfoot);

                $row->{'style'} = 'height: 30px';
                $cell = new TElement('td');
                $cell->add( $count . ' ' . AdiantiCoreTranslator::translate('Records'));
                $cell->{'colspan'} = $this->datagrid->getTotalColumns();
                $cell->{'style'} = 'text-align:center';

                $row->add($cell);
            }

            // close the transaction
            TTransaction::close();
            $this->loaded = true;
        }
        catch (Exception $e) // in case of exception
        {
            // shows the exception error message
            new TMessage('error', $e->getMessage());
            // undo all pending operations
            TTransaction::rollback();
        }
    }
}
