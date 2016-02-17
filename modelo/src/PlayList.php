<?php
require_once 'Cliente.php';
require_once 'ListJson.php';

class PlayList extends Cliente implements listJson{
    
    private $listas = array();
    const URL_CONSULTA = "https://www.googleapis.com/youtube/v3/playlists?";
    
    public function __construct($scope, $key) {
        parent::__construct($scope, $key);
        $this->consulta();        
    }
    
    public function getListId(){
        return json_encode( $this->listas );
    }
    
    public function getIdForName($nombre){
        $auxId = "";
        foreach ($this->listas as $object){
            if($object['title'] == $nombre){
                $auxId = $object['id'];
                break;
            }
        }
        return $auxId;
    }
    
    private function consulta(){
        
        do{
            $url = self::URL_CONSULTA;
            foreach(parent::getScope() as $key => $value){
                $url .= $key . '=' . $value . '&';
            }
            $url .= 'key=' . parent::getKey();

            $respuesta = json_decode( file_get_contents($url) );
            
            /****************[solicitudes]****************************/
            
            foreach($respuesta->items as $object){
                array_push($this->listas, array(
                    'id' => $object->id,
                    'publishedAt' => $object->snippet->publishedAt,
                    'title' => $object->snippet->title,
                    'thumbnails' => $object->snippet->thumbnails->high->url
                ));
            }
            if( isset($respuesta->nextPageToken) ){
                $scope = parent::getScope();
                $scope['pageToken'] = $respuesta->nextPageToken;
                parent::setScope($scope);
            }
        }while( isset($respuesta->nextPageToken) );
    }
}