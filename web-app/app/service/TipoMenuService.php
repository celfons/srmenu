<?php
class TipoMenuService extends AdiantiRecordService
{
    const DATABASE = 'microerp';
    const ACTIVE_RECORD = 'TipoMenu';

    public function getTipoMenuList($param)
    {
        TTransaction::open('microerp');

            $fornecedor_id = $param['fornecedor_id'];
            $response = array();

            // define o critério
            $criteria = new TCriteria;
            $criteria->add(new TFilter('empresa_id', '=', $fornecedor_id));

            // carrega os tipoMenu
            $all = TipoMenu::getObjects($criteria);
            foreach ($all as $all)
            {
                $response[] = $all->toArray();
            }
            TTransaction::close();
            return  json_encode ($response);
    }
}