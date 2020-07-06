<?php
class ProdutoService extends AdiantiRecordService
{
    const DATABASE = 'microerp';
    const ACTIVE_RECORD = 'Produto';

    public static function getBetween( $request )
    {

        TTransaction::open('microerp');
        $response = array();

        // define o critério
        $criteria = new TCriteria;
        $criteria->add(new TFilter('id', '>=', $request['from']));
        $criteria->add(new TFilter('id', '<=', $request['to']));

        // carrega os produtos
        $all = Produto::getObjects($criteria);
        foreach ($all as $produto)
        {
            $response[] = $produto->toArray();
        }
        TTransaction::close();
        return $response;
    }

    public static function getProdutoFornecedor( $request )
    {
        TTransaction::open('microerp');
        $response = array();

        // define o critério
        $criteria = new TCriteria;
        $criteria->add(new TFilter('fornecedor_id', '=', $request['fornecedor_id']));

        // carrega os produtos
        $all = Produto::getObjects($criteria);

        foreach ($all as $produto)
        {
            $response[] = $produto->toArray();
        }
        TTransaction::close();
        return $response;
    }
    public static function getProdutoList( $request )
    {
        TTransaction::open('microerp');
        $response = array();

        // define o critério
        $criteria = new TCriteria;
        $criteria->add(new TFilter('fornecedor_id', '=', $request['fornecedor_id']));
        $criteria->add(new TFilter('tipo_produto_id', '=', $request['tipo_produto_id']));
        $criteria->add(new TFilter('qtde_estoque', '>', '0'));

        // carrega os produtos
        $all = Produto::getObjects($criteria);

        foreach ($all as $produto)
        {
            $response[] = $produto->toArray();
        }
        TTransaction::close();
        return json_encode ($response);
    }

}