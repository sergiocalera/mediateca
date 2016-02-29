<?php

class indexController extends Controlador{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function index() {
        $this->_view->renderizarPeticion('index', file_get_contents( BASE_URL.'api/index/?tipo=listas_reproduccion') );
    }
    
    public function contenido(){
        $this->_view->renderizarPeticion('contenido', $this->getGetParam('items'));
    }
}
