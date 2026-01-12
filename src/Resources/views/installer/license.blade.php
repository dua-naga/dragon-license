@extends('dragon-license::layouts.master')

@section('title', 'License Activation - Dragon License')

@section('content')
<div class="steps">
    <div class="step active">1</div>
    <div class="step">2</div>
    <div class="step">3</div>
    <div class="step">4</div>
</div>

<div class="content">
    <h2>License Activation</h2>
    <p>Please enter your license details to continue with the installation.</p>
    
    <div class="info-box">
        <h4>Site And Device Information</h4>
        <div class="info-row">
            <span class="label">Domain</span>
            <span class="value">{{ request()->getHost() }}</span>
        </div>
        <div class="info-row">
            <span class="label">Device Name</span>
            <span class="value">{{ gethostname() }}</span>
        </div>
    </div>
    
    @if(session('failed'))
    <div class="alert alert-danger">
        {{ session('failed') }}
    </div>
    @endif
    
    <form action="{{ route('DragonLicense::licenseStore') }}" method="POST">
        @csrf
        <input type="hidden" name="product" value="{{ config('app.name', 'Application') }}">
        
        <div class="form-group">
            <label for="purchase">Purchase Code</label>
            <input type="text" name="purchase" id="purchase" required placeholder="Enter your purchase code">
        </div>
        
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" required placeholder="Enter your email">
        </div>
        
        <button type="submit" class="btn">
            Verify License →
        </button>
    </form>
</div>
@endsection
