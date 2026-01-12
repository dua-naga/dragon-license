@extends('dragon-license::layouts.master')

@section('title', 'Update License - Dragon License')

@section('content')
<div class="content">
    <h2>Update License</h2>
    <p>Update your license information.</p>
    
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
    
    <div id="alert-container"></div>
    
    <form id="license-form">
        @csrf
        <input type="hidden" name="product" value="{{ $license->name ?? config('app.name', 'Application') }}">
        
        <div class="form-group">
            <label for="purchase">Purchase Code</label>
            <input type="text" name="purchase" id="purchase" value="{{ $license->purchase ?? '' }}" required placeholder="Enter your purchase code">
        </div>
        
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="{{ $license->email ?? '' }}" required placeholder="Enter your email">
        </div>
        
        <button type="submit" class="btn" id="submit-btn">
            Update License
        </button>
    </form>
</div>
@endsection

@section('scripts')
<script>
document.getElementById('license-form').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const form = this;
    const submitBtn = document.getElementById('submit-btn');
    const alertContainer = document.getElementById('alert-container');
    
    submitBtn.disabled = true;
    submitBtn.textContent = 'Updating...';
    
    const formData = new FormData(form);
    
    fetch('/app-license/store-update', {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            alertContainer.innerHTML = '<div class="alert alert-success">' + data.pesan + '</div>';
            setTimeout(() => {
                window.location.href = '/';
            }, 1500);
        } else {
            alertContainer.innerHTML = '<div class="alert alert-danger">' + data.pesan + '</div>';
            submitBtn.disabled = false;
            submitBtn.textContent = 'Update License';
        }
    })
    .catch(error => {
        alertContainer.innerHTML = '<div class="alert alert-danger">An error occurred. Please try again.</div>';
        submitBtn.disabled = false;
        submitBtn.textContent = 'Update License';
    });
});
</script>
@endsection
