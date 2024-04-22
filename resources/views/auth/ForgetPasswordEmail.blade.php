<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">{{ config('app.name') }}</h4>
                </div>
                <div class="card-body">
                    <h4 class="card-title">Password Reset</h4>
                    <p class="card-text">Hello,</p>
                    <p class="card-text">We received a request to reset your password. If you did not make this request, you can ignore this email.</p>
                    <p class="card-text">To reset your password, please click on the following link:</p>
                    <a href="{{ route('reset.password', $token) }}" class="btn btn-primary">Reset Password</a>
                    <p class="card-text mt-2">If you're having trouble clicking the "Reset Password" button, copy and paste the URL below into your web browser:</p>
                    <p class="card-text">{{ route('reset.password', $token) }}</p>
                    <p class="card-text">This link will expire in 24 hours for security reasons.</p>
                    <p class="card-text">Thank you!</p>
                </div>
            </div>
        </div>
    </div>
</div>