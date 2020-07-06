<?php
/**
 * PedidoForm Form
 * @author  <André Luiz Ferreira>
 */
date_default_timezone_set('America/Sao_Paulo');
class PedidoForm extends TPage
{
    protected $form; // form
    
    use adianti\base\AdiantiMasterDetailTrait;


    
    /**
     * Form constructor
     * @param $param Request
     */
    public function __construct( $param )
    {
        parent::__construct();
        
        $this->form = new BootstrapFormBuilder('list_Pedido');
        $this->form->setFormTitle('Pedido');

        // master fields

        $criteria = new TCriteria();
        $criteria   ->add(new TFilter('empresa_id','=',TSession::getValue('userunitid')));

        $id                     = new TEntry('id');
//        $estado_pedido_id       = new TDBCombo('estado_pedido_id', 'microerp', 'EstadoPedido', 'id', 'nome','id asc'  );
        $mesa_pedido_id         = new TDBCombo('mesa_pedido_id', 'microerp', 'MesaPedido', 'id', 'nome','', $criteria);
        // $dt_pedido              = new TDate('dt_pedido');
        $obs                    = new TText('obs');
        $active = new TCombo('dezporcento');

        $active->addItems( [ 'N' => _t('No') ] );

    //   $active->setDefaultOption('Sim');

        /// conatinuar aqui

        $criteria = new TCriteria();
        $criteria->add(new TFilter('fornecedor_id','=',TSession::getValue('userunitid')));
        $criteria->add(new TFilter('qtde_estoque','>',0));
        //parent::setCriteria($criteria);

        // detail fields
        $item_pedido_produto_id = new TDBCombo('item_pedido_produto_id', 'microerp', 'Produto', 'id', 'nome','', $criteria);
        // $item_pedido_produto_id = new TDBUniqueSearch('item_pedido_produto_id', 'microerp', 'Produto', 'id', 'nome','id asc', $criteria);
       // $item_pedido_produto_id->setDefaultOption(false);

        $item_pedido_quantidade = new TEntry('item_pedido_quantidade');
//        $item_pedido_valor      = new TNumeric('item_pedido_valor', '2', ',', '.' );
        $item_pedido_id         = new THidden('item_pedido_id');

 //       $estado_pedido_id->addValidation('Estado pedido', new TRequiredValidator());
        $mesa_pedido_id->addValidation('Mesa', new TRequiredValidator());

        $id->setEditable(false);
        $id->setSize(100);
//        $item_pedido_produto_id->setMinLength(2);
  //      $dt_pedido->setValue(date('d/m/Y h:i'));
 //       $dt_pedido->setDatabaseMask('yyyy-mm-dd');
 //       $dt_pedido->setMask('dd/mm/yyyy');
  //      $dt_pedido->setSize(190);
        $obs->setSize('90%', 68);
        $active->setSize('10%');
 //       $estado_pedido_id->setSize('40%');
        $mesa_pedido_id->setSize('40%');
 //       $item_pedido_valor->setSize('71%');
 //       $item_pedido_produto_id->setMask('{nome}');
        $item_pedido_produto_id->setSize('40%');
        $item_pedido_quantidade->setSize('15%');
 //       $item_pedido_quantidade->setMask('99999');
        
        // master fields
        $this->form->addFields([new TLabel('Id:')],[$id]);
  //      $this->form->addFields([new TLabel('Estado pedido:', '#ff0000')],[$estado_pedido_id]);
        $this->form->addFields([new TLabel('Mesa:', '#ff0000')],[$mesa_pedido_id]);
   //     $this->form->addFields([new TLabel('Dt pedido:')],[$dt_pedido]);
        $this->form->addFields( [new TLabel("10%")], [$active] );
    //    $this->form->addFields([new TLabel('Obs:')],[$obs]);

        // create ONOFF action
       // $action_onoff = new TDataGridAction(array($this, 'onTurnOnOff'));
       // $action_onoff->setButtonClass('btn btn-default');
       // $action_onoff->setLabel(_t('Activate/Deactivate'));
       // $action_onoff->setImage('fa:power-off fa-lg orange');
      //  $action_onoff->setField('id');
       // $this->datagrid->addAction($action_onoff);

        
        // detail fields
        $this->form->addContent([new TFormSeparator('Itens', '#333333', '18', '#eeeeee')]);
        $this->form->addFields([new TLabel('Produto:', '#ff0000')],[$item_pedido_produto_id]);
        $this->form->addFields([new TLabel('Quantidade:')],[$item_pedido_quantidade]);
  //      $this->form->addFields([new TLabel('Valor:')],[$item_pedido_valor]);
        $this->form->addFields([$item_pedido_id]);         
        
        // add button
        $add_item_pedido = new TButton('add_item_pedido');
        $add_item_pedido->setAction(new TAction(array($this, 'onAddItemPedido')), 'Adicionar');
        $add_item_pedido->setImage('fa:plus #51c249');
        $this->form->addFields([$add_item_pedido]);
        
        // detail datagrid
        $this->item_pedido_list = new BootstrapDatagridWrapper(new TQuickGrid);
        $this->item_pedido_list->style = 'width:100%';
        $this->item_pedido_list->class .= ' table-bordered';
        $this->item_pedido_list->disableDefaultClick();
        $this->item_pedido_list->addQuickColumn('', 'edit', 'left', 50);
        $this->item_pedido_list->addQuickColumn('', 'delete', 'left', 50);


        $col_produto_id        = $this->item_pedido_list->addQuickColumn('Produto', 'item_pedido_produto_id', 'left');
        $col_quantidade        = $this->item_pedido_list->addQuickColumn('Quantidade', 'item_pedido_quantidade', 'left');
        $col_valor             = $this->item_pedido_list->addQuickColumn('Valor', 'item_pedido_valor', 'right');
        $col_total             = $this->item_pedido_list->addQuickColumn('Total', '= {item_pedido_quantidade} * {item_pedido_valor}', 'right');

        $col_total->setTotalFunction( function($values) {
            return array_sum((array) $values);
        });
        
        $this->item_pedido_list->createModel();
        
        $col_total->setTransformer(function($value, $object, $row) {
            if (!$value)
            {
                $value = 0;
            }
   //         $col_total = $col_total * 1.1;
            return "R$ " . number_format($value, 2, ",", ".");
        });
        
        $this->form->addContent([$this->item_pedido_list]);
        
        // create the form actions
        $this->form->addAction('Enviar', new TAction([$this, 'onSave']), 'fa:floppy-o')->addStyleClass('btn-primary');
        $this->form->addAction('Limpar formulário', new TAction([$this, 'onClear']), 'fa:eraser #dd5a43');

        $this->form->addFields([new TLabel('Obs:')],[$obs]);


        // vertical box container
        $container = new TVBox;
        $container->style = 'width: 100%';
        $container->class = 'form-container';
        $container->add(new TXMLBreadCrumb('menu.xml', 'PedidoList'));
        $container->add($this->form);
        
        parent::add($container);

    }
    
