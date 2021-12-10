@extends('base')
    @section('content')
        <div class="col-12">
            <form action="{{ 'asdadsdsa' }}" method="post" class="card" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <fieldset class="form-fieldset">
                                <div class="mb-3">
                                    <label class="form-label required">نام و نام خانوادگی</label>
                                    <input type="text" class="form-control rtl" name="fullName" required autocomplete="off"
                                        value="{{ $fullName ?? '' }}"/>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label required">شماره موبایل</label>
                                    <input type="text" class="form-control rtl" name="phoneNumber" required autocomplete="off"
                                        value="{{ $phoneNumber ?? '' }}"/>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label required">ایمیل</label>
                                    <input type="email" class="form-control rtl" name="email" required autocomplete="off"
                                        value="{{ $email ?? '' }}"/>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label required">نام کاربری</label>
                                    <input type="text" class="form-control rtl" name="username" required autocomplete="off"
                                        value="{{ $username ?? '' }}"/>
                                </div>
                                    <div class="mb-3">
                                        <label class="form-label required">سمت</label>
                                        <select class="form-control rtl" name="role">
                                            <x-role-select-options/>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label ">گذرواژه</label>
                                        <input type="text" class="form-control rtl" name="password"  autocomplete="off"/>
                                    </div>
                            </fieldset>
                        </div>

                        <div class="col-6">

                            <fieldset class="form-fieldset">
                                <div class="mb-3 d-flex flex-row  justify-content-center">
                                    <img id="userIMG"  src="{{ asset('assets/img/avatars/default.jpg') }}" width="200" height="200" class="" style="border: #FFF solid 5px; border-radius: 20px" alt="avatar">
                                </div>
                                <div class="mb-3">
                                    <input type="file" class="form-control" accept="image/jpeg" name="photo">
                                </div>
                            </fieldset>
                        </div>
                    </div>
                    <div class=" ">
                        <div class="form-footer">
                            <button type="submit" class="btn btn-primary " id="submitButton">
                                ثبت
                            </button>
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
        window.addEventListener('load', function() {
            document.querySelector('input[type="file"]').addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    let img = document.getElementById('userIMG');
                    img.onload = () => {
                        URL.revokeObjectURL(img.src);
                    }
                    img.src = URL.createObjectURL(this.files[0]);
                }
            });
        });
    </script>
@endsection


