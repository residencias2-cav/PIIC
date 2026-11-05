<h1>Inicio</h1>

<p>
    Usuario:
    {{ auth()->user()->usuario }}
</p>

<p>
    Gerencia:
    {{ auth()->user()->gerencia?->nombre ?? 'Sin gerencia' }}
</p>

<form action="{{ route('logout') }}" method="POST">
    @csrf

    <button type="submit">
        Cerrar sesión
    </button>
</form>