@if (session()->has('msg'))
    <div><br/></div>
    <div class="alert alert-success alert-dismissible fade in">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>{{ session()->get('msg') }}</strong> 
    </div>
@endif