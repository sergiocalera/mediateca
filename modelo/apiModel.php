<?php
include_once ROOT. 'modelo' . DS . 'src' . DS . 'Cliente.php';
include_once ROOT . 'modelo' . DS . 'src' . DS . 'PlayList.php';
include_once ROOT . 'modelo' . DS . 'src' . DS . 'VideoList.php';





//$playList = new PlayList($scopePlayList, $key);
//var_dump( $playList->getListId() );
//var_dump( $playList->getIdForName('Entornos Creativos') );


//$videoList = new VideoList($scopeVideoList, $key);
//var_dump($videoList->getListId());
//$name = "PL49QfD7Cjc0gNVtV6wcg7rnvikssYep0UzMDiiO-O0mw";
//var_dump( $videoList->getIdForName($name));

class apiModel{
    /***************[SCOPE PARA PLAYLIST]**************/
    private $channelId = 'UCQPGruPlVLSM2lVsMcOPMvQ';

//    private $scopePlayList = array(
//        "part" => "snippet",
//        "channelId" => '$channelId',
//        "maxResults" => "5",
//        'pageToken' => ""
//    );

    /*****************[SCOPE PARA VIDEOLIST]*****************/
    private $playListId = 'PLOAi62E9rjCSRzWBkfEqVMByd3sPtlvQI';

//    private $scopeVideoList = array(
//        'part' => 'snippet',
//        'maxResults' => "5",
//        'playlistId' => '$playListId',
//        'pageToken' => ""
//    );
    /******************[PARAMETROS DEL SCOPE]******************/
    private $scope = array(
        'part' => 'snippet',
        'maxResults' => '5',
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