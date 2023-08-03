
        <div class="row mb-3">
            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
            <div class="col-md-6 col-form-label">
            {{ $person->full_name }}
            <input id="id" type="hidden" class="form-control" name="id" value="{{ $person->id }}" required>                       
            </div>
        </div>

        <div class="row mb-3">
            <label for="nickname" class="col-md-4 col-form-label text-md-right">{{ __('Nickname') }}</label>

            <div class="col-md-6">
                <input id="nickname" type="text" class="form-control" name="nickname" value="{{ $person->nickname }}" required autocomplete="nickname">

            </div>
        </div>

        <div class="row mb-3">
            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

            <div class="col-md-6">
                <input id="personal_email" type="email" class="form-control" name="personal_email" value="{{ $person->personal_email }}" required autocomplete="email">

            </div>
        </div>

        <div class="row mb-3">
            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

            <div class="col-md-6">
                <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password">

            </div>
        </div>

        <div class="row mb-3">
            <label for="password_confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

            <div class="col-md-6">
                <input id="password_confirm" type="password" class="form-control" name="password_confirm" required autocomplete="new-password">
            </div>
        </div>

        <div class="row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Register') }}
                </button>
            </div>
        </div>