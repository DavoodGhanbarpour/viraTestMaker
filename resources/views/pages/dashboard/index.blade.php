@extends('base')
    @section('content')
    <div class="row row-deck row-cards">
      <div class="col-sm-6">
        <div class="row  row-cards">
          <div class="col-md-12">
            <div class="row row-cards">
              <div class="col-sm-4">
                <div class="card">
                  <div class="card-body p-2 text-center">
                    <div class="text-end text-green">
                      <span class="text-green d-inline-flex align-items-center lh-1">
                     
                        {{-- <svg xmlns="http://www.w3.org/2000/svg" class="icon ms-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><polyline points="3 17 9 11 13 15 21 7"></polyline><polyline points="14 7 21 7 21 14"></polyline></svg> --}}
                      </span>
                    </div>
                    <div class="h1 m-0">   {{ $cards['teachersCount'] }}</div>
                    <div class="text-muted mb-3">تعداد اساتید</div>
                  </div>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="card">
                  <div class="card-body p-2 text-center">
                    <div class="text-end text-red">
                      <span class="text-red d-inline-flex align-items-center lh-1">
                      
                        {{-- <svg xmlns="http://www.w3.org/2000/svg" class="icon ms-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><polyline points="3 7 9 13 13 9 21 17"></polyline><polyline points="21 10 21 17 14 17"></polyline></svg> --}}
                      </span>
                    </div>
                    <div class="h1 m-0">  {{ $cards['studentsCount'] }}</div>
                    <div class="text-muted mb-3">تعداد دانش آموزان / دانشجویان</div>
                  </div>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="card">
                  <div class="card-body p-2 text-center">
                    <div class="text-end text-green">
                      <span class="text-green d-inline-flex align-items-center lh-1">
                      
                        {{-- <svg xmlns="http://www.w3.org/2000/svg" class="icon ms-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><polyline points="3 17 9 11 13 15 21 7"></polyline><polyline points="14 7 21 7 21 14"></polyline></svg> --}}
                      </span>
                    </div>
                    <div class="h1 m-0">  {{ $cards['coursesCount'] }}</div>
                    <div class="text-muted mb-3">تعداد دروس</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
     
        </div>
      </div>
      <div class="col-sm-6">
        <div class="row  row-cards">
          <div class="col-12">
            <div class="card">
              <div class="card-header border-0">
                <div class="card-title">فضای ذخیره سازی</div>
              </div>
              <div class="card-body">
                <p class="mb-3">
                  درحال استفاده 
                  <strong>{{ $systemStatics['usedDisk'] }}GB</strong>
                  از 
                  <strong>{{ $systemStatics['totalDisk'] }}GB</strong>
                </p>
                <div class="progress progress-separated mb-3">
                  <div class="progress-bar bg-warning" role="progressbar" style="width: {{$systemStatics['usedPercent']}}%"></div>
                </div>
                <div class="row">
                  <div class="col-auto d-flex align-items-center pe-2">
                    <span class="legend me-2 bg-warning"></span>
                    <span>درحال استفاده</span>
                    <span class="d-none d-md-inline d-lg-none d-xxl-inline ms-2 text-muted">{{ $systemStatics['usedDisk'] }}GB</span>
                  </div>
                  <div class="col-auto d-flex align-items-center ps-2">
                    <span class="legend me-2"></span>
                    <span>آزاد</span>
                    <span class="d-none d-md-inline d-lg-none d-xxl-inline ms-2 text-muted">{{ $systemStatics['freeDisk'] }}GB</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">رویداد های آینده</h3>
              </div>
              <div class="table-responsive">
                <table class="table card-table table-vcenter">
                  <tbody>
                    <tr>
                      <td class="w-50">
                        <a href="#" class="text-reset">
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 14a3.5 3.5 0 0 0 5 0l4 -4a3.5 3.5 0 0 0 -5 -5l-.5 .5" /><path d="M14 10a3.5 3.5 0 0 0 -5 0l-4 4a3.5 3.5 0 0 0 5 5l.5 -.5" /></svg>
                          آزمون پایان ترم
  
                        </a>
                      </td>
                      <td class="text-nowrap text-muted w-25">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 19a9 9 0 0 1 9 0a9 9 0 0 1 9 0" /><path d="M3 6a9 9 0 0 1 9 0a9 9 0 0 1 9 0" /><line x1="3" y1="6" x2="3" y2="19" /><line x1="12" y1="6" x2="12" y2="19" /><line x1="21" y1="6" x2="21" y2="19" /></svg>
                        ساختمان داده ها
                      </td>
                      <td class="text-nowrap text-muted w-25">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><rect x="4" y="5" width="16" height="16" rx="2"></rect><line x1="16" y1="3" x2="16" y2="7"></line><line x1="8" y1="3" x2="8" y2="7"></line><line x1="4" y1="11" x2="20" y2="11"></line><line x1="11" y1="15" x2="12" y2="15"></line><line x1="12" y1="15" x2="12" y2="18"></line></svg>
                      1400/12/12
                      </td>
                    </tr>
                    <tr>
                      <td class="w-50">
                        <a href="#" class="text-reset">
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 14a3.5 3.5 0 0 0 5 0l4 -4a3.5 3.5 0 0 0 -5 -5l-.5 .5" /><path d="M14 10a3.5 3.5 0 0 0 -5 0l-4 4a3.5 3.5 0 0 0 5 5l.5 -.5" /></svg>
                          آزمون میانترم
    
                        </a>
                      </td>
                      <td class="text-nowrap text-muted w-25">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 19a9 9 0 0 1 9 0a9 9 0 0 1 9 0" /><path d="M3 6a9 9 0 0 1 9 0a9 9 0 0 1 9 0" /><line x1="3" y1="6" x2="3" y2="19" /><line x1="12" y1="6" x2="12" y2="19" /><line x1="21" y1="6" x2="21" y2="19" /></svg>
                        ساختمان داده ها
                      </td>
                      <td class="text-nowrap text-muted w-25">
                        <span class="text-warning">
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><rect x="4" y="5" width="16" height="16" rx="2"></rect><line x1="16" y1="3" x2="16" y2="7"></line><line x1="8" y1="3" x2="8" y2="7"></line><line x1="4" y1="11" x2="20" y2="11"></line><line x1="11" y1="15" x2="12" y2="15"></line><line x1="12" y1="15" x2="12" y2="18"></line></svg>
                        1400/10/12
                        </span>
                      </td>
                    </tr>
                </tbody>
              </table>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
    @endsection