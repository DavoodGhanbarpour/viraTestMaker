@extends('base')
    @section('content')
        <div class="card">
            <div class="card-body" >
                <div class="col-12">
                    <div class="card-body border-bottom py-3">
                        <div class="d-flex">
                            <div class="ms-auto ">
                                <a href="{{ route('addExam') }}" class="btn bg-teal w-100">
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
                                <th>درس</th>
                                <th>استاد</th>
                                <th>تاریخ شروع</th>
                                <th>تاریخ پایان</th>
                                <th>مدت زمان</th>
                                <th>امکان مرور</th>
                                <th>امکان جا به جایی میان سوالات</th>
                                <th>دفعات تکرار آزمون</th>
                                <th class="w-1"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($exams as $eachExam)
                                <tr>
                                    <td>
                                        <div class="d-flex py-1 align-items-center">
                                            <div class="flex-fill">
                                                <div class="font-weight-medium">{{ $eachExam->title }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex py-1 align-items-center">
                                            <div class="flex-fill">
                                                <div class="font-weight-medium">{{ $eachExam->classTitle }}</div>
                                                <div class="text-muted">{{ $eachExam->semesterTitle }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex py-1 align-items-center">
                                            <div class="flex-fill">
                                                <div class="font-weight-medium">{{ $eachExam->teacherName }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex py-1 align-items-center">
                                            <div class="flex-fill">
                                                <div>{{ timestampToJalali( $eachExam->dateStart ) }}</div>
                                                <div class="text-muted">{{ timestampTHours( $eachExam->timeStart ) }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex py-1 align-items-center">
                                            <div class="flex-fill">
                                                <div>{{ timestampToJalali( $eachExam->dateFinish ) }}</div>
                                                <div class="text-muted">{{ timestampTHours( $eachExam->timeFinish ) }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex py-1 align-items-center">
                                            <div class="flex-fill">
                                                <div class="font-weight-medium">{{ timestampTHours($eachExam->timeFinish - $eachExam->timeStart) }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex py-1 align-items-center">
                                            <div class="flex-fill">
                                                <div class="font-weight-medium">{{ trueFalseTitle($eachExam->isReviewAllowed) }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex py-1 align-items-center">
                                            <div class="flex-fill">
                                                <div class="font-weight-medium">{{ trueFalseTitle($eachExam->isMoveAllowed) }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex py-1 align-items-center">
                                            <div class="flex-fill">
                                                <div class="font-weight-medium">{{ $eachExam->timesToTry }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="btn-list flex-nowrap">
                                            <a class="btn btn-warning btn-sm" href="{{route('addQuestions',['id'=>$eachExam->id])}}">
                                                افزودن سوالات
                                            </a>
                                            <a class="btn btn-info btn-sm" href="{{route('editExam',['id'=>$eachExam->id])}}">
                                                ویرایش
                                            </a>
                                            <a class="btn btn-danger btn-sm" href="{{route('deleteExam',['id'=>$eachExam->id])}}">
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

        
        


