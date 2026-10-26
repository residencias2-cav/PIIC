<h1>Editar gerencia</h1>

<form action="{{ route('gerencia.update', $gerencia) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Nombre</label>

    <input
        type="text"
        name="nombre"
        value="{{ old('nombre', $gerencia->nombre) }}"
    >

    <label>Código</label>

    <input
        type="text"
        name="code"
        value="{{ old('code', $gerencia->code) }}"
    >

    <button type="submit">
        Actualizar
    </button>
</form>