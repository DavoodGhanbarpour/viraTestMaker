@extends('base')
    @section('content')
        <div class="card">
            <div class="card-body" >
                <div class="col-12">
                    جمع نمرات اخذ شده : {{$totalScoreOfUser}}
                        <div class="my-2 row fix-header" >
                            <div class="col-1 text-center">
                                <label for="">ردیف</label>
                            </div>
                            <div class="col-3 text-center">
                                <label for="">عنوان</label>
                            </div>
                            <div class="col-1 text-center">
                                <label for="">نمره در نظر گرفته شده</label>
                            </div>
                            <div class="col-3 text-center">
                                <label for="">نوع سوال</label>
                            </div>
                            <div class="col-3 text-center">
                                <label for="">جواب ها</label>
                            </div>
                            <div class="col-1 text-center">
                                <label for="">نمره دریافت شده</label>
                            </div>
                        </div>

                        <div data-repeater-list="examQuestions">
                            @php
                                $index = 1;
                            @endphp
                            @foreach ($questions as $key => $eachQuestion)
                            <div class="row px-1" data-repeater-item>
                                <div class="col-1 text-center">
                                    @php
                                        echo $index++;
                                    @endphp
                                </div>
                                <div class="col-3">
                                    <input type="text" class="form-control" disabled name="title" value="{{ $eachQuestion['title'] }}" required>
                                    <input type="hidden" name="lastQuestionID" disabled value="{{ $eachQuestion['id'] }}">
                                </div>
                                <div class="col-1">
                                    <input type="text" class="form-control" disabled name="score" value="{{ $eachQuestion['score'] }}" required>
                                </div>
                                <div class="col-3">
                                    <select class="form-control questionsTypeSelect" disabled name="questionType">
                                        @foreach (questionTypes() as $key => $item)
                                            @php
                                                $selected = ( $key == $eachQuestion['questionType'] ) ? 'selected' : '' ;
                                            @endphp
                                            <option {{$selected}} value="{{$key}}" >{{$item}}</option>    
                                        @endforeach
                                    </select>
                                </div>
                                    <div class="col-3 questionsTypeSection" data-question-type="multiOption">
                                        <div class="row pb-2">
                                            <div class="col-2 d-flex align-items-center justify-content-center">
                                                @php
                                                    $selected = ( $eachQuestion['slavesMultiOption'][0]->correctAnswer == "true" ) ? 'checked' : '' ;
                                                @endphp 
                                                <input type="radio" name="correctAnswer" disabled value="1"  {{$selected}}>
                                            </div>
                                            <div class="col-10">
                                                <input type="text" class="form-control" disabled name="answer1" value="{{ $eachQuestion['slavesMultiOption'][0]->optionTitle }}" required>
                                            </div>
                                        </div>

                                        <div class="row pb-2">
                                            <div class="col-2 d-flex align-items-center justify-content-center">
                                                @php
                                                    $selected = ( $eachQuestion['slavesMultiOption'][1]->correctAnswer == "true" ) ? 'checked' : '' ;
                                                @endphp 
                                                <input type="radio" name="correctAnswer" disabled value="2"  {{ ( $eachQuestion['slavesMultiOption'][1]->correctAnswer == "true" ) ? 'checked' : '' ; }}>
                                            </div>
                                            <div class="col-10">
                                                <input type="text"  class="form-control" disabled name="answer2" value="{{ $eachQuestion['slavesMultiOption'][1]->optionTitle }}" required>
                                            </div>
                                        </div>

                                        <div class="row pb-2">
                                            <div class="col-2 d-flex align-items-center justify-content-center">
                                                @php
                                                    $selected = ( $eachQuestion['slavesMultiOption'][2]->correctAnswer == "true" ) ? 'checked' : '' ;
                                                @endphp 
                                                <input type="radio" name="correctAnswer" disabled value="3"  {{ ( $eachQuestion['slavesMultiOption'][2]->correctAnswer == "true" ) ? 'checked' : '' ; }}>
                                            </div>
                                            <div class="col-10">
                                                <input type="text" class="form-control" disabled name="answer3" value="{{ $eachQuestion['slavesMultiOption'][2]->optionTitle }}" required>
                                            </div>
                                        </div>

                                        <div class="row pb-2">
                                            <div class="col-2 d-flex align-items-center justify-content-center">
                                                @php
                                                    $selected = ( $eachQuestion['slavesMultiOption'][3]->correctAnswer == "true" ) ? 'checked' : '' ;
                                                @endphp 
                                                <input type="radio" name="correctAnswer" disabled value="4"  {{ ( $eachQuestion['slavesMultiOption'][3]->correctAnswer == "true" ) ? 'checked' : '' ; }}>
                                            </div>
                                            <div class="col-10">
                                                <input type="text" class="form-control" disabled name="answer4" value="{{ $eachQuestion['slavesMultiOption'][3]->optionTitle }}" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-3 questionsTypeSection d-none" data-question-type="trueFalse">
                                        <div class="row pb-2">
                                            <div class="col-2 d-flex align-items-center justify-content-center">
                                                @php
                                                    $selected = ( $eachQuestion['slavesTrueFlase'][0]->correctAnswer == "true" ) ? 'checked' : '' ;
                                                @endphp 
                                                <input type="radio" name="correctAnswer" disabled value="1"  {{ ( $eachQuestion['slavesTrueFlase'][0]->correctAnswer == "true" ) ? 'checked' : '' ; }}>
                                            </div>
                                            <div class="col-10">
                                                <input type="text" class="form-control" disabled name="answer1" value="{{ $eachQuestion['slavesTrueFlase'][0]->optionTitle }}" required>
                                            </div>
                                        </div>

                                        <div class="row pb-2">
                                            <div class="col-2 d-flex align-items-center justify-content-center">
                                                @php
                                                    $selected = ( $eachQuestion['slavesTrueFlase'][1]->correctAnswer == "true" ) ? 'checked' : '' ;
                                                @endphp 
                                                <input type="radio" name="correctAnswer" disabled value="2"  {{ ( $eachQuestion['slavesTrueFlase'][1]->correctAnswer == "true" ) ? 'checked' : '' ; }}>
                                            </div>
                                            <div class="col-10">
                                                <input type="text"  class="form-control" disabled name="answer2" value="{{ $eachQuestion['slavesTrueFlase'][1]->optionTitle }}" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-3 questionsTypeSection d-none" data-question-type="description">
                                        <div class="row">
                                            <div class="col-2">
                                                &nbsp;
                                            </div>
                                            <div class="col-10">
                                                <textarea class="form-control" name="answer" disabled rows="3">{{ $eachQuestion['slavesDescription'][0]->optionTitle }}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-1 text-center">
                                        <label>{{$eachQuestion['slavesDescription'][0]->scoreIfCorrect??$eachQuestion['slavesTrueFlase'][0]->scoreIfCorrect??$eachQuestion['slavesMultiOption'][0]->scoreIfCorrect??'0'}}</label>
                                    </div>
                            </div>
                            @endforeach
               
                        </div>
                        <div class="d-flex justify-content-end">
                            <div class="form-footer">
                                <x-cancel-button/>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
