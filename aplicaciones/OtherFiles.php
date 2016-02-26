<?php

class otherFiles{
    
    public static function run($directorio, $controlador){
        $archivosJS = array();
        $archivosCSS = array();
        $archivosImg = array();
        
        if(is_dir( $directorio.DS.$controlador )){
            $gestor_directorio = opendir($directorio.DS.$controlador.DS.'js');
            while(false !== ($nombre = readdir($gestor_directorio))){
                $archivosJS[$nombre] = URL.'mediateca/'.VISTAS.'/'.$controlador.'/js/'.$nombre;
            }

            $gestor_directorio = opendir($directorio.DS.$controlador.DS.'css');
            while(false !== ($nombre = readdir($gestor_directorio))){
                $archivosCSS[$nombre] = URL.'mediateca/'.VISTAS.'/'.$controlador.'/css/'.$nombre;
            }
            
            $gestor_directorio = opendir($directorio.DS.$controlador.DS.'img');
            while(false !== ($nombre = readdir($gestor_directorio))){
                $archivosImg[$nombre] = URL.'mediateca/'.VISTAS.'/'.$controlador.'/img/'.$nombre;
            }
        }
        
        return array( 'js' => $archivosJS, 'css' => $archivosCSS, 'img' => $archivosImg );
    }
}