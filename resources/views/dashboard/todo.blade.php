<head>
    {{-- <link rel="stylesheet" href="css/bootstrap.css"> --}}
    <link rel="stylesheet" href="css/boxicons.min.css">
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
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
            padding-left:3%;
            padding-right:3%;
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

        .category{
            background-image:linear-gradient(to right bottom, #ff9a9e,#fecfef);
            width:200px;
            height:150px;
        }
        h4{
            color:#5e1996;
        }
        h5{
            color:black;
        }
        .summary{
            display: flex;
            flex-wrap:wrap;
            margin-bottom:40px;
            margin-top:40px;
        }
        .card{
            width:90%;
        }
        .summary > div{
            flex:50%;
            margin-bottom:10px;
        }
        .dropdown-menu{
            z-index:2000;
        }

    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
 <script src="https://unpkg.com/boxicons@latest/dist/boxicons.js"></script>
    {{-- <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.no-icons.min.css" rel="stylesheet"> --}}
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    {{-- <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" /> --}}
    <script src="js/jquery.min.js"></script>
    <script src="js/iconPicker.min.js"></script>
    <link href="css/icon-picker.min.css"  rel="stylesheet" type="text/css" />
    <script>
            
                $("#cat_icon").iconPicker();
                $('[data-toggle="tooltip"]').tooltip();
        
    </script>
</head>
<body>
{{-- <div class="container" style = "margin:2% 0 0 2%">
    <button class = "button btn-primary">Hello</button>
    <div class="row" style="display:flex; margin-bottom:2%;">
        <div class="col"><h3>To Do List</h3></div>
    </div>
    <div class="row">--}}
        <div class="content" style = "margin: 20px 20px 0px 20px;">
        <h4 style = "margin-bottom:30px;">Categories</h4>
        <but id = "toggle" style = "margin-bottom:30px;">New Category</but>
        <but id = "toggle2" style = "margin-bottom:30px;">New Todo List</but>
        <?php 
            // foreach($category as $cat){
            //     echo "<div class = 'category'>";
            //     echo "<div class = '".$cat->icon."'<h4>".$cat->name."</h4>";
            //     foreach($todo_list as $todo){
            //         $counter = 0;
            //         if($todo->category == $cat->name)
            //             $counter++;
            //     }
            //     echo "<h5>We have ".$counter." things to do under this category</h5>";
            // }
        ?>
    {{-- <div class="collapse" style = "margin-top:30px;" id="collapseExample">
        <div class="card card-body">
            <form action="imgupload" method = "post" enctype="multipart/form-data" id = "my-form">
            <label for="image">Upload Image</label>
                    <input type="file" name = "upload_file " id = "upload_file">
            <label for="description">Image Description</label>
                    <input class = "form-control" type="text" name="" id="description"><br>
                    <input type="text" name="" class = "icon-picker">
            <p style = "margin-top:20px;"><but id = "img-submit"><input type = "submit" name = "upload" id = "upload" value = "Upload" style = "background:none; border:none;"></but></p>
            </form>
        </div>
      </div> --}}
</div>
<div class="summary"  style = "display:flex; flex-wrap:wrap;">
@foreach($category as $cat)
<div class="card">
    <div class="card-header" style = "display:flex;">
      <h4>{{ $cat->name }}&nbsp;<i class = "{{ $cat->icon }}"></i></h4>
    </div>
    <div class="card-body" style = "position:relative;">
        <div style = "background:#1b809e; position:absolute; height:100%; width:10px;"></div>
      <blockquote class="blockquote mb-0">
        <?php 
        $counter = 0;
        foreach($todo_list as $todo){
            if($todo->status=='incomplete')
            if($todo->category==$cat->name)
                $counter++;
        }?> 
        <p>We have <strong id = "counter{{ $cat->name }}">{{ $counter }}</strong> to do things under this category</p>
        <footer class="blockquote-footer"><cite title="Source Title">{{ $cat->description }}</cite></footer>
      </blockquote>
    </div>
</div>
@endforeach
</div>
<div class="container">
    <div class="row"  style = "display:flex; flex-wrap:wrap;">
        @foreach($category as $cat)
        <div class="col-sm-3" name = "{{ $cat->name }}" style = "background:#E4E9F7; margin-bottom:10px; margin-left:10px; margin-right:10px; padding-bottom:10px;">
            <h3>{{ $cat->name }}&nbsp;<i class = "{{ $cat->icon }}"></i></h3>
        <?php $counter = 0;?>
                @foreach($todo_list as $todo)
                    <?php
                    // $i = 0;
                    // $size = count($todo_list);
                    if($todo->status=='incomplete'){
                    if($todo->category == $cat->name){ 
                        $counter++;
                    ?>
                    <div id = "todo{{ $todo->id }}"style = "background:white; padding:5px;">
                        <div>
                            <h4 id = "title{{ $todo->id }}">{{ $todo->title }}</h4>
                        </div>
                        <div style = "background:white;">
                            <h5 id = "desc{{ $todo->id }}">{{ $todo->description }}</h5>
                            <h6 id = "deadline{{ $todo->id }}">Before {{ $todo->deadline }}</h6>
                        </div>
                        <div style = "background:white;;">
                            <button type="button" id ="edit{{ $todo->id }}" data-toggle = "tooltip" title = "Edit" name = "edit_but" class="btn btn-warning" style = "border:none;"><i class = "glyphicon glyphicon-edit"></i></button>
                            <button type="button" id ="delete{{ $todo->id }}" data-toggle = "tooltip" title = "Delete" name =  "del_but" class="btn btn-danger" style = "border:none;"><i class = "glyphicon glyphicon-remove"></i></button>
                            <button type="button" id ="complete{{ $todo->id }}" data-toggle = "tooltip" title = "Complete" name = "complete_but" class="btn btn-primary" style = "border:none;"><i class = "glyphicon glyphicon-ok"></i></button> 
                        </div>
                    </div>
                    <?php }
                    }
                    ?>
                    
             @endforeach
            <?php 
            $counter = 0; ?>
        </div>
        @endforeach
        <div class="col-sm-3" id = "completed_list" style = "background:#E4E9F7; margin-bottom:10px;margin-left:10px; margin-right:10px; padding-bottom:10px;">
            <h3>Completed &nbsp;<i class = "glyphicon glyphicon-check"></i></h3>
            <?php $counter = 0; ?>
            @foreach($todo_list as $todo)
            <?php if($todo->status=='completed'){?>
                <div style = "background:white; padding:5px;">
                    <div>
                        <h4>{{ $todo->title }}</h4>
                    </div>
                    <div style = "background:white;">
                        <h5>{{ $todo->description }}</h5>
                        <h6>Completed on {{ $todo->completed_on }}</h6>
                    </div>
                </div>
            <?php }?>
            @endforeach
        </div>
    </div>
</div>
<div class="modal" id = 'addcategory' tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add New Category</h5>
        </div>
        <div class="modal-body" style = "width:100%;">
            <form action="" method = "post" id = "my-form">
                <label for="cat_name">Category Name</label>
                        <input class = "form-control"type="text" name = "cat_name " id = "cat_name"><br>
                <label for="description">Category Description</label>
                        <input class = "form-control" type="text" name="" id="cat_description"><br>
                <label for="description">Pick an icon</label>
                        <input type="text" id = "cat_icon" name="cat_icon" class = "icon-picker">
                </form>
        </div>
        <div class="modal-footer">
          <button type="button" id ="closepop" class="btn btn-secondary" data-dismiss = "#addcategory">Close</button>
          <but id = "addcat"data-dismiss="#addcategory">Submit</but> 
        </div>
      </div>
    </div>
  </div>
  <div class="modal" id = 'addtodo' tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add New To-do List</h5>
        </div>
        <div class="modal-body" style = "width:100%;">
            <form action="" method = "post" id = "my-form">
                <label for="todo_name">Task Title</label>
                        <input class = "form-control"type="text" name = "todo_name " id = "todo_name"><br>
                <label for="description">Task Description</label>
                        <input class = "form-control" type="text" name="" id="todo_description"><br>
                <label for="category">Category</label>
                        <select name="category" id="todo_category" class = "form-control">
                        @foreach($category as $cat)
                        <option value="{{ $cat->name }}">{{ $cat->name }}</option>
                        @endforeach
                        </select><br>
                <label for="description">Complete before</label>
                        <input type="date" class = "form-control" id = "todo_deadline">
                </form>
        </div>
        <div class="modal-footer">
          <button type="button" id ="closepop2" class="btn btn-secondary">Close</button>
          <but id = "submittodo">Submit</but> 
        </div>
      </div>
    </div>
  </div>
  <div class="modal" id = 'edittodo' tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit To-do List</h5>
        </div>
        <div class="modal-body" style = "width:100%;">
            <form action="" method = "post" id = "my-form">
                <label for="todo_name">Task Title</label>
                        <input class = "form-control"type="text" name = "todo_name " id = "todo_name2"><br>
                <label for="description">Task Description</label>
                        <input class = "form-control" type="text" name="" id="todo_description2"><br>
                <label for="category">Category</label>
                        <select name="category" id="todo_category2" class = "form-control">
                        @foreach($category as $cat)
                        <option value="{{ $cat->name }}">{{ $cat->name }}</option>
                        @endforeach
                        </select><br>
                <label for="description">Complete before</label>
                        <input type="date" class = "form-control" id = "todo_deadline2">
                </form>
        </div>
        <div class="modal-footer">
          <button type="button" id ="closepop3" class="btn btn-secondary">Close</button>
          <but id = "submit_edit_todo">Submit</but> 
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
   $('#toggle,#closepop').click(function(){
        $('#addcategory').toggle();
   });
   $('button[name=del_but],button[name=complete_but]').click(function(e)
   {
        var date = new Date();
        var dd = String(date.getDate()).padStart(2, '0');
        var mm = String(date.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = date.getFullYear();
        var today = yyyy+'-'+mm+'-'+dd;
        var button_id = $(this).attr('id');
        var id = button_id.match(/\d+/g);
        var request_type =  button_id.match(/[a-zA-Z]+/g);
        var title = $('#title'+id).text();
        var description = $('#desc'+id).text();
        var deadline = $('#deadline'+id).text();
        var category = $(this).parent().parent().parent().attr('name');
        var counter = $('#counter'+category).text();
        if(request_type=='delete'){
            $.ajax({
                url:'todo/delete/'+id,
                method:'post',
                data:{
                    id:id,
                    "_token": "{{ csrf_token() }}"
                    },
                success:function(response){    
                    if(response==true){
                        Swal.fire({
                            icon:'success',
                            title: "",
                            text: "Todo list deleted!",
                            type: "success"
                              }).then(function() {
                                $('#counter'+category).text(parseInt(counter)-1);
                           $('#todo'+id).remove();
                    });
                    }
                    else{
                        Swal.fire(
                            '',
                            'Unable to delete',
                            'error'
                            )
                    }                
                }
            });
        }
        else{
            $.ajax({
                url:'todo/complete/'+id+'/'+today,
                method:'post',
                data:{
                    id:id,
                    "_token": "{{ csrf_token() }}",
                    date:today
                    },
                success:function(response){
                    if(response==true){
                        Swal.fire({
                            icon:'success',
                            title: "",
                            text: "Todo list marked as completed!",
                            type: "success"
                              }).then(function() {
                                $('#counter'+category).text(parseInt(counter)-1);
                                $('#completed_list').append('<div style = "background:white; padding:5px;"><div><h4>'+title+'</h4></div><div style = "background:white;"><h5>'+description+'</h5><h6>Completed on '+today+'</h6></div></div>');
                                $('#todo'+id).remove();
                    });
                    }
                    else{
                        Swal.fire(
                            '',
                            'Unable to mark it as completed',
                            'error'
                            )
                    }
                    
                }
            })
        }

   });
   $('#toggle2,#closepop2').click(function(){
        $('#addtodo').toggle();
   });    

   $('#addcat').click(function(e){
        // e.preventDefault();
        var name = $('#cat_name').val();
        var description = $('#cat_description').val();
        var category = $('#cat_icon').val();
        var error = "";
        if(!name.length)
            error+="Name is required<br>";
        if(!description.length)
            error+="Description is required<br>";
        if(!category.length)
            error+="Icon is required";
        if(error!=""){
            Swal.fire({
                icon:'error',
                html:error
            })
        }   
        else{
        $.ajax({
           url:'todo/category/'+name+'/'+description+'/'+category,
           method:'post',
           data:{ 
               "_token": "{{ csrf_token() }}",
            },
           success:function(response){
               if(response==true){
                Swal.fire({
                            icon:'success',
                            title: "",
                            text: "Category has been added!",
                            type: "success"
                              }).then(function() {
                                        $.ajax({
                                            url:'main',
                                            method:'GET',
                                            data:{id: 3},
                                            success:function(response){
                                                $('.home_content').html(response);
                                                //$("#cat_icon").iconPicker();
                                            }
                                        });
                                // $('.summary').append('<div class = "card"><div class = "card-header"style = "display:flex;"><h4>'+name+'&nbsp;<i class ="'+category+'"></i></h4></div><div class = "card-body" style = "position:relative;"><div style = "background:#1b809e; position:absolute; height:100%; width:10px;"></div><blockquote class = "blockquote mb-0"><p>We have<strong id = "'+name+'"> 0</strong> to do things under this category</p><footer class = "blockquote-footer"><cite title = "Source Title">'+description+'</cite></footer></blockquote></div></div');
                                // $('<div class = "col-sm-3" name = "'+name+'" style = "background:#E4E9F7;margin:0 10px 10px 10px;padding-bottom:10px;"><h3>'+name+'&nbsp;<i class = "'+category+'"></i></h3><div id = ""')
                                // $('#addcategory').toggle();
                            });
               }
               else{
                Swal.fire(
                    '',
                    'Something went wrong',
                    'error'
                );
               }
           } 
        });
    }
   });
   $('#submittodo').click(function(){
    var task_name = $('#todo_name').val();
    var task_desc = $('#todo_description').val();
    var task_deadline = $('#todo_deadline').val();
    var task_category = $('#todo_category').val();
    var error = "";
        if(!task_name.length)
            error+="Name is required<br>";
        if(!task_desc.length)
            error+="Description is required<br>";
        if(!task_deadline.length)
            error+="Deadline is required";
        if(error!=""){
            Swal.fire({
                icon:'error',
                html:error
            })
        }
        else{
            $.ajax({
                url:'todo/addtodo/'+task_name+'/'+task_desc+'/'+task_category+'/'+task_deadline,
                method:'post',
                data:{ 
                    "_token": "{{ csrf_token() }}",
                    },
                success:function(response){
                    if(response==true){
                        Swal.fire({
                                    icon:'success',
                                    title: "",
                                    text: "Todo List has been added!",
                                    type: "success"
                                    }).then(function() {
                                                $.ajax({
                                                    url:'main',
                                                    method:'GET',
                                                    data:{id: 3},
                                                    success:function(response){
                                                        $('.home_content').html(response);
                                                    }
                                                });
                                    });
                }
                else{
                    Swal.fire(
                        '',
                        'Something went wrong',
                        'error'
                    );
                }
            }   
            })
        }   
   });

   $('button[name=edit_but],#closepop3').click(function(){
        if($(this).attr('name')=='edit_but'){
            var button_id = $(this).attr('id');
            var id = button_id.match(/\d+/g);
            var title = $('#title'+id).text();
            var description = $('#desc'+id).text();
            var deadline_text = $('#deadline'+id).text();
            var deadline = deadline_text.split(" ");
            var category = $(this).parent().parent().parent().attr('name');
            $('#todo_name2').val(title);
            $('#todo_description2').val(description);
            $('#todo_deadline2').val(deadline[1]);
            $('#todo_category2').val(category);
            $('#submit_edit_todo').attr('name',id);
        }
        $('#edittodo').toggle();
        $('#submit_edit_todo').click(function(){
            var todo_id = $('#submit_edit_todo').attr('name');
            var todo_title = $('#todo_name2').val();
            var todo_desc = $('#todo_description2').val();
            var todo_category = $('#todo_category2').val();
            var todo_deadline = $('#todo_deadline2').val();
            var error = "";
        if(!todo_title.length)
            error+="Title is required<br>";
        if(!todo_desc.length)
            error+="Description is required<br>";
        if(!todo_deadline.length)
            error+="Deadline is required";
        if(error!=""){
            Swal.fire({
                icon:'error',
                html:error
            })
        }
        else{
            $.ajax({
                url:'todo/edittodo/'+todo_id+'/'+todo_title+'/'+todo_desc+'/'+todo_category+'/'+todo_deadline,
                method:'post',
                data:{ 
                    "_token": "{{ csrf_token() }}",
                    },
                success:function(response){
                    if(response==true){
                        Swal.fire({
                                    icon:'success',
                                    title: "",
                                    text: "Todo List has been edited!",
                                    type: "success"
                                    }).then(function() {
                                                $.ajax({
                                                    url:'main',
                                                    method:'GET',
                                                    data:{id: 3},
                                                    success:function(response){
                                                        $('.home_content').html(response);
                                                    }
                                                });
                                    });
                }
                else{
                    Swal.fire(
                        '',
                        'Something went wrong',
                        'error'
                    );
                }
            }   
            })
        } 
        });
   });

   
</script>