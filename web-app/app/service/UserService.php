<?php
class UserService extends AdiantiRecordService
{
    const DATABASE = 'permission';
    const ACTIVE_RECORD = 'SystemUser';
    
    public function getlogin($param)
    {
        TTransaction::open('permission');

        $login     = $param['login'];
        $password  = $param['password'];

        $user = SystemUser::authenticate( $login, $password );

        if ($user){
   //         return json_encode ($user->id);
            $response = array();

            // define o critério
            $criteria = new TCriteria;
            $criteria->add(new TFilter('id', '=', $user->id));

            // carrega os produtos
            $all = SystemUser::getObjects($criteria);
            foreach ($all as $all)
            {
                $response[] = $all->toArray();
            }
            TTransaction::close();

         //   echo json_encode ($response);

            return  json_encode ($response);

        }else{
            TTransaction::close();
            return ('notok');
        }


    }
    public function storeUser($param)
    {

        TTransaction::open('permission');

        $object = new SystemUser;
        $object->fromArray($param['data']);
        $return = $object->store();

        TTransaction::close();
        return $return;
    }
}


