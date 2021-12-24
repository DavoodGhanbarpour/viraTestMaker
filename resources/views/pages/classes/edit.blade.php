@extends('base')
    @section('content')
        <div class="col-12">
            <form action="/class/update/{{$class->id}}" method="post" class="card" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="d-flex justify-content-center">
                            <div class="col-5">
                                <fieldset class="form-fieldset">
                                    <div class="mb-3">
                                        <label class="form-label required">عنوان</label>
                                        <input type="text" class="form-control rtl" name="title" required autocomplete="off"
                                            value="{{ $class->title }}"/>
                                    </div>
                                    <div class="mb-3">
                                        <div class="row">
                                            <div class="col-6">
                                                <label class="form-label required">تاریخ شروع</label>
                                                <input type="text" class="form-control rtl datepickerFrom datepickerFrom" name="timeStart" required autocomplete="off"
                                                value="{{ timestampToJalali( $class->timeStart ) }}"/>
                                            </div>
                                            <div class="col-6">
                                                    <label class="form-label required">تاریخ پایان</label>
                                                <input type="text" class="form-control rtl datepickerTo" name="timeFinish" required autocomplete="off"
                                                value="{{ timestampToJalali( $class->timeFinish ) }}"/>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label required">استاد</label>
                                                <select class="form-control rtl" name="teacher">
                                                    <x-teacher-select-options :selected="$class->teacherID"/>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label required">درس</label>
                                                <select class="form-control rtl" name="course">
                                                    <x-course-select-options :selected="$class->courseID"/>
                                                </select>
                                            </div>
                                        </div>
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
@endsection


