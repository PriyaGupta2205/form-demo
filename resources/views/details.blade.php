<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <!-- Styles -->
        <style>
            .row {
    margin-right: -10px;
    margin-left: -10px;
}
.m-b-20 {
    margin-bottom: 20px;
}
.table td, .table th {
    padding: .75rem;
    vertical-align: top;
    border-top: 1px solid #dee2e6;
}
.table{
    width: 90%;
    /* text-align: center; */
    margin-left: 5%;
}
#export{
  margin-left: 80%;
    margin-top: -7%;
}
#pag{
  padding: 0px 35%;
}
        </style>
    </head>
    <body>
    <div class="content-page">
    <div class="content">
        <div class="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                   
                </div>
                <div class="col-lg-12">
                    <div class="card m-b-20">
                        <div class="card-body">
                            <h4 class="mt-0 m-b-20 header-title" style="text-align: center;">Details List</h4>
                            <table id="datatable-buttons" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Body</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = ($result->currentpage()-1)* $result->perpage() + 1; @endphp
                                @foreach ($result as $row)
                                
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td >{{ $row->id}}</td>
                                    <td style="width:25%";>{{ $row->title }}</td>
                                    <td style="width:50%";>{{ $row->body }}</td>
                                    <td>
                                    <a href="/edit/{{$row->details_id}}" class="btn btn-primary">Edit</a>
                                    <!-- <a href="/delete/{{$row->details_id}}" class="btn btn-primary">Delete</a> -->
                                    <button type="button" data-id="{{$row->details_id}}" class="btn btn-primary trash" data-toggle="modal" data-target="#exampleModal">Delete</button>
                                    </td>
                                </tr>
                                @php $i++; @endphp
                                @endforeach
                            </tbody>
                            </table>
                            <div id="pag">
                            {!! $result->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
     <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary"><a id="delete_record">Save changes</a></button>
        <!-- <input type="hidden" value="{{$row->details_id}}" id="details_id" name="details_id" /> -->
      </div>
    </div>
  </div>
</div>
	 <!--Modal-->
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<!-- <script>
   function exportTasks(_this) {
      let _url = $(_this).data('href');
      window.location.href = _url;
   }
</script> -->
<!-- <script>
$('#myModal').on('shown.bs.modal', function () {
  $('#myInput').trigger('focus')
})
</script> -->
<script>
    $('.trash').click(function(){
    var id=$(this).data('id');
    alert(id);
    $('#delete_record').attr('href','/delete/'+id);
})
</script>
<!-- <script>
     $('#delete_record').click(function(){
       delete_record();
     });
     function logoutFromHall()
       {
        var token = "{{csrf_token()}}";
        var id = $(this).data('id');
        alert(id);
        // $.ajax({
        // url:'/delete',
        // type:'post',
        // data:{_token:token},
        // success: function(response){
        // response
        // window.location.href = "https://ifnr.org/";
        //     },
        // });
      }

    </script> -->
    </body>
</html>
