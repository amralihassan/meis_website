@extends('front_end.index')
@section('styles')
<style>
    .legend{color:red;font-weight:700;}
    #regForm {
      background-color: #ffffff;
      margin: 20px auto;
      font-family: Raleway;
      padding: 40px;
      width: 70%;
      min-width: 300px;
    }
    label{color: #373636}
    .error-message{color: red;text-align: center}
    .required{color:red;font-size:16px;}

    /* Mark input boxes that gets an error on validation: */
    input.invalid {
      background-color: #ffdddd;
    }

    /* Hide all steps by default: */
    .tab {
      display: none;
    }


    button:hover {
      opacity: 0.8;
    }

    #prevBtn {
      background-color: #bbbbbb;
    }

    /* Make circles that indicate the steps of the form: */
    .step {
      height: 15px;
      width: 15px;
      margin: 0 2px;
      background-color: #bbbbbb;
      border: none;
      border-radius: 50%;
      display: inline-block;
      opacity: 0.5;
    }

    .step.active {
      opacity: 1;
    }

    /* Mark the steps that are finished and valid: */
    .step.finish {
      background-color: #4CAF50;
    }
    </style>
@endsection
@section('content')
<section>
    <div class="container">
        <h2 style="text-align: center;color: #1070a0;font-weight: bold;text-transform: uppercase">School Admission Form</h2>
        <span class="required">*</span> Fields required
        <hr>
        <div id="msg"></div>
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
    </div>
    <form id="regForm" action="{{url('admission/online_register/store')}}" method="POST">
        @csrf
        {{-- father information--}}
        <div class="tab">
            <fieldset>
                <legend><label class="legend">Father Information</label><label class="legend" style="float:right">بيانات الاب</label></legend>
                <div class="form-row">
                    <div class="col-md-3 mb-3">
                        <label>Name</label>
                        <input type="text" class="form-control"  name="firstNameEn"  value="{{old('firstNameEn')}}" >
                    </div>
                    <div class="col-md-3 mb-3">
                        <label>Second Name</label>
                        <input type="text" class="form-control"  name="middleNameEn"  value="{{old('middleNameEn')}}" >
                    </div>
                    <div class="col-md-3 mb-3">
                        <label>Third Name</label>
                        <input type="text" class="form-control"  name="lastNameEn"  value="{{old('lastNameEn')}}" >
                    </div>
                    <div class="col-md-3 mb-3">
                        <label>Last Name</label>
                        <input type="text" class="form-control"  name="familyNameEn"  value="{{old('familyNameEn')}}" >
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-3 mb-3">
                        <label></label><label style="float:right;">اللقب <span class="required">*</span></label>
                        <input type="text" class="form-control"  name="familyName" value="{{old('familyName')}}"  >
                        @error('familyName')<span class="error-message">{{$message}}</span>@enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label></label><label style="float:right;">اسم الجد <span class="required">*</span></label>
                        <input type="text" class="form-control"  name="lastName" value="{{old('lastName')}}"  >
                        @error('lastName')<span class="error-message">{{$message}}</span>@enderror
                    </div>

                    <div class="col-md-3 mb-3">
                        <label></label><label style="float:right;">اسم الاب <span class="required">*</span></label>
                        <input type="text" class="form-control"  name="middleName" value="{{old('middleName')}}"  >
                        @error('middleName')<span class="error-message">{{$message}}</span>@enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label></label><label style="float:right;">الاسم <span class="required">*</span></label>
                        <input type="text" class="form-control"  name="firstName" value="{{old('firstName')}}"  >
                        @error('firstName')<span class="error-message">{{$message}}</span>@enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-3 mb-3">
                        <label>Home Phone</label><label style="float:right;">هاتف المنزل</label>
                        <input type="text" class="form-control" name="homePhone" value="{{old('homePhone')}}"  onkeypress='validate(event)'>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label><span class="required">*</span> Mobile</label><label style="float:right;">رقم الموبايل</label>
                        <input type="text" class="form-control" name="fatherMobile"  value="{{ old('fatherMobile') }}" onkeypress='validate(event)'>
                        @error('fatherMobile')<span class="error-message">{{$message}}</span>@enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label><span class="required">*</span> National ID</label><label style="float:right;">الرقم القومي</label>
                        <input type="text" class="form-control" name="fatherIdNumber"  value="{{ old('fatherIdNumber') }}">
                        @error('fatherIdNumber')<span class="error-message">{{$message}}</span>@enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label><span class="required">*</span> Religion</label><label style="float:right;">الديانة</label>
                        <select name="fatherReligion" class="form-control" >
                            <option value="">Choose</option>
                            <option {{old('fatherReligion') == 'Muslim' ?'selected':''}} value="Muslim">Muslim مسلم</option>
                            <option {{old('fatherReligion') == 'Christian' ?'selected':''}} value="Christian">Christian مسيحي</option>
                        </select>
                        @error('fatherReligion')<span class="error-message">{{$message}}</span>@enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <label><span class="required">*</span> Nationality</label><label style="float:right;">الجنسية</label>
                        <input type="text" class="form-control" name="fatherNationality" value="{{old('fatherNationality')}}">
                        @error('fatherNationality')<span class="error-message">{{$message}}</span>@enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Email</label><label style="float:right;">البريد الالكتروني</label >
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@</span>
                            </div>
                            <input type="email" class="form-control" name="fatherEmail" value="{{old('fatherEmail')}}" >
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label><span class="required">*</span> Marital Status</label><label style="float:right;">الحالة الاجتماعية</label>
                        <select name="maritalStatus" class="form-control"  >
                            <option value="">Choose</option>
                            <option {{old('maritalStatus') == 'Married' ?'selected':''}} value="Married">Married متزوج</option>
                            <option {{old('maritalStatus') == 'Divorced' ?'selected':''}} value="Divorced">Divorced مطلق</option>
                            <option {{old('maritalStatus') == 'Separated' ?'selected':''}} value="Separated">Separated منفصل</option>
                            <option {{old('maritalStatus') == 'Widow' ?'selected':''}} value="Widow">Widow ارمل</option>
                        </select>
                        @error('maritalStatus')<span class="error-message">{{$message}}</span>@enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <label><span class="required">*</span> Qualification</label><label style="float:right;">المؤهل</label>
                        <input type="text" class="form-control"  name="fatherQualification" value="{{old('fatherQualification')}}" >
                        @error('fatherQualification')<span class="error-message">{{$message}}</span>@enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Job</label><label style="float:right;">الوظيقة</label>
                        <input type="text" class="form-control"  name="fatherJob" value="{{old('fatherJob')}}" >
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Facebook Account</label><label style="float:right;">حساب الفيس بوك</label>
                        <input type="text" class="form-control"  name="fatherFacebookAccount" value="{{old('fatherFacebookAccount')}}" >
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-3 mb-3">
                        <label><span class="required">*</span> Block No.</label><label style="float:right;">رقم العقار</label>
                        <input type="text" class="form-control" name="fatherBlockNo" value="{{old('fatherBlockNo')}}" onkeypress='validate(event)'>
                        @error('fatherBlockNo')<span class="error-message">{{$message}}</span>@enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label><span class="required">*</span> Street Name</label><label style="float:right;">اسم الشارع</label>
                        <input type="text" class="form-control" name="fatherStreetName"  value="{{ old('fatherStreetName') }}">
                        @error('fatherStreetName')<span class="error-message">{{$message}}</span>@enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label><span class="required">*</span> City</label><label style="float:right;">المدينة / الحي</label>
                        <input type="text" class="form-control" name="fatherArea"  value="{{ old('fatherArea') }}">
                        @error('fatherArea')<span class="error-message">{{$message}}</span>@enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label><span class="required">*</span> Governorate</label><label style="float:right;">المحافظة</label>
                        <input type="text" class="form-control" name="fatherGovernorate"  value="{{ old('fatherGovernorate') }}">
                        @error('fatherGovernorate')<span class="error-message">{{$message}}</span>@enderror
                    </div>
                </div>
            </fieldset>
        </div>
        {{-- mother information --}}
        <div class="tab">
            <fieldset>
                <legend><label class="legend">Mother Information</label><label class="legend" style="float:right">بيانات الام</label></legend>
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label><span class="required">*</span> Full Name</label><label style="float:right;">الاسم ثلاثي</label>
                            <input type="text" class="form-control"  name="motherName"  value="{{old('motherName')}}">
                            @error('motherName')<span class="error-message">{{$message}}</span>@enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label><span class="required">*</span> Mobile</label><label style="float:right;">رقم الموبايل</label>
                            <input type="text" class="form-control" name="motherMobile"  value="{{old('motherMobile')}}" onkeypress='validate(event)'>
                            @error('motherMobile')<span class="error-message">{{$message}}</span>@enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label><span class="required">*</span> National ID</label><label style="float:right;">الرقم القومي</label>
                            <input type="text" class="form-control" name="motherIdNumber"  value="{{old('motherIdNumber')}}">
                            @error('motherIdNumber')<span class="error-message">{{$message}}</span>@enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label><span class="required">*</span> Religion</label><label style="float:right;">الديانة</label>
                            <select name="motherReligion" class="form-control" >
                                <option value="">Choose</option>
                                <option {{old('motherReligion') == 'Muslim' ?'selected':''}} value="Muslim">Muslim مسلم</option>
                                <option {{old('motherReligion') == 'Christian' ?'selected':''}} value="Christian">Christian مسيحي</option>
                            </select>
                            @error('motherReligion')<span class="error-message">{{$message}}</span>@enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label><span class="required">*</span> Nationality</label><label style="float:right;">الجنسية</label>
                            <input type="text" name="motherNationality" class="form-control" value="{{old('motherNationality')}}">
                            @error('motherNationality')<span class="error-message">{{$message}}</span>@enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Email</label><label style="float:right;">البريد الالكتروني</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">@</span>
                                </div>
                                <input type="email" class="form-control" name="motherEmail" value="{{old('motherEmail')}}" >
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label>Qualification</label><label style="float:right;">المؤهل</label>
                            <input type="text" class="form-control" name="motherQualification" value="{{old('motherQualification')}}" >
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Job</label><label style="float:right;">الوظيقة</label>
                            <input type="text" class="form-control"  name="motherJob" value="{{old('motherJob')}}" >
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Facebook Account</label><label style="float:right;">حساب الفيس بوك</label>
                            <input type="text" class="form-control"  name="motherFacebookAccount" value="{{old('motherFacebookAccount')}}" >
                        </div>
                    </div>
                    <div class="form-row">
                    <div class="col-md-3 mb-3">
                        <label><span class="required">*</span> Block No.</label><label style="float:right;">رقم العقار</label>
                        <input type="text" class="form-control" name="motherBlockNo" value="{{old('motherBlockNo')}}" onkeypress='validate(event)'>
                        @error('motherBlockNo')<span class="error-message">{{$message}}</span>@enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label><span class="required">*</span> Street Name</label><label style="float:right;">اسم الشارع</label>
                        <input type="text" class="form-control" name="motherStreetName"  value="{{ old('motherStreetName') }}">
                        @error('motherStreetName')<span class="error-message">{{$message}}</span>@enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label><span class="required">*</span> City</label><label style="float:right;">المدينة / الحي</label>
                        <input type="text" class="form-control" name="motherArea"  value="{{ old('motherArea') }}">
                        @error('motherArea')<span class="error-message">{{$message}}</span>@enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label><span class="required">*</span> Governorate</label><label style="float:right;">المحافظة</label>
                        <input type="text" class="form-control" name="motherGovernorate"  value="{{ old('motherGovernorate') }}">
                        @error('motherGovernorate')<span class="error-message">{{$message}}</span>@enderror
                    </div>
                </div>
            </fieldset>
        </div>
        {{-- applicant information--}}
        <div class="tab">
            <fieldset>
                <legend><label class="legend">Student Information</label><label class="legend" style="float:right">بيانات الطالب</label></legend>
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label><span class="required">*</span> Student Name</label><label style="float:right;">اسم المتقدم / الطالب</label>
                            <input type="text" class="form-control"  name="applicantName"  value="{{old('applicantName')}}">
                            @error('applicantName')<span class="error-message">{{$message}}</span>@enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Eng. name</label><label style="float:right;">اسم المتقدم باللغة الانجليزية</label>
                            <input type="text" class="form-control"  name="applicantNameEn"  value="{{old('applicantNameEn')}}">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label><span class="required">*</span> Gender</label><label style="float:right;">النوع</label>
                            <select name="applicantGender" class="form-control" name="applicantGender" >
                                <option value="">Choose</option>
                                <option {{old('applicantGender') == 'Male' ?'selected':''}} value="Male">Male ذكر</option>
                                <option {{old('applicantGender') == 'Female' ?'selected':''}} value="Female">Female أنثى</option>
                            </select>
                            @error('applicantGender')<span class="error-message">{{$message}}</span>@enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label><span class="required">*</span> Native Language</label><label style="float:right;">لغة التحدث</label>
                            <select name="nativeLanguage" class="form-control" >
                                <option {{old('nativeLanguage') == '' ?'selected':''}} value="">Choose</option>
                                <option {{old('nativeLanguage') == 'Arabic' ?'selected':''}} value="Arabic">Arabic العربية</option>
                                <option {{old('nativeLanguage') == 'English' ?'selected':''}} value="English">English الإنجليزية</option>
                                <option {{old('nativeLanguage') == 'Chinese' ?'selected':''}} value="Chinese">Chinese الصينية</option>
                                <option {{old('nativeLanguage') == 'Hindi' ?'selected':''}} value="Hindi">Hindi الهندية</option>
                                <option {{old('nativeLanguage') == 'Spanish' ?'selected':''}} value="Spanish">Spanish الإسبانية</option>
                                <option {{old('nativeLanguage') == 'Russian' ?'selected':''}} value="Russian">Russian الروسية</option>
                                <option {{old('nativeLanguage') == 'Portuguese' ?'selected':''}} value="Portuguese">Portuguese البرتغالية</option>
                                <option {{old('nativeLanguage') == 'Bengali' ?'selected':''}} value="Bengali">Bengali البنغالية</option>
                                <option {{old('nativeLanguage') == 'French' ?'selected':''}} value="French">French الفرنسية</option>
                                <option {{old('nativeLanguage') == 'German' ?'selected':''}} value="German">German الألمانية</option>
                                <option {{old('nativeLanguage') == 'Italian' ?'selected':''}} value="Italian">Italian الايطالبية</option>
                                <option {{old('nativeLanguage') == 'Other' ?'selected':''}} value="Other">Other غير ذلك</option>
                            </select>
                            @error('nativeLanguage')<span class="error-message">{{$message}}</span>@enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label><span class="required">*</span> Second Chosen Language</label><label style="float:right;">اللغة الثانية</label>
                            <select name="secondLanguage" class="form-control" >
                                <option value="">Choose</option>
                                <option {{old('secondLanguage') == 'French' ?'selected':''}} value="French">French الفرنسية</option>
                                <option {{old('secondLanguage') == 'German' ?'selected':''}} value="German">German الألمانية</option>
                            </select>
                            @error('secondLanguage')<span class="error-message">{{$message}}</span>@enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label><span class="required">*</span> Date of Birth</label><label style="float:right;">تاريخ الميلاد</label>
                            <div class="row">
                                <div class="col-md-4">
                                    <select name="dd" class="form-control" style="font-size: 14px;">
                                        <option value="">Day</option>
                                        @for($i=1;$i <=31;$i++)
                                            <option value="{{$i}}">{{$i}}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <select name="mm" class="form-control" style="font-size: 14px;">
                                        <option value="">Mon.</option>
                                        @for($i=1;$i <=12;$i++)
                                            <option value="{{$i}}">{{$i}}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <select name="yy" class="form-control" style="font-size: 14px;">
                                        <option value="">Year</option>
                                        @for($i=\Carbon\Carbon::now()->year-15;$i <=\Carbon\Carbon::now()->year-3;$i++)
                                            <option value="{{$i}}">{{$i}}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            @if($errors->any())
                            <ul>
                                <li>@error('dd')<span class="error-message">{{$message}}</span>@enderror</li>
                                <li>@error('mm')<span class="error-message">{{$message}}</span>@enderror</li>
                                <li>@error('yy')<span class="error-message">{{$message}}</span>@enderror</li>
                            </ul>
                            @endif

                        </div>
                        <div class="col-md-4 mb-3">
                            <label><span class="required">*</span> Nationality</label><label style="float:right;">الجنسية</label>
                            <input type="text" name="applicantNationality" class="form-control" value="{{old('applicantNationality')}}">
                            @error('applicantNationality')<span class="error-message">{{$message}}</span>@enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label><span class="required">*</span> Religion</label><label style="float:right;">الديانة</label>
                            <select name="applicantReligion" class="form-control" >
                                <option value="">Choose</option>
                                <option {{old('applicantReligion') == 'Muslim' ?'selected':''}} value="Muslim">Muslim مسلم</option>
                                <option {{old('applicantReligion') == 'Christian' ?'selected':''}} value="Christian">Christian مسيحي</option>
                            </select>
                            @error('applicantReligion')<span class="error-message">{{$message}}</span>@enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label><span class="required">*</span> Division</label><label style="float:right;">القسم الاكاديمي</label>
                            <select name="devisionId" class="form-control">
                                <option value="">-- Select --</option>
                                @foreach($divisions as $row)
                                    <option {{old('devisionId')==$row->id?'selected':''}} value="{{$row->id}}">{{$row->enDevision}}</option>
                                @endforeach
                            </select>
                            @error('devisionId')<span class="error-message">{{$message}}</span>@enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label><span class="required">*</span> Next Grade</label><label style="float:right;">المرحلة المتقدم اليها</label>
                            <select name="nextGradeId" class="form-control">
                                <option value="">-- Select --</option>
                                @foreach($grades as $row)
                                    <option {{old('nextGradeId') ==$row->id?'selected':''}} value="{{$row->id}}">{{$row->enGradeParent}}</option>
                                @endforeach
                            </select>
                            @error('nextGradeId')<span class="error-message">{{$message}}</span>@enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label><span class="required">*</span> Next Academic Year</label><label style="float:right;">العام الدراسي المتقدم اليها</label>
                            <select name="nextAcademicYearId" class="form-control">
                                <option value="">-- Select --</option>
                                @foreach($academicYears as $row)
                                    <option {{old('nextAcademicYearId')==$row->id?'selected':''}} value="{{$row->id}}">{{$row->academicYear}}</option>
                                @endforeach
                            </select>
                            @error('nextAcademicYearId')<span class="error-message">{{$message}}</span>@enderror
                        </div>
                    </div>
            </fieldset>
        </div>
        <div class="tab">
            <fieldset>
                <legend><label class="legend">Other Information</label><label class="legend" style="float:right">بيانات اخرى</label></legend>
                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label><span class="required">*</span> How did you know the school?</label><label style="float:right;">كيف عرفت المدرسة؟</label>
                        <select name="recognition" class="form-control" >
                            <option  value="">Choose</option>
                            <option {{old('recognition') == 'facebook' ?'selected':''}} value="facebook">Facebook الفيسبوك</option>
                            <option {{old('recognition') == 'parent' ?'selected':''}} value="parent">Parent ولي أمر</option>
                            <option {{old('recognition') == 'friend' ?'selected':''}} value="friend">Friend صديق</option>
                            <option {{old('recognition') == 'show' ?'selected':''}} value="show">School hub معرض المدارس</option>
                            <option {{old('recognition') == 'street' ?'selected':''}} value="street">Street advertises إعلانات الطرق</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label><span class="required">*</span> Educational Mandate</label><label style="float:right;">الولاية التعليمية</label>
                        <select name="educationRights" class="form-control" >
                            <option value="">Choose</option>
                            <option {{old('educationRights') == 'father' ?'selected':''}} value="father">Father الاب</option>
                            <option {{old('educationRights') == 'mother' ?'selected':''}} value="mother">Mother الام</option>
                        </select>
                        @error('educationRights')<span class="error-message">{{$message}}</span>@enderror
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>From School </label><label style="float:right;">المدرسة المحول منها</label>
                    </div>
                    <div class="col-md-12 mb-3">
                        <textarea name="fromSchool"rows="1" class="30" style="width:100%;"></textarea>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>The reason for the transfer </label><label style="float:right;">سبب التحويل</label>
                    </div>
                    <div class="col-md-12 mb-3">
                        <textarea name="transferReason"rows="3" class="30" style="width:100%;"></textarea>
                    </div>
                </div>
            </fieldset>

        </div>
        <div class="tab">
            <div class="form-row" style="color: #373636">
                <div class="col-md-6">
                    <p style="text-align: justify">A school representative will come to your residence to collect the admission exam fees all along with some of the required documents which are:</p>
                    <ol>
                        <li>A clear photocopy for the parents national IDs or passports if they are foreigners.</li>
                        <li>10 clear photos for the students (size 4*6).</li>
                        <li>An electronic birth certificate for the student.</li>
                    </ol>
                    <p style="text-align: justify">Also the school representative will give you a code to use it in the follow up the application process  section, in order to proceed to the parents’ interview & the student’s assessment.</p>
                    <p style="text-align: justify">The assessments will be performed through (zoom) application, Zoom is available to be downloaded for free on Apple store and Google play store.
                        Please, specify a suitable apportionment for the school representative visit:</p>
                </div>
                <div class="col-md-6" dir="rtl">
                    <p style="text-align: right"> سوف يقوم ممثل من المدرسة بزيارة سيادتكم في المنزل لتحصيل قيمة اختبار القبول وتسلم الاوراق المبدئية المطلوبة:</p>
                    <ol>
                        <li style="text-align: justify">صورة من البطاقة الشخصية للاب والام.</li>
                        <li style="text-align: justify">10 صور للطالب مقاس4*6.</li>
                        <li style="text-align: justify">شهادة الميلاد مميكنة.</li>
                    </ol>
                    <p style="text-align: justify;">سوف يقوم بتسليم سيادتكم كود لادخاله في خانه “Follow up the Application process  ”  لاجراء المقابلة الشخصية لاولياء الامور واختبارات القبول للطالب عبر تطبيق “زووم” - التطبيق متاح على متجر ابل ستور و جوجل ستور.</p>
                    <p style="text-align: justify">برجاء تحديد موعد زيارة ممثل المدرسة.</p>
                </div>
                <div class="col-md-3 mb-3"><span class="required">*</span>
                    <select name="meetRepresentative" class="form-control" >
                        <option value="">Choose</option>
                        <option {{old('meetRepresentative') == '9:00 am - 11:00 am' ?'selected':''}} value="9:00 am - 11:00 am">9:00 am - 11:00 am</option>
                        <option {{old('meetRepresentative') == '11:00 am - 1:00 pm' ?'selected':''}} value="11:00 am - 1:00 pm">11:00 am - 1:00 pm</option>
                        <option {{old('meetRepresentative') == '1:00 pm- 4:00 pm' ?'selected':''}} value="1:00 pm- 4:00 pm">1:00 pm- 4:00 pm</option>
                    </select>
                    @error('meetRepresentative')<span class="error-message">{{$message}}</span>@enderror
                </div>

                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                    <input type="checkbox" {{old('AcceptanceAcknowledgment') ?'checked':''}} class="custom-control-input" id="invalidCheck33" name="AcceptanceAcknowledgment" value="True" >
                    <label class="custom-control-label" for="invalidCheck33"><span class="required">*</span> I acknowledge that all the given data is correct and under my responsibility.</label> <label style="float:right"> اقر بأن جميع البيانات التي قمت بادخالها صحيحة وتحت مسئوليتي</label>
                    <div class="invalid-feedback">
                        You must agree before submitting.
                    </div>
                    </div>
                    <div class="invalid-feedback">
                    You must agree before submitting.
                    </div>
                    @error('AcceptanceAcknowledgment')<span class="error-message">{{$message}}</span>@enderror
                </div>
            </div>
        </div>
        <br>
        <div style="overflow:auto;">
          <div style="float:right;">
            <button class="btn btn-primary" type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
            <button class="btn btn-primary" type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
          </div>
        </div>
        <!-- Circles which indicates the steps of the form: -->
        <div style="text-align:center;margin-top:40px;">
          <span class="step"></span>
          <span class="step"></span>
          <span class="step"></span>
          <span class="step"></span>
          <span class="step"></span>
        </div>
    </form>

