<!DOCTYPE html>
<!-- Created By CodingLab - www.codinglabweb.com -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <!--<title> Responsive Sidebar Menu  | CodingLab </title>-->
    <link rel="stylesheet" href="css/boxicons.min.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta name="csrf-token" content="{{ csrf_token() }}" />
   </head>
<body>
  <div class="sidebar" id = "sidebar">
    <div class="logo_content">
      <div class="logo">
        <div class="logo_name">Alan & Lynnie</div>
      </div>
      <i class='bx bx-menu-alt-right' id="btn" ></i>
    </div>
    <ul class="nav_list">
      <li>
        <a href="#"  id = "dashboard" class = "navbar act">
          <i class='bx bx-grid-alt' ></i>
          <span class="links_name">Dashboard</span>
        </a>
        <span class="tooltip">Dashboard</span>
      </li>
      <li>
        <a href="#" id = "profile" class = "navbar">
          <i class='bx bx-user' ></i>
          <span class="links_name">Profile</span>
        </a>
        <span class="tooltip">Profile</span>
      </li>
      <li>
        <a href="#"  id = "to-do" class = "navbar">
          <i class='bx bx-task' ></i>
          <span class="links_name">To do list</span>
        </a>
        <span class="tooltip">To do list</span>
      </li>
      {{-- <li>
        <a href="#">
          <i class='bx bx-pie-chart-alt-2' ></i>
          <span class="links_name">Analytics</span>
        </a>
        <span class="tooltip">Analytics</span>
      </li> --}}
      <li>
        <a href="#" id = "media" class = "navbar">
          <i class='bx bx-folder' ></i>
          <span class="links_name">Media Library</span>
        </a>
        <span class="tooltip">Media Library</span>
      </li>
      <li>
        <a href="#" id = "blog" class = "navbar">
          <i class='bx bx-news' ></i>
          <span class="links_name">Blog</span>
        </a>
        <span class="tooltip">Blog</span>
      </li>
      <li>
        <a href="#" id = "saved" class = "navbar">
          <i class='bx bx-heart' ></i>
          <span class="links_name">Saved</span>
        </a>
        <span class="tooltip">Saved</span>
      </li>
      {{-- <li>
        <a href="#">
          <i class='bx bx-cog' ></i>
          <span class="links_name">Setting</span>
        </a>
        <span class="tooltip">Setting</span>
      </li> --}}
    </ul>
    <div class="profile_content">
      <div class="profile">
        <div class="profile_details">
          <!--<img src="profile.jpg" alt="">-->
          <div class="name_job">
            <div class="name">Prem Shahi</div>
            <div class="job">Web Designer</div>
          </div>
        </div>
        <i class='bx bx-log-out' id="log_out" ></i>
      </div>
    </div>
  </div>
  <div class="home_content"> 
  </div>

  <script>
     $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
   let btn = document.querySelector("#btn");
   let sidebar = document.querySelector(".sidebar");
   let searchBtn = document.querySelector(".bx-search");
   let dashboard = $('#dashboard');
   let profile = $("#profile");
   let todo = $("#to-do");
   let media = $("#media");
   let blog = $("#blog");
   let saved = $("#saved");
   btn.onclick = function() {
     sidebar.classList.toggle("active");
     if(btn.classList.contains("bx-menu")){
       btn.classList.replace("bx-menu" , "bx-menu-alt-right");
     }else{
       btn.classList.replace("bx-menu-alt-right", "bx-menu");
     }
   }
   var nav_container = document.getElementById("sidebar");
   var btns = nav_container.getElementsByClassName("navbar");
   for(var i=0;i<btns.length;i++){
       btns[i].addEventListener("click",function(){
        var current = document.getElementsByClassName("act");
        current[0].className = current[0].className.replace(" act","");
        this.className += " act";
       });
   }

   $.ajax({
            url:'main',
            method:'GET',
            data:{id:1},
            success:function(response){
                $('.home_content').html(response);
            }
        });
  dashboard.click(function(){
        $.ajax({
            url:'main',
            method:'GET',
            data:{id: 1},
            success:function(response){
                $('.home_content').html(response);
            }
        });
  });
  
  profile.click(function(){
        $.ajax({
            url:'main',
            method:'GET',
            data:{id: 2},
            success:function(response){
                $('.home_content').html(response);
            }
        });
  });
  todo.click(function(){
        $.ajax({
            url:'main',
            method:'GET',
            data:{id: 3},
            success:function(response){
                $('.home_content').html(response);
            }
        });
  });
  media.click(function(){
        $.ajax({
            url:'main',
            method:'GET',
            data:{id: 4},
            success:function(response){
                $('.home_content').html(response);
            }
        });
  });
  blog.click(function(){
        $.ajax({
            url:'main',
            method:'GET',
            data:{id: 5},
            success:function(response){
                $('.home_content').html(response);
            }
        });
  });
  saved.click(function(){
        $.ajax({
            url:'main',
            method:'GET',
            data:{id: 6},
            success:function(response){
                $('.home_content').html(response);
            }
        });
  });
//   profile.click(function(){
//     dashboard.attr('class','');
//     profile.attr('class','active');
//   });
  


  </script>

</body>
</html>