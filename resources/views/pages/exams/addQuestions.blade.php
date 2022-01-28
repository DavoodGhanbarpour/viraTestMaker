@extends('base')
    @section('content')
        <div class="card">
            <div class="card-body" >
                <div class="col-12">
                    <form action="{{ route('insertQuestions', ['id'=>$examID]) }}" method="post" class="card repeater "  enctype="multipart/form-data">
                        @csrf
                        <div class="card-body border-bottom py-3">
                            <div class="d-flex">
                                <div class="ms-auto ">
                                    <a class="btn bg-teal w-100 " data-repeater-create>
                                        افزودن ردیف جدید
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="my-2 row fix-header" >
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

                        <div data-repeater-list="examQuestions">
                            @php
                                $index = 1;
                            @endphp
                            @if ( !$questions )
                                    
                                
                              
                                <div class="row px-1" data-repeater-item>
                                    <div class="col-1 text-center">
                                        @php
                                            echo $index++;
                                        @endphp
                                    </div>
                                    <div class="col-3">
                                        <input type="text" class="form-control" name="title" value="" required>
                                        <input type="hidden" name="lastQuestionID" value="">
                                    </div>
                                    <div class="col-1">
                                        <input type="text" class="form-control" name="score" value="" required>
                                    </div>
                                    <div class="col-3">
                                        <select class="form-control questionsTypeSelect" name="questionType">
                                            @foreach (questionTypes() as $key => $item)
                                                <option value="{{$key}}" >{{$item}}</option>    
                                            @endforeach
                                        </select>
                                    </div>
                                        <div class="col-3 questionsTypeSection" data-question-type="multiOption">
                                            <div class="row pb-2">
                                                <div class="col-2 d-flex align-items-center justify-content-center">
                                                    <input type="radio" name="correctAnswer" value="1" >
                                                </div>
                                                <div class="col-10">
                                                    <input type="text" class="form-control" name="answer1" value="" required>
                                                </div>
                                            </div>

                                            <div class="row pb-2">
                                                <div class="col-2 d-flex align-items-center justify-content-center">
                                                    <input type="radio" name="correctAnswer" value="2" >
                                                </div>
                                                <div class="col-10">
                                                    <input type="text"  class="form-control" name="answer2" value="" required>
                                                </div>
                                            </div>

                                            <div class="row pb-2">
                                                <div class="col-2 d-flex align-items-center justify-content-center">
                                                    <input type="radio" name="correctAnswer" value="3" >
                                                </div>
                                                <div class="col-10">
                                                    <input type="text" class="form-control" name="answer3" value="" required>
                                                </div>
                                            </div>

                                            <div class="row pb-2">
                                                <div class="col-2 d-flex align-items-center justify-content-center">
                                                    <input type="radio" name="correctAnswer" value="4"  >
                                                </div>
                                                <div class="col-10">
                                                    <input type="text" class="form-control" name="answer4" value="" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-3 questionsTypeSection d-none" data-question-type="trueFalse">
                                            <div class="row pb-2">
                                                <div class="col-2 d-flex align-items-center justify-content-center">
                                                    <input type="radio" name="correctAnswer" value="1"  >
                                                </div>
                                                <div class="col-10">
                                                    <input type="text" class="form-control" name="answer1" value="" required>
                                                </div>
                                            </div>

                                            <div class="row pb-2">
                                                <div class="col-2 d-flex align-items-center justify-content-center">
                                                    <input type="radio" name="correctAnswer" value="2"  >
                                                </div>
                                                <div class="col-10">
                                                    <input type="text"  class="form-control" name="answer2" value="" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-3 questionsTypeSection d-none" data-question-type="description">
                                            <div class="row">
                                                <div class="col-2">
                                                    &nbsp;
                                                </div>
                                                <div class="col-10">
                                                    <textarea class="form-control" name="answer" rows="3"></textarea>
                                                </div>
                                            </div>
                                        </div>

                                    <div class="col-1 text-center">
                                        <a class="btn btn-danger" data-repeater-delete>
                                            حذف
                                        </a>
                                    </div>

                                </div>
                                @else
                                    
                                
                                @foreach ($questions as $key => $eachQuestion)
                                <div class="row px-1" data-repeater-item>
                                    <div class="col-1 text-center">
                                        @php
                                            echo $index++;
                                        @endphp
                                    </div>
                                    <div class="col-3">
                                        <input type="text" class="form-control" name="title" value="{{ $eachQuestion['title'] }}" required>
                                        <input type="hidden" name="lastQuestionID" value="{{ $eachQuestion['id'] }}">
                                    </div>
                                    <div class="col-1">
                                        <input type="text" class="form-control" name="score" value="{{ $eachQuestion['score'] }}" required>
                                    </div>
                                    <div class="col-3">
                                        <select class="form-control questionsTypeSelect" name="questionType">
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
                                                    <input type="radio" name="correctAnswer" value="1"  {{$selected}}>
                                                </div>
                                                <div class="col-10">
                                                    <input type="text" class="form-control" name="answer1" value="{{ $eachQuestion['slavesMultiOption'][0]->optionTitle }}" required>
                                                </div>
                                            </div>

                                            <div class="row pb-2">
                                                <div class="col-2 d-flex align-items-center justify-content-center">
                                                    @php
                                                        $selected = ( $eachQuestion['slavesMultiOption'][1]->correctAnswer == "true" ) ? 'checked' : '' ;
                                                    @endphp 
                                                    <input type="radio" name="correctAnswer" value="2"  {{ ( $eachQuestion['slavesMultiOption'][1]->correctAnswer == "true" ) ? 'checked' : '' ; }}>
                                                </div>
                                                <div class="col-10">
                                                    <input type="text"  class="form-control" name="answer2" value="{{ $eachQuestion['slavesMultiOption'][1]->optionTitle }}" required>
                                                </div>
                                            </div>

                                            <div class="row pb-2">
                                                <div class="col-2 d-flex align-items-center justify-content-center">
                                                    @php
                                                        $selected = ( $eachQuestion['slavesMultiOption'][2]->correctAnswer == "true" ) ? 'checked' : '' ;
                                                    @endphp 
                                                    <input type="radio" name="correctAnswer" value="3"  {{ ( $eachQuestion['slavesMultiOption'][2]->correctAnswer == "true" ) ? 'checked' : '' ; }}>
                                                </div>
                                                <div class="col-10">
                                                    <input type="text" class="form-control" name="answer3" value="{{ $eachQuestion['slavesMultiOption'][2]->optionTitle }}" required>
                                                </div>
                                            </div>

                                            <div class="row pb-2">
                                                <div class="col-2 d-flex align-items-center justify-content-center">
                                                    @php
                                                        $selected = ( $eachQuestion['slavesMultiOption'][3]->correctAnswer == "true" ) ? 'checked' : '' ;
                                                    @endphp 
                                                    <input type="radio" name="correctAnswer" value="4"  {{ ( $eachQuestion['slavesMultiOption'][3]->correctAnswer == "true" ) ? 'checked' : '' ; }}>
                                                </div>
                                                <div class="col-10">
                                                    <input type="text" class="form-control" name="answer4" value="{{ $eachQuestion['slavesMultiOption'][3]->optionTitle }}" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-3 questionsTypeSection d-none" data-question-type="trueFalse">
                                            <div class="row pb-2">
                                                <div class="col-2 d-flex align-items-center justify-content-center">
                                                    @php
                                                        $selected = ( $eachQuestion['slavesTrueFlase'][0]->correctAnswer == "true" ) ? 'checked' : '' ;
                                                    @endphp 
                                                    <input type="radio" name="correctAnswer" value="1"  {{ ( $eachQuestion['slavesTrueFlase'][0]->correctAnswer == "true" ) ? 'checked' : '' ; }}>
                                                </div>
                                                <div class="col-10">
                                                    <input type="text" class="form-control" name="answer1" value="{{ $eachQuestion['slavesTrueFlase'][0]->optionTitle }}" required>
                                                </div>
                                            </div>

                                            <div class="row pb-2">
                                                <div class="col-2 d-flex align-items-center justify-content-center">
                                                    @php
                                                        $selected = ( $eachQuestion['slavesTrueFlase'][1]->correctAnswer == "true" ) ? 'checked' : '' ;
                                                    @endphp 
                                                    <input type="radio" name="correctAnswer" value="2"  {{ ( $eachQuestion['slavesTrueFlase'][1]->correctAnswer == "true" ) ? 'checked' : '' ; }}>
                                                </div>
                                                <div class="col-10">
                                                    <input type="text"  class="form-control" name="answer2" value="{{ $eachQuestion['slavesTrueFlase'][1]->optionTitle }}" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-3 questionsTypeSection d-none" data-question-type="description">
                                            <div class="row">
                                                <div class="col-2">
                                                    &nbsp;
                                                </div>
                                                <div class="col-10">
                                                    <textarea class="form-control" name="answer" rows="3">{{ $eachQuestion['slavesDescription'][0]->optionTitle }}</textarea>
                                                </div>
                                            </div>
                                        </div>

                                    <div class="col-1 text-center">
                                        <a class="btn btn-danger" data-repeater-delete>
                                            حذف
                                        </a>
                                    </div>

                                </div>
                                @endforeach
                            @endif
               
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
                rowSelector.parent().parent().find('.questionsTypeSection[data-question-type=multiOption]').find('input').prop('disabled',false);
                // rowSelector.parent().parent().find('.questionsTypeSection[data-question-type=multiOption]').find('input').not('.form-control').first().prop('checked',true);
                break; 
                
            case 'trueFalse':
                rowSelector.parent().parent().find('.questionsTypeSection[data-question-type=trueFalse]').removeClass('d-none');
                rowSelector.parent().parent().find('.questionsTypeSection[data-question-type=trueFalse]').find('input').prop('disabled',false);
                // rowSelector.parent().parent().find('.questionsTypeSection[data-question-type=trueFalse]').find('input').not('.form-control').first().prop('checked',true);
                break;

            case 'description':
                rowSelector.parent().parent().find('.questionsTypeSection[data-question-type=description]').removeClass('d-none');
                rowSelector.parent().parent().find('.questionsTypeSection[data-question-type=description]').find('textarea').prop('disabled',false);
                break;


            default:
                rowSelector.parent().parent().find('.questionsTypeSection[data-question-type=multiOption]').removeClass('d-none');
                rowSelector.parent().parent().find('.questionsTypeSection[data-question-type=multiOption]').find('input').prop('disabled',false);
                rowSelector.parent().parent().find('.questionsTypeSection[data-question-type=multiOption]').find('input').not('.form-control').first().prop('checked',true);
                break;
        }
    }
</script>
@endsection

        
        