@endsection


@section('styles')
@endsection

@section('scripts')
<script>
$(document).ready(function () {
        $('.repeater').repeater({
            hide: function (deleteElement) {
                if(confirm('آیا از حذف این سوال مطمئن میباشید؟')) {
                    $(this).slideUp(deleteElement);
                }
            },
            isFirstItemUndeletable: true,
        });

        loopThroughReapeterItem();
    });

    $(document).on('change', '.questionsTypeSelect', function (){ changeSelectorRowOptions( $(this) ); });
    $(document).on('click', '[data-repeater-create]', function (){ loopThroughReapeterItem(); });


    function loopThroughReapeterItem() 
    {
        $('[data-repeater-item]').each(function(){
            changeSelectorRowOptions( $(this).find('.questionsTypeSelect'))
        });
    }

    function changeSelectorRowOptions( rowSelector )
    {
        var type =  rowSelector.val();
        rowSelector.parent().parent().find('.questionsTypeSection').addClass('d-none');
        rowSelector.parent().parent().find('.questionsTypeSection').find('input').prop('disabled',true);
        rowSelector.parent().parent().find('.questionsTypeSection').find('textarea').prop('disabled',true);

        switch(type)
        {
            case 'multiOption':
                rowSelector.parent().parent().find('.questionsTypeSection[data-question-type=multiOption]').removeClass('d-none');
                // rowSelector.parent().parent().find('.questionsTypeSection[data-question-type=multiOption]').find('input').prop('disabled',false);
                // rowSelector.parent().parent().find('.questionsTypeSection[data-question-type=multiOption]').find('input').not('.form-control').first().prop('checked',true);
                break; 
                
            case 'trueFalse':
                rowSelector.parent().parent().find('.questionsTypeSection[data-question-type=trueFalse]').removeClass('d-none');
                // rowSelector.parent().parent().find('.questionsTypeSection[data-question-type=trueFalse]').find('input').prop('disabled',false);
                // rowSelector.parent().parent().find('.questionsTypeSection[data-question-type=trueFalse]').find('input').not('.form-control').first().prop('checked',true);
                break;

            case 'description':
                rowSelector.parent().parent().find('.questionsTypeSection[data-question-type=description]').removeClass('d-none');
                // rowSelector.parent().parent().find('.questionsTypeSection[data-question-type=description]').find('textarea').prop('disabled',false);
                break;


            default:
                rowSelector.parent().parent().find('.questionsTypeSection[data-question-type=multiOption]').removeClass('d-none');
                // rowSelector.parent().parent().find('.questionsTypeSection[data-question-type=multiOption]').find('input').prop('disabled',false);
                rowSelector.parent().parent().find('.questionsTypeSection[data-question-type=multiOption]').find('input').not('.form-control').first().prop('checked',true);
                break;
        }
    }
</script>
@endsection

        
        


