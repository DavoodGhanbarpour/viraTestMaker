@foreach (translatedRole() as $roleKey => $roleItem)
    <option value="{{$roleKey}}">{{$roleItem}}</option>
@endforeach
