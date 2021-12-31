@extends('base')
    @section('content')
        <div class="card">
            <div class="card-body" >
                <div class="col-12">
                    <div class="card-body border-bottom py-3">
                        <div class="d-flex">
                            <div class="ms-auto ">
                                <a href="/semester/add" class="btn bg-teal w-100">
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
                                <th>تاریخ شروع</th>
                                <th>تاریخ پایان</th>
                                <th>وضعیت</th>
                                <th class="w-1"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($semesters as $eachSemester)
                                <tr>
                                    <td data-label="Name">
                                        <div class="d-flex py-1 align-items-center">
                                            <div class="flex-fill">
                                                <div class="font-weight-medium">{{ $eachSemester->title }}</div>
                                                <div class="text-muted">{{ $eachSemester->code }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td >
                                        <div>{{ timestampToJalali( $eachSemester->timeStart ) }}</div>
                                    </td>
                                    <td >
                                        <div>{{ timestampToJalali( $eachSemester->timeFinish ) }}</div>
                                    </td>
                                    <td >
                                        <div class="flex-fill">
                                            <div class="font-weight-medium">{{ trueFalseTitle( $eachSemester->isActive ) }}</div>
                                            <div class="text-muted">{{ semesterTypeTitles( $eachSemester->type ) }}</div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="btn-list flex-nowrap">
                                            @if ( $eachSemester->isActive != 'true' )
                                                <a class="btn btn-warning btn-sm" href="/semester/activate/{{$eachSemester->id}}">
                                                    فعال سازی
                                                </a>
                                            @endif
                                            <a class="btn btn-info btn-sm" href="/semester/edit/{{$eachSemester->id}}">
                                                ویرایش
                                            </a>
                                            <a class="btn btn-danger btn-sm" href="/semester/delete/{{$eachSemester->id}}">
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

        
        


