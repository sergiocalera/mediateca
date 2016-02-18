<?php
$respuestaJson = json_decode($respuesta);
?>
<!-- Button trigger modal -->

<div class="container-fluid">
    <div class="row">
        <?php foreach ($respuestaJson as $thum):?>
        <div class="col-sm-6 col-md-3">
            <a href='' class='thumbnail playList' data-toggle='modal' data-target='#videoModal' 
               data-whatever='<?php echo $thum->title;?>' id="<?php echo $thum->id;?>">
                <img src='<?php echo $thum->thumbnails;?>' alt='<?php echo $thum->title;?>' class="img-thumbnail">
                <div class="caption">
                    <h4><?php echo $thum->title;?></h4>
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
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">Descripci&oacute;n</h4>
                        </div>
                        <div id="descripcion" class="panel-body">
                            ...
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
<script src="<?php echo $js['video']?>" type="text/javascript"></script>
<link rel='stylesheet' type="text/css" href="<?php echo $css['index'];?>"/>