
@foreach (translatedRole() as $roleKey => $roleItem)
    @php
        $selected = $role == $roleKey ? 'selected' : '';
    @endphp
    <option {{$selected}} value="{{$roleKey}}">{{$roleItem}}</option>
@endforeach
