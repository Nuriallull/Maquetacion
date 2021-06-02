@extends('front.layout.master')

@section('title')@lang('front/seo.web-name') | {{$mueble->seo->title}} @stop
@section('description'){{$mueble->seo->description != null? $mueble->seo->description : $mueble->seo->locale_seo->description}} @stop
@section('keywords'){{$mueble->seo->keywords != null ? $mueble->seo->keywords : $mueble->seo->locale_seo->keywords}} @stop
@section('facebook-url'){{URL::asset('/muebles/' . $mueble->seo->slug)}} @stop
@section('facebook-title'){{$mueble->seo->title}} @stop
@section('facebook-description'){{$mueble->seo->description != null ? $mueble->seo->description : $mueble->seo->locale_seo->description}} @stop

@section("content")
    @if($agent->isDesktop())
        <div class="page-section">
            @include("front.pages.muebles.desktop.mueble")
            
        </div>
    @endif

    @if($agent->isMobile())
        <div class="page-section">
            @include("front.pages.muebles.mobile.mueble")
            
        </div>
    @endif
@endsection
        
        