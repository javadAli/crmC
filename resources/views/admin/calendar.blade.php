@extends('layout')
@section('content')

<style>

@media only screen and (max-width: 920px){
.contentHeader {
    height: 37%;
}

}
#timeTable{
    display: none;

}

.calendarStaff{
    display: none;
}
</style>
        <div class="container-fluid containerDiv">
            <div class="row">
                 <div class="col-lg-2 col-md-2 col-sm-3 sideBar">
                     <fieldset class="border rounded mt-5 sidefieldSet">
                        <legend  class="float-none w-auto legendLabel mb-0"> تقویم روزانه  </legend>
                             @if(hasPermission(Session::get("asn"),"oppCustCalendarN") > -1)
                            <div class="form-check">
                                <input class="form-check-input p-2 float-end" type="radio" name="settings" id="customerListRadioBtn" checked>
                                <label class="form-check-label me-4" for="assesPast"> لیست مشتریان </label>
                            </div>
                            @endif

                             @if(hasPermission(Session::get("asn"),"oppCalendarN") > -1)
                             @if(hasPermission(Session::get("asn"),"oppjustCalendarN") > -1)
                            <div class="form-check">
                                <input class="form-check-input p-2 float-end" type="radio" name="settings" id="calendarRadioBtn">
                                <label class="form-check-label me-4" for="assesPast"> تقویم روزانه </label>
                            </div>
                            @endif
                            @if(hasPermission(Session::get("asn"),"oppjustCalendarN") > -1)
                            <div class="form-check">
                                <input class="form-check-input p-2 float-end" type="radio" name="settings" id="newCustomerRadioBtn">
                                <label class="form-check-label me-4" for="assesPast"> مشتریان جدید </label>
                            </div>
                            @endif
                           
                            <form action="{{url('/changeDate')}}" method="POST">
                                @csrf
                            <select class="form-select form-select-sm col-sm6" id="month" name="month" style="font-size:16px; width:48%;display:none">
                                @for ($i = 1; $i < 13; $i++)
                                    @switch($i)
                                        @case(1)
                                        <option @if($i==$month) selected @endif value="1">فروردین</option>
                                            @break
                                        @case(2)
                                        
                                        <option @if($i==$month) selected @endif  value="2">اردبهشت</option>
                                            @break
                                        @case(3)
                                        <option @if($i==$month) selected @endif  value="3">خرداد</option>
                                            @break
                                        @case(4)
                                        <option @if($i==$month) selected @endif  value="4">تیر</option>
                                            @break
                                        @case(5)
                                        <option @if($i==$month) selected @endif  value="5">مرداد</option>
                                            @break
                                        @case(6)
                                        <option @if($i==$month) selected @endif  value="6">شهریور</option>
                                            @break
                                        @case(7)
                                        <option @if($i==$month) selected @endif  value="7">مهر</option>
                                            @break
                                        @case(8)
                                        <option @if($i==$month) selected @endif  value="8">آبان</option>
                                            @break
                                        @case(9)
                                        <option @if($i==$month) selected @endif  value="9">آذر</option>
                                            @break
                                        @case(10)
                                        <option @if($i==$month) selected @endif  value="10">دی</option>
                                            @break
                                        @case(11)
                                        <option @if($i==$month) selected @endif  value="11">بهمن</option>
                                            @break
                                        @case(12)
                                        <option @if($i==$month) selected @endif  value="12">اسفند</option>
                                            @break
                                        @default
                                    @endswitch
                                @endfor
                            </select>
                            <select class="form-select form-select-sm col-sm-6 w-50" id="year" name="year" style="font-size:16px; width:48%;display:none">
                                @for ($i = 1397; $i < 1420; $i++)
                                    <option @if($i==$year) selected @endif value="{{$i}}">{{$i}}</option>
                                @endfor
                            </select>
                            <label class="form-lable">کاربر</label>
                            <select class="form-select form-select-sm" name="asn" id="searchByMantagheh">
                                @foreach($employies as $employee)
                                    <option @if($employee->id==$adminId) selected @endif value="{{$employee->id}}">{{$employee->name.' '.$employee->lastName}}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-primary btn-sm"> بازخوانی <i class="fa fa-edit"></i> </button>
                        </form>
                        @endif
                      </fieldset>
                  </div>

                    <div class="col-sm-10 col-md-10 col-sm-12 contentDiv">
                      <div class="row contentHeader pt-1">
                            <div class="form-group col-sm-1 customerStaff mt-1">
                                <input type="text" name="" placeholder="جستجو" class="form-control form-control-sm" id="searchCustomerName">
                            </div>
                            <div class="form-group col-sm-1 customerStaff mt-1">
                                <input type="number" name="" placeholder=" کد " class="form-control form-control-sm" id="searchCustomerCode">
                            </div>
                            <div class="form-group col-sm-1 customerStaff mt-1">
                                <select class="form-select form-select-sm" id="orderByCodeOrName">
                                    <option value="1" hidden>مرتب سازی</option>
                                    <option value="1">اسم</option>
                                    <option value="0">کد</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-1 customerStaff mt-1">
                                <select class="form-select form-select-sm" id="findMantaghehByCity">
                                <option value="شهر" hidden>شهر</option>
                                    @foreach($cities as $city)
                                    <option value="{{$city->SnMNM}}">{{trim($city->NameRec)}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-sm-2 customerStaff mt-1">
                                <select class="form-select form-select-sm" id="searchCustomerByMantagheh">
                                    <option value="مناطق" hidden>مناطق</option>
                                </select>
                            </div>
                            <div class="col-sm-6 text-start">
                                 @if(hasPermission(Session::get("asn"),"oppCalendarN") > -1)
                                  <button class='enableBtn btn-sm btn btn-primary text-warning customerStaff' type="button" disabled id='openDashboard'> داشبورد <i class="fal fa-dashboard"></i></button>
                                  <button class='enableBtn btn-sm btn btn-primary text-warning customerStaff' type="button" disabled id='returnCustomer'> ارجاع <i class="fal fa-history"></i></button>
                                @endif
                          
                                 @if(hasPermission(Session::get("asn"),"oppCalendarN") > 1)
                                   <button class='enableBtn btn btn-primary btn-sm text-warning mx-1' type="button" disabled onclick="openEditCustomerModalForm()">ویرایش <i class="fa fa-plus-square fa-lg"></i></button>
                                 @endif
                                <button class='enableBtn btn btn-primary btn-sm text-warning mx-1' type="button" id="addingNewCustomerBtn">افزودن مشتری   <i class="fa fa-plus-square fa-lg"></i></button>   
                            </div>
                        </div>
                        <div class="row mainContent">
                            <div class="col-lg-12 px-0 pd-0">
                                <table class="table table-bordered border-primary resizableTable" id="timeTable">
                                    <thead class="monthDay text-warning">
                                        <th class="weekDay">روز</th>
										  @for ($i = 0; $i < 7; $i++)
                                          <th class="weekDay">
                                            @switch($i) 
                                               @case(0)شنبه @break
                                                @case(1) یکشنبه @break
                                                @case(2)  دوشنبه @break
                                                @case(3)  سه شنبه @break
                                                @case(4) چهار شنبه @break
                                                @case(5)پنج شنبه @break
                                                @case(6) جمعه  @break
                                                @hefault
                                            @endswitch
                                          </th>
                                     @endfor
                                       
                                    </thead>
                                    <tbody class="monthDay tableBody">
										 @for ($v = 1; $v < 32; $v++)
                                           <tr style="background-color:#b3d1ef">
										         <td >{{$v}}</td> 
                                        
                                        @for($j = 1; $j < 8; $j++)
                                            <td onclick="showTimeTableTasks(this,{{$adminId}})" style="cursor:pointer" class="">
                                                @foreach ($commenDates as $dt)
                                                    @php
                                                        $monthDay=\Morilog\Jalali\Jalalian::fromCarbon(\Carbon\Carbon::parse($dt->specifiedDate))->getDay();
                                                        $commenYear=\Morilog\Jalali\Jalalian::fromCarbon(\Carbon\Carbon::parse($dt->specifiedDate))->getYear();
                                                        $commenMonth=\Morilog\Jalali\Jalalian::fromCarbon(\Carbon\Carbon::parse($dt->specifiedDate))->getMonth();
                                                        $weekDay=\Morilog\Jalali\Jalalian::fromCarbon(\Carbon\Carbon::parse($dt->specifiedDate))->getDayOfWeek();
                                                    @endphp
                                                    @if( $monthDay==$v and $weekDay==$j and $commenYear==$year and $commenMonth==$month)
                                                        {{$dt->count}}
                                                    <input type="radio" style="display: none;" name="" value="{{$dt->specifiedDate}}" id="">
                                                    @endif
                                                    @endforeach
                                            </td>
                                        @endfor
										
								           </tr>
                                         @endfor
									
                                    </tbody>
                                </table>

                                <table class='table table-bordered table-striped table-sm' id="customerTable">
                                    <thead class="tableHeader">
                                        <tr>
                                            <th class="forMobileDisplay" style="width:55px">ردیف</th>
                                            <th class="forMobileDisplay" style="width:66px">کد</th>
                                            <th>اسم</th>
                                            <th class="forMobileDisplay" style="width:222px">آدرس </th>
                                            <th>تلفن</th>
                                            <th>منطقه </th>
                                            <th style="width:88px">انتخاب</th>
                                        </tr>
                                    </thead>
                                    <tbody class="select-highlight tableBody" id="customerListBody1">
                                        @foreach ($customers as $customer)
                                            <tr @if($customer->maxTime) style="background-color:lightblue" @endif>
                                                <td class="forMobileDisplay" style="width:55px">{{$loop->iteration}}</td>
                                                <td class="forMobileDisplay" style="width:66px">{{trim($customer->PCode)}}</td>
                                                <td >{{trim($customer->Name)}}</td>
                                                <td class="forMobileDisplay" style="width:222px">{{trim($customer->peopeladdress)}}</td>
                                                <td>{{trim($customer->PhoneStr)}}</td>
                                                <td>{{trim($customer->NameRec)}}</td>
                                                <td style="width:77px"> <input class="customerList form-check-input" name="customerId" type="radio" value="{{$customer->PSN.'_'.$customer->GroupCode}}"></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                             </table>

                            <div class="row">
                                <div class="col-lg-12" style="height:550px; display:block; overflow-y:scroll;">
                                    <div class="monthlyAction mt-0" id="newCustomerTable" style="display:none; margin-bottom:30px;">
                                        @foreach($eachdays as $eachday)
                                            <div class="eachMonth">
                                                <div class="accordion accordion-flush" id="firstMonth">
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="flush-headingOne">
                                                            <button class="accordion-button collapsed"
                                                               @if(Session::get('adminType')==1 or Session::get('adminType')==5) onclick="showThisDayCustomerForAdmin({{"'".$eachday->addedDate."'"}},
                                                                  {{$loop->iteration}})" @else onclick="showThisDayMyCustomer({{"'".$eachday->addedDate."'"}},{{$loop->iteration}})" @endif type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{$loop->iteration}}" aria-expanded="false" aria-controls="flush-collapse{{$loop->iteration}}">
                                                                  {{\Morilog\Jalali\Jalalian::fromCarbon(\Carbon\Carbon::parse($eachday->addedDate))->format('Y/m/d')}}
                                                                <span class="mx-5" style="border-radius:50%;background-color:black;padding:10px;">{{$eachday->countPeopels}}</span>
                                                            </button>
                                                        </h2>
                                                        <div id="flush-collapse{{$loop->iteration}}" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                                        <button class="btn btn-primary" id="loadMoreData" style="display:none"> بیشتر ...</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div> 
                                </div> 
                            </div> 
                        </div>

                    <div class="row contentFooter"> </div>
                </div>
            </div>
        </div>     
    </div>


