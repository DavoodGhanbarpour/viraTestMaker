@extends('base')
    @section('content')
        <div class="card">
            <div class="card-body" >
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-vcenter table-mobile-md card-table">
                            <thead>
                            <tr>
                                <th>نام و نام خانوادگی</th>
                                <th>اطلاعات تکمیلی</th>
                                <th>سمت</th>
                                <th class="w-1"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($users as $eachUser)
                                <tr>
                                    <td data-label="Name">
                                        <div class="d-flex py-1 align-items-center">
                                            <span class="avatar me-2" style="background-image: url( {{ asset('storage'.$eachUser->avatar) }})"></span>
                                            <div class="flex-fill">
                                                <div class="font-weight-medium">{{ $eachUser->name }}</div>
                                                <div class="text-muted">{{ $eachUser->username }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td data-label="Title">
                                        <div>{{ $eachUser->email }}</div>
                                        <div class="text-muted">{{ $eachUser->phoneNumber }}</div>
                                    </td>
                                    <td class="text-muted" data-label="Role">
                                        {{ translatedRole( $eachUser->role ) }}
                                    </td>
                                    <td>
                                        <div class="btn-list flex-nowrap">
                                            <a class="btn btn-info btn-sm" href="/user/edit/{{$eachUser->id}}">
                                                ویرایش
                                            </a>
                                            <a class="btn btn-danger btn-sm" href="/user/delete/{{$eachUser->id}}">
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

        
        


