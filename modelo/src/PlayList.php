<?php
require_once 'Cliente.php';
require_once 'ListJson.php';

class PlayList extends Cliente implements listJson{
    
    private $listas = array();
    private $blockend = array(
        'PLOAi62E9rjCR6pftFQ6ML_a1GCXsbF6H7' => 'Misión Espacial México',
        'PLOAi62E9rjCQgMzHqs1WyYnT4rVmmGstM' => 'Mesa Cuadrada',
        'PLOAi62E9rjCT2I-sgnR8NvMYUI3Pe_wE7' => 'En Corto',
        'PLOAi62E9rjCR8YSg-Gkp7SMCphsT2Hni7' => 'México al Día',
        'PLOAi62E9rjCSS7xTb4shNwhU93dX94WUn' => 'Mesa Cuadrada (2015)'
    );
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
                if( !isset( $this->blockend[$object->id] ) ){
                    array_push($this->listas, array(
                        'id' => $object->id,
                        'publishedAt' => $object->snippet->publishedAt,
                        'title' => $object->snippet->title,
                        'thumbnails' => $object->snippet->thumbnails->medium->url,
                        'width' => $object->snippet->thumbnails->medium->width,
                        'height' => $object->snippet->thumbnails->medium->height,
                        'description' => $object->snippet->description
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