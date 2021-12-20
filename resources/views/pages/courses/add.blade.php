@extends('base')
    @section('content')
        <div class="col-12">
            <form action="/course/insert" method="post" class="card" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="d-flex justify-content-center">
                        <div class="col-5">
                            <fieldset class="form-fieldset">
                                <div class="mb-3">
                                    <label class="form-label required">عنوان</label>
                                    <input type="text" class="form-control rtl" name="title" required autocomplete="off"
                                        value=""/>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label required">والد</label>
                                    <select class="form-control rtl" name="parent" id="parentCombo" required>
                                        <option value="0">بدون والد</option>
                                        @foreach ($parentCourse as $eachParent)
                                            @php
                                                $selected = ( $parentCode == $eachParent->code ) ? 'selected' : '' ;
                                            @endphp
                                            <option {{ $selected }} value="{{$eachParent->code}}">{{$eachParent->title}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label required">کد</label>
                                    <input type="text" class="form-control rtl" id="nextCode"  disabled autocomplete="off"
                                        value="{{ 0 }}"/>
                                </div>

                            </fieldset>
                        </div>
                        </div>
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
    @endsection
@section('styles')
@endsection

@section('scripts')
    <script>
        getNextCourseCode();
        document.getElementById('parentCombo').addEventListener("change", getNextCourseCode); 




        function getNextCourseCode() 
        {
            let parentCode = document.getElementById('parentCombo').value;
            minAjax({
                url:"/getNextCourseCode",
                type:"POST",
                data: {
                    parentCode: parentCode,        
                    _token: '{{csrf_token()}}'
                },
                success: function(data){
                    data = JSON.parse(data);
                    document.getElementById('nextCode').value = data['nextCode'];
                }
            });    
        }
      

    </script>
@endsection


