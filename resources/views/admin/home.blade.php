@extends('layouts.admin')
@section('title')
    Admin Panel || {{$admin->first_name}}
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-3 panel tabs-panel" align="center" style=" "> <!-- required for floating -->
                <!-- Nav tabs -->
                <ul class="nav nav-tabs tabs-left">
                    <h3>Admins</h3>
                    <li class="active"><a href="#all_admins" data-toggle="tab">All Admins</a></li>
                    <li><a href="#new_admin" data-toggle="tab">Add Admin</a></li>
                    <li><a href="#me" data-toggle="tab">My Profile</a></li>
                    <li><a href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" data-toggle="tab">Logout</a></li>
                    <h3>Courses</h3>
                    <li><a href="#courses" data-toggle="tab">All Courses</a></li>
                    <li><a href="{{url('courses/create')}}">Create New</a></li>
                    <li><a href="#edit Course" data-toggle="tab">Edit Course</a></li>
                    <li><a href="#settings" data-toggle="tab">Settings</a></li>
                </ul>
            </div>

            <div class="col-xs-12 col-sm-8 col-sm-offset-1 ">
                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane active panel panel-default tabs-panel" id="all_admins">
                        <div class="panel-heading" align="center">
                            All Admins
                        </div>
                        <div class="panel-body">
                            @php $admins = \App\Admin::paginate(4);@endphp
                            @foreach($admins as $display_admin)
                                <div class="col-md-4 col-sm-6 card-holder">
                                    <div class="card">
                                        {{--<canvas class="header-bg" width="250" height="70" id="header-blur"></canvas>--}}
                                        <div class="avatar">
                                            <img src="{{  asset('storage/'.$display_admin->avatar) }}" alt="{{$display_admin->first_name}}'s face" />
                                        </div>
                                        <div class="content">
                                            <p>{{$display_admin->first_name}}<br>
                                                {{$display_admin->job_title}}</p>
                                            <p><button type="button" class="btn btn-success">Contact</button></p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="panel-footer center-block">
                            {{$admins->links('vendor.pagination.bootstrap-4',[])}}
                        </div>
                    </div>
                    <div class="tab-pane panel panel-default tabs-panel" id="new_admin">
                        <div class="panel-heading" align="center">
                            Create new Admin
                        </div>
                        <div class="panel-body" align="center">
                            @if($admin->can_create == TRUE )

                            @else
                                <p class="jumbotron lead"><span class="header">{{$admin->first_name}}</span> You are not authorized to create new Admin users</p>
                            @endif
                        </div>
                    </div>
                    <div class="tab-pane panel panel-default tabs-panel" id="courses">
                        <div class="panel-heading" align="center">
                            All Courses
                        </div>
                        <div class="panel-body" align="center">
                            @php $courses = \App\Course::paginate(4); @endphp
                            @foreach($courses as $course)
                                <div class="col-sm-6 col-md-4">
                                    <div class="thumbnail" >
                                        @if($admin->id == $course->owner->id)
                                            <h4 class="text-center"><span class="label label-success">{{$course->title}}</span></h4>
                                        @else
                                            <h4 class="text-center"><span class="label label-info">{{$course->title}}</span></h4>
                                        @endif
                                        <img src="{{asset('storage/'.$course->banner)}}" class="img-responsive">
                                        <div class="caption">
                                            <div class="row">
                                                <div class="col-md-6 col-xs-6">
                                                    <h5>{{$course->category}}</h5>
                                                </div>
                                                <div class="col-md-6 col-xs-6 price">
                                                    <h5>
                                                        <label>{{$course->price}}</label></h5>
                                                </div>
                                            </div>
                                            @if($admin->id == $course->owner->id)
                                                <p class="text-center text-info">Me: {{$course->owner->first_name}} {{$course->owner->last_name}}</p>
                                            @else
                                                <p class="text-center text-success">{{$course->owner->first_name}} {{$course->owner->last_name}}</p>
                                            @endif
                                            <div class="row">
                                                @if($admin->id == $course->owner->id)
                                                    <div class="col-md-6">
                                                        <a class="btn btn-primary btn-product" href="{{url('courses/'.$course->id)}}"><span class="glyphicon glyphicon-eye-open"></span> View</a>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <a class="btn btn-success btn-product" href="{{url('courses/'.$course->id.'/edit')}}" ><span class="glyphicon glyphicon-pencil"></span> Edit</a>
                                                    </div>
                                                @else
                                                    <div class="col-md-12">
                                                        <a class="btn btn-primary btn-product" ><span class="glyphicon glyphicon-eye-open"></span> View</a>
                                                    </div>
                                                @endif
                                            </div>

                                            <p> </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            @if($courses->count() <= 0)
                                <h1 class="lead jumbotron">No Courses</h1>
                            @endif
                        </div>
                        <div class="panel-footer center-block">
                            {{$courses->links('vendor.pagination.bootstrap-4',[])}}
                        </div>
                    </div>
                    <div class="tab-pane panel panel-default tabs-panel" id="settings">
                        <div class="panel-heading" align="center">
                            Settings
                        </div>
                        <div class="panel-body" align="center">

                        </div>
                    </div>
                    <div class="tab-pane panel panel-default tabs-panel" id="me">
                        <div class="panel-heading" align="center">
                            My Profile
                        </div>
                        <div class="panel-body" align="center">
                            <div class="col-md-4 col-sm-12 my-course-holder"  style="">
                                <h3 class="lead text-info">Profile</h3>
                                <div class="card-holder">
                                    <div class="card">
                                        {{--<canvas class="header-bg" width="250" height="70" id="header-blur"></canvas>--}}
                                        <div class="avatar">
                                            <img src="{{  asset('storage/'.$admin->avatar) }}" alt="{{$admin->first_name}}'s face" />
                                        </div>
                                        <div class="content">
                                            <p>{{$admin->first_name}}<br>
                                                {{$admin->job_title}}<br>
                                                {{$admin->courses()->count()}}
                                                @if($admin->courses()->count() === 1) Course @else Courses @endif</p>
                                            <p><i class="fa fa-fw fa-envelope-o"></i> {{$admin->email}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8 col-sm-12">
                                <h3 class="lead text-info">Courses</h3>
                                @php $myCourses = $admin->courses; @endphp
                                @foreach($myCourses as $course)
                                    <div class="col-sm-6 col-md-6">
                                        <div class="thumbnail panel-danger" >
                                                <h4 class="text-center"><span class="label label-success">{{$course->title}}</span></h4>
                                            <img src="{{asset('storage/'.$course->banner)}}" class="img-responsive">
                                            <div class="caption">
                                                <div class="row">
                                                    <div class="col-md-6 col-xs-6">
                                                        <h5>{{$course->category}}</h5>
                                                    </div>
                                                    <div class="col-md-6 col-xs-6 price">
                                                        <h5>
                                                            <label>{{$course->price}}</label></h5>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                        <div class="col-md-6">
                                                            <a class="btn btn-primary btn-product" href="{{url('courses/'.$course->id)}}"><span class="glyphicon glyphicon-eye-open"></span> View</a>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <a class="btn btn-success btn-product" href="{{url('courses/'.$course->id.'/edit')}}" ><span class="glyphicon glyphicon-pencil"></span> Edit</a>
                                                        </div>
                                                </div>
                                                <p> </p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection