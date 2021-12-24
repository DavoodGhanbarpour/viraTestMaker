@foreach ($teachers as $eachTeacher)
    @php     
        $selectedHTML = $selected == $eachTeacher->id ? 'selected' : '' ;
    @endphp
    <option  {{$selectedHTML}}  value="{{$eachTeacher->id}}">{{$eachTeacher->name}}</option>
@endforeach