<!-- مشتری جدید -->
    <!-- modal of adding new customer -->
    <div class="modal fade dragableModal" id="addingNewCutomer" tabindex="-1"  data-bs-backdrop="static" role="dialog" aria-hidden="true">
       <div class="modal-dialog modal-dialog-scrollable  modal-xl" role="document">
           <div class="modal-content">
               <div class="modal-header" style="margin:0; border:none">
                   <button type="button" class="btn-close btn-danger" style="background-color:red;" data-bs-dismiss="modal" aria-label="Close"></button>
                    <h5 class="modal-title" id="exampleModalLongTitle"> افزودن مشتری </h5>
                </div>
                <div class="modal-body">
                    <form action="{{url('/addCustomer')}}" method="POST"  enctype="multipart/form-data">
                    @csrf    
                    <div class="row">
                         <div class="col-md-3 col-sm-4 ">
                             <div class="form-group">
                                <label class="dashboardLabel dashboardLabel form-label">نام و نام خانوادگی</label>
                                   <input type="text" required class="form-control" autocomplete="off" name="name">
                                </div>
                            </div>
						    <div class="col-md-3 col-sm-4 col-xs-5">
                                <div class="form-group">
                                    <label class="dashboardLabel dashboardLabel form-label">نام رستوران</label>
                                    <input type="text" required class="form-control" autocomplete="off" name="restaurantName">
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-4 col-xs-7">
                                <div class="form-group">
                                    <label class="dashboardLabel dashboardLabel form-label"> شماره همراه  </label>
                                    <input type="tel" required class="form-control" autocomplete="off" name="mobilePhone" maxlength="11">
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-3 col-10">
                                 <div class="form-group ">
                                     <label class="dashboardLabel dashboardLabel form-label"> شماره ثابت </label>
                                         <div class="input-group  input-group-sm">
                                             <input type="tel" style="height:40px !important;" required class="form-control p-0 " autocomplete="off" aria-label="Small" aria-describedby="inputGroup-sizing-sm" name="sabitPhone" min="0"  maxlength = "8">
                                            <div class="input-group-append">
                                                <select class="form-select" name="PhoneCode" id="PhoneCode">
                                                    @foreach($phoeCodes as $code)
                                                    <option value="{{$code->provinceCode}}">{{$code->provinceCode}}</option>
                                                    @endforeach
                                                </select>
                                            </div> &nbsp;
                                       <!--   <span id="addProvinceCode" data-toggle="modal" data-target="#countryCodeModal" style="margin-top:5px; color:blue; font-size:22px;"> <i class="fa fa-plus-circle fa-lg"></i> </sapn> -->
                                       </div>
                                 </div>
                            </div>
                            <div class="col-md-1 col-sm-1 col-1" style="margin-top:33px;"> 
                                <span id="addProvinceCode" data-toggle="modal" data-target="#countryCodeModal" style="margin-top:55px; color:blue; font-size:22px;"> <i class="fa fa-plus-circle fa-lg"></i> </sapn>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="dashboardLabel dashboardLabel form-label"> ادرس کامل  </label>
                                    <input type="text" required class="form-control" autocomplete="off" name="peopeladdress">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="dashboardLabel dashboardLabel form-label"> جنسیت</label>
                                    <select class="form-select" name="gender">
                                        <option value="2">مرد</option>
                                        <option value="1" >زن</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="dashboardLabel dashboardLabel form-label"> شهر</label>
                                    <select class="form-select" id="searchCity" name="snNahiyeh">
                                        @foreach($cities as $city)
                                        <option value="{{$city->SnMNM}}" >{{$city->NameRec}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
							   <div class="col-md-2">
                                <div class="form-group">
                                    <label class="dashboardLabel dashboardLabel form-label"> منطقه </label>
                                    <select class="form-select" id="searchMantagheh" name="snMantagheh">
                                        @foreach ($mantagheh as $mantaghe)
                                        <option value="{{$mantaghe->SnMNM}}">{{$mantaghe->NameRec}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
							  <div class="col-md-2">
                                 <div class="form-group">
                                    <label class="dashboardLabel dashboardLabel form-label"> نوع مشتری </label>
                                    <select class="form-select" name="secondGroupCode">
										<option value="7" >رستوران</option>
										<option value="8" >کترينگ</option>
										<option value="9" >فست فود</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                       
                        <div class="row">
                            @if(Session::get('adminType')==1 or Session::get('adminType')==5)
                            <div class="col-md-2">
                                <div class="form-group">
                                <label class="dashboardLabel dashboardLabel form-label">پشتیبان</label>
                                    <select class="form-select" name="adminId">
                                        @foreach($admins as $admin)
                                        <option value="{{$admin->id}}">{{$admin->name.' '.$admin->lastName}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @else
                            <input type="hidden" name="adminId" value="{{Session::get('asn')}}">
                            @endif
                            <div class="col-md-4">
                               <div class="form-group">
                                    <label class="dashboardLabel dashboardLabel form-label"> عکس </label>
								    <input type="file" class="form-control" name="picture" accept="image/*" capture="user">
                                </div>
                            </div>  
							<div class="col-md-3">           
                                 <input type="text" id="customerLocation" name="location">  
                               <button type="button" class="btn btn-success mt-3" id="openCurrentLocationModal" >دریافت لوکیشن خودکار</button>
                           </div>
						</div>
                        <div class="modal-footer mt-2">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal"> انصراف <i class="fa-solid fa-xmark"> </i> </button>
                            <button type="submit" class="btn btn-primary">ذخیره <i class="fa fa-save" aria-hidden="true"> </i> </button>
                        </div>
                    </form>
                </div>
            </div>
        </div> 
    </div>
		
    <div class="modal" id="currentLocationModal" tabindex="-1" data-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable  modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" style="background-color:red"></button>
                    <h5 class="modal-title" id="exampleModalLabel"> تعیین موقعیت </h5>
                </div>
                    <div class="modal-body">
                            <div id="mapId" style="width: 100%; height: 60vh"></div> 
                    </div>
                <div class="modal-footer">
                        <button type="button" class="btn btn-primary" disabled id="saveLocationBtn" onclick="saveLocation()">ذخیره <i class="fa fa-save"></i> </button>
                    <input type="text" id="currentLocationInput">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">بستن <i class="fa fa-x-mark"></i> </button>
                </div>
            </div>
        </div>
    </div>

    <!-- modal of editting new customer -->
    <div class="modal fade dragableModal" id="editNewCustomer" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable  modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header" style="margin:0; border:none">
                    <h5 class="modal-title" id="exampleModalLongTitle"> ویرایش مشتری</h5>
                </div>
                <div class="modal-body">
                    <form action="{{url('/editCustomer')}}" method="POST"  enctype="multipart/form-data">
                    @csrf   
                    <input type="hidden" name="customerId" id="customerID" value="3004345"> 
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="dashboardLabel dashboardLabel form-label">نام و نام خانوادگی</label>
                                    <input type="text" required class="form-control" autocomplete="off" name="name" id="name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="dashboardLabel dashboardLabel form-label">کد</label>
                                    <input type="text" required class="form-control" autocomplete="off" name="PCode" id="PCode">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="dashboardLabel dashboardLabel form-label"> شماره همراه  </label>
                                    <input type="number" required class="form-control" autocomplete="off" name="mobilePhone" id="mobilePhone">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="dashboardLabel dashboardLabel form-label"> شماره ثابت </label>
                                    <input type="number" required class="form-control" autocomplete="off" name="sabitPhone" id="sabitPhone">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="dashboardLabel dashboardLabel form-label"> جنسیت</label>
                                    <select class="form-select" name="gender" id="gender">
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="dashboardLabel dashboardLabel form-label"> شهر</label>
                                    <select class="form-select" name="snNahiyeh" id="snNahiyehE">
                                        @foreach($cities as $city)
                                        <option value="{{$city->SnMNM}}" >{{$city->NameRec}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="dashboardLabel dashboardLabel form-label"> منطقه </label>
                                    <select class="form-select" name="snMantagheh" id="snMantaghehE">
                                        @foreach ($mantagheh as $mantaghe) 
                                        <option value="{{$mantaghe->SnMNM}}">{{$mantaghe->NameRec}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="dashboardLabel dashboardLabel form-label"> ادرس کامل  </label>
                                    <input type="text" required class="form-control" autocomplete="off" name="peopeladdress" id="peopeladdress">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="dashboardLabel dashboardLabel form-label"> نوع مشتری </label>
                                    <select class="form-select" name="groupCode" id="groupCode">
                                            <option value="314" >جدید</option>
                                    </select>
                                    <input type="hidden" name="adminId" id="adminId">
                                </div>
                            </div>
							<div class="col-md-6">           
                                <div class="form-group">
                                    <label class="dashboardLabel dashboardLabel form-label"> عکس </label>
                                    <input type="file" class="form-control" name="picture"  name="image" accept="image/*" capture="user">
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group" style="margin-top:4%">
                            <button type="button" class="btn btn-danger" id="cancelEditCustomer"> انصراف <i class="fa-solid fa-xmark"> </i> </button>
                            <button type="submit" class="btn btn-primary">ذخیره <i class="fa fa-save" aria-hidden="true"> </i> </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
   </div>

   <!-- ختم مشتری جدید -->
<div class="modal fade" id="customreForCallModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="customreForCallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
        <div class="modal-header py-2 text-white">
            <button type="button" class="btn-close bg-danger" data-bs-dismiss="modal" aria-label="Close"></button>
            <h6 class="modal-title fs-5" id="customreForCallModalLabel">مشتریان</h6>
        </div>
        <div class="modal-body p-1">
            <div class="col-lg-12 py-0 text-end">
                    <span class="fw-bold fs-4"  id="dashboardTitle" style="display:none;"></span>
                    <button class="btn openAddCommentModal btn-sm btn-primary d-inline" type="button" value="" name="" style="float:left; display:inline;" > کامنت <i class="fas fa-comment fa-lg"> </i> </button>
                    <form action="https://starfoods.ir/crmLogin" target="_blank"  method="get" style="display:inine !important;">
                        <input type="text" class="customerSnLogin" style="display:none" name="psn" value="" />
                        <button class="btn btn-sm btn-primary d-inline" type="submit" style="float:left;"> ورود جعلی  <i class="fas fa-sign-in fa-lg"> </i> </button>
                        <input type="text"  style="display: none" name="otherName" value="{{trim(Session::get('username'))}}" />
                    </form>
                    <button class='enableBtn customerSnLogin btn-sm btn btn-primary text-warning customerStaff'  type="button" disabled id="customerSndashboard" onclick="openDashboard(this.value)"> داشبورد <i class="fal fa-dashboard"></i></button>
            </div>
            <div class="col-sm-12 text-start" id="customerListSection">
                <input type="hidden" id="customerSn" style="" name="customerSn" value="" />
                <input type="hidden" id="commentSn" style="" name="commentSn" value="" />
                <table class='table table-bordered table-striped table-sm'>
                    <thead class="tableHeader">
                        <tr>
                            <th>ردیف</th>
                            <th style="width:66px">کد</th>
                            <th>اسم</th>
                            <th>آدرس </th>
                            <th>تلفن</th>
                            <th>منطقه </th>
                            <th style="width:111px;">انتخاب</th>
                        </tr>
                    </thead>
                    <tbody class="select-highlight tableBody" id="customerListBody" style="height:300px !important;">
                    
                    </tbody>
                </table>
            </div>
        </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
<div class="modal fade notScroll" id="customerDashboard" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog  modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header py-2">
                <button type="button" class="btn-close btn-danger" style="background-color:red;" data-bs-dismiss="modal" aria-label="Close"></button>
                <h5 class="modal-title" id="exampleModalLabel"> داشبورد </h5>
            </div>
            <div class="modal-body">
                <div class="row">
                     <div class="col-lg-8 col-md-8 col-sm-8">
                            <div class="flex-container">
                                <div style="flex-grow: 1"> کد:  <span id="customerCode"></span> </div>
                                <div style="flex-grow: 1">  نام و نام خانوادگی : <span id="customerName"> </span>  </div>
                                <div style="flex-grow: 1"> تعداد فاکتور : <span id="countFactor"> </span>  </div>
                                <div style="flex-grow: 1"> شماره های تماس :  <span id="mobile1"> </span>  </div>
                            </div>
                            <div class="flex-container">
                                <div style="flex-grow: 1">  نام کاربری: <span id="username"> </span>  </div>
                                <div style="flex-grow: 1"> رمز کاربری:   <span  id="password"> </span>  </div>
                                <div style="flex-grow: 2"> ادرس :   <span id="customerAddress"> </span>  </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <span class="fw-bold fs-4"  id="dashboardTitle" style="display:none;"></span>
                               <button class="btn openAddCommentModal btn-sm btn-primary d-inline"  type="button" value="" name="" style="float:left; display:inline;" > کامنت <i class="fas fa-comment fa-lg"> </i> </button>
                                <form action="https://starfoods.ir/crmLogin" target="_blank"  method="get" style="display:inine !important;">
                                    <input type="text" class="customerSnLogin" style="display:none" name="psn" />
                                    <button class="btn btn-sm btn-primary d-inline" type="submit" style="float:left;"> ورود جعلی  <i class="fas fa-sign-in fa-lg"> </i> </button>
                                    <input type="text"  style="display: none" name="otherName" value="{{trim(Session::get('username'))}}" />
                                </form>
                            <div class="mb-2"> <br> <br>
                                <label for="exampleFormControlTextarea1" class="form-label mb-0">یاداشت</label>
                                <textarea class="form-control" id="customerProperty" onblur="saveCustomerCommentProperty(this)" rows="2"></textarea>
                            </div>
                        </div>
                  </div>


                <div class="c-checkout container" style="background-color:#c5c5c5; padding:0.5% !important; border-radius:10px 10px 2px 2px;">
                    <div class="col-sm-12" style="margin: 0; padding:0;">
                        <ul class="header-list nav nav-tabs" data-tabs="tabs" style="margin: 0; padding:0;">
                            <li><a class="active" data-toggle="tab" style="color:black; font-size:14px; font-weight:bold;"  href="#custAddress"> فاکتور های ارسال شده </a></li>
                            <li><a data-toggle="tab" style="color:black; font-size:14px; font-weight:bold;"  href="#moRagiInfo">  کالاهای خریداری شده </a></li>
                            <li><a data-toggle="tab" style="color:black; font-size:14px; font-weight:bold;"  href="#userLoginInfo1"> کالاهای سبد خرید</a></li>
                            <li><a data-toggle="tab" style="color:black; font-size:14px; font-weight:bold;"  href="#customerLoginInfo">ورود به سیستم</a></li>
                            <li><a data-toggle="tab" style="color:black; font-size:14px; font-weight:bold;"  href="#returnedFactors1"> فاکتور های برگشت داده </a></li>
                            <li><a data-toggle="tab" style="color:black; font-size:14px; font-weight:bold;"  href="#comments"> کامنت ها </a></li>
                            <li><a data-toggle="tab" style="color:black; font-size:14px; font-weight:bold;"  href="#assesments"> نظرسنجی ها</a></li>
                        </ul>
                    </div>
                    <div class="c-checkout tab-content"   style="background-color:#f5f5f5; margin:0;padding:0.3%; border-radius:10px 10px 2px 2px;">
                        <div class="row c-checkout rounded-3 tab-pane active" id="custAddress"  style="width:99%; margin:0 auto; padding:1% 0% 0% 0%">
                            <div class="col-sm-12">
                                <table class="table table-bordered table-striped table-sm">
                                    <thead class="tableHeader">
                                    <tr>
                                        <th> ردیف</th>
                                        <th>تاریخ</th>
                                        <th> نام راننده</th>
                                        <th>مبلغ </th>
                                        <th style="width:88px; !important;"> جزئیات </th>
                                    </tr>
                                    </thead>
                                    <tbody class="tableBody" id="factorTable">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row c-checkout rounded-3 tab-pane" id="moRagiInfo" style="width:99%; margin:0 auto; padding:1% 0% 0% 0%">
                            <div class="row c-checkout rounded-3 tab-pane" style="width:99%; margin:0 auto; padding:1% 0% 0% 0%">
                                <div class="col-sm-12">
                                    <table class="table table-bordered table-striped table-sm" style="text-align:center;">
                                        <thead class="tableHeader">
                                        <tr>
                                            <th> ردیف</th>
                                            <th>تاریخ</th>
                                            <th> نام کالا</th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody class="tableBody" id="goodDetail"> </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="row c-checkout rounded-3 tab-pane" id="userLoginInfo1" style="width:99%; margin:0 auto; padding:1% 0% 0% 0%">
                            <div class="row c-checkout rounded-3 tab-pane" style="width:99%; margin:0 auto; padding:1% 0% 0% 0%">
                                <div class="col-sm-12">
                                    <table class="table table-bordered table-striped table-sm" style="text-align:center;">
                                        <thead class="tableHeader">
                                        <tr>
                                            <th> ردیف</th>
                                            <th>تاریخ</th>
                                            <th> نام کالا</th>
                                            <th>تعداد </th>
                                            <th>فی</th>
                                        </tr>
                                        </thead>
                                        <tbody class="tableBody" id="basketOrders">
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="row c-checkout rounded-3 tab-pane" id="customerLoginInfo" style="width:99%; margin:0 auto; padding:1% 0% 0% 0%">
                            <div class="row c-checkout rounded-3 tab-pane" style="width:99%; margin:0 auto; padding:1% 0% 0% 0%">
                                <div class="col-sm-12">
                                    <table class="table table-bordered table-striped table-sm" style="text-align:center;">
                                        <thead class="tableHeader">
                                        <tr>
                                            <th> ردیف</th>
                                            <th>تاریخ</th>
                                            <th>نوع پلتفورم</th>
                                            <th style="width:111px !important;">مرورگر</th>
                                        </tr>
                                        </thead>
                                        <tbody class="tableBody" id="customerLoginInfoBody">
                                    
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="row c-checkout rounded-3 tab-pane" id="returnedFactors1"  style="width:99%; margin:0 auto; padding:1% 0% 0% 0%">
                        <div class="row c-checkout rounded-3 tab-pane" style="width:99%; margin:0 auto; padding:1% 0% 0% 0%">
                                <div class="col-sm-12">
                                    <table class="table table-bordered table-striped table-sm" style="text-align:center;">
                                        <thead class="tableHeader">
                                        <tr>
                                            <th> ردیف</th>
                                            <th>تاریخ</th>
                                            <th> نام راننده</th>
                                            <th>مبلغ </th>
                                        </tr>
                                        </thead>
                                        <tbody class="tableBody" id="returnedFactorsBody">
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="c-checkout tab-pane" id="comments" style="margin:0; border-radius:10px 10px 2px 2px;">
                            <div class="row c-checkout rounded-3 tab-pane active"  style="width:99%; margin:0 auto; padding:1% 0% 0% 0%">
                                <div class="col-sm-12">
                                    <table class="table table-bordered table-striped table-sm" style="text-align:center;">
                                        <thead class="tableHeader">
                                        <tr>
                                            <th> ردیف</th>
                                            <th>تاریخ</th>
                                            <th> کامنت</th>
                                            <th> کامنت بعدی</th>
                                            <th style="width:111px !important;"> تاریخ بعدی </th>
                                        </tr>
                                        </thead>
                                        <tbody class="tableBody" id="customerComments"  >

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="c-checkout tab-pane" id="assesments" style="margin:0; border-radius:10px 10px 2px 2px;">
                            <div class="row c-checkout rounded-3 tab-pane active" style="width:99%; margin:0 auto; padding:1% 0% 0% 0%">
                                <div class="col-sm-12">
                                    <table class="table table-bordered table-striped table-sm" style="text-align:center;">
                                        <thead class="tableHeader">
                                        <tr>
                                            <th> ردیف</th>
                                            <th>تاریخ</th>
                                            <th> کامنت</th>
                                            <th> برخورد راننده</th>
                                            <th> مشکل در بارگیری</th>
                                            <th style="width:110px;"> کالاهای برگشتی</th>
                                        </tr>
                                        </thead>
                                        <tbody class="tableBody" id="customerAssesments"  >
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        <!-- Modal for reading comments-->
    <div class="modal fade" id="viewFactorDetail" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-dialog   modal-lg">
            <div class="modal-content">
                <div class="modal-header py-2">
                    <button type="button" class="btn-close bg-danger" data-bs-dismiss="modal" aria-label="Close"></button>
                    <h5 class="modal-title" id="exampleModalLabel">جزئیات فاکتور</h5>
                </div>
                <div class="modal-body" id="readCustomerComment">
                    <div class="container">
                        <div class="row">
                                 <div class="flex-container">
                                    <div style="flex-grow: 1"> تاریخ فاکتور: <span id="factorDate"> </span>  </div>
                                    <div style="flex-grow: 1"> مشتری:  <span  id="customerNameFactor"> </span>  </div>
                                    <div style="flex-grow: 1"> ادرس :   <span id="customerAddress"> </span>  </div>
                                    <div style="flex-grow: 1"> تلفن :  <span id="customerPhoneFactor"> </span>  </div>
                                    <div style="flex-grow: 1"> کاربر :  <span id="Admin"> </span>  </div>
                                    <div style="flex-grow: 1"> شماره فاکتور :  <span id="factorSnFactor"> </span>  </div>
                                </div>
                            </div>
                            <div class="row">
                                <table id="strCusDataTable" class='table table-bordered table-striped table-sm'>
                                    <thead class="tableHeader">
                                    <tr>
                                        <th>ردیف</th>
                                        <th>نام کالا </th>
                                        <th>تعداد/مقدار</th>
                                        <th>واحد کالا</th>
                                        <th>فی (تومان)</th>
                                        <th style="width:120px;">مبلغ (تومان)</th>
                                    </tr>
                                    </thead>
                                    <tbody class="tableBody" id="productList" style="height: 255px !important;">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for returning customer-->
    <div class="modal fade" id="returnComment"  data-bs-backdrop="static"  aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                </div>
                <form action="{{url('/returnCustomer')}}" id="returnCustomerForm" method="get">
                    <div class="modal-body">
                        <input type="text" name="returnCustomerId" id="returnCustomerId" style="display:none;">
                        <div class="row">
                            <div class="col-sm-12 fw-bold">
                                <label for="tahvilBar">دلیل ارجاع</label>
                                <textarea class="form-control" style="position:relative" name="returnComment" rows="3" ></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal" id="cancelReturn" style="background-color:red;">انصراف<i class="fal fa-cancel"> </i></button>
                        <button type="submit" class="btn btn-sm btn-primary">ارجاع<i class="fal fa-history"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal for reading comments-->
<div class="modal fade" id="viewComment" tabindex="1"  data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-scrollable  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header py-2">
                <button type="button" class="btn-close bg-danger" data-bs-dismiss="modal" aria-label="Close"></button>
                <h5 class="modal-title" id="exampleModalLabel">کامنت ها</h5>
            </div>
            <div class="modal-body" >
                <h3 id="readCustomerComment1"></h3>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">بستن</button>
            </div>
        </div>
    </div>
</div>
{{-- modal for adding comments --}}
<div class="modal" id="addComment"  data-bs-backdrop="static" >
    <div class="modal-dialog modal-dialog-scrollable ">
        <div class="modal-content">
            <div class="modal-header py-2">
                <h5 class="modal-title"> افزودن کامنت </h5>
            </div>
            <div class="modal-body">
                <form action="{{url('/addComment')}}" id='addCommentTimeTable' method="get" style="background-color:transparent; box-shadow:none;">
                    @csrf
                <div class="row">
                    <div class="col-lg-12 fw-bold">
                        <label for="tahvilBar">نوع تماس</label>
                        <select class="form-select form-select-sm" name="callType">
                            <option value="1">موبایل  </option>
                            <option value="2"> تلفن ثابت </option>
                            <option value="3"> واتساپ</option>
                            <option value="4">حضوری </option>
                        </select>
                        <input type="text" name="customerIdForComment" id="customerIdForComment" style="">
                    </div>
                </div>
                <input type="hidden" value="" id="dayDate" >
                <div class="row">
                    <div class="col-sm-12 fw-bold">
                        <label for="tahvilBar" >کامنت </label>
                        <textarea class="form-control" style="position:relative" required name="firstComment" rows="2" ></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 fw-bold">
                        <label for="tahvilBar" >زمان تماس بعدی </label>
                        <input class="form-control form-control-sm" autocomplete="off" required name="nextDate" id="commentDate2">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 fw-bold">
                        <label for="tahvilBar">کامنت بعدی</label>
                        <textarea class="form-control" name="secondComment" required rows="2" ></textarea>
                        <input type="text"  style="display: none" name="place" value="calendar">
                    </div>
                </div>
            
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal" id="cancelComment">انصراف <i class="fa fa-xmark"></i></button>
                    <button type="submit" class="btn btn-sm btn-primary">ذخیره <i class="fa fa-save"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>
 </div>


@endsection
