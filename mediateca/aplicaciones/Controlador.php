<?php

abstract class Controlador{
    
    protected $_view;
    
    public function __construct(){
        $this->_view = new View(new Request());
    }
    abstract public function index();
    
    protected function loadModel($modelo){
        $modelo = $modelo.'Model';
        $rutaModelo = ROOT.'modelo'.DS.$modelo.'.php';
        
        if(is_readable($rutaModelo)){
            require_once $rutaModelo;
            $modelo = new $modelo;
            return $modelo;
        }else{
            throw new Exception('Error de modelo');
        }
    }
    
    //metodo para cargar las librerias
    protected function getLibrary($libreria){
        $rutaLibreria = ROOT.'libs'.DS.$libreria.'.php';
        
        if(is_readable($rutaLibreria)){
            require_once $rutaLibreria;
        }else{
            throw new Exception("Error de libreria");
        }
    }
    
    // metodo para tomar variable enviada por pots y la filtrara
    protected function getTexto($clave){
        if(isset($_POST[$clave]) && !empty($_POST[$clave])){
            $_POST[$clave] = htmlspecialchars($_POST[$clave], ENT_QUOTES);
            return $_POST[$clave];
        }else{
            return "";
        }
    }
    
    protected function getInt($clave){
        if(isset($_POST[$clave]) && !empty($_POST[$clave])){
            $_POST[$clave] = filter_input(INPUT_POST, $clave, FILTER_VALIDATE_INT);
            return $_POST[$clave];
        }else{
            return 0;
        }
    }
    
    //metodo que nos redirecciona a los posts
    protected function redireccionar($ruta = false){
        if($ruta){
            header('location:' . BASE_URL.$ruta);
            exit;
        }else{
            header('location:' . BASE_URL);
            exit;
        }
    }
    
    
    protected function filtrarInt($int){
        $int = (int) $int;
        if(is_int($int)){
            return $int;
        }else{
            return 0;
        }
    }
    
    protected function getPostParam($clave){
        if(isset($_POST[$clave])){
            return $_POST[$clave];
        }
    }
    
    protected function getGetParam($clave){
        if( isset($_GET[$clave])){
            return $_GET[$clave];
        }
    }
}