<div id="navbar" class="navbar navbar-default ace-save-state">
    <div class="navbar-container ace-save-state" id="navbar-container">
        <button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
            <span class="sr-only">Toggle sidebar</span>

            <span class="icon-bar"></span>

            <span class="icon-bar"></span>

            <span class="icon-bar"></span>
        </button>

        <div class="navbar-header pull-left">
            <a href="{{aurl()}}" class="navbar-brand">
                <small>
                    {{trans('admin.systemShourtName')}}
                </small>
            </a>
        </div>

        <div class="navbar-buttons navbar-header pull-right" role="navigation">
            <ul class="nav ace-nav">
                <li class="light-blue dropdown-modal">
                    <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                        <img class="nav-user-photo" src="{{asset('public/images/imagesProfile/'.authInfo()->imageProfile)}}" alt="Jason's Photo" />
                        <span class="user-info">
                            <small>{{trans('admin.welcome')}},</small>
                            {{adminAuth()->user()->name}}
                        </span>
                        <i class="ace-icon fa fa-caret-down"></i>
                    </a>
                    <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                        <!-- website -->
                        <li>
                            <a href="{{url('/')}}">
                                <i class="ace-icon fa fa-globe"></i>
                                {{trans('admin.website')}}
                            </a>
                        </li>
                        <!-- settings -->
                        <li>
                            <a href="{{aurl('setting')}}">
                                <i class="ace-icon fa fa-cog"></i>
                                {{trans('admin.settings')}}
                            </a>
                        </li>

                        <li>
                            <a href="{{aurl('lang/ar')}}">
                                <i class="ace-icon fa fa-language"></i>
                                العربية
                            </a>
                        </li>
                        <li class="divider"></li>
                        {{-- profile --}}
                        <li>
                            <a href="{{aurl('show_profile/'.authInfo()->id)}}">
                                <i class="ace-icon fa fa-user"></i>
                                {{trans('admin.profile')}}
                            </a>
                        </li>
                        {{-- change password --}}
                        <li>
                            <a href="{{aurl('change/password')}}">
                                <i class="ace-icon fa fa-unlock-alt"></i>
                                {{trans('admin.changePassword')}}
                            </a>
                        </li>

                        <li class="divider"></li>
                        <li>
                            <a href="{{aurl('logout')}}">
                                <i class="ace-icon fa fa-power-off"></i>
                                {{trans('admin.logout')}}
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div><!-- /.navbar-container -->
</div>

