 @if (Auth::user()->avatar != null )
<div class="container-avatar" >
    <img class="avatar"  src="{{ route('user.avatar',['filename' => Auth::user()->avatar]) }}">
</div>
@endif
