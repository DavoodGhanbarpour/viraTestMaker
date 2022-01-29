@extends('base')
    @section('content')
        <div class="col-12">
            <form action="{{route('updateExam',['id'=>$exam->id])}}" method="post" class="card" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="d-flex justify-content-center">
                        <div class="col-5">
                            <fieldset class="form-fieldset">
                                <div class="mb-3">
                                    <label class="form-label required">عنوان</label>
                                    <input type="text" class="form-control rtl" name="title" required autocomplete="off"
                                        value="{{$exam->title}}"/>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label required">درس</label>
                                    <select class="form-control rtl" name="class">
                                        @foreach ($classes as $eachClass)
                                        @php
                                            $selected = ($eachClass->id == $exam->classID) ? 'selected' : '' ;
                                        @endphp
                                            <option  {{ $selected }} value="{{$eachClass->id}}">{{$eachClass->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label required">نمره کامل آزمون</label>
                                    <input type="text" class="form-control rtl" name="score" required autocomplete="off"
                                        value="{{$exam->score}}"/>
                                </div>
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-6">
                                            <label class="form-label required">تاریخ شروع</label>
                                            <input type="text" class="form-control rtl datepickerFrom" name="dateStart" required autocomplete="off"
                                            value="{{ timestampToJalali( $exam->dateStart ) }}"/>
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label required">تاریخ پایان</label>
                                            <input type="text" class="form-control rtl datepickerTo" name="dateFinish" required autocomplete="off"
                                            value="{{ timestampToJalali( $exam->dateFinish ) }}"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-6">
                                            <label class="form-label required">ساعت شروع</label>
                                            <input type="text" class="form-control rtl timepicker" name="timeStart" required autocomplete="off"
                                            value="{{ timestampTHours( $exam->timeStart ) }}"/>
                                        </div>
                                        <div class="col-6">
                                                <label class="form-label required">ساعت پایان</label>
                                            <input type="text" class="form-control rtl timepicker" name="timeFinish" required autocomplete="off"
                                            value="{{ timestampTHours( $exam->timeFinish ) }}"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label required">چیدمان تصادفی سوالات و گزینه ها</label>
                                    <select class="form-control rtl" name="random">
                                        @php
                                            $trueSelected   = '';
                                            $falseSelected  = '';
                                            if( $exam->isRandom == 'true' )
                                                $trueSelected   = 'selected';
                                            else
                                                $falseSelected  = 'selected';
                                        @endphp
                                        <option {{$trueSelected}} value="TRUE">فعال</option>
                                        <option {{$falseSelected}} value="FALSE">غیرفعال</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label required">مرور آزمون</label>
                                    <select class="form-control rtl" name="review">
                                        @php
                                            $trueSelected   = '';
                                            $falseSelected  = '';
                                            if( $exam->isReviewAllowed == 'true' )
                                                $trueSelected   = 'selected';
                                            else
                                                $falseSelected  = 'selected';
                                        @endphp
                                        <option value="TRUE">فعال</option>
                                        <option value="FALSE">غیرفعال</option>
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
<x-datepicker-renger/>
<x-timepicker/>
@endsection


