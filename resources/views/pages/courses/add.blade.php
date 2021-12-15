@extends('base')
    @section('content')
        <div class="col-12">
            <form action="/updateProfile" method="post" class="card" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="d-flex justify-content-center">
                        <div class="col-5">
                            <fieldset class="form-fieldset">
                                <div class="mb-3">
                                    <label class="form-label required">عنوان</label>
                                    <input type="text" class="form-control rtl" name="fullName" required autocomplete="off"
                                        value="{{ $fullName ?? '' }}"/>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label required">والد</label>
                                    <select class="form-control rtl" name="parent" id="parentCombo" required>
                                        <option value="0">بدون والد</option>
                                        @foreach ($parentCourse as $eachParent)
                                            <option value="{{$eachParent->code}}">{{$eachParent->title}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label required">کد</label>
                                    <input type="text" class="form-control rtl"  disabled autocomplete="off"
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
    // var document.getEleme
    // $.ajax({
    //     url: "/ajax-request",
    //     type:"POST",
    //     data:{
    //       name:name,
    //       email:email,
    //       mobile_number:mobile_number,
    //       message:message,
    //       _token: _token
    //     },
    //     success:function(response){
    //       console.log(response);
    //       if(response) {
    //         $('.success').text(response.success);
    //         $("#ajaxform")[0].reset();
    //       }
    //     },
    //     error: function(error) {
    //      console.log(error);
    //     }
    // });
</script>
@endsection


