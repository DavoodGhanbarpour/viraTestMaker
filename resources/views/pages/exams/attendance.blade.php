@extends('base')
    @section('content')
        <div class="col-12">
            <form action="/class/insert" method="post" class="card" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="d-flex justify-content-center">
                            <div class="col-5">
                                <fieldset class="form-fieldset">
                                    <div class="mb-3">
                                        <h3 class="text-muted">سوال یک :</h3>
                                        <label class="form-label">{{ $questionsDetails['master']->title }}</label> 
                                    </div>
                                    <hr>
                                    @if ( count( $questionsDetails['slaves'] ) > 1 )
                                        @foreach ($questionsDetails['slaves'] as $eachKey => $eachItem)
                                            <div class="mb-3">
                                                <div class="row">
                                                    <div class="col-1">
                                                        <input type="radio" name="correctAnswer" id="correctAnswer{{$eachKey+1}}">
                                                    </div>
                                                    <div class="col-11">
                                                        <label class="form-label" for="correctAnswer{{$eachKey+1}}">{{$eachItem->title}}</label>
                                                    </div>
                                                </div>
                                            </div> 
                                        @endforeach
                                    @else
                                        <div class="mb-3">
                                            <div class="row">
                                                <div class="col-12">
                                                    <textarea class="form-control" name="correctAnswer" cols="30" rows="10"></textarea>
                                                </div>
                                            </div>
                                        </div> 
                                    @endif
                            
                                    {{-- <div class="mb-3">
                                        <div class="row">
                                            <div class="col-1">
                                                <input type="radio" name="correctAnswer" id="correctAnswer2">
                                            </div>
                                            <div class="col-11">
                                                <label class="form-label" for="correctAnswer2">عنوان</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="row">
                                            <div class="col-1">
                                                <input type="radio" name="correctAnswer" id="correctAnswer3">
                                            </div>
                                            <div class="col-11">
                                                <label class="form-label" for="correctAnswer3">عنوان</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="row">
                                            <div class="col-1">
                                                <input type="radio" name="correctAnswer" id="correctAnswer4">
                                            </div>
                                            <div class="col-11">
                                                <label class="form-label" for="correctAnswer4">عنوان</label>
                                            </div>
                                        </div>
                                    </div> --}}
                                </fieldset>
                            </div>
                        </div>
                    </div>
                    <div class="form-footer">
                        <div class="d-flex justify-content-evenly">
                            <button class="btn">قبلی</button>
                            <button class="btn">بعدی</button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    @endsection



@section('styles')
@endsection

@section('scripts')
<x-datepicker-renger/>
@endsection


