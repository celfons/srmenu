<?php
/**
 * ProdutoQRCode Form
 * @author  <André Luiz Ferreira>
 */
class MesaQRCode extends TPage
{
    /**
     * Form constructor
     * @param $param Request
     */
    public function __construct()
    {
        parent::__construct();

        // creates the form
        $this->form = new BootstrapFormBuilder('form_MesaQRCode');

        // define the form title
        $this->form->setFormTitle('QRCode para Mesa');

        $criteria = new TCriteria();
        $criteria   ->add(new TFilter('empresa_id','=',TSession::getValue('userunitid')));

        $id = new TEntry('id');
        $descricao_id = new TDBUniqueSearch('nome_id', 'microerp', 'MesaPedido', 'id', 'nome','', $criteria );

        $id->setSize(100);

        $descricao_id->setSize('100%');
        $descricao_id->setMinLength(2);

        $this->form->addFields([new TLabel('Id:')],[$id]);
        $this->form->addFields([new TLabel('Mesa:')],[$descricao_id]);

        // keep the form filled during navigation with session data
        $this->form->setData( TSession::getValue(__CLASS__.'_filter_data') );

        $this->form->addAction('Gerar', new TAction([$this, 'onGenerate']), 'fa:cog')->addStyleClass('btn-primary');


        // vertical box container
        $container = new TVBox;
        $container->style = 'width: 100%';
        $container->add(new TXMLBreadCrumb('menu.xml', __CLASS__));
        $container->add($this->form);

        parent::add($container);
    }

    public function onGenerate($param)
    {

        try 
        {
            TTransaction::open('microerp');

            $data = $this->form->getData();
            $criteria = new TCriteria();


            if (isset($data->nome_id) AND ($data->nome_id))
            {
                $criteria->add(new TFilter('id', '=', $data->nome_id));
            }
            if (isset($data->id) AND ($data->id))
            {
                $criteria->add(new TFilter('id', '=', $data->id));
            }

            TSession::setValue(__CLASS__.'_filter_data', $data);

            $properties = [];

            $properties['leftMargin']    = 10; // Left margin
            $properties['topMargin']     = 10; // Top margin
            $properties['labelWidth']    = 64; // Label width in mm
            $properties['labelHeight']   = 28; // Label height in mm
            $properties['spaceBetween']  = 4;  // Space between labels
            $properties['rowsPerPage']   = 10;  // Label rows per page
            $properties['colsPerPage']   = 3;  // Label cols per page
            $properties['fontSize']      = 12; // Text font size
            $properties['barcodeHeight'] = 14; // Barcode Height
            $properties['imageMargin']   = 0;


            $label = "{nome} - ";
            $label .= "empresa id {empresa_id} \n";
            $label .= "#qrcode#";


            $bcgen = new AdiantiBarcodeDocumentGenerator('p', 'A4');
            $bcgen->setProperties($properties);
            $bcgen->setLabelTemplate($label);

 //           $criteria = new TCriteria();
            $criteria->add(new TFilter('empresa_id','=',TSession::getValue('userunitid')));
 //           $criteria->add(new TFilter('id', '=', $data->nome_id));
//            parent::setCriteria($criteria);

            $objects = MesaPedido::getObjects($criteria);

            if ($objects)
            {
                foreach ($objects as $object)
                {
                    $bcgen->addObject($object);
                }

                $filename = 'tmp/barcode_'.uniqid().'.pdf';

                $bcgen->setBarcodeContent('{id} - '. $object->empresa->name. ' - {empresa_id}');
                $bcgen->generate();
                $bcgen->save($filename);

                parent::openFile($filename);
                new TMessage('info', _t('QR Codes successfully generated'));
            }
            else
            {
                new TMessage('error', _t('No records found'));
            }

            TTransaction::close();

            $this->form->setData($data);
        } 
        catch (Exception $e) 
        {
            new TMessage('error', $e->getMessage());
            TTransaction::rollback();
        }
    } 
}
