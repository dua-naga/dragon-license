@extends('dragon-license::layouts.master')

@section('title', 'Installation Complete - Dragon License')

@section('content')
<div class="content">
    <div style="font-size: 4rem; margin-bottom: 20px;">🎉</div>
    <h2 style="margin-bottom: 15px;">Installation Complete!</h2>
    <p style="margin-bottom: 30px; color: rgba(255,255,255,0.7);">
        Congratulations! Your application has been installed successfully.
    </p>
    
    <div class="alert alert-success">
        {{ $finalStatusMessage ?? 'Installation completed successfully.' }}
    </div>
    
    <a href="{{ url('/') }}" class="btn">
        Go to Application →
    </a>
</div>
@endsection
