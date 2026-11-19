<form
    method="POST"
    action="{{ url('/two-factor-challenge') }}"
>
    @csrf

    <div>
        <label for="code">
            Código del autenticador
        </label>

        <input
            id="code"
            type="text"
            name="code"
            inputmode="numeric"
            autocomplete="one-time-code"
        >

        @error('code')
            <span>{{ $message }}</span>
        @enderror
    </div>

    <div>
        <label for="recovery_code">
            Código de recuperación
        </label>

        <input
            id="recovery_code"
            type="text"
            name="recovery_code"
            autocomplete="one-time-code"
        >

        @error('recovery_code')
            <span>{{ $message }}</span>
        @enderror
    </div>

    <button type="submit">
        Verificar
    </button>
</form>