<?php
class PedidoItemService extends AdiantiRecordService
{
    const DATABASE = 'microerp';
    const ACTIVE_RECORD = 'PedidoItem';

    public static function getitempedido( $request )
    {
        TTransaction::open('microerp');
        $response = array();

        // define o critério
        $criteria = new TCriteria;
        $criteria->add(new TFilter('pedido_id', '=', $request['pedido_id']));

        // carrega os produtos
        $all = PedidoItem::getObjects($criteria);

        foreach ($all as $pedidoitem)
        {
            $pedidoitem->nome = $pedidoitem->produto->nome;
            $pedidoitem->valor_total = $pedidoitem->quantidade * $pedidoitem->valor;
            $response[] = $pedidoitem->toArray();
        }
        TTransaction::close();
        return json_encode ($response);
    }
    public static function deleteitempedido( $request )
    {
        TTransaction::open('microerp');
        $response = array();

        // define o critério
        $criteria = new TCriteria;
        $criteria->add(new TFilter('pedido_id', '=', $request['pedido_id']));
        $criteria->add(new TFilter('produto_id', '=', $request['produto_id']));
        $criteria->add(new TFilter('id', '=', $request['id']));
        $repository = new TRepository('PedidoItem');
        $repository->delete($criteria);

        $produto = new Produto($request['produto_id']);
        $produto->qtde_estoque = $produto->qtde_estoque + $request['quantidade'];
        $produto->store();

        $pedido = new Pedido($request['pedido_id']);

        if ($pedido->dezporcento == 'N') {
            $pedido->valor_total = $pedido->valor_total - ($produto->preco_venda * $request['quantidade']);
        }
        else
            {
                $pedido->valor_total = $pedido->valor_total - ($produto->preco_venda * $request['quantidade'] * 1.1);
            }
        $pedido->store();

        TTransaction::close();

    }

    public static function additempedido( $request )
    {
        TTransaction::open('microerp');
        $object = new PedidoItem;
        $object->fromArray($request['data']);
        $object->store();

        $produto = new Produto($object->produto_id);
        $produto->qtde_estoque = $produto->qtde_estoque - $object->quantidade;
        $produto->store();


        TTransaction::close();

    }


}