    /**
     * Adiciona item ao pedido
     * @param $param Request
     */
    public function onAddItemPedido( $param )
    {
        try
        {
            $data = $this->form->getData();

            if(!$data->item_pedido_produto_id)
            {
                throw new Exception(AdiantiCoreTranslator::translate('The field ^1 is required', 'Produto id'));
            }
            
            $item_pedido_items = TSession::getValue('item_pedido_items');
            $key = !empty($data->item_pedido_id) ? $data->item_pedido_id : uniqid();
            
            $fields = []; 
            $fields['item_pedido_produto_id'] = $data->item_pedido_produto_id;
            $fields['item_pedido_quantidade'] = $data->item_pedido_quantidade;
            //recupera valor de venda do produtos
            TTransaction::open('microerp');
            $produto = new Produto($data->item_pedido_produto_id);
            $fields['item_pedido_valor']      = $produto->preco_venda;

            $produto->qtde_estoque = $produto->qtde_estoque - $data->item_pedido_quantidade;

            $produto->store();

            TTransaction::close();
            $item_pedido_items[ $key ]        = $fields;
            
            TSession::setValue('item_pedido_items', $item_pedido_items);

            // limpa os campos do item do pedido
            $data->item_pedido_produto_id = '';
            $data->item_pedido_quantidade = '';
            $data->item_pedido_valor = '';
            $data->item_pedido_id = '';
            
            $this->form->setData($data);
            $this->onReload( $param );
        }
        catch (Exception $e)
        {
            $this->form->setData( $this->form->getData());
            new TMessage('error', $e->getMessage());
        }
    }

