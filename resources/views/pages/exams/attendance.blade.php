@extends('base')
    @section('content')
        <div class="col-12">
            <form action="" method="post" class="card" id="questionForm" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="d-flex justify-content-center">
                            <div class="col-5">
                                <fieldset class="form-fieldset">
                                    <div class="mb-3">
                                        <div class="row">
                                            <div class="col-5">
                                                <h3 class="text-muted">سوال {{ $questionNumbers[ $questionsDetails['slaves'][0]->questionID ] }} :</h3>
                                            </div>
                                            <div class="col-7 justify-content-end d-flex">
                                                <h5> 
                                                    <span class="text-muted">زمان باقی مانده : </span>
                                                    <span>
                                                        {{ gmdate('H:i:s', $examDetails->timeFinish - ( time() % 86400 ) ) }}
                                                    </span>
                                                </h5>
                                            </div>
                                        </div>
                                        <label class="form-label">{{ $questionsDetails['master']->title }}</label> 
                                    </div>
                                    <hr>
                                    @if ( count( $questionsDetails['slaves'] ) > 1 )
                                        @foreach ($questionsDetails['slaves'] as $eachKey => $eachItem)
                                            <div class="mb-3">
                                                <div class="row">
                                                    <div class="col-1">
                                                        <input type="radio" name="correctAnswer" {{ $eachKey == 0 ? 'checked' : '' }} value="{{$eachItem->id}}" id="correctAnswer{{$eachKey+1}}">
                                                    </div>
                                                    <div class="col-11">
                                                        <label class="form-label" for="correctAnswer{{$eachKey+1}}">{{$eachItem->title}}</label>
                                                    </div>
                                                </div>
                                            </div> 
                                        @endforeach
                                    @else
                                        <div class="mb-3">
                                            <div class="row">
                                                <div class="col-12">
                                                    <textarea class="form-control" name="correctAnswer" cols="30" rows="10"></textarea>
                                                </div>
                                            </div>
                                        </div> 
                                    @endif
                                    {{-- <div class="mb-3">
                                        <div class="row">
                                            <div class="col-1">
                                                <input type="radio" name="correctAnswer" id="correctAnswer2">
                                            </div>
                                            <div class="col-11">
                                                <label class="form-label" for="correctAnswer2">عنوان</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="row">
                                            <div class="col-1">
                                                <input type="radio" name="correctAnswer" id="correctAnswer3">
                                            </div>
                                            <div class="col-11">
                                                <label class="form-label" for="correctAnswer3">عنوان</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="row">
                                            <div class="col-1">
                                                <input type="radio" name="correctAnswer" id="correctAnswer4">
                                            </div>
                                            <div class="col-11">
                                                <label class="form-label" for="correctAnswer4">عنوان</label>
                                            </div>
                                        </div>
                                    </div> --}}
                                </fieldset>
                            </div>
                        </div>
                    </div>
                    <div class="form-footer">
                        <div class="d-flex justify-content-evenly">
                            @if ( !$isFirstQuestion )
                                <a id="previousQ" class="btn">قبلی</a>
                            @endif

                            @if ( !$isLastQuestion )
                                <a id="nextQ" class="btn">بعدی</a>
                            @else
                                <a id="finishE" class="btn">اتمام آزمون</a>
                            @endif
                        </div>
                    </div>
                </div>

            </form>
        </div>
    @endsection



@section('styles')
@endsection

@section('scripts')
<script>
    $(document).on('click', '#previousQ,#nextQ,#finishE', function (e) { 
        changeAction( $(this).attr('id') );
    });

    function changeAction(action) 
    {
        moveType = '';
        switch (action) 
        {
            case 'previousQ':
                moveType = 'prev';
                break;

            case 'nextQ':
                moveType = 'next';
                break;

            case 'finishE':
                moveType = 'finish';
                break;
        }

        if( moveType == 'finish' )
            if ( confirm("آیا برای اتمام آزمون مطمئن میباشید؟") == false ) 
                return;

        lastAction = '{{route('updateExamQuestion',[ 'questionID' =>  $questionsDetails['master']->id ])}}';
        $('#questionForm').attr('action', lastAction + '/' + moveType );
        $('#questionForm').submit();
    }
</script>

<x-datepicker-renger/>
@endsection


