<h1>Nueva gerencia</h1>

<form action="{{ route('gerencia.store') }}" method="POST">
    @csrf

    <label>Nombre</label>

    <input
        type="text"
        name="nombre"
        value="{{ old('nombre') }}"
    >

    @error('nombre')
        <p>{{ $message }}</p>
    @enderror

    <label>Código</label>

    <input
        type="text"
        name="code"
        value="{{ old('code') }}"
    >

    @error('code')
        <p>{{ $message }}</p>
    @enderror

    <button type="submit">
        Guardar
    </button>
</form>