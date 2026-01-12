@extends('dragon-license::layouts.master')

@section('title', 'Enter License - Dragon License')

@section('content')
<div class="content">
    <h2>License Activation</h2>
    <p>Please enter your license details to activate the application.</p>
    
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
    
    <div id="alert-container"></div>
    
    <form id="license-form">
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
        
        <button type="submit" class="btn" id="submit-btn">
            Activate License
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
    submitBtn.textContent = 'Verifying...';
    
    const formData = new FormData(form);
    
    fetch('{{ route("dragon-license.store") }}', {
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
            submitBtn.textContent = 'Activate License';
        }
    })
    .catch(error => {
        alertContainer.innerHTML = '<div class="alert alert-danger">An error occurred. Please try again.</div>';
        submitBtn.disabled = false;
        submitBtn.textContent = 'Activate License';
    });
});
</script>
@endsection
