@extends('base')
    @section('content')
        <div class="card">
            <div class="card-body" >
                <div class="col-12">
                    <div class="card-body border-bottom py-3">
                        <div class="d-flex">
                         
                            <div class="ms-auto ">
                                <a href="/course/add/0" class="btn bg-teal w-100">
                                    افزودن
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-vcenter table-mobile-md card-table">
                            <thead>
                            <tr>
                                <th>عنوان</th>
                                <th>دسته بندی</th>
                                <th class="w-1"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($courses as $eachCourse)
                                <tr>
                                    <td data-label="Name">
                                        <div class="d-flex py-1 align-items-center">
                                            <div class="flex-fill">
                                                {{-- <div class="font-weight-medium">{{ $eachCourse->title }}</div> --}}
                                                {{-- <div class="text-muted"><a href="#" class="text-reset">{{ $eachCourse->username }}</a></div> --}}
                                            </div>
                                        </div>
                                    </td>
                                    <td data-label="Title">
                                        {{-- <div>{{ $eachCourse->email }}</div> --}}
                                        {{-- <div class="text-muted">{{ $eachCourse->phoneNumber }}</div> --}}
                                    </td>
                                    <td class="text-muted" data-label="Role">
                                        {{-- {{ translatedRole( $eachCourse->role ) }} --}}
                                    </td>
                                    <td>
                                        <div class="btn-list flex-nowrap">
                                            {{-- <a class="btn btn-info" href="/user/edit/{{$eachCourse->id}}">
                                                ویرایش
                                            </a>
                                            <a class="btn btn-danger" href="/user/delete/{{$eachCourse->id}}">
                                                حذف
                                            </a> --}}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
@endsection


@section('styles')
@endsection

@section('scripts')
    
@endsection

        
        


