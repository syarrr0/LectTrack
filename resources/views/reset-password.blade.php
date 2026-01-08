<h2>Reset Password</h2>

<form method="POST" action="{{ route('reset.submit') }}">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">

    <label>New password:</label>
    <input type="password" name="password" required>

    <button type="submit">Reset Password</button>
</form>