    /**
     * Recarrega tudo
     * @param $param Request
     */
    public function onReload($params = null)
    {
        $this->loaded = TRUE;
        $this->onReloadPedidoItemPedido($params);
    }
    
    /**
     * Recarrega itens do pedido
     * @param $param Request
     */
    public function onReloadPedidoItemPedido( $param )
    {
        $items = TSession::getValue('item_pedido_items'); 

        $this->item_pedido_list->clear(); 

        if($items) 
        { 
            $cont = 1; 
            foreach ($items as $key => $item) 
            {
                $rowItem = new StdClass;

                $action_del = new TAction(array($this, 'onDeleteItemPedido')); 
                $action_del->setParameter('item_pedido_id_row_id', $key);   

                $action_edi = new TAction(array($this, 'onEditItemPedido'));  
                $action_edi->setParameter('item_pedido_id_row_id', $key);  

                $button_del = new TButton('delete_item_pedido'.$cont);
                $button_del->class = 'btn btn-default btn-sm';
                $button_del->setAction($action_del, '');
                $button_del->setImage('fa:trash-o'); 
                $button_del->setFormName($this->form->getName());

                $button_edi = new TButton('edit_item_pedido'.$cont);
                $button_edi->class = 'btn btn-default btn-sm';
                $button_edi->setAction($action_edi, '');
                $button_edi->setImage('bs:edit');
                $button_edi->setFormName($this->form->getName());

                $rowItem->edit   = $button_edi;
                $rowItem->delete = $button_del;
                
                $rowItem->item_pedido_produto_id = '';
                
                if (isset($item['item_pedido_produto_id']) && $item['item_pedido_produto_id'])
                {
                    TTransaction::open('microerp');
                    $produto = Produto::find($item['item_pedido_produto_id']);
                    $rowItem->item_pedido_produto_id = $produto->render('{nome}');
                    TTransaction::close();
                }
                
                $rowItem->item_pedido_quantidade = isset($item['item_pedido_quantidade']) ? $item['item_pedido_quantidade'] : '';
                $rowItem->item_pedido_valor      = isset($item['item_pedido_valor']) ? $item['item_pedido_valor'] : '';

                $this->item_pedido_list->addItem($rowItem);
                $cont ++;
            } 
        } 
    } 
    
    /**
     * Edita item do pedido
     * @param $param Request
     */
    public function onEditItemPedido( $param )
    {
        $data = $this->form->getData();

        // read session items
        $items = TSession::getValue('item_pedido_items');

        // get the session item
        $item = $items[$param['item_pedido_id_row_id']];

        $data->item_pedido_produto_id = $item['item_pedido_produto_id'];
        $data->item_pedido_quantidade = $item['item_pedido_quantidade'];
        $data->item_pedido_valor      = $item['item_pedido_valor'];
        $data->item_pedido_id         = $param['item_pedido_id_row_id'];
        
        // fill product fields
        $this->form->setData( $data );

        $this->onReload( $param );
    }
    
