<?php

class apiController extends Controlador{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function index(){
        $modelo = $this->loadModel('api');
        switch( $this->getGetParam('tipo') ){
            case 'listas_reproduccion':
                $modelo->addPropetyScope('channelId', CHANNELID);
                $modelo->setKey( KEY );
                $modelo->setParam( $this->getGetParam('tipo') );
                $this->_view->renderizarConsulta('index', $modelo->getJson() );
                break;
            case 'lista_videos':
                $modelo->addPropetyScope('playlistId', $this->getGetParam('idLista'));
                $modelo->setKey( KEY );
                $modelo->setParam( $this->getGetParam('tipo'));
                $this->_view->renderizarConsulta('index', $modelo->getJson() );
                break;
        }
    }
}
