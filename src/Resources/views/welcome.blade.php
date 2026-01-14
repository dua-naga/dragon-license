@extends('dragon-license::layouts.master')

@section('title', 'License Required - Dragon License')

@section('styles')
<style>
    .content {
        text-align: center;
    }
    .content h2 {
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: hsl(0 0% 3.9%);
        letter-spacing: -0.025em;
    }
    .content p {
        font-size: 0.875rem;
        color: hsl(0 0% 45.1%);
        margin-bottom: 2rem;
        line-height: 1.5;
        max-width: 28rem;
        margin-left: auto;
        margin-right: auto;
    }
    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        padding: 0.625rem 1rem;
        font-size: 0.875rem;
        font-weight: 500;
        background-color: hsl(0 0% 9%);
        color: hsl(0 0% 98%);
        border: 1px solid hsl(0 0% 9%);
        border-radius: 0.375rem;
        transition: all 0.2s;
        text-decoration: none;
        cursor: pointer;
    }
    .btn:hover {
        background-color: hsl(0 0% 3.9%);
        border-color: hsl(0 0% 3.9%);
    }
    .btn:focus-visible {
        outline: 2px solid hsl(0 0% 9%);
        outline-offset: 2px;
    }
</style>
@endsection

@section('content')
<div class="content">
    <h2>License Required</h2>
    <p>
        Please activate your license to continue using the application.
    </p>
    
    <a href="{{ route('dragon-license.validation') }}" class="btn">
        Enter License Key
    </a>
</div>
@endsection
