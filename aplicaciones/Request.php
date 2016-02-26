<?php

require_once 'Config.php';

class Request{
    private $_controlador;
    private $_metodos;
    private $_argumentos;
    
    public function __construct() {
        //if(isset($_GET['url'])){
        if(isset($_SERVER['PATH_INFO']) ){
            //echo 'funcion<br>';
            //$url = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_URL);
            $url = filter_input(INPUT_SERVER, 'PATH_INFO', FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            $url = array_filter($url);
            
            $this->_controlador = array_shift($url);
            $this->_metodos = array_shift($url);
            $this->_argumentos = $url;
        }
        
        
        if(!$this->_controlador){
            $this->_controlador = DEFAULT_CONTROLLER;
        }
        
        if(!$this->_metodos){
            $this->_metodos = DEFAULT_CONTROLLER;
        }
        
        if(!isset($this->_argumentos)){
            $this->_argumentos = array();
        }

/*
        echo 'URL: '.$_SERVER['PATH_INFO'].'<br>';
        echo 'Controlador: '.$this->_controlador.'<br>';
        echo 'Metodo: '.$this->_metodos.'<br>';
        echo 'Argumentos: ';
        var_dump($this->_argumentos); echo'<br>';
        */
    }
    
    public function getControlador(){
        return $this->_controlador;
    }
    
    public function getMetodo(){
        return $this->_metodos;
    }
    
    public function getArgs(){
        return $this->_argumentos;
    }
}