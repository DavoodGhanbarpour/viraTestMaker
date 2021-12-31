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
                        <div class="table-responsive">
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
                                            <div class="d-flex py-1 align-items-center">
                                                <div class="">
                                                    <input type="text" class="form-control">
                                                </div>
                                            </div>
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

        
        


