<form method="post" action="{{url('adddo')}}">
    @csrf
    <input type="text" name="test">
    <button>add</button>
</form>