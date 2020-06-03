<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{trans('admin.login')}}</title>

    <meta charset="UTF-8">
    <link rel="shortcut icon" href="{{asset('images/website/'.settingHelper()->icon)}}">
    <meta name="description" content="User login page" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{url('/public/design/login/vendor/bootstrap/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{url('/public/design/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}" />
    <link rel="stylesheet" href="{{url('/public/design/login/css/util.css')}}" />
    <link rel="stylesheet" href="{{url('/public/design/login/css/main.css')}}" />


    @if (session('lang') == 'ar')
        <link rel="stylesheet" href="{{url('/public/design/css/rtl.css')}}" />            
    @endif	
    <style>
        body {font-family: Arial, Helvetica, sans-serif;}
        * {box-sizing: border-box;}
        .input-container { display: -ms-flexbox; /* IE10 */ display: flex; width: 100%;margin-bottom: 15px;}  
        .icon {padding: 10px;background: dodgerblue; color: white;min-width: 50px;text-align: center;}
        .input-field {width: 100%;padding: 10px;outline: none;}
        .input-field:focus { border: 2px solid dodgerblue;}
        /* Set a style for the submit button */
        .btn {background-color: dodgerblue;color: white;padding: 15px 20px;border: none; cursor: pointer;width: 100%; opacity: 0.9; }
        .btn:hover {opacity: 1;}
        .center{text-align: center}
        .se-pre-con {
                position: fixed;
                left: 0px;
                top: 0px;
                width: 100%;
                height: 100%;
                z-index: 9999;
                background: url("{{url('public/design/loader-64x/mv2.gif')}}") center no-repeat #fff;        }
                .message{
                position: absolute;width: 100%;height: 50px;background-color: #11c011;color: white;line-height: 50px;
                z-index: 1200;text-align: center;opacity: 1;top: -50px ;
            }
            .sweet-alert h2 {font-family: 'Noto Kufi Arabic';font-weight: 500;}
            .sweet-alert p {font-family: 'Noto Kufi Arabic';}
            .sweet-alert button {font-family: 'Noto Kufi Arabic';}
            .sweet-alert {font-family: 'Noto Kufi Arabic';}
    </style>
</head>
<body style="background-color: #666666; font-family: 'Noto Kufi Arabic';/">
	<div class="se-pre-con"></div>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
                <form action="{{url('/admin/login')}}" method="POST" class="login100-form validate-form">     
                    <div class="center">
                        <img src="{{asset('public/images/website/'.settingHelper()->logo)}}" width="100" height="100">
                        <h1>                            
                            <span class="white" style="font-size: 30px;font-weight:bold;color:#3590ff;" id="id-text2">{{trans('admin.systemShourtName')}}</span>
                        </h1>								
                    </div>     
                    <br>         
                    @csrf
					<span class="login100-form-title p-b-20" style="font-family: 'Noto Kufi Arabic';">
						{{trans('admin.startSession')}}
                    </span>
                      <div class="input-container">
                        <i class="fa fa-envelope icon"></i>
                        <input class="input-field" type="email" placeholder="{{trans('admin.email')}}" name="email">
                      </div>
                      <div class="input-container">
                        <i class="fa fa-lock icon"></i>
                        <input class="input-field" type="password" placeholder="{{trans('admin.password')}}" name="password">
                      </div>

					<div class="flex-sb-m w-full p-t-3 p-b-32">
						<div class="contact100-form-checkbox">
							<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
							<label class="label-checkbox100" for="ckb1" style="font-family: 'Noto Kufi Arabic';">
								{{trans('admin.rememberme')}}
							</label>
						</div>

						<div>
							<a href="#" class="txt1" style="font-family: 'Noto Kufi Arabic';">
								{{trans('admin.forgotPasswordText')}}
							</a>
						</div>
					</div>
			

					<div class="container-login100-form-btn">
                        <button type="submit" style="font-family: 'Noto Kufi Arabic';" class="btn">{{trans('admin.signIn')}}</button>						
                    </div>
                    <br>
                    <p style="font-family: 'Noto Kufi Arabic';">{{ trans('admin.loginTips') }}</p>					
				</form>
                @if(session()->has('error'))
                    <div class="alert alert-danger">
                    {{ session('error')}}
                    </div>    
                @endif
				<div class="login100-more" style='background-image: url("{{url('/public/design/login/images/10.jpeg')}}");'>
				</div>
			</div>
		</div>
    </div>
    <script src="{{url('/public/design/js/jquery-2.1.4.min.js')}}"></script>
    <script>
        $(document).ready(function(){            
            $(".se-pre-con").fadeOut("slow");
        })
    </script>
</body>
</html>