<head>
    {{-- <link rel="stylesheet" href="css/bootstrap.css"> --}}
    <link rel="stylesheet" href="css/boxicons.min.css">
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        body{
            overflow: auto;
        }
        but{
            background:#F14E95; 
            border-radius:5px; 
            color:white; 
            padding:8px;  
        }
        but:hover{
            cursor:pointer;
        }
        .card{
            /* background: #E4E9F7; */
            position:relative;
            width:50%;
            padding:3%;
            border-radius:12px;
        }
        #media-box{
            display: grid;
            grid-template-columns: repeat(6,1fr);
        }
        .library-img{
            display:block;
            width:150px;
            height:200px;
            object-fit: cover;
        }
        .library-img:hover{
            opacity: 0;
        }
        .text {
            color: white;
            font-size: 15px;
            position: absolute;
            top: 50%;
            left: 50%;
            -webkit-transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
            text-align: center;
        }
        .overlay {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            height: 202px;
            width: 152px;
            opacity: 0;
            transition: .5s ease;
            background-color: rgba(255,255,255,0.5);
            transform:translate(6px,6px);
        }
        .card:hover .overlay {
            opacity: 1;
            cursor:pointer;
        }
        box-icon{
           color:#F14E95 !important;
        }
        .modal-body{
            height:38em;
        }
        .modal-body img{
            position:absolute;
            left:50%;
            top:50%;
            margin-top:-42%; /* This needs to be half of the height */
            margin-left:-35%; /* This needs to be half of the width */
        }

        .card-body{
            background:#E4E9F7;
            margin-bottom: 3%;
        }
        box-icon[name=heart]{
            transform:translate(10px,5px);
        }
        box-icon[name=show]{
            position:absolute;
            transform:translate(-400%,400%);
            opacity: 0;
        }
        /* box-icon[name=show]:hover{
            opacity: 1;
        } */
        .img-hover:hover{
            opacity: 0.5;
            transition: .5s ease;
            background-color: rgba(255,255,255,0.5);
        }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
 <script src="https://unpkg.com/boxicons@latest/dist/boxicons.js"></script>
    {{-- <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.no-icons.min.css" rel="stylesheet"> --}}
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <script>
        $('.img-hover').hover(function(){
            var image = $(this).attr('id');
            var id = image.match(/\d+/g);
            $('.img-hover').css('background-color','rgba(255,255,255,0.5)');
            var image = $(this).attr('id');
            $('#show'+id).css('opacity','1');
        },function(){
            var image = $(this).attr('id');
            var id = image.match(/\d+/g);
            $('.img-hover').css('background-color','none');
            $('#show'+id).css('opacity','0');
        });
    </script>
<div class="container" style = "margin:2% 0 0 2%">
    <div class="row" style="display:flex; margin-bottom:2%;">
        <div class="col"><h3>Media Library</h3></div>
        <div style = "position: absolute; right:1%;"><but id = "coll-media" style="background:#F14E95; border-radius:5px; color:white; padding:6px; opacity:1;">UPLOAD MEDIA</but></div>
    </div>
    <div class="collapse" id="collapseExample">
        <div class="card card-body">
            <form action="imgupload" method = "post" enctype="multipart/form-data" id = "my-form">
            @csrf
            <label for="image">Upload Image</label>
                    <input type="file" name = "image" id = "file">
            <label for="description">Image Description</label>
                    <input class = "form-control" type="text" name="media_description" id="media_description" style="margin-bottom:5px;"><br>
            <p style = "position:absolute; bottom:2%;"><but id = "img-submit"><input type = "submit" name = "upload" id = "upload" value = "Upload" style = "background:none; border:none;"></but></p>
            </form>
        </div>
      </div>
    <div class="container" style = "height:80vh; width:120%; background:#E4E9F7; padding:10px;" >
        <?php 
            if(count($library) == 0)
            echo "No media at this moment";
            else{
                $media_counter = 1;
                foreach($library as $med){
                    echo "<div class = 'div-hover' id = 'img".$med->id."'>";
                    $img_path = asset('/image/media/'.$media_counter.$med->filetype);
                    echo "<img class = 'img-hover' style=' display:inline-block; float:left; margin:10px; height: 200px; width:150px; max-width:100%;' src = ".$img_path." id = 'image".$med->id."'>";
                    echo "<input type = 'hidden' id = 'des".$med->id."' value = '".$med->description."'>";
                    //width:15%; min-width:100px;
                    // echo "<p>".$med->description,"</p>";
                    echo "<div class = 'icon-overlay'><box-icon name='show' id = 'show$med->id'></box-icon></div></div>";
                    $media_counter++;
                }
            }
        ?>
    </div>
</div>

<div class="modal" id = 'mymodal' tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Modal title</h5>
        </div>
        <div class="modal-body" style = "width:100%;">
        </div>
        <div class="modal-footer" id = "modal-des" style = "text-align:center;">

        </div>
        <div class="modal-footer">
          {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
          <but data-dismiss="modal">Close</but>
        </div>
      </div>
    </div>
  </div>
</body>
<script>
    
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $('#coll-media').click(function(){
        $('#collapseExample').collapse('toggle');
    });
    $('.div-hover').click(function(){
        var img_id = $(this).attr('id').split('img');
        //var image = 'image'+img_id[1];
        //var src = $('#'+image).attr('src');
        $('.modal-title').html('Image '+img_id[1]+'<box-icon name="heart" type="solid" animation="flashing" ></box-icon>');
        $('.modal-body').html('<img style = "height:90%; width:65%;" src = "http://127.0.0.1:8000/image/media/'+img_id[1]+'.jpg">');
        $('#modal-des').text($('#des'+img_id[1]).val());
        $('#mymodal').modal('toggle');
    });
    $('#my-form').on('submit',function(event){
        event.preventDefault();
        let formData = new FormData(this);
       
        $.ajax({
            url:'imgupload',
            type:'POST',
            data:formData,
            contentType:false,
            processData:false,
            success:function(response){                
                if(response){
                    if(response.image){
                        Swal.fire({
                        icon:'error',
                        html:response.image
                        })
                    }     
                    else{
                        if(response==true){
                            Swal.fire(
                            '',
                            'Image uploaded',
                            'success'
                            ).then(function() {
                                    $.ajax({
                                    url:'main',
                                    method:'GET',
                                    data:{id: 4},
                                    success:function(response){
                                        $('.home_content').html(response);
                                    }
                                    });
                            });
                        }
                        else{
                            Swal.fire(
                            '',
                            'Unable to upload',
                            'error'
                            )
                        }
                    }
                    
                }
                
            }
        });
    });
</script>