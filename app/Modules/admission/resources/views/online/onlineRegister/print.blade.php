@extends('main_report.body_report')
@section('styles')
    <style>        
        .column-cell{font-size: 12px;}
        .data-cell{border: 1px solid #333;padding: 5px;font-size: 12px;}
        .form-group {margin-bottom: 5px;}
    </style>
@endsection
@section('content')
    {{-- applicant data --}}
    <h5><b>{{ trans('admission::admission.applicantData') }}</b></h5>
    <hr>
    <div class="form-group">
        <div class="row">            
            <div class="col-xs-2 column-cell">{{ trans('admission::admission.applicantName') }}</div>
            <div class="col-xs-4 data-cell">{{$online->applicantName}}</div>
            <div class="col-xs-2 column-cell">{{ trans('admission::admission.applicantName') }}</div>
            <div class="col-xs-4 data-cell">{{$online->applicantNameEn}}</div>        
        </div>
    </div>
    <div class="form-group">
        <div class="row">            
            <div class="col-xs-2 column-cell">{{ trans('admission::admission.gender') }}</div>
            <div class="col-xs-4 data-cell">{{ $online->applicantGender == 'Male'?trans('admission::admission.male'):trans('admission::admission.female') }}</div>
            <div class="col-xs-2 column-cell">{{ trans('admission::admission.nationality') }}</div>
            <div class="col-xs-4 data-cell">{{$online->applicantNationality}}</div>        
        </div>
    </div>
    <div class="form-group">
        <div class="row">            
            <div class="col-xs-2 column-cell">{{ trans('admission::admission.dob') }}</div>
            <div class="col-xs-4 data-cell">{{$online->dob}}</div>
            <div class="col-xs-2 column-cell">{{ trans('admission::admission.age') }}</div>
            <div class="col-xs-4 data-cell">{{$online->yy}} {{ trans('admission::admission.yearAge') }} - {{$online->mm}} {{ trans('admission::admission.monthAge') }} - {{$online->dd}}  {{ trans('admission::admission.dayAge') }}</div>        
        </div>
    </div>
    <div class="form-group">
        <div class="row">            
            <div class="col-xs-2 column-cell">{{ trans('admission::admission.religion') }}</div>
            <div class="col-xs-4 data-cell">{{$online->applicantReligion=='Muslim'? trans('admission::admission.muslim'):trans('admission::admission.christian') }}</div>
            <div class="col-xs-2 column-cell">{{ trans('admission::admission.registrationType') }}</div>
            <div class="col-xs-4 data-cell">
                @switch($online->registrationType)
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
            @endswitch    
            </div>         
        </div>
    </div>
    <div class="form-group">
        <div class="row">            
            <div class="col-xs-2 column-cell">{{ trans('admission::admission.nativeLanguage') }}</div>
            <div class="col-xs-4 data-cell">{{ $online->nativeLanguage }}</div>
            <div class="col-xs-2 column-cell">{{ trans('admission::admission.secondLanguage') }}</div>
            <div class="col-xs-4 data-cell">{{$online->secondLanguage}}</div>        
        </div>
    </div>
    <div class="form-group">
        <div class="row">            
            <div class="col-xs-2 column-cell">{{ trans('admission::admission.nextAcademicYear') }}</div>
            <div class="col-xs-2 data-cell">{{ $online->academicyears->academicYear }}</div>
            <div class="col-xs-2 column-cell">{{ trans('admission::admission.division') }}</div>
            <div class="col-xs-2 data-cell">{{session('lang')=='ar'?$online->divisions->arDevision:$online->divisions->enDevision}}</div>        
            <div class="col-xs-2 column-cell">{{ trans('admission::admission.nextGrade') }}</div>
            <div class="col-xs-2 data-cell">{{session('lang')=='ar'?$online->grades->arGrade:$online->grades->enGrade}}</div>
        </div>
    </div>
    {{-- father information --}}
    <h5><b>{{ trans('admission::admission.fatherInformation') }}</b></h5>
    <hr>
    <div class="form-group">
        <div class="row">            
            <div class="col-xs-2 column-cell">{{ trans('admission::admission.fatherFullName') }}</div>
            <div class="col-xs-4 data-cell">{{ $online->firstName }} {{ $online->middleName }} {{ $online->lastName }} {{ $online->familyName }}</div>
            <div class="col-xs-2 column-cell">{{ trans('admission::admission.fatherFullNameEnglish') }}</div>
            <div class="col-xs-4 data-cell">{{ $online->firstNameEn }} {{ $online->middleNameEn }} {{ $online->lastNameEn }} {{ $online->familyNameEn }}</div>        
        </div>
    </div>
    <div class="form-group">
        <div class="row">            
            <div class="col-xs-2 column-cell">{{ trans('admission::admission.homePhone') }}</div>
            <div class="col-xs-4 data-cell">{{$online->homePhone}}</div>
            <div class="col-xs-2 column-cell">{{ trans('admission::admission.mobile') }}</div>
            <div class="col-xs-4 data-cell">{{ $online->fatherMobile }}</div>        
        </div>
    </div>
    <div class="form-group">
        <div class="row">            
            <div class="col-xs-2 column-cell">{{ trans('admission::admission.nationality') }}</div>
            <div class="col-xs-4 data-cell">{{$online->fatherNationality}}</div>
            <div class="col-xs-2 column-cell">{{ trans('admission::admission.idNumber') }}</div>
            <div class="col-xs-4 data-cell">{{ $online->fatherIdNumber }}</div>        
        </div>
    </div>
    <div class="form-group">
        <div class="row">            
            <div class="col-xs-2 column-cell">{{ trans('admission::admission.qualification') }}</div>
            <div class="col-xs-4 data-cell">{{$online->fatherQualification}}</div>
            <div class="col-xs-2 column-cell">{{ trans('admission::admission.job') }}</div>
            <div class="col-xs-4 data-cell">{{ $online->fatherJob }}</div>        
        </div>
    </div>
    <div class="form-group">
        <div class="row">            
            <div class="col-xs-2 column-cell">{{ trans('admission::admission.religion') }}</div>
            <div class="col-xs-4 data-cell">{{$online->fatherReligion=='Muslim'? trans('admission::admission.muslim'):trans('admission::admission.christian') }}</div>
            <div class="col-xs-2 column-cell">{{ trans('admission::admission.maritalStatus') }}</div>
            <div class="col-xs-4 data-cell">
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
            </div>        
        </div>
    </div>
    <div class="form-group">
        <div class="row">            
            <div class="col-xs-2 column-cell">{{ trans('admission::admission.email') }}</div>
            <div class="col-xs-4 data-cell">{{$online->fatherEmail}}</div>
            <div class="col-xs-2 column-cell">{{ trans('admission::admission.address') }}</div>
            <div class="col-xs-4 data-cell">{{ $online->fatherAddress }}</div>        
        </div>
    </div>
    <div class="form-group">
        <div class="row">            
            <div class="col-xs-2 column-cell">{{ trans('admission::admission.email') }}</div>
            <div class="col-xs-10 data-cell">{{$online->fatherEmail}}</div>      
        </div>
    </div>
    {{-- mother information --}}
    <h5><b>{{ trans('admission::admission.motherInformation') }}</b></h5>
    <hr>
    <div class="form-group">
        <div class="row">            
            <div class="col-xs-2 column-cell">{{ trans('admission::admission.motherName') }}</div>
            <div class="col-xs-4 data-cell">{{ $online->motherName }}</div>
            
        </div>
    </div>
    <div class="form-group">
        <div class="row">            
            <div class="col-xs-2 column-cell">{{ trans('admission::admission.idNumber') }}</div>
            <div class="col-xs-4 data-cell">{{ $online->motherIdNumber }}</div>
            <div class="col-xs-2 column-cell">{{ trans('admission::admission.mobile') }}</div>
            <div class="col-xs-4 data-cell">{{ $online->motherMobile }}</div>        
        </div>
    </div>
    <div class="form-group">
        <div class="row">            
            <div class="col-xs-2 column-cell">{{ trans('admission::admission.qualification') }}</div>
            <div class="col-xs-4 data-cell">{{ $online->motherQualification }}</div>
            <div class="col-xs-2 column-cell">{{ trans('admission::admission.job') }}</div>
            <div class="col-xs-4 data-cell">{{ $online->motherJob }}</div>        
        </div>
    </div>
    <div class="form-group">
        <div class="row">            
            <div class="col-xs-2 column-cell">{{ trans('admission::admission.nationality') }}</div>
            <div class="col-xs-4 data-cell">{{$online->motherReligion=='Muslim'? trans('admission::admission.muslim'):trans('admission::admission.christian') }}</div>
            <div class="col-xs-2 column-cell">{{ trans('admission::admission.job') }}</div>
            <div class="col-xs-4 data-cell">{{ $online->motherNationality }}</div>        
        </div>
    </div>
    <div class="form-group">
        <div class="row">            
            <div class="col-xs-2 column-cell">{{ trans('admission::admission.email') }}</div>
            <div class="col-xs-4 data-cell">{{$online->motherEmail}}</div>
            <div class="col-xs-2 column-cell">{{ trans('admission::admission.facebookAccount') }}</div>
            <div class="col-xs-4 data-cell">{{ $online->motherFacebookAccount }}</div>        
        </div>
    </div>
    <div class="form-group">
        <div class="row">            
            <div class="col-xs-2 column-cell">{{ trans('admission::admission.address') }}</div>
            <div class="col-xs-10 data-cell">{{$online->motherAddress}}</div>            
        </div>
    </div>

    
    
  
@endsection
@section('javascript')
    <script> window.print();</script>
@endsection
@section('jquery')
<script src="{{url('/public/design/js/jquery-2.1.4.min.js')}}"></script>
@endsection