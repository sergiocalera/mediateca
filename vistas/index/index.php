<?php
$respuestaJson = json_decode($respuesta);
?>
<!-- Button trigger modal -->
<style type="text/css">
    
    
</style>

<div id="principal">
    <div id="tituloGaleria"><h3>MEDIATECA</h3></div>
    <div id="contenedor" class="row">
        <?php foreach ($respuestaJson as $thum):?>
        <div class="col-md-4" style="width: 360px">
            <a href='' class='thumbnail playList' data-toggle='modal' data-target='#videoModal' 
               data-whatever='<?php echo $thum->title;?>'
               id="<?php echo $thum->id;?>"
               data-container="body" data-toggle="popover" data-placement="bottom" 
               data-content="<?php echo $thum->description;?>">
                <div id="caratula"
                     style="background: url(<?php echo $img['f02.png'];?>) left bottom no-repeat, 
                                        url(<?php echo $thum->thumbnails;?>) left bottom no-repeat;
                                        height : <?php echo $thum->height;?>px;
                                        width : <?php echo $thum->width;?>px" >
                </div>
                <div class="caption" style="width: <?php echo $thum->width;?>px">
                    <h4 class="titleMain"><?php echo $thum->title;?></h4>
                </div>
            </a>
        </div>
        <?php endforeach;?>
    </div>
</div>

<!-- Modal -->
<div>
    <div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="videoModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="videoModalLabel"></h4>
                </div>
                <div class="modal-body">
                    <!-- div de contenido multimedia -->
                    <div id="videoPrincipal">
                        <div class="embed-responsive embed-responsive-4by3">
                            <iframe id='videoYouTube' class="embed-responsive-item" width="490" height="370" src="http://www.youtube.com/embed/UZOr8AAMorw" frameborder="0" allowfullscreen="allowfullscreen" 
                                    data-link="http://www.youtube.com/watch?v=UZOr8AAMorw"></iframe>
                        </div>
                    </div>
                    <!-- div para descripcion-->
                    <br>
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title">
                                    <a class="iconos" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <span class="material-icons">[ + ]</span>
                                        Descripci&oacute;n
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                <div id="descripcion" class="panel-body">
                                    ...
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- div de contenido relacionado -->
                    <div id='contenidoRelacionado'>
                        <!-- div donde se encontraran las listas-->
                        <div id='listaRelacional' class="row">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src='<?php echo $js['jquery-1.12.0.min.js'];?>'> type='text/javascript'></script>
<script src="<?php echo $js['bootstrap.min.js']?>" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $css['bootstrap.min.css'];?>" />

<script src="<?php echo $js['video.js']?>" type="text/javascript"></script>
<link rel='stylesheet' type="text/css" href="<?php echo $css['index.css'];?>"/>