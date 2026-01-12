@extends('vendor.dragon-license.layouts.master')

@section('title', 'License Activation - Dragon License')

@section('content')
<div class="steps">
    <div class="step active">1</div>
    <div class="step">2</div>
    <div class="step">3</div>
    <div class="step">4</div>
</div>

<div class="content">
    <h2 style="margin-bottom: 15px;">License Activation</h2>
    <p style="margin-bottom: 30px; color: rgba(255,255,255,0.7);">
        Please enter your license details to continue with the installation.
    </p>
    
    @if(session('failed'))
    <div class="alert alert-danger">
        {{ session('failed') }}
    </div>
    @endif
    
    <form action="{{ route('DragonLicense::licenseStore') }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label for="purchase">Purchase Code</label>
            <input type="text" name="purchase" id="purchase" required placeholder="Enter your purchase code">
        </div>
        
        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" name="email" id="email" required placeholder="Enter your email">
        </div>
        
        <div class="form-group">
            <label for="product">Product Name</label>
            <input type="text" name="product" id="product" value="{{ config('app.name', 'Application') }}" required>
        </div>
        
        <button type="submit" class="btn">
            Verify License →
        </button>
    </form>
</div>
@endsection
