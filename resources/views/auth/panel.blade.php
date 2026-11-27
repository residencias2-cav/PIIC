<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Verificación de acceso | Grupo CAVI</title>

    <link
        rel="stylesheet"
        href="{{ asset('css/login.css') }}"
    >

    <style>
        /*
        |--------------------------------------------------------------------------
        | Ajustes exclusivos de la vista 2FA
        |--------------------------------------------------------------------------
        |
        | Se reutiliza completamente el diseño original del login.
        | Estas reglas solamente adaptan el campo del código y las
        | acciones secundarias.
        |
        */

        .codigo-verificacion {
            text-align: center;
            font-size: 22px;
            font-weight: 700;
            letter-spacing: 8px;
        }

        .two-factor-descripcion {
            margin: 0 auto 24px;
            max-width: 340px;

            text-align: center;

            font-size: 14px;
            line-height: 1.6;
        }

        .two-factor-ayuda {
            margin: 18px 0 0;

            text-align: center;

            font-size: 13px;
            line-height: 1.5;

            opacity: 0.75;
        }

        .two-factor-acciones {
            display: flex;
            flex-direction: column;
            gap: 10px;

            margin-top: 20px;
        }

        .two-factor-secondary {
            width: 100%;

            padding: 11px 16px;

            border: 1px solid currentColor;
            border-radius: 8px;

            background: transparent;

            font: inherit;
            font-size: 14px;
            font-weight: 600;

            cursor: pointer;

            opacity: 0.85;

            transition:
                opacity 0.2s ease,
                background-color 0.2s ease;
        }

        .two-factor-secondary:hover {
            opacity: 1;
        }

        .two-factor-cancel {
            display: block;

            width: 100%;

            padding: 8px;

            border: none;

            background: transparent;

            font: inherit;
            font-size: 13px;

            cursor: pointer;

            opacity: 0.65;
        }

        .two-factor-cancel:hover {
            opacity: 1;
            text-decoration: underline;
        }

        .two-factor-status {
            margin-bottom: 20px;

            padding: 14px 16px;

            border: 1px solid #bbf7d0;
            border-radius: 8px;

            background: #f0fdf4;

            color: #166534;

            font-size: 14px;
            line-height: 1.5;
        }

        @media (max-width: 480px) {
            .codigo-verificacion {
                font-size: 19px;
                letter-spacing: 6px;
            }
        }
    </style>
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
             TARJETA 2FA
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
                    Verificación de acceso
                </h1>

                <p class="login-sistema">
                    SISTEMA DE PEDIDOS
                </p>

                <div class="login-linea"></div>

            </header>


            {{-- Descripción --}}

            <p class="two-factor-descripcion">
                Ingresa el código de seis dígitos
                enviado al correo asociado con tu cuenta.
            </p>


            {{-- =================================================
                 ERRORES
                 ================================================= --}}

            @if ($errors->any())

                <div
                    style="
                        margin-bottom: 20px;
                        padding: 14px 16px;
                        background: #fef2f2;
                        border: 1px solid #fecaca;
                        border-radius: 8px;
                        color: #991b1b;
                        font-size: 14px;
                    "
                >

                    @foreach ($errors->all() as $error)

                        <div>
                            {{ $error }}
                        </div>

                    @endforeach

                </div>

            @endif


            {{-- =================================================
                 MENSAJE DE REENVÍO
                 ================================================= --}}

            @if (session('status'))

                <div class="two-factor-status">
                    {{ session('status') }}
                </div>

            @endif


            {{-- =================================================
                 FORMULARIO DE VERIFICACIÓN
                 ================================================= --}}

            <form
                method="POST"
                action="{{ route('email-2fa.verify') }}"
                class="login-form"
            >

                @csrf


                <div class="login-campo">

                    <label for="codigo">
                        Código de verificación
                    </label>

                    <div class="login-input-wrapper">

                        {{-- Icono de seguridad --}}

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
                            type="text"
                            id="codigo"
                            name="codigo"

                            class="codigo-verificacion"

                            value="{{ old('codigo') }}"

                            placeholder="000000"

                            inputmode="numeric"

                            pattern="[0-9]{6}"

                            maxlength="6"

                            autocomplete="one-time-code"

                            required
                            autofocus
                        >

                    </div>

                    @error('codigo')

                        <p class="login-error">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                <button
                    type="submit"
                    class="login-submit"
                >

                    <span>
                        Verificar código
                    </span>

                    <span
                        class="login-submit-arrow"
                        aria-hidden="true"
                    >
                        →
                    </span>

                </button>

            </form>


            {{-- Información adicional --}}

            <p class="two-factor-ayuda">
                El código tiene una vigencia de 5 minutos.
                Si solicitas un código nuevo, el anterior
                dejará de ser válido.
            </p>


            {{-- =================================================
                 ACCIONES SECUNDARIAS
                 ================================================= --}}

            <div class="two-factor-acciones">

                {{-- Reenviar código --}}

                <form
                    method="POST"
                    action="{{ route('email-2fa.resend') }}"
                >

                    @csrf

                    <button
                        type="submit"
                        class="two-factor-secondary"
                    >
                        Reenviar código
                    </button>

                </form>


                {{-- Cancelar challenge --}}

                <form
                    method="POST"
                    action="{{ route('email-2fa.cancel') }}"
                >

                    @csrf

                    <button
                        type="submit"
                        class="two-factor-cancel"
                    >
                        Cancelar y volver al inicio de sesión
                    </button>

                </form>

            </div>


            {{-- Pie --}}

            <footer class="login-footer">
                Verificación de seguridad
            </footer>

        </main>

    </div>

</body>

</html>