@extends('dragon-license::layouts.master')

@section('title', 'License Required - Dragon License')

@section('content')
<div class="content">
    <div style="font-size: 4rem; margin-bottom: 20px;">🔐</div>
    <h2 style="margin-bottom: 15px;">License Required</h2>
    <p style="margin-bottom: 30px; color: rgba(255,255,255,0.7);">
        Please activate your license to continue using the application.
    </p>
    
    <a href="{{ route('dragon-license.validation') }}" class="btn">
        Enter License Key →
    </a>
</div>
@endsection
