@section('content')
<form method="POST" action="{{ route('password.update') }}">
            @csrf

            <!-- REQUIRED -->
            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="email" value="{{ request()->email }}">

            <div class="mb-6">
              <label class="form-label">New Password</label>
              <input type="password" name="password" class="form-control" required>
            </div>

            <div class="mb-6">
              <label class="form-label">Confirm Password</label>
              <input type="password" name="password_confirmation" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary d-grid w-100 mb-6">
              Set new password
            </button>

            <div class="text-center">
              <a href="{{ route('login') }}" class="d-flex justify-content-center">
                Back to login
              </a>
            </div>
          </form>
@endsection
