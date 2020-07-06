<?php
class PedidoService extends AdiantiRecordService
{
    const DATABASE = 'microerp';
    const ACTIVE_RECORD = 'Pedido';
    
    public function getTotalPedidosPessoa($param)
    {
        TTransaction::open('microerp');
        
        $cliente_id = $param['cliente_id'];
        $ano        = $param['ano'];
        
        $total = Pedido::getTotalPedidosPessoa($cliente_id, $ano);
        
        TTransaction::close();
        return $total;
    }
    public function get2TotalPedidosPessoa($param)
    {
        TTransaction::open('microerp');

        $cliente_id = $param['cliente_id'];
        $ano        = $param['ano'];

        $total = Pedido::get2TotalPedidosPessoa($cliente_id, $ano);

        TTransaction::close();
        return $total;
    }
    public static function getPididoId( $request )
    {
        TTransaction::open('microerp');
        $response = array();

        // define o critério
        $criteria = new TCriteria;
        $criteria->add(new TFilter('cliente_id', '=', $request['cliente_id']));
        $criteria->add(new TFilter('empresa_id', '=', $request['empresa_id']));
        $criteria->add(new TFilter('mesa_pedido_id', '=', $request['mesa_pedido_id']));
  //      $criteria->add(new TFilter('hora', '=', $request['Hora_pedido']));
        $criteria->add(new TFilter('status', '=', $request['status']));

        // carrega os produtos
        $all = Pedido::getObjects($criteria);

        foreach ($all as $pedido)
        {
            $response[] = $pedido->toArray();
        }
        TTransaction::close();
        return json_encode ($response);
    }
    public static function getPididoList( $request )
    {
        TTransaction::open('microerp');
        $response = array();

        // define o critério
        $criteria = new TCriteria;
        $criteria->add(new TFilter('cliente_id', '=', $request['cliente_id']));
        $criteria->add(new TFilter('empresa_id', '=', $request['empresa_id']));
        $criteria->add(new TFilter('mesa_pedido_id', '=', $request['mesa_pedido_id']));
        $criteria->add(new TFilter('status','not like','Inicial'));
        $criteria->add(new TFilter('status','not like','Pago'));
        $criteria->add(new TFilter('status','not like','Tarifado'));
        $criteria->add(new TFilter('valor_total','>','0'));

        // carrega os pedidos
        $all = Pedido::getObjects($criteria);

        foreach ($all as $pedido)
        {
            $response[] = $pedido->toArray();
        }
        TTransaction::close();
        return json_encode ($response);
    }

}