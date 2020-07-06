<?php
class TipoProdutoService extends AdiantiRecordService
{
    const DATABASE = 'microerp';
    const ACTIVE_RECORD = 'TipoProduto';

    public function getTipoProduto($param)
    {
        TTransaction::open('microerp');

            $idMenu     = $param['idMenu'];
            $fornecedor_id = $param['fornecedor_id'];
            $response = array();

            // define o critério
            $criteria = new TCriteria;
            $criteria->add(new TFilter('idMenu', '=', $idMenu));
            $criteria->add(new TFilter('empresa_id', '=', $fornecedor_id));

            // carrega os produtos
            $all = TipoProduto::getObjects($criteria);
            foreach ($all as $all)
            {
                $response[] = $all->toArray();
            }
            TTransaction::close();
            return  json_encode ($response);
    }
}