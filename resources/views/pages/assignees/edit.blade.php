@extends('base')
    @section('content')
    <div class="d-flex justify-content-center">
        <div class="col-5">
            <form action="/assign/update/{{ $classID }}" method="post" class="card" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table table-vcenter table-mobile-md card-table" id="studentTable">
                                <thead>
                                <tr>
                                    <th>اختصاص به کلاس</th>
                                    <th>نام {{translatedRole('STUDENT')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($students as $eachStudent)
                                    <tr>
                                        <td>
                                            <div class="d-flex py-1 align-items-center">
                                                <div class="flex-fill">
                                                    @php
                                                        $checked = ( in_array( $eachStudent->id , $assignees ) ) ? 'checked': '';
                                                    @endphp
                                                    <input {{ $checked }} type="checkbox" value="{{ $eachStudent->id }}" name="students[]"/>
                                                    
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex py-1 align-items-center">
                                                <div class="flex-fill">
                                                    <div class="font-weight-medium">{{ $eachStudent->name }}</div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
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
    </div>
    @endsection



@section('styles')
@endsection

@section('scripts')
<script>
    $(document).on('click', '#studentTable tbody tr', function(){
        let status = $(this).find('input:checkbox');
        if( status.prop('checked') == true )
            status.prop('checked',false);
        else
            status.prop('checked',true);
    });
</script>

<x-datepicker-renger/>
@endsection


