@extends('dragon-license::layouts.master')

@section('title', 'License Invalid - Dragon License')

@section('content')
<div class="content">
    <div class="icon-error">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#ff6b6b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"></circle>
            <line x1="15" y1="9" x2="9" y2="15"></line>
            <line x1="9" y1="9" x2="15" y2="15"></line>
        </svg>
    </div>
    
    <h2 style="color: #ff6b6b;">License Verification Failed</h2>
    <p>{{ $error ?? 'Your license could not be verified with the license server.' }}</p>
    
    <div class="info-box">
        <h4>Site And Device Information</h4>
        <div class="info-row">
            <span class="label">Domain</span>
            <span class="value">{{ $license->ip_or_domain ?? request()->getHost() }}</span>
        </div>
        <div class="info-row">
            <span class="label">Device Name</span>
            <span class="value">{{ gethostname() }}</span>
        </div>
    </div>
    
    <div class="info-box">
        <h4>License Information</h4>
        <div class="form-group" style="margin-bottom: 12px;">
            <label>Purchase Code</label>
            <div class="display-field">{{ $license->purchase ?? 'N/A' }}</div>
        </div>
        <div class="form-group" style="margin-bottom: 0;">
            <label>Email</label>
            <div class="display-field">{{ $license->email ?? 'N/A' }}</div>
        </div>
    </div>
    
    <p style="font-size: 0.85rem; margin-bottom: 20px;">
        Please contact support or update your license to continue using the application.
    </p>
    
    <div class="btn-group">
        <a href="{{ route('dragon-license.license-update') }}" class="btn">Update License</a>
        <a href="javascript:location.reload()" class="btn btn-secondary">Retry</a>
    </div>
</div>
@endsection
