$(function(){
    
    var local = this.location.origin + this.location.pathname;
    var id = '';
    var cantidad = 0;
    var info;
    
    $('#videoModal').on('show.bs.modal', function(event){
        var button = $(event.relatedTarget);
        var titulo = button.data('whatever');
        var info;
        
        solicitar(local + 'api/index/?tipo=lista_videos&idLista=' + id, 'json', function(data){
            if(data.length !== 0){
                info = data;
                cantidad = data.length;
                $('#videoYouTube').attr({
                    'src' : 'http://www.youtube.com/embed/' + data[0]['videoId'],
                    'data-link' : 'http://www.youtube.com/watch?v=' + data[0]['videoId']
                });

                $('#descripcion').html(data[0]['description']);
            }else{
                cantidad = 0;
                $('#videoYouTube').attr({
                    'src' : 'http://www.youtube.com/embed/',
                    'data-link' : 'http://www.youtube.com/watch?v='
                });
                $('#descripcion').html('Sin contenido multimedia')
            }
        });
        
        if(cantidad){
            solicitar(local + 'index/contenido/?items=' + cantidad, 'html', function(data){
                $('#listaRelacional').html(data);
            });
            
            $('#listaRelacional img').each(function(index){
                $(this).attr({
                    'src' : info[index]['thumbnails'],
                    'alt' : info[index]['title']
                });
            });
            
            $('#listaRelacional .title').each(function(index){
                $(this).html(info[index]['title']);
            });
            
            $('#listaRelacional .thumbnail').each(function(index){
                $(this).attr({
                    'id' : info[index]['videoId'],
                    'descripcion' : info[index]['description']
                });
            });
        }
        
        var modal = $(this);
        modal.find('.modal-title').text(titulo);
        
        $('#listaRelacional .thumbnail').click(function(){
            $('#videoYouTube').attr({
                'src' : 'http://www.youtube.com/embed/' + $(this).attr('id'),
                'data-link' :'http://www.youtube.com/watch?v=' + $(this).attr('id')
            });
            $('#descripcion').html( $(this).attr('descripcion'));
        });
    
    });
    
    $('#videoModal').on('hidden.bs.modal', function(event){
        $('#videoYouTube').attr({
            'src' : 'http://www.youtube.com/embed',
            'data-link' : 'http://www.youtube.com/watch?v='
        });
    });
    
    var solicitar = function(url, dataType, funcion){
        $.ajax({
            async : false,
            url : url,
            type : 'GET',
            dataType : dataType,
            success: function(data){
                funcion(data);
            }
        });
    };
    
    $('.playList').click(function(){
        id = this.id;
    });
});