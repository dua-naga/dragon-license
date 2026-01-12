@extends('vendor.dragon-license.layouts.master')

@section('title', 'Environment - Dragon License')

@section('content')
<div class="steps">
    <div class="step completed">1</div>
    <div class="step completed">2</div>
    <div class="step completed">3</div>
    <div class="step active">4</div>
</div>

<div class="content">
    <h2 style="margin-bottom: 15px;">Environment Setup</h2>
    <p style="margin-bottom: 30px; color: rgba(255,255,255,0.7);">
        Choose how you want to configure your environment.
    </p>
    
    <a href="{{ route('DragonLicense::environmentWizard') }}" class="btn" style="margin-bottom: 15px; display: block;">
        Setup Wizard
    </a>
</div>
@endsection
