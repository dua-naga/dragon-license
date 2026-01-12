@extends('vendor.dragon-license.layouts.master')

@section('title', 'Permissions - Dragon License')

@section('content')
<div class="steps">
    <div class="step completed">1</div>
    <div class="step completed">2</div>
    <div class="step active">3</div>
    <div class="step">4</div>
</div>

<div class="content">
    <h2 style="margin-bottom: 15px;">Folder Permissions</h2>
    <p style="margin-bottom: 30px; color: rgba(255,255,255,0.7);">
        Checking folder permissions.
    </p>
    
    <div style="text-align: left; margin-bottom: 20px;">
        @foreach($permissions['permissions'] as $permission)
        <div style="padding: 10px; background: rgba(255,255,255,0.1); border-radius: 8px; margin-bottom: 5px;">
            <span>{{ $permission['folder'] }} ({{ $permission['permission'] }})</span>
            <span style="float: right;">
                @if($permission['isSet'])
                    <span style="color: #2ecc71;">✓</span>
                @else
                    <span style="color: #e74c3c;">✗</span>
                @endif
            </span>
        </div>
        @endforeach
    </div>
    
    @if(!$permissions['errors'])
    <a href="{{ route('DragonLicense::environment') }}" class="btn">
        Continue →
    </a>
    @else
    <div class="alert alert-danger">
        Please fix the folder permissions above before continuing.
    </div>
    @endif
</div>
@endsection