</section>
@endsection
@section('javascript')
<script src="{{url('public/design/site/js/jquery.min.js')}}"></script>
<script src="{{url('public/design/site/js/jquery-migrate-3.0.1.min.js')}}"></script>
<script>
    var currentTab = 0; // Current tab is set to be the first tab (0)
    showTab(currentTab); // Display the current tab

    function showTab(n) {
      // This function will display the specified tab of the form...
      var x = document.getElementsByClassName("tab");
      x[n].style.display = "block";
      //... and fix the Previous/Next buttons:
      if (n == 0) {
        document.getElementById("prevBtn").style.display = "none";
      } else {
        document.getElementById("prevBtn").style.display = "inline";
      }
      if (n == (x.length - 1)) {
        document.getElementById("nextBtn").innerHTML = "Submit";
      } else {
        document.getElementById("nextBtn").innerHTML = "Next";
      }
      //... and run a function that will display the correct step indicator:
      fixStepIndicator(n)
      $('html, body').animate({ scrollTop: 0 }, 'fast');

    }

    function nextPrev(n) {
      // This function will figure out which tab to display
      var x = document.getElementsByClassName("tab");
      // Exit the function if any field in the current tab is invalid:
    //   if (n == 1 && !validateForm() ) return false;
    //   if (n == 1 && !validateFormSelect()) return false;
      // Hide the current tab:
      x[currentTab].style.display = "none";
      // Increase or decrease the current tab by 1:
      currentTab = currentTab + n;
      // if you have reached the end of the form...
      if (currentTab >= x.length) {
        // ... the form gets submitted:
        document.getElementById("regForm").submit();

        return false;
      }
      // Otherwise, display the correct tab:
      showTab(currentTab);
    }

    function validateForm() {
      // This function deals with validation of the form fields
      var x, y, i, valid = true;
      x = document.getElementsByClassName("tab");
      y = x[currentTab].getElementsByTagName("input");
      // A loop that checks every input field in the current tab:
      for (i = 0; i < y.length; i++) {
        // If a field is empty...
        if (y[i].value == "") {
          // add an "invalid" class to the field:
          y[i].className += " invalid";
          // and set the current valid status to false
          $('html, body').animate({ scrollTop: 0 }, 'fast');
          $('#msg').html('<div class="alert alert-danger">All fields are .</div>');
          valid = false;
        }
        else{
            $('#msg').html('');
        }
      }
      // If the valid status is true, mark the step as finished and valid:
      if (valid) {
        document.getElementsByClassName("step")[currentTab].className += " finish";
      }
      return valid; // return the valid status
    }

    function validateFormSelect() {
      // This function deals with validation of the form fields
      var x, y, i, valid = true;
      x = document.getElementsByClassName("tab");
      y = x[currentTab].getElementsByTagName("select");
      // A loop that checks every input field in the current tab:
      for (i = 0; i < y.length; i++) {
        // If a field is empty...
        if (y[i].value == "") {
          // add an "invalid" class to the field:
          y[i].className += " invalid";
          // and set the current valid status to false
          $('html, body').animate({ scrollTop: 0 }, 'fast');
          $('#msg').html('<div class="alert alert-danger">All fields are .</div>');
          valid = false;
        }
        else{
            $('#msg').html('');
        }
      }
      // If the valid status is true, mark the step as finished and valid:
      if (valid) {
        document.getElementsByClassName("step")[currentTab].className += " finish";
      }
      return valid; // return the valid status
    }

    function fixStepIndicator(n) {
      // This function removes the "active" class of all steps...
      var i, x = document.getElementsByClassName("step");
      for (i = 0; i < x.length; i++) {
        x[i].className = x[i].className.replace(" active", "");
      }
      //... and adds the "active" class on the current step:
      x[n].className += " active";
    }
    // HTML text input allow only numeric input
    function validate(evt) {
        var theEvent = evt || window.event;

        // Handle paste
        if (theEvent.type === 'paste') {
            key = event.clipboardData.getData('text/plain');
        } else {
        // Handle key press
            var key = theEvent.keyCode || theEvent.which;
            key = String.fromCharCode(key);
        }
        var regex = /[0-9]|\./;
        if( !regex.test(key) ) {
            theEvent.returnValue = false;
            if(theEvent.preventDefault) theEvent.preventDefault();
        }
    }
</script>
@endsection
