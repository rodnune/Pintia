

@if($errors->any())
    <div class="alert alert-danger alert-dismissible col-sm-6" role="alert" style="margin-left: 25%">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <i class="fa fa-thumbs-down fa-1x"></i>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif


