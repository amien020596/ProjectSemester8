@if (Auth::guard('web')->check())
  <p class="text-success">you are login as <strong>user</strong></p>
@else
  <p class="text-danger">you are logout as <strong>user</strong></p>
@endif

@if (Auth::guard('admin')->check())
  <p class="text-success">you are login as <strong>admin</strong></p>
@else
  <p class="text-danger">you are logout as <strong>admin</strong></p>
@endif
