@foreach ( $courses as $eachCourse)
    @php 
        $selectedHTML = $selected == $eachCourse->id ? 'selected' : '' ;
    @endphp
    <option {{$selectedHTML}} value="{{$eachCourse->id}}">{{$eachCourse->title}}</option>
@endforeach
