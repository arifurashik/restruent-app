@if ($errors->any())
<div class="alert alert-danger">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

    @foreach ($errors->all() as $error)
    <p>{{ $error }}</p>
    @endforeach

</div>
@endif


@if(Session::has('success'))
<div class="alert alert-success">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <p> {{ Session:: get('success') }}</p>
</div>
@endif



@if (Session::has('error'))
<div class="alert alert-danger">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <P> {{ Session::get('error') }}</P>
</div>
@endif