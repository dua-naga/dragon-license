@extends('dragon-license::layouts.master')

@section('title', 'Update License - Dragon License')

@section('content')
<div class="content">
    <h2 style="margin-bottom: 15px;">Update License</h2>
    <p style="margin-bottom: 30px; color: rgba(255,255,255,0.7);">
        Update your license information.
    </p>
    
    <div id="alert-container"></div>
    
    <form id="license-form">
        @csrf
        
        <div class="form-group">
            <label for="purchase">Purchase Code</label>
            <input type="text" name="purchase" id="purchase" value="{{ $license->purchase ?? '' }}" required placeholder="Enter your purchase code">
        </div>
        
        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" name="email" id="email" value="{{ $license->email ?? '' }}" required placeholder="Enter your email">
        </div>
        
        <div class="form-group">
            <label for="product">Product Name</label>
            <input type="text" name="product" id="product" value="{{ $license->name ?? config('app.name', 'Application') }}" required>
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
