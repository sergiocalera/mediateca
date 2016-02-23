<?php

class View{
    
    private $_controlador;
    
    public function __construct(Request $peticion) {
        $this->_controlador = $peticion->getControlador();
    }
    
    public function renderizarPeticion($vista, $respuesta=false){
        $archivos = otherFiles::run(ROOT.VISTAS, $this->_controlador);
        $rutaView = ROOT . 'vistas'.DS.$this->_controlador.DS.$vista.'.php';
        $js = $archivos['js'];
        $css = $archivos['css'];
        $img = $archivos['img'];
        
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
}