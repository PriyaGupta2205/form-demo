<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous"> -->
        <!-- Styles -->
        <style>
            .row {
    margin-right: -10px;
    margin-left: -10px;
}
.m-b-20 {
    margin-bottom: 20px;
    text-align:center;
}

.form-control {
    margin-top: 10px;
    padding: .375rem .75rem;
    font-size: 1rem;
    line-height: 1.5;
    width:80%;
    color: #495057;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: .25rem;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
}
.btn-primary {
    background-color: #fff;
    /* background-color: #4a4a4a; */
    border: 1px solid #4a4a4a;
    
}
.btn {
    border-radius: 3px;
    font-family: "Roboto", sans-serif;
    font-size: 15px;
    padding: 4px 10px 8px 10px;
}
</style>
    </head>
    <body style="background-color: #000;color:#fff">
    <div class="content-page">
    <div class="content">
        <div class="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                   
                </div>
                <div class="row">
            <div class="col-md-12 col-lg-12 col-xl-1"></div>
            <div class="col-md-12 col-lg-12 col-xl-10" style="background-color: #363940;margin: 10%;padding: 5%;">
                @if(session()->has('success-message'))
                    <div class="alert alert-success text-center" style="text-align: center;font-size: 20px;color: green;"><b>{{ session()->get('success-message') }}</b></div>
                @endif
                @if(session()->has('error-message'))
                    <div class="alert alert-danger text-center" style="text-align: center;font-size: 20px;color: green;"><b>{{ session()->get('error-message') }}</b></div>
                @endif
                <div class="card m-b-20">
                    <div class="card card-body">
                        <h3 class="card-title font-20 mb-4 text-primary text-center">Edit User Details</h3>
                        <div class="row" id="div-single-registration">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-10">
                                @if(!empty($result_reg_details))
                                @foreach ($result_reg_details as $row)
                                <form id="editDelegateForm" name="editDelegateForm" method="POST" action="/edit" onsubmit="return validateForm();">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="details_id" value="{{$row->details_id}}" required>
                                    <div class="row">
                                        <label class="col-sm-4 col-form-label">ID <span class="required">*</span></label><br>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="id" id="id" value="{{$row->id}}" required>
                                        </div><br>
                                        <label class="col-sm-4 col-form-label">Title <span class="required">*</span></label><br>
                                        <div class="col-sm-8">
                                            <textarea class="form-control" name="title" id="title" required>{{  $row->title }}</textarea>
                                        </div><br>
                                        <label class="col-sm-4 col-form-label">Body<span class="required">*</span></label><br>
                                        <div class="col-sm-8">
                                            <textarea class="form-control" name="body" id="body" required>{{  $row->body }}</textarea>
                                        </div>
                                    </div><br>
                                    <div class="row" style="display: flex;justify-content: center;">
                                        <div class="col-sm-6 text-center">
                                           <button type="button" class="btn btn-primary" style="background-color: #007bff;padding: 10px 20px;"><a href="/" style="text-decoration: none;color: #fff;">Back</a></button>
                                        </div><br>
                                        <div class="col-sm-6 text-center">
                                           <button type="submit" class="btn btn-primary" name="edit_candidate" style="background-color: #007bff;padding: 10px 20px; color: #fff;">Submit</button>
                                        </div>
                                    </div>
                                </form>
                                @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            </div>
        </div>
    </div>
</div>
<script>
        function setInputFilter(textbox, inputFilter) {
  ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
    textbox.addEventListener(event, function() {
      if (inputFilter(this.value)) {
        this.oldValue = this.value;
        this.oldSelectionStart = this.selectionStart;
        this.oldSelectionEnd = this.selectionEnd;
      } else if (this.hasOwnProperty("oldValue")) {
        this.value = this.oldValue;
        this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
      } else {
        this.value = "";
      }
    });
  });
}

setInputFilter(document.getElementById("id"), function(value) {
  return /^-?\d*$/.test(value); });

</script>
    </body>
</html>
