@extends('vendor.dragon-license.layouts.master')

@section('title', 'Enter License - Dragon License')

@section('content')
<div class="content">
    <h2 style="margin-bottom: 15px;">License Activation</h2>
    <p style="margin-bottom: 30px; color: rgba(255,255,255,0.7);">
        Please enter your license details to activate the application.
    </p>
    
    <div id="alert-container"></div>
    
    <form id="license-form">
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
            <input type="text" name="product" id="product" value="{{ env('APP_NAME', 'Application') }}" required>
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
