<?php

abstract class Cliente{
    
    private $key = "";
    private $scope = array();
    
    public function __construct($scope, $key) {
        $this->key = $key;
        $this->scope = $scope;
    }
    
    public function getKey(){
        return $this->key;
    }
    
    public function getScope(){
        return $this->scope;
    }
    
    public function setKey($key){
        $this->key = key;
    }
    
    public function setScope($scope){
        $this->scope = $scope;
    }
}