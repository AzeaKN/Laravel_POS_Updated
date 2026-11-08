<div class="form-grid">
    <label>
        <span>Full name</span>
        <input type="text" name="full_name" value="{{ old('full_name', $customer->full_name ?? '') }}" required>
        @error('full_name')<small class="form-error">{{ $message }}</small>@enderror
    </label>
    <label>
        <span>Email address</span>
        <input type="email" name="email" value="{{ old('email', $customer->email ?? '') }}" required>
        @error('email')<small class="form-error">{{ $message }}</small>@enderror
    </label>
    <label>
        <span>Phone number</span>
        <input type="text" name="phone" value="{{ old('phone', $customer->phone ?? '') }}" required>
        @error('phone')<small class="form-error">{{ $message }}</small>@enderror
    </label>
</div>
<div class="form-actions">
    <a class="button button-secondary" href="{{ route('customers.index') }}">Cancel</a>
    <button class="button button-primary" type="submit">{{ $submitLabel }}</button>
</div>
