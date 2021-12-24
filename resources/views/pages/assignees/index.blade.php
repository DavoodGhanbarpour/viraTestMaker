@extends('base')
    @section('content')
        <div class="card">
            <div class="card-body" >
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-vcenter table-mobile-md card-table">
                            <thead>
                            <tr>
                                <th>عنوان</th>
                                <th>تاریخ شروع</th>
                                <th>تاریخ پایان</th>
                                <th>ترم</th>
                                <th>عنوان درس</th>
                                <th>استاد</th>
                                <th>تعداد نفرات</th>
                                <th class="w-1"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($classes as $eachClass)
                                <tr>
                                    <td>
                                        <div class="d-flex py-1 align-items-center">
                                            <div class="flex-fill">
                                                <div class="font-weight-medium">{{ $eachClass->title }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex py-1 align-items-center">
                                            <div class="flex-fill">
                                                <div class="font-weight-medium">{{ timestampToJalali( $eachClass->timeStart ) }}</div>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="d-flex py-1 align-items-center">
                                            <div class="flex-fill">
                                                <div class="font-weight-medium">{{ timestampToJalali( $eachClass->timeFinish ) }}</div>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="d-flex py-1 align-items-center">
                                            <div class="flex-fill">
                                                <div class="font-weight-medium">{{ $eachClass->semesterTitle }}</div>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="d-flex py-1 align-items-center">
                                            <div class="flex-fill">
                                                <div class="font-weight-medium">{{ $eachClass->courseTitle }}</div>
                                            </div>
                                        </div>
                                    </td>


                                    <td>
                                        <div class="d-flex py-1 align-items-center">
                                            <div class="flex-fill">
                                                <div class="font-weight-medium">{{ $eachClass->teacherName }}</div>
                                            </div>
                                        </div>
                                    </td>


                                    
                                    <td>
                                        <div class="d-flex py-1 align-items-center">
                                            <div class="flex-fill">
                                                <div class="font-weight-medium">{{ $eachClass->studentCount }}</div>
                                            </div>
                                        </div>
                                    </td>


                                    <td>
                                        <div class="btn-list flex-nowrap">
                                            <a class="btn btn-teal btn-sm" href="./assign/edit/{{$eachClass->id}}">
                                                افزودن اعضاء
                                            </a>
                                            <a class="btn btn-info btn-sm btnStudentsOfThisClass" data-class="{{$eachClass->id}}" data-bs-toggle="modal" data-bs-target="#modal-students">
                                              لیست اعضاء
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



        <div class="modal modal-blur fade" id="modal-students" tabindex="-1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">لیست اعضاء</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="row mb-3 align-items-end">
                    <div class="col">
                        <div class="input-icon mb-3">
                            <input type="text" class="form-control" id="studentModalSearchInput" placeholder="جستجو">
                            <span class="input-icon-addon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="10" cy="10" r="7"></circle><line x1="21" y1="21" x2="15" y2="15"></line></svg>
                            </span>
                        </div>
                    </div>
                  </div>
                  <div>
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table table-vcenter table-mobile-md card-table" id="assigneesTable">
                                <thead>
                                <tr>
                                    <th>ردیف</th>
                                    <th>نام {{translatedRole('STUDENT')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn me-auto" data-bs-dismiss="modal">بستن</button>
                </div>
              </div>
            </div>
        </div>
@endsection


@section('styles')
@endsection

@section('scripts')
<script>
    $(document).on('click', '.btnStudentsOfThisClass', function(){
        classID = $(this).attr('data-class');
        if( classID )
            getAssigneeAndShowInModal(classID);
    });

    $(document).on('keyup', '#studentModalSearchInput', assigneeModalSearch);
    

    function getAssigneeAndShowInModal(classID) 
    { 
        minAjax({
            url:`./assignees/class/${classID}`,
            type:"GET",
            success: function(data){
                compileAssignToHTML( data );
            }
        });
    }

    function compileAssignToHTML(data) 
    {
        $('#assigneesTable tbody').children().remove();
        let tableData = '';
        if( !data )
            tableData += `<tr>
                <td colspan="2" class="text-center">بدون اعضاء</td>
            </tr>`;
        else
        {
            data        = JSON.parse( data );
            console.log( data)
            let index   = 1;
            for (const key in data.assignees) 
            {
                tableData += `<tr>
                    <td>${index++}</td>
                    <td>${data.assignees[key]}</td>
                </tr>`;
            }
         
        }

       
        $('#assigneesTable tbody').append(tableData);
    }

    function assigneeModalSearch() 
    {
        dataToSearch = $('#studentModalSearchInput').val();

        $('#assigneesTable tbody tr').each(function () {
            if( $(this).text().includes( dataToSearch ) )
                $(this).removeClass('d-none')
            else
                $(this).addClass('d-none')
        });
    }




</script>
@endsection

        
        


