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
            <div class="avatar-upload" data-avatar-upload>
                <input class="avatar-upload-input" type="file" name="avatar" accept="image/*" data-avatar-input>
                <div class="avatar-upload-preview">
                    @if ($user->avatar)
                        <img src="{{ asset('storage/'.$user->avatar) }}" alt="{{ $user->full_name }}" data-avatar-preview>
                    @else
                        <span class="avatar avatar-upload-placeholder" data-avatar-placeholder>{{ strtoupper(collect(preg_split('/\s+/', $user->full_name))->map(fn ($part) => substr($part, 0, 1))->take(2)->implode('')) }}</span>
                    @endif
                </div>
                <div class="avatar-upload-copy">
                    <strong data-avatar-label>Choose a profile picture</strong>
                    <small>Drag and drop an image here, or click to browse.</small>
                    <small data-avatar-status>PNG, JPG, GIF, or WEBP up to 2 MB</small>
                </div>
            </div>
            @error('avatar')<small class="form-error">{{ $message }}</small>@enderror
        </label>
    @endif
</div>
<div class="form-actions">
    <a class="button button-secondary" href="{{ route('users.index') }}">Cancel</a>
    <button class="button button-primary" type="submit">{{ $submitLabel }}</button>
</div>
