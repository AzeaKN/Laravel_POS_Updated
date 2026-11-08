<div class="form-grid">
    <label>
        <span>Username</span>
        <input type="text" name="username" value="{{ old('username', $user->username ?? '') }}" required>
        @error('username')<small class="form-error">{{ $message }}</small>@enderror
    </label>
    <label>
        <span>Full name</span>
        <input type="text" name="full_name" value="{{ old('full_name', $user->full_name ?? '') }}" required>
        @error('full_name')<small class="form-error">{{ $message }}</small>@enderror
    </label>
    <label>
        <span>Email address</span>
        <input type="email" name="email" value="{{ old('email', $user->email ?? '') }}" required>
        @error('email')<small class="form-error">{{ $message }}</small>@enderror
    </label>
    @if (isset($user))
        <label>
            <span>Profile picture <small>(JPG, PNG, GIF, or WEBP; max 2 MB)</small></span>
            <input type="file" name="avatar" accept="image/*">
            @error('avatar')<small class="form-error">{{ $message }}</small>@enderror
        </label>
    @endif
</div>
<div class="form-actions">
    <a class="button button-secondary" href="{{ route('users.index') }}">Cancel</a>
    <button class="button button-primary" type="submit">{{ $submitLabel }}</button>
</div>
