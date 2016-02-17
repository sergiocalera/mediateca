<?php

class View{
    
    private $_controlador;
    private $_js;
    
    public function __construct(Request $peticion) {
        $this->_controlador = $peticion->getControlador();
        $this->_js = array();
    }
    
    public function renderizarPeticion($vista, $respuesta=false){
        $rutaView = ROOT . 'vistas'.DS.$this->_controlador.DS.$vista.'.php';
        $js = array(
            'bootstrap' => BASE_URL.'/medioteca/vistas/index/js/bootstrap.min.js',
            'jquery' => BASE_URL.'/medioteca/vistas/index/js/jquery-1.12.0.min.js',
            'video' => BASE_URL.'/medioteca/vistas/index/js/video.js'
        );
        $css = array(
            'bootstrap' => BASE_URL.'medioteca/vistas/index/css/bootstrap.min.css',
            'index' => BASE_URL.'medioteca/vistas/index/css/index.css'
        );
        if(is_readable($rutaView)){
            include_once ROOT.'vistas'.DS.'layout'.DS.DEFAULT_LAYOUT.DS.'header.php';
            include_once $rutaView;
            include_once ROOT.'vistas'.DS.'layout'.DS.DEFAULT_LAYOUT.DS.'footer.php';
        } else{
            throw new Exception('Error de vista :: '.$vista);
        }
    }
    
    public function renderizarConsulta($vista, $respuesta = false){
        $rutaView = ROOT . 'vistas'.DS.$this->_controlador.DS.$vista.'.php';
        if(is_readable($rutaView)){
            include_once $rutaView;
        }else{
            throw new Exception("Error de vista :: ".$vista);
        }
    }


    public function setJS(array $js){
        if(is_array($js) && count($js)){
            foreach ($js as $aux){
                $this->_js[] = BASE_URL.'views/'. $this->_controlador."/js/".$aux.'.js';
            }
        }else{
            throw new Exception("Error de JS");
        }
    }
}