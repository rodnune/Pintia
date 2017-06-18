@if (session('success'))
    <div class="col-md-12">
        <div class="alert alert-success alert-dismissible col-sm-6" role="alert" style="margin-left: 25%">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="text-center"><i class="fa fa-thumbs-up fa-1x"></i>

                {{session('success')}}
            </h4>
        </div>
    </div>
@endif