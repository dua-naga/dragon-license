@extends('dragon-license::layouts.master')

@section('title', 'Welcome - Dragon License')

@section('content')
<div class="content">
    <h2 style="margin-bottom: 15px;">Welcome to Installation</h2>
    <p style="margin-bottom: 30px; color: rgba(255,255,255,0.7);">
        Let's get started with the installation process. Please follow the steps to complete the setup.
    </p>
    <a href="{{ route('DragonLicense::license') }}" class="btn">
        Get Started →
    </a>
</div>
@endsection
