@extends('layouts.home)
@section('title')
    Take test || {{$course->title}}
@endsection
@section('moreStyles')
    <link type="text/css" rel="stylesheet" href="{{URL::asset('css/sb-admin.css')}}"/>
@endsection
