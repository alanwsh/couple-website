<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
  <style>
      .home_content{
          padding:3%;
      }
      button:hover{
        cursor: pointer;
      }
  </style>
</head>
<body>
    <button class = "btn btn-primary" id = "addblog" data-toggle = "modal" data-target = "#blogmodal" style = "background:#F14E95; border:none; margin-bottom:10px;">Add Blog</button>
    <h4 style = "margin-bottom:10px;">Our Blogs</h4>
    <div class="container">
        <div class="row">
            <div class="col-3">
                <div class="panel panel-default" style="width: 18rem; border-1px solid black;">
                    <?php $img_path = asset('/image/blog/1.jpg') ?>
                    <img class="card-img-top" style = " width: 100%;
                    height: 15vw;
                    object-fit: cover;" src="{{ $img_path }}" alt="Card image cap">
                    <div class="panel-body">
                      <h5 class="card-title">Travel To China</h5>
                      <p class="card-text">We travelled to China Beijing and Hunan.</p>
                      <a href="#" class="btn btn-primary">View All</a>
                    </div>
                  </div>
            </div>
        </div>
    </div>
  
  <div class="modal fade" id = 'blogmodal' tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add Blog</h5>
        </div>
        <div class="modal-body" style = "width:100%;">
            <label for="blog_title">Blog Title</label>
            <input type="text" name="title" id="title" class = "form-control"><br>
            <label for="description">Blog Description</label>
            <form action="">
                <textarea name="customeditor" id="customeditor"></textarea>
            </form>
        </div>
        <div class="modal-footer" id = "modal-des" style = "text-align:center;">

        </div>
        <div class="modal-footer">
          {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
          <button class = "btn btn-secondary"data-dismiss="modal">Close</button>
          <button class = "btn btn-primary" style = "background:#F14E95;">Submit</button>
        </div>
      </div>
    </div>
  </div>
  <script>
      $(document).ready(function(){
        $('#customeditor').summernote();
      });
  </script>
</body>
</html>
