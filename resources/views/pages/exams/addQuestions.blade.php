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
                            @foreach ($questions as $key => $eachQuestion)
                            <div class="row px-1" data-repeater-item>
                                <div class="col-1 text-center">
                                    @php
                                        echo $index++;
                                    @endphp
                                </div>
                                <div class="col-3">
                                    <input type="text" class="form-control" name="title" value="{{ $eachQuestion['title'] }}" required>
                                </div>
                                <div class="col-1">
                                    <input type="text" class="form-control" name="score" value="{{ $eachQuestion['score'] }}" required>
                                </div>
                                <div class="col-3">
                                    <select class="form-control questionsTypeSelect" name="questionType">
                                        @foreach (questionTypes() as $key => $item)
                                            <option value="{{$key}}" >{{$item}}</option>    
                                        @endforeach
                                    </select>
                                </div>
                                @foreach ($eachQuestion['slaves'] as $eachOption)
                                    <div class="col-3 questionsTypeSection" data-question-type="multiOption">
                                        <div class="row pb-2">
                                            <div class="col-2 d-flex align-items-center justify-content-center">
                                                <input type="radio" name="correctAnswer" value="1" checked>
                                            </div>
                                            <div class="col-10">
                                                <input type="text" class="form-control" name="answer1" required>
                                            </div>
                                        </div>

                                        <div class="row pb-2">
                                            <div class="col-2 d-flex align-items-center justify-content-center">
                                                <input type="radio" name="correctAnswer" value="2" >
                                            </div>
                                            <div class="col-10">
                                                <input type="text" class="form-control" name="answer2" required>
                                            </div>
                                        </div>

                                        <div class="row pb-2">
                                            <div class="col-2 d-flex align-items-center justify-content-center">
                                                <input type="radio" name="correctAnswer" value="3" >
                                            </div>
                                            <div class="col-10">
                                                <input type="text" class="form-control" name="answer3" required>
                                            </div>
                                        </div>

                                        <div class="row pb-2">
                                            <div class="col-2 d-flex align-items-center justify-content-center">
                                                <input type="radio" name="correctAnswer" value="4" >
                                            </div>
                                            <div class="col-10">
                                                <input type="text" class="form-control" name="answer4" required>
                                            </div>
                                        </div>
                                    </div>
                                {{-- @endforeach --}}

                                {{-- @foreach ($eachQuestion as $key => $eachQuestion) --}}
                                    <div class="col-3 questionsTypeSection d-none" data-question-type="trueFalse">
                                        <div class="row pb-2">
                                            <div class="col-2 d-flex align-items-center justify-content-center">
                                                <input type="radio" name="correctAnswer" value="1">
                                            </div>
                                            <div class="col-10">
                                                <input type="text" name="answer1" class="form-control">
                                            </div>
                                        </div>

                                        <div class="row pb-2">
                                            <div class="col-2 d-flex align-items-center justify-content-center">
                                                <input type="radio" name="correctAnswer" value="2" >
                                            </div>
                                            <div class="col-10">
                                                <input type="text" name="answer2" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                {{-- @endforeach --}}

                                {{-- @foreach ($eachQuestion as $key => $eachQuestion) --}}
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
                                @endforeach

                                <div class="col-1 text-center">
                                    <a class="btn btn-danger" data-repeater-delete>
                                        حذف
                                    </a>
                                </div>

                            </div>
                            @endforeach
                            {{-- <div class="row px-1" data-repeater-item>
                                <div class="col-1 text-center">
                                    ۱
                                </div>
                                <div class="col-3">
                                    <input type="text" class="form-control" name="title" value="{{ $questions->questionsTitle }}" required>
                                </div>
                                <div class="col-1">
                                    <input type="text" class="form-control" name="score" value="{{ $questions->questionsTitle }}" required>
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
                                            <input type="radio" name="correctAnswer" value="1" checked>
                                        </div>
                                        <div class="col-10">
                                            <input type="text" class="form-control" name="answer1" required>
                                        </div>
                                    </div>

                                    <div class="row pb-2">
                                        <div class="col-2 d-flex align-items-center justify-content-center">
                                            <input type="radio" name="correctAnswer" value="2" >
                                        </div>
                                        <div class="col-10">
                                            <input type="text" class="form-control" name="answer2" required>
                                        </div>
                                    </div>

                                    <div class="row pb-2">
                                        <div class="col-2 d-flex align-items-center justify-content-center">
                                            <input type="radio" name="correctAnswer" value="3" >
                                        </div>
                                        <div class="col-10">
                                            <input type="text" class="form-control" name="answer3" required>
                                        </div>
                                    </div>

                                    <div class="row pb-2">
                                        <div class="col-2 d-flex align-items-center justify-content-center">
                                            <input type="radio" name="correctAnswer" value="4" >
                                        </div>
                                        <div class="col-10">
                                            <input type="text" class="form-control" name="answer4" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-3 questionsTypeSection d-none" data-question-type="trueFalse">
                                    <div class="row pb-2">
                                        <div class="col-2 d-flex align-items-center justify-content-center">
                                            <input type="radio" name="correctAnswer" value="1">
                                        </div>
                                        <div class="col-10">
                                            <input type="text" name="answer1" class="form-control">
                                        </div>
                                    </div>

                                    <div class="row pb-2">
                                        <div class="col-2 d-flex align-items-center justify-content-center">
                                            <input type="radio" name="correctAnswer" value="2" >
                                        </div>
                                        <div class="col-10">
                                            <input type="text" name="answer2" class="form-control">
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
                         --}}

                            {{-- <hr>

                            <div class="row px-1" data-repeater-item>
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

                          

                                <div class="col-1 text-center">
                                    <a class="btn btn-danger">
                                        حذف
                                    </a>
                                </div>

                            </div>

                            <hr>

                            <div class="row px-1" data-repeater-item>
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

                             

                                <div class="col-1 text-center">
                                    <a class="btn btn-danger">
                                        حذف
                                    </a>
                                </div>

                            </div> --}}
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
                rowSelector.parent().parent().find('.questionsTypeSection[data-question-type=multiOption]').find('input').not('.form-control').first().prop('checked',true);
                break; 
                
            case 'trueFalse':
                rowSelector.parent().parent().find('.questionsTypeSection[data-question-type=trueFalse]').removeClass('d-none');
                rowSelector.parent().parent().find('.questionsTypeSection[data-question-type=trueFalse]').find('input').prop('disabled',false);
                rowSelector.parent().parent().find('.questionsTypeSection[data-question-type=trueFalse]').find('input').not('.form-control').first().prop('checked',true);
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

        
        


