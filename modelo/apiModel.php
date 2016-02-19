<?php
include_once ROOT. 'modelo' . DS . 'src' . DS . 'Cliente.php';
include_once ROOT . 'modelo' . DS . 'src' . DS . 'PlayList.php';
include_once ROOT . 'modelo' . DS . 'src' . DS . 'VideoList.php';

class apiModel{
    /***************[SCOPE PARA PLAYLIST]**************/
    private $channelId = 'UCQPGruPlVLSM2lVsMcOPMvQ';

    /******************[PARAMETROS DEL SCOPE]******************/
    private $scope = array(
        'part' => 'snippet',
        'maxResults' => '50',
        'pageToken' => ''
    );
    
    private $param = '';
    private $clase;
    private $key;
    
    public function addPropetyScope($key, $value){
        $this->scope[$key] = $value;
    }
    
    public function setParam($param){
        $this->param = $param;
    }
    
    public function setKey($key){
        $this->key = $key;
    }
    
    public function getJson(){
        $lista = '';
        switch ($this->param){
            case 'listas_reproduccion':
                $this->clase = new PlayList($this->scope, $this->key);
                $lista = $this->clase->getListId();
                break;
            case 'lista_videos':
                $this->clase = new VideoList($this->scope, $this->key);
                $lista = $this->clase->getListId();
                break;
        }
        
        return $lista;
    }
}