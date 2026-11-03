<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Iniciar sesión | Grupo CAVI</title>

    <link
        rel="stylesheet"
        href="{{ asset('css/login.css') }}"
    >
</head>

<body>

    <div class="login-page">

        {{-- =====================================================
             DECORACIÓN DEL FONDO
             ===================================================== --}}

        <div
            class="decoracion decoracion-superior"
            aria-hidden="true"
        ></div>

        <div
            class="decoracion decoracion-inferior"
            aria-hidden="true"
        ></div>

        <div
            class="linea-diagonal linea-superior-1"
            aria-hidden="true"
        ></div>

        <div
            class="linea-diagonal linea-superior-2"
            aria-hidden="true"
        ></div>

        <div
            class="linea-diagonal linea-inferior-1"
            aria-hidden="true"
        ></div>

        <div
            class="linea-diagonal linea-inferior-2"
            aria-hidden="true"
        ></div>


        {{-- =====================================================
             TARJETA LOGIN
             ===================================================== --}}

        <main class="login-card">

            <div class="login-acento"></div>


            {{-- Logo / identidad --}}
            <div class="login-logo">

                <span>
                    GRUPO CAVI
                </span>

            </div>


            {{-- Encabezado --}}
            <header class="login-header">

                <h1>
                    Bienvenido
                </h1>

                <p class="login-sistema">
                    SISTEMA DE PEDIDOS
                </p>

                <div class="login-linea"></div>

            </header>


            {{-- =================================================
                 FORMULARIO
                 ================================================= --}}

            <form
                action="#"
                method="POST"
                class="login-form"
            >

                @csrf


                {{-- Correo --}}
                <div class="login-campo">

                    <label for="email">
                        Correo electrónico
                    </label>

                    <div class="login-input-wrapper">

                        <svg
                            class="login-input-icon"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            aria-hidden="true"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="M20 21a8 8 0 0 0-16 0m12-13a4 4 0 1 1-8 0 4 4 0 0 1 8 0Z"
                            />
                        </svg>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="Ingresa tu correo electrónico"
                            autocomplete="email"
                            required
                            autofocus
                        >

                    </div>

                    @error('email')
                        <p class="login-error">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Contraseña --}}
                <div class="login-campo">

                    <label for="password">
                        Contraseña
                    </label>

                    <div class="login-input-wrapper">

                        <svg
                            class="login-input-icon"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            aria-hidden="true"
                        >
                            <rect
                                x="5"
                                y="10"
                                width="14"
                                height="10"
                                rx="2"
                                stroke-width="1.8"
                            />

                            <path
                                stroke-linecap="round"
                                stroke-width="1.8"
                                d="M8 10V7a4 4 0 0 1 8 0v3"
                            />
                        </svg>

                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Ingresa tu contraseña"
                            autocomplete="current-password"
                            required
                        >

                        <button
                            type="button"
                            class="password-toggle"
                            id="password-toggle"
                            aria-label="Mostrar contraseña"
                        >

                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                aria-hidden="true"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M2.5 12s3.5-6 9.5-6 9.5 6 9.5 6-3.5 6-9.5 6-9.5-6-9.5-6Z"
                                />

                                <circle
                                    cx="12"
                                    cy="12"
                                    r="2.5"
                                    stroke-width="1.8"
                                />
                            </svg>

                        </button>

                    </div>

                    @error('password')
                        <p class="login-error">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Recordarme --}}
                <div class="login-opciones">

                    <label class="remember">

                        <input
                            type="checkbox"
                            name="remember"
                            value="1"
                        >

                        <span>
                            Recordarme
                        </span>

                    </label>

                </div>


                {{-- Botón --}}
                <button
                    type="submit"
                    class="login-submit"
                >

                    <span>
                        Iniciar sesión
                    </span>

                    <span
                        class="login-submit-arrow"
                        aria-hidden="true"
                    >
                        →
                    </span>

                </button>

            </form>


            {{-- Pie --}}
            <footer class="login-footer">

                Pedidos

            </footer>

        </main>

    </div>


    <script>
        const password = document.getElementById('password');
        const passwordToggle = document.getElementById('password-toggle');

        passwordToggle.addEventListener('click', function () {
            const showingPassword = password.type === 'text';

            password.type = showingPassword
                ? 'password'
                : 'text';

            passwordToggle.setAttribute(
                'aria-label',
                showingPassword
                    ? 'Mostrar contraseña'
                    : 'Ocultar contraseña'
            );
        });
    </script>

</body>

</html>