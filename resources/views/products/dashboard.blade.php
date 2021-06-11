<head>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src = "https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src = "https://cdn.datatables.net/1.10.25/js/dataTables.bulma.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.1/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bulma.min.css">
    <script src="https://kit.fontawesome.com/e2059797a7.js" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        $(document).ready(function(){
            let delete_id = 0;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#live_table').DataTable();
            $('.btn-info').click(function(){
                var id = $(this).attr('id');
                console.log(id);
                var p_id = id.split('view');
                var img = $('#img'+p_id[1]).val();
                console.log(img);
                var p_name = $('#product_name').html();
                var p_desc = $('#product_desc').html();
                var p_price = $('#product_price').html();
                $('#p_id').html(p_id[1]);
                $('#p_name').html(p_name);
                $('#p_desc').html(p_desc);
                $('#p_price').html(p_price);
                var img_path = 'http://127.0.0.1:8000/image/product/'+img;
                $('#p_img').html('<img src = "'+img_path+'" style = "height:150px;">');
                $('#product_modal').toggle();
            });
            $('#x_button').click(function(){
                $('#product_modal').toggle();
            });


            $('.btn-danger').click(function(){
                var id = $(this).attr('id');
                id = id.split('delete');
                var p_id = id[1];
                $('#delete_modal').toggle();
                $('#confirm_delete').click(function(){
                console.log('Product ID = '+p_id);
                $.ajax({
                    url:'delete_product',
                    method:'POST',
                    data:{id:p_id},
                    success:function(response){
                        if(response==true){
                            Swal.fire({
                            icon:'success',
                            title: "",
                            text: "Product Deleted!",
                            type: "success"
                              }).then(function() {
                           location.reload();
                        });
                        }
                        else{
                            console.log(response);
                            Swal.fire(
                                '',
                                "Product can't be deleted",
                                'error'
                            ) 
                        }
                    }
                });
            });
            });

            $('.btn-secondary').click(function(){
                $('#delete_modal').toggle();
            });

            
        });
    </script>
</head>
<style>
    thead{
        background-color: #57a0d1 !important;
    }
    th{
        color:white !important;
    }
    .fa-eye,.fa-trash{
        box-shadow: 0 6px 6px rgba(0,0,0,0.2);
    }
</style>
<input type="hidden" id = "sel_del">
<div class="row justify-content-center">
    <div class="col-auto">
<div class="table-responsive" style = "margin:auto; width:80% !important; overflow:hidden;">
    <h1 style = "font-size:40px; margin:5% 0 5% 0;">Product Page</h1>   
<table class = "table table-hover" id = "live_table">
    <thead>
        <tr>
            <th>Action</th>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Price(RM)</th>
        </tr>
    </thead>
    <tbody>
        @foreach($product as $p)
        <tr>
            <?php //$img_path = asset('/image/product/'.$counter.'jpg');?>
            {{-- <td><img src="<?php //echo $img_path; ?>" alt=""></td> --}}
            <td style="display:flex;"><button class="btn btn-info" id = "view{{ $p->id }}"><span class="fa fa-eye" aria-hidden="true" ></span></button><button class="btn btn-danger" id = "delete{{ $p->id }}"><span class="fa fa-trash" aria-hidden="true" ></span></button>
            </td>
            <td id = "product_id">{{ $p->id }}</td>
            <td id = "product_name">{{ $p->name }}</td>
            <td id = "product_desc">{{ $p->description }}</td>
            <td id = "product_price">{{ $p->price }}</td>
            <input type="hidden" value = "{{ $p->img }}" id="img{{ $p->id }}">
        </tr>
        @endforeach
    </tbody>
</table>
</div>
</div>
</div>
{{-- View Modal --}}
<div class="modal" id = "product_modal" tabindex="-1" role="dialog"  style = "height:150%;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><strong>Product Details</strong></h5>
        <button type="button" id = "x_button"class="close" data-dismiss="#product_modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-striped">
            <tr><td><strong>ID</strong></td><td id = "p_id"></td></tr>
            <tr><td><strong>Name</strong></td><td id = "p_name"></td></tr>
            <tr><td><strong>Price(RM)</strong></td><td id = "p_price"></td></tr>
            <tr><td><strong>Image</strong></td><td id = "p_img"></td></tr>
            <tr><td><strong>Description</strong></td><td id = "p_desc"></td></tr>
        </table>
      </div>
    </div>
  </div>
</div>
{{-- Delete Modal --}}
<div class="modal" id = "delete_modal" tabindex="-1" role="dialog"  style = "height:150%;">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"><strong>Delete Product</strong></h5>
        </div>
        <div class="modal-body">
          <p>Are you sure to delete this product?</p>
        </div>
        <div class="modal-footer">
            <button class = "btn btn-secondary">Cancel</button>
            <button class = "btn btn-danger" id = "confirm_delete">Delete</button>
        </div>
      </div>
    </div>
  </div>