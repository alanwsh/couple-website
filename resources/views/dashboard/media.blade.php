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
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
 <script src="https://unpkg.com/boxicons@latest/dist/boxicons.js"></script>
    {{-- <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.no-icons.min.css" rel="stylesheet"> --}}
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
<div class="container" style = "margin:2% 0 0 2%">
    <div class="row" style="display:flex; margin-bottom:2%;">
        <div class="col"><h3>Media Library</h3></div>
        <div style = "position: absolute; right:1%;"><but style="background:#F14E95; border-radius:5px; color:white; padding:6px; opacity:1;" data-toggle = "collapse" data-target = "#collapseExample" aria-expanded = "false" aria-controls = "collapseExample">UPLOAD MEDIA</but></div>
    </div>
    <div class="collapse" id="collapseExample">
        <div class="card card-body">
            <form action="" method = "post" enctype="multipart/form-data" id = "my-form">
                @csrf
            <label for="image">Upload Image</label>
                    <input type="file" id = "file">
            <label for="descriptiob">Image Description</label>
                    <input class = "form-control" type="text" name="" id="description"><br>
            <p style = "position:absolute; bottom:2%;"><but id = "img-submit">Submit</but></p>
            </form>
        </div>
      </div>
    <div class="con" id ="media-box" style = " background:#E4E9F7; border-radius:10px; width:120%;height:90vh;overflow:auto; max-height:85vh; padding:2%;" >
        <?php 
            if(count($library) == 0)
            echo "No media at this moment";
            else{
                $media_counter = 1;
                foreach($library as $med){
                    echo "<div class = 'card' id = 'img".$med->id."'>";
                    $img_path = asset('/image/media/'.$media_counter.$med->filetype);
                    echo "<img class = 'library-img' src = ".$img_path." id = 'image".$med->id."'>";
                    echo "<input type = 'hidden' id = 'des".$med->id."' value = '".$med->description."'>";
                    //width:15%; min-width:100px;
                    // echo "<p>".$med->description,"</p>";
                    echo "<div class = 'overlay'><div class = 'text'><box-icon name='show'></box-icon></div></div>";
                    echo "</div>";
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
    console.log($('meta[name="csrf-token"]').attr('content'));
    $('.card').click(function(){
        var img_id = $(this).attr('id').split('img');
        //var image = 'image'+img_id[1];
        //var src = $('#'+image).attr('src');
        $('.modal-title').html('Image '+img_id[1]+'<box-icon name="heart" type="solid" animation="flashing" ></box-icon>');
        $('.modal-body').html('<img style = "height:95%; width:70%;" src = "http://127.0.0.1:8000/image/media/'+img_id[1]+'.jpg">');
        $('#modal-des').text($('#des'+img_id[1]).val());
        $('#mymodal').modal('toggle');
    });
    $('#img-submit').click(function(){
        var form = new FormData();
        var files = $('#file')[0].files;
        var description = $('#description').val();
        if(files.length>0)
            form.append('file',files[0]);
        $.ajax({
            url:'imgupload',
            data:{
                form:form,
                description:description,
            },
            type:'POST',
            contentType:false,
            processData:false,
            success:function(response){
                console.log(response);
            }
        });
    });
</script>