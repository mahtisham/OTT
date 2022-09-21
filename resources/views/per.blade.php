<form action="" method="POST">
    @csrf
    <label for="name">{{__('Permission Name')}}:</label>
    <input type="name" name="name" placeholder="{{__('permission name')}}">
    <input type="submit" value="{{__('Create')}}">
</form>