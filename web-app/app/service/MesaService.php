<?php
class MesaService extends AdiantiRecordService
{
    const DATABASE = 'microerp';
    const ACTIVE_RECORD = 'MesaPedido';

    public static function getMesaList( $request )
    {
        TTransaction::open('microerp');
        $response = array();

        // define o critério
        $criteria = new TCriteria;
        $criteria->add(new TFilter('empresa_id', '=', $request['empresa_id']));

        // carrega os Mesas
        $all = MesaPedido::getObjects($criteria);

        foreach ($all as $pedido)
        {
            $response[] = $pedido->toArray();
        }
        TTransaction::close();
        return json_encode ($response);
    }

}