    /**
     * Exclui item do pedido
     * @param $param Request
     */
    public function onDeleteItemPedido( $param )
    {
        $data = $this->form->getData();

        $data->item_pedido_produto_id = '';
        $data->item_pedido_quantidade = '';
        $data->item_pedido_valor      = '';
        $this->form->setData( $data );

        // read session items
        $items = TSession::getValue('item_pedido_items');

        // delete the item from session
        unset($items[$param['item_pedido_id_row_id']]);
        TSession::setValue('item_pedido_items', $items);
        
        $this->onReload( $param );
    }

    /**
     * Limpa formulário
     * @param $param Request
     */
    public function onClear( $param )
    {
        $this->form->clear();
        TSession::setValue('item_pedido_items', null);
        $this->onReload();
    }
    
    /**
     * Salva pedido
     * @param $param Request
     */
    public function onSave($param = null) 
    {
        try
        {
            TTransaction::open('microerp');
            
            $this->form->validate();
            $data = $this->form->getData();
            
            $object = new Pedido; 
            $object->fromArray( (array) $data);
            $object->cliente_id = TSession::getValue('userid');
            $object->empresa_id = TSession::getValue('userunitid');
            $object->status = "Enviado";
            $object->estado_pedido_id = 1;
            //$object->hora_pedido = date('H:i:s');

      //      $timestamp = mktime(date("H")-3, date("i"), date("s"));
       //     $data_hora = gmdate("d/m/Y H:i:s", $timestamp);

            $object->hora_pedido = date('Y-m-d H:i:s');
            $object->dt_pedido = date('Y-m-d');
            $object->hora = date('H:i:s');

     //       $object->mesa_id = $data->form->mesa_id ;

            if (!$data->dezporcento == 'N') {
                $object->dezporcento = 'S';
            }

            $object->store();


            if ($data->dezporcento == 'N') {
                $this->storeItems('PedidoItem', 'pedido_id', $object, 'item_pedido',
                    function ($masterObject, $detailObject) {
                        $masterObject->valor_total += ($detailObject->quantidade * $detailObject->valor);
                        if(!$detailObject->status == 'Pronto') {
                            $detailObject->status = 'Enviado';
                        }
                    });
            }else
                {

                    $this->storeItems('PedidoItem', 'pedido_id', $object, 'item_pedido',
                        function ($masterObject, $detailObject) {
                            $masterObject->valor_total += ($detailObject->quantidade * $detailObject->valor * 1.1);
                            if(!$detailObject->status == 'Pronto') {
                                $detailObject->status = 'Enviado';
                            }
                        });
                }
            $object->store();

            $data->id = $object->id;
          //  $this->form->setData($data);
            $this->form->clear();
            $this->onClear();
            TTransaction::close();
            
            new TMessage('info', AdiantiCoreTranslator::translate('Record saved'));
        }
        catch (Exception $e)
        {
            new TMessage('error', $e->getMessage());
            $this->form->setData( $this->form->getData() );
            TTransaction::rollback();
        }
    }
    
    /**
     * Edita formulário
     * @param $param Request
     */
    public function onEdit( $param )
    {
        try
        {
            if (isset($param['key']))
            {
                $key = $param['key'];
                TTransaction::open('microerp');
                
                $object = new Pedido($key);
     //           $object->cliente_id = TSession::getValue('userid');
     //           $object->empresa_id = TSession::getValue('userunitid');
     //           $object->status = "Enviado";
                $this->loadItems('PedidoItem', 'pedido_id', $object, 'item_pedido');
                 
                $this->form->setData($object); 
                $this->onReload();
                TTransaction::close(); 
            }
            else
            {
                $this->form->clear();
            }
        }
        catch (Exception $e)
        {
            new TMessage('error', $e->getMessage());
            TTransaction::rollback();
        }
    }
    
    /**
     * Exibe a página
     * @param $param Request
     */
    public function show() 
    { 
        if (!$this->loaded AND (!isset($_GET['method']) OR $_GET['method'] !== 'onReload') ) 
        { 
            $this->onReload( func_get_arg(0) );
        }
        parent::show();
    }
}
