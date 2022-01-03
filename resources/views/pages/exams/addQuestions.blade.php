@extends('base')
    @section('content')
        <div class="card">
            <div class="card-body" >
                <div class="col-12">
                    <form action="/assign/update/" method="post" class="card" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body border-bottom py-3">
                            <div class="d-flex">
                                <div class="ms-auto ">
                                    <a class="btn bg-teal w-100">
                                        افزودن ردیف جدید
                                    </a>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="table-responsive">
                            <table class="table table-vcenter table-mobile-md card-table">
                                <thead>
                                <tr>
                                    <th>ردیف</th>
                                    <th>عنوان</th>
                                    <th>نمره</th>
                                    <th>نوع سوال</th>
                                    <th>گزینه ها</th>
                                    <th class="w-1"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($classes as $key => $eachCategory)
                                    <tr>
                                        <td>
                                            <div class="d-flex py-1 align-items-center">
                                                {{$key+1}}
                                            </div>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control">
                                        </td>
                                        <td>
                                            <div class="d-flex py-1 align-items-center">
                                                <div class="">
                                                    <input type="text" class="form-control">
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex py-1 align-items-center">
                                                <div class="">
                                                    <select class="form-control">
                                                        <option value="" >تشریحی</option>
                                                        <option value="" >صحیح/غلط</option>
                                                        <option value="" >چهار گزینه ای</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex py-1 align-items-center">
                                                <div class="">
                                                    <input type="radio" name="" id="">
                                                    <input type="text" class="form-control">
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="btn-list flex-nowrap">
                                                <a class="btn btn-danger btn-sm" >
                                                    حذف
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div> --}}
                        <div class="my-2 row fix-header">
                            <div class="col-1 text-center">
                                <label for="">ردیف</label>
                            </div>
                            <div class="col-3 text-center">
                                <label for="">عنوان</label>
                            </div>
                            <div class="col-1 text-center">
                                <label for="">نمره</label>
                            </div>
                            <div class="col-3 text-center">
                                <label for="">نوع سوال</label>
                            </div>
                            <div class="col-3 text-center">
                                <label for="">گزینه ها</label>
                            </div>
                            <div class="col-1 text-center">
                                <label for="">اقدامات</label>
                            </div>
                        </div>

                        <div class="row px-1">
                            <div class="col-1 text-center">
                                ۱
                            </div>
                            <div class="col-3">
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-1">
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-3">
                                <select class="form-control">
                                    <option value=""></option>
                                </select>
                            </div>

                            <div class="col-3">
                                <div class="row pb-2">
                                    <div class="col-2 d-flex align-items-center justify-content-center">
                                        <input type="radio" name="" id="">
                                    </div>
                                    <div class="col-10">
                                        <input type="text" class="form-control">
                                    </div>
                                </div>

                                <div class="row pb-2">
                                    <div class="col-2 d-flex align-items-center justify-content-center">
                                        <input type="radio" name="" id="">
                                    </div>
                                    <div class="col-10">
                                        <input type="text" class="form-control">
                                    </div>
                                </div>

                                <div class="row pb-2">
                                    <div class="col-2 d-flex align-items-center justify-content-center">
                                        <input type="radio" name="" id="">
                                    </div>
                                    <div class="col-10">
                                        <input type="text" class="form-control">
                                    </div>
                                </div>

                                <div class="row pb-2">
                                    <div class="col-2 d-flex align-items-center justify-content-center">
                                        <input type="radio" name="" id="">
                                    </div>
                                    <div class="col-10">
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="col-1 text-center">
                                <a class="btn btn-danger">
                                    حذف
                                </a>
                            </div>

                        </div>

                        <hr>

                        <div class="row px-1">
                            <div class="col-1 text-center">
                               ۲
                            </div>
                            <div class="col-3">
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-1">
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-3">
                                <select class="form-control">
                                    <option value=""></option>
                                </select>
                            </div>

                            <div class="col-3">
                                <div class="row pb-2">
                                    <div class="col-2 d-flex align-items-center justify-content-center">
                                        <input type="radio" name="" id="">
                                    </div>
                                    <div class="col-10">
                                        <input type="text" class="form-control">
                                    </div>
                                </div>

                                <div class="row pb-2">
                                    <div class="col-2 d-flex align-items-center justify-content-center">
                                        <input type="radio" name="" id="">
                                    </div>
                                    <div class="col-10">
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="col-1 text-center">
                                <a class="btn btn-danger">
                                    حذف
                                </a>
                            </div>

                        </div>

                        <hr>

                        <div class="row px-1">
                            <div class="col-1 text-center">
                               ۳
                            </div>
                            <div class="col-3">
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-1">
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-3">
                                <select class="form-control">
                                    <option value=""></option>
                                </select>
                            </div>

                            <div class="col-3">
                                <div class="row">
                                    <div class="col-2">
                                        &nbsp;
                                    </div>
                                    <div class="col-10">
                                        <textarea class="form-control" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="col-1 text-center">
                                <a class="btn btn-danger">
                                    حذف
                                </a>
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
        </div>
@endsection


@section('styles')
@endsection

@section('scripts')
    
@endsection

        
        


