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
                                    <label class="form-label required">تاریخ شروع</label>
                                    <input type="text" class="form-control rtl" name="title" required autocomplete="off"
                                        value="{{ $class->title }}"/>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label required">تاریخ پایان</label>
                                    <input type="text" class="form-control rtl" name="title" required autocomplete="off"
                                        value="{{ $class->title }}"/>
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


