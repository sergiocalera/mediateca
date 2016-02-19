<?php

require_once 'ListJson.php';
require_once 'Cliente.php';

class VideoList extends Cliente implements listJson{
    
    private $listas = array();
    const URL_CONSULTA = "https://www.googleapis.com/youtube/v3/playlistItems?";
    
    public function __construct($scope, $key) {
        parent::__construct($scope, $key);
        $this->consulta();
    }
    
    public function getListId() {
        return json_encode( $this->listas );
    }
    
    public function getIdForName($id) {
        $auxVideoId = "";
        foreach ($this->listas as $object){
            if($object['id'] === $id){
                $auxVideoId = $object['videoId'];
                break;
            }
        }
        return $auxVideoId;
    }
    
    private function consulta(){  
        
        do{
            $url = self::URL_CONSULTA;
            foreach (parent::getScope() as $key => $value){
                $url .= $key . '=' . $value . '&';
            }
            $url .= 'key=' . parent::getKey();
            
            $respuesta = json_decode( file_get_contents($url) );
            
            /***********************[SOLICITUDES]**********************/
            foreach ($respuesta->items as $object){
                
                if(isset($object->snippet->thumbnails->high->url)){
                    array_push($this->listas, array(
                        'id' => $object->id,
                        'fecha' => $object->snippet->publishedAt,
                        'title' => $object->snippet->title,
                        'description' => $object->snippet->description,
                        'thumbnails' => $object->snippet->thumbnails->high->url,
                        'videoId' => $object->snippet->resourceId->videoId
                    ));
                }
            }
            
            if( isset($respuesta->nextPageToken) ){
                $scope = parent::getScope();
                $scope['pageToken'] = $respuesta->nextPageToken;
                parent::setScope($scope);
            }
        }while( isset($respuesta->nextPageToken) );
    }
}