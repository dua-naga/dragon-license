@extends('vendor.dragon-license.layouts.master')

@section('title', 'Requirements - Dragon License')

@section('content')
<div class="steps">
    <div class="step completed">1</div>
    <div class="step active">2</div>
    <div class="step">3</div>
    <div class="step">4</div>
</div>

<div class="content">
    <h2 style="margin-bottom: 15px;">System Requirements</h2>
    <p style="margin-bottom: 30px; color: rgba(255,255,255,0.7);">
        Checking if your server meets the requirements.
    </p>
    
    <div style="text-align: left; margin-bottom: 20px;">
        <h4 style="margin-bottom: 10px;">PHP Version</h4>
        <div style="padding: 10px; background: rgba(255,255,255,0.1); border-radius: 8px; margin-bottom: 15px;">
            <span>Current: {{ $phpSupportInfo['current'] }}</span>
            <span style="float: right;">
                @if($phpSupportInfo['supported'])
                    <span style="color: #2ecc71;">✓</span>
                @else
                    <span style="color: #e74c3c;">✗</span>
                @endif
            </span>
        </div>
        
        <h4 style="margin-bottom: 10px;">PHP Extensions</h4>
        @if(isset($requirements['requirements']['php']))
            @foreach($requirements['requirements']['php'] as $extension => $enabled)
            <div style="padding: 10px; background: rgba(255,255,255,0.1); border-radius: 8px; margin-bottom: 5px;">
                <span>{{ $extension }}</span>
                <span style="float: right;">
                    @if($enabled)
                        <span style="color: #2ecc71;">✓</span>
                    @else
                        <span style="color: #e74c3c;">✗</span>
                    @endif
                </span>
            </div>
            @endforeach
        @endif
    </div>
    
    @if(!isset($requirements['errors']) && $phpSupportInfo['supported'])
    <a href="{{ route('DragonLicense::permissions') }}" class="btn">
        Continue →
    </a>
    @else
    <div class="alert alert-danger">
        Please fix the requirements above before continuing.
    </div>
    @endif
</div>
@endsection
