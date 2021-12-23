@extends('base')
    @section('content')
        <div class="col-12">
            <form action="/course/update/{{$course->id}}" method="post" class="card" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="d-flex justify-content-center">
                        <div class="col-5">
                            <fieldset class="form-fieldset">
                                <div class="mb-3">
                                    <label class="form-label required">عنوان</label>
                                    <input type="text" class="form-control rtl" name="title" value="{{ $course->title }}" required autocomplete="off" 
                                    />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label required">دسته بندی</label>
                                    <select class="form-control rtl" name="category" id="parentCombo" required>
                                        <option value="0">بدون دسته بندی</option>
                                        @foreach ($categories as $eachCategory)
                                            
                                            @php
                                                $selected = ( $course->categoryID == $eachCategory->id ) ? 'selected' : '' ;
                                            @endphp
                                            <option {{ $selected }} value="{{$eachCategory->id}}">{{$eachCategory->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </fieldset>
                        </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                       <div class="form-footer">
                            <x-cancel-button/>
                            <x-submit-button/>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    @endsection
@section('styles')
@endsection

@section('scripts')
@endsection


