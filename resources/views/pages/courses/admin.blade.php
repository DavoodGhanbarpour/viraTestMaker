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
                                <th>سطح</th>
                                <th>کد</th>
                                <th>عنوان</th>
                                <th>والد</th>
                                <th class="w-1"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($courses as $eachCourse)
                                <tr>
                                    <td>
                                        <div class="d-flex py-1 align-items-center">
                                            <div class="flex-fill">
                                                <div class="font-weight-medium">{{ coursesLevelTitle( $eachCourse->level ) }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex py-1 align-items-center">
                                            <div class="flex-fill">
                                                <div class="font-weight-medium">{{ $eachCourse->code }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex py-1 align-items-center">
                                            <div class="flex-fill">
                                                <div class="font-weight-medium">{{ $eachCourse->title }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @if ( $eachCourse->parent == 0 )
                                            <div>بدون والد</div>
                                        @else
                                            <div>{{ $courses[ $eachCourse->parent ]['title'] }}</div>
                                            <div>{{ $courses[ $eachCourse->parent ]['code'] }}</div>
                                        @endif

                                     
                                    </td>
                                    <td>
                                        <div class="btn-list flex-nowrap">
                                            <a href="/course/add/{{$eachCourse->code}}" class="btn btn-sm bg-teal w-100">
                                                افزودن زیر مجموعه
                                            </a>
                                            <a class="btn btn-info btn-sm" href="/user/edit/{{$eachCourse->id}}">
                                                ویرایش
                                            </a>
                                            <a class="btn btn-danger btn-sm" href="/user/delete/{{$eachCourse->id}}">
                                                حذف
                                            </a>
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

        
        


