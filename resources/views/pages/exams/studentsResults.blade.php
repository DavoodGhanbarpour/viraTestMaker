@extends('base')
    @section('content')
        <div class="card">
            <div class="card-body" >
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-vcenter table-mobile-md card-table">
                            <thead>
                            <tr>
                                <th>نام دانشجو</th>
                                <th>تاریخ شروع</th>
                                <th>تاریخ پایان</th>
                                <th>مدت زمان</th>
                                <th>نمره اخذ شده سیستمی</th>
                                <th>وضعیت تصحیح</th>
                                <th class="w-1"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($exams as $eachExam)
                                <tr>
                                    <td>
                                        <div class="d-flex py-1 align-items-center">
                                            <div class="flex-fill">
                                                <div class="font-weight-medium">{{ $eachExam->studentName }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex py-1 align-items-center">
                                            <div class="flex-fill">
                                                <div>{{ timestampToJalali( $eachExam->timeStart ) }}</div>
                                                <div class="text-muted">{{ timestampTHours( $eachExam->timeStart ) }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex py-1 align-items-center">
                                            <div class="flex-fill">
                                                <div>{{ timestampToJalali( $eachExam->timeFinish ) }}</div>
                                                <div class="text-muted">{{ timestampTHours( $eachExam->timeFinish ) }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex py-1 align-items-center">
                                            <div class="flex-fill">
                                                <div class="font-weight-medium">{{ gmdate('H:i',$eachExam->timeFinish - $eachExam->timeStart) }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex py-1 align-items-center">
                                            <div class="flex-fill">
                                                <div class="font-weight-medium">{{ $eachExam->sumOfCorrectScores }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex py-1 align-items-center">
                                            <div class="flex-fill">
                                                <div class="font-weight-medium">{{ !$eachExam->hasDescriptionQuestionWithoutAnswer ? 'نیاز به تصحیح ندارد' : 'نیاز به تصحیح دارد' ; }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="btn-list flex-nowrap">
                                            <a class="btn btn-info btn-sm" href="{{ route('examResult', [ 'examID' => $eachExam->id,'studentID' => $eachExam->studentID ]) }}">
                                                نمایش جزئیات
                                            </a> 
                                            <a class="btn btn-info btn-sm" href="{{ route('addScore', [ 'examID' => $eachExam->id, 'studentID' => $eachExam->studentID ]) }}">
                                                تصحیح آزمون
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

        
        


