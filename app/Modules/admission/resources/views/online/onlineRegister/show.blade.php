@extends('layouts.app')
@section('navbar')
    @include('layouts.navbar')
@endsection
@section('sidebar')
    @include('layouts.sidebars.admission')
@endsection
@section('content')
    <div class="page-header">
        <div class="links">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="{{aurl()}}">{{trans('admin.dashboard')}}</a>
                </li>
                <li>
                    <a href="{{url('admission/all/online_register')}}">{{trans('admission::admission.onlineRegister')}}</a>
                </li>
                <li class="active">{{ !empty($title)?$title:trans('staff::employee.employeesGate')}}</li>
            </ul><!-- /.breadcrumb -->
        </div>
        <h1>
        {{$title}} | {{ session('lang') == 'ar'? $online->applicantName .' ' .$online->firstName . ' ' . $online->middleName .' '. $online->lastName.' '.$online->familyName:$online->applicantNameEn .' ' .$online->firstNameEn . ' ' . $online->middleNameEn .' '. $online->lastNameEn.' '.$online->familyNameEn }}


        </h1>
    </div><!-- /.page-header -->
    {{Form::open(['url'=>'admission/online_register/update/'.$online->id,'class'=>'form-horizontal','role'=>'from' ,'method'=> 'post'])}}
        {{-- page content --}}
        {{Form::button('<i class="ace-icon fa fa-save bigger-110"></i> '.trans('admin.saveChanges'),['class'=>'btn btn-success btn-sm','type'=>'submit'])}}
        {{Form::button('<i class="ace-icon fa fa-print bigger-110"></i> '.trans('admin.print'),['class'=>'btn btn-info btn-sm','onclick'=>'location.href="'.url("admission/online_register/application/print/".$online->id).'"'])}}
        {{Form::button('<i class="ace-icon fa fa-undo bigger-110"></i> '.trans('admin.back'),['class'=>'btn btn-default btn-sm','onclick'=>'location.href="'.url("admission/all/online_register").'"'])}}
        <div class="row">
            <div class="col-xs-12 col-sm-6">
                <h3>{{ trans('admission::admission.applicantData') }}</h3>
                <div class="profile-user-info profile-user-info-striped">
                    {{-- code --}}
                    <div class="profile-info-row">
                        <div class="profile-info-name"> {{ trans('admission::admission.applicantCode') }} </div>
                        <div class="profile-info-value">
                            <span class="editable">{{$online->code}}</span>
                        </div>
                    </div>
                    {{-- applicant name --}}
                    <div class="profile-info-row">
                        <div class="profile-info-name"> {{ trans('admission::admission.applicantName') }} </div>
                        <div class="profile-info-value">
                            <span class="editable">{{$online->applicantName}}</span>
                        </div>
                    </div>
                    {{-- applicant english name --}}
                    <div class="profile-info-row">
                        <div class="profile-info-name"> {{ trans('admission::admission.applicantEnglishName') }} </div>
                        <div class="profile-info-value">
                            <span class="editable">{{$online->applicantNameEn}}</span>
                        </div>
                    </div>
                    {{-- gender --}}
                    <div class="profile-info-row">
                        <div class="profile-info-name"> {{ trans('admission::admission.gender') }} </div>
                        <div class="profile-info-value">
                            <span class="editable"> {{ $online->applicantGender == 'Male'?trans('admission::admission.male'):trans('admission::admission.female') }}</span>
                        </div>
                    </div>
                    {{-- native language --}}
                    <div class="profile-info-row">
                        <div class="profile-info-name"> {{ trans('admission::admission.nativeLanguage') }} </div>
                        <div class="profile-info-value">
                            <span class="editable">
                                @switch($online->nativeLanguage)
                                    @case('Arabic')
                                        {{ trans('admission::admission.arabic') }}
                                        @break
                                    @case('English')
                                        {{ trans('admission::admission.english') }}
                                        @break
                                    @case('Chinese')
                                        {{ trans('admission::admission.chinese') }}
                                        @break
                                    @case('Hindi')
                                        {{ trans('admission::admission.hindi') }}
                                        @break
                                    @case('Spanish')
                                        {{ trans('admission::admission.spanish') }}
                                        @break
                                    @case('Russian')
                                        {{ trans('admission::admission.russian') }}
                                        @break
                                    @case('Portuguese')
                                        {{ trans('admission::admission.portuguese') }}
                                        @break
                                    @case('Bengali')
                                        {{ trans('admission::admission.bengali') }}
                                        @break
                                    @case('French')
                                        {{ trans('admission::admission.frensh') }}
                                        @break
                                    @case('German')
                                        {{ trans('admission::admission.german') }}
                                        @break
                                    @case('Italian')
                                        {{ trans('admission::admission.italian') }}
                                        @break
                                    @default
                                        {{ trans('admission::admission.other') }}
                                @endswitch
                            </span>
                        </div>
                    </div>
                    {{-- second langauge --}}
                    <div class="profile-info-row">
                        <div class="profile-info-name"> {{ trans('admission::admission.secondLanguage') }} </div>
                        <div class="profile-info-value">
                            <span class="editable">
                                @switch($online->secondLanguage)
                                    @case('French')
                                        {{ trans('admission::admission.frensh') }}
                                        @break
                                    @default
                                    {{ trans('admission::admission.german') }}

                                @endswitch
                            </span>
                        </div>
                    </div>
                    {{--date of birth  --}}
                    <div class="profile-info-row">
                        <div class="profile-info-name"> {{ trans('admission::admission.dob') }} </div>
                        <div class="profile-info-value">
                            <span class="editable">{{$online->dob}}</span>
                        </div>
                    </div>
                    {{-- age --}}
                    <div class="profile-info-row">
                        <div class="profile-info-name"> {{ trans('admission::admission.age') }} </div>
                        <div class="profile-info-value">
                            <span class="editable">{{$online->yy}} {{ trans('admission::admission.yearAge') }} - {{$online->mm}} {{ trans('admission::admission.monthAge') }} - {{$online->dd}}  {{ trans('admission::admission.dayAge') }}</span>
                        </div>
                    </div>
                    {{-- applicant nationality --}}
                    <div class="profile-info-row">
                        <div class="profile-info-name"> {{ trans('admission::admission.nationality') }} </div>
                        <div class="profile-info-value">
                            <span class="editable">{{$online->applicantNationality}}</span>
                        </div>
                    </div>
                    {{--religion  --}}
                    <div class="profile-info-row">
                        <div class="profile-info-name"> {{ trans('admission::admission.religion') }} </div>
                        <div class="profile-info-value">
                            <span class="editable">{{$online->applicantReligion=='Muslim'? trans('admission::admission.muslim'):trans('admission::admission.christian') }}</span>
                        </div>
                    </div>
                    {{-- grade --}}
                    <div class="profile-info-row">
                        <div class="profile-info-name"> {{ trans('admission::admission.nextGrade') }} </div>
                        <div class="profile-info-value">
                            <span class="editable">{{session('lang')=='ar'?$online->grades->arGrade:$online->grades->enGrade}}</span>
                        </div>
                    </div>
                    {{-- division --}}
                    <div class="profile-info-row">
                        <div class="profile-info-name"> {{ trans('admission::admission.division') }} </div>
                        <div class="profile-info-value">
                            <span class="editable">{{session('lang')=='ar'?$online->divisions->arDevision:$online->divisions->enDevision}}</span>
                        </div>
                    </div>
                    {{-- academic year --}}
                    <div class="profile-info-row">
                        <div class="profile-info-name"> {{ trans('admission::admission.nextAcademicYear') }} </div>
                        <div class="profile-info-value">
                            <span class="editable">{{$online->academicyears->academicYear}}</span>
                        </div>
                    </div>
                    {{-- registeration type --}}
                    <div class="profile-info-row">
                        <div class="profile-info-name"> {{ trans('admission::admission.registrationType') }} </div>
                        <div class="profile-info-value">
                            <span class="editable">
                                {{-- @switch($online->registrationType)
                                    @case('new')
                                        {{ trans('admission::admission.registrationNew') }}
                                        @break
                                    @case('transfer')
                                        {{ trans('admission::admission.registrationTransfer') }}
                                        @break
                                    @case('returning')
                                        {{ trans('admission::admission.registrationReturning') }}
                                        @break
                                    @default
                                    {{ trans('admission::admission.registrationArrival') }}
                                @endswitch --}}

                                {!! Form::select('registrationType', ['new'=>trans('admission::admission.statusNew'),'transfer'=>trans('admission::admission.statusTransfer'),'transfer'=>trans('admission::admission.statusTransfer'),'returning'=>trans('admission::admission.statusReturning'),'arrival'=>trans('admission::admission.statusArrival')], $online->registrationType, ['class'=>'form-control']) !!}

                            </span>

                        </div>

                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6">
                <h3>{{ trans('admission::admission.otherInformation') }}</h3>
                <div class="profile-user-info profile-user-info-striped">
                    <div class="profile-info-row">
                        <div class="profile-info-name"> {{ trans('admission::admission.recognition') }} </div>
                        <div class="profile-info-value">
                            <span class="editable">
                                @switch($online->recognition)
                                    @case('facebook')
                                        {{ trans('admission::admission.facebook') }}
                                        @break
                                    @case('parent')
                                        {{ trans('admission::admission.parent') }}
                                        @break
                                    @case('friend')
                                        {{ trans('admission::admission.friend') }}
                                        @break
                                    @case('show')
                                        {{ trans('admission::admission.show') }}
                                        @break
                                    @default
                                        {{ trans('admission::admission.street') }}
                                @endswitch
                            </span>
                        </div>
                    </div>
                    <div class="profile-info-row">
                        <div class="profile-info-name"> {{ trans('admission::admission.educationRights') }} </div>
                        <div class="profile-info-value">
                            <span class="editable">
                                @switch($online->educationRights)
                                    @case(1)
                                        {{ trans('admission::admission.father') }}
                                        @break
                                    @default
                                        {{ trans('admission::admission.mother') }}
                                @endswitch
                            </span>
                        </div>
                    </div>
                    <div class="profile-info-row">
                        <div class="profile-info-name"> {{ trans('admission::admission.fromSchool') }} </div>
                        <div class="profile-info-value">
                            <span class="editable">{{$online->fromSchool}}</span>
                        </div>
                    </div>
                    <div class="profile-info-row">
                        <div class="profile-info-name"> {{ trans('admission::admission.transferReason') }} </div>
                        <div class="profile-info-value">
                            <span class="editable">{{$online->transferReason}}</span>
                        </div>
                    </div>
                    <div class="profile-info-row">
                        <div class="profile-info-name"> {{ trans('admission::admission.meetRepresentative') }} </div>
                        <div class="profile-info-value">
                            <span class="editable">{{$online->meetRepresentative}}</span>
                        </div>
                    </div>
                    <div class="profile-info-row">
                        <div class="profile-info-name"> {{ trans('admission::admission.registerDate') }} </div>
                        <div class="profile-info-value">
                            <span class="editable">{{\Carbon\Carbon::parse($online->created_at)->isoFormat('MMMM Do YYYY, h:m a')}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            {{-- father information --}}
            <div class="col-xs-12 col-sm-6">
                <h3>{{ trans('admission::admission.fatherInformation') }}</h3>
                <div class="profile-user-info profile-user-info-striped">
                    <div class="profile-info-row">
                        <div class="profile-info-name"> {{ trans('admission::admission.fatherFullName') }} </div>
                        <div class="profile-info-value">
                            <span class="editable"> {{ $online->firstName }} {{ $online->middleName }} {{ $online->lastName }} {{ $online->familyName }}</span>
                        </div>
                    </div>
                    <div class="profile-info-row">
                        <div class="profile-info-name"> {{ trans('admission::admission.fatherFullNameEnglish') }} </div>
                        <div class="profile-info-value">
                            <span class="editable"> {{ $online->firstNameEn }} {{ $online->middleNameEn }} {{ $online->lastNameEn }} {{ $online->familyNameEn }}</span>
                        </div>
                    </div>
                    <div class="profile-info-row">
                        <div class="profile-info-name"> {{ trans('admission::admission.idNumber') }} </div>
                        <div class="profile-info-value">
                            <span class="editable">{{$online->fatherIdNumber}}</span>
                        </div>
                    </div>
                    <div class="profile-info-row">
                        <div class="profile-info-name"> {{ trans('admission::admission.mobile') }} </div>
                        <div class="profile-info-value">
                            <span class="editable">{{$online->fatherMobile}}</span>
                        </div>
                    </div>
                    <div class="profile-info-row">
                        <div class="profile-info-name"> {{ trans('admission::admission.homePhone') }} </div>
                        <div class="profile-info-value">
                            <span class="editable">{{$online->homePhone}}</span>
                        </div>
                    </div>
                    <div class="profile-info-row">
                        <div class="profile-info-name"> {{ trans('admission::admission.job') }} </div>
                        <div class="profile-info-value">
                            <span class="editable">{{$online->fatherJob}}</span>
                        </div>
                    </div>
                    <div class="profile-info-row">
                        <div class="profile-info-name"> {{ trans('admission::admission.qualification') }} </div>
                        <div class="profile-info-value">
                            <span class="editable">{{$online->fatherQualification}}</span>
                        </div>
                    </div>
                    <div class="profile-info-row">
                        <div class="profile-info-name"> {{ trans('admission::admission.email') }} </div>
                        <div class="profile-info-value">
                            <span class="editable">{{$online->fatherEmail}}</span>
                        </div>
                    </div>
                    <div class="profile-info-row">
                        <div class="profile-info-name"> {{ trans('admission::admission.nationality') }} </div>
                        <div class="profile-info-value">
                            <span class="editable">{{$online->fatherNationality}}</span>
                        </div>
                    </div>
                    <div class="profile-info-row">
                        <div class="profile-info-name"> {{ trans('admission::admission.maritalStatus') }} </div>
                        <div class="profile-info-value">
                            <span class="editable">
                                @switch($online->maritalStatus)
                                    @case('Married')
                                        {{ trans('admission::admission.married') }}
                                        @break
                                    @case('Divorced')
                                        {{ trans('admission::admission.divorced') }}
                                        @break
                                    @case('Separated')
                                        {{ trans('admission::admission.separated') }}
                                        @break
                                    @default
                                        {{ trans('admission::admission.widow') }}
                                @endswitch

                            </span>
                        </div>
                    </div>
                    <div class="profile-info-row">
                        <div class="profile-info-name"> {{ trans('admission::admission.religion') }} </div>
                        <div class="profile-info-value">
                            <span class="editable">{{$online->fatherReligion=='Muslim'? trans('admission::admission.muslim'):trans('admission::admission.christian') }}</span>
                        </div>
                    </div>
                    <div class="profile-info-row">
                        <div class="profile-info-name"> {{ trans('admission::admission.address') }} </div>
                        <div class="profile-info-value">
                            <span class="editable">
                                {{$online->fatherBlockNo}}
                                {{$online->fatherStreetName}}
                                {{$online->fatherArea}}
                                {{$online->fatherGovernorate}}
                            </span>
                        </div>
                    </div>
                    <div class="profile-info-row">
                        <div class="profile-info-name"> {{ trans('admission::admission.facebookAccount') }} </div>
                        <div class="profile-info-value">
                            <span class="editable">{{$online->fatherFacebookAccount}}</span>
                        </div>
                    </div>
                </div>
            </div>
            {{-- mother information --}}
            <div class="col-xs-12 col-sm-6">
                <h3>{{ trans('admission::admission.motherInformation') }}</h3>
                <div class="profile-user-info profile-user-info-striped">
                    <div class="profile-info-row">
                        <div class="profile-info-name"> {{ trans('admission::admission.motherName') }} </div>
                        <div class="profile-info-value">
                            <span class="editable"> {{ $online->motherName }} </span>
                        </div>
                    </div>
                    <div class="profile-info-row">
                        <div class="profile-info-name"> {{ trans('admission::admission.idNumber') }} </div>
                        <div class="profile-info-value">
                            <span class="editable">{{$online->motherIdNumber}}</span>
                        </div>
                    </div>
                    <div class="profile-info-row">
                        <div class="profile-info-name"> {{ trans('admission::admission.mobile') }} </div>
                        <div class="profile-info-value">
                            <span class="editable">{{$online->motherMobile}}</span>
                        </div>
                    </div>
                    <div class="profile-info-row">
                        <div class="profile-info-name"> {{ trans('admission::admission.job') }} </div>
                        <div class="profile-info-value">
                            <span class="editable">{{$online->motherJob}}</span>
                        </div>
                    </div>
                    <div class="profile-info-row">
                        <div class="profile-info-name"> {{ trans('admission::admission.qualification') }} </div>
                        <div class="profile-info-value">
                            <span class="editable">{{$online->motherQualification}}</span>
                        </div>
                    </div>
                    <div class="profile-info-row">
                        <div class="profile-info-name"> {{ trans('admission::admission.email') }} </div>
                        <div class="profile-info-value">
                            <span class="editable">{{$online->motherEmail}}</span>
                        </div>
                    </div>
                    <div class="profile-info-row">
                        <div class="profile-info-name"> {{ trans('admission::admission.nationality') }} </div>
                        <div class="profile-info-value">
                            <span class="editable">{{$online->motherNationality}}</span>
                        </div>
                    </div>
                    <div class="profile-info-row">
                        <div class="profile-info-name"> {{ trans('admission::admission.religion') }} </div>
                        <div class="profile-info-value">
                            <span class="editable">{{$online->motherReligion=='Muslim'? trans('admission::admission.muslim'):trans('admission::admission.christian') }}</span>
                        </div>
                    </div>
                    <div class="profile-info-row">
                        <div class="profile-info-name"> {{ trans('admission::admission.address') }} </div>
                        <div class="profile-info-value">
                            <span class="editable">
                                {{$online->motherBlockNo}}
                                {{$online->motherStreetName}}
                                {{$online->motherArea}}
                                {{$online->motherGovernorate}}
                            </span>
                        </div>
                    </div>
                    <div class="profile-info-row">
                        <div class="profile-info-name"> {{ trans('admission::admission.facebookAccount') }} </div>
                        <div class="profile-info-value">
                            <span class="editable">{{$online->motherFacebookAccount}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    {!! Form::close() !!}

@endsection
@section('jquery')
<script src="{{url('/public/design/js/jquery-2.1.4.min.js')}}"></script>
@endsection
