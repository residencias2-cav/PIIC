<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Seguridad de la cuenta | Grupo CAVI
    </title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;

            font-family:
                Arial,
                Helvetica,
                sans-serif;

            background: #f8fafc;
            color: #1e293b;
        }

        .seguridad-page {
            min-height: 100vh;

            display: flex;
            align-items: flex-start;
            justify-content: center;

            padding: 48px 20px;
        }

        .seguridad-container {
            width: 100%;
            max-width: 760px;
        }

        .seguridad-header {
            margin-bottom: 24px;
        }

        .seguridad-header h1 {
            margin: 0 0 8px;

            font-size: 28px;
            color: #0f172a;
        }

        .seguridad-header p {
            margin: 0;

            font-size: 14px;
            color: #64748b;
        }

        .seguridad-card {
            position: relative;

            margin-bottom: 20px;
            padding: 28px;

            overflow: hidden;

            background: #ffffff;

            border: 1px solid #e2e8f0;
            border-radius: 14px;

            box-shadow:
                0 8px 24px
                rgba(15, 23, 42, 0.06);
        }

        .seguridad-acento {
            position: absolute;

            top: 0;
            left: 0;

            width: 100%;
            height: 4px;

            background: #991b1b;
        }

        .seguridad-card h2 {
            margin: 0 0 10px;

            font-size: 20px;
            color: #0f172a;
        }

        .seguridad-card h3 {
            margin: 24px 0 10px;

            font-size: 17px;
            color: #0f172a;
        }

        .seguridad-card p {
            line-height: 1.6;
            color: #475569;
        }

        .cuenta {
            display: flex;
            align-items: center;
            justify-content: space-between;

            gap: 20px;

            margin-bottom: 20px;
            padding: 16px 18px;

            background: #ffffff;

            border: 1px solid #e2e8f0;
            border-radius: 12px;
        }

        .cuenta strong {
            display: block;

            margin-bottom: 4px;

            color: #0f172a;
        }

        .cuenta small {
            color: #64748b;
        }

        .estado {
            display: inline-flex;
            align-items: center;

            padding: 6px 10px;

            border-radius: 999px;

            font-size: 12px;
            font-weight: 700;
        }

        .estado-desactivado {
            background: #fef2f2;
            color: #991b1b;
        }

        .estado-pendiente {
            background: #fef3c7;
            color: #92400e;
        }

        .estado-activo {
            background: #dcfce7;
            color: #166534;
        }

        .mensaje-exito {
            margin-bottom: 20px;
            padding: 12px 14px;

            background: #dcfce7;
            color: #166534;

            border: 1px solid #bbf7d0;
            border-radius: 9px;
        }

        .mensaje-error {
            margin-top: 8px;

            color: #b91c1c;
            font-size: 13px;
        }

        .qr-container {
            display: flex;
            justify-content: center;

            margin: 22px 0;
            padding: 22px;

            background: #ffffff;

            border: 1px solid #e2e8f0;
            border-radius: 12px;
        }

        .qr-container svg {
            width: 230px;
            height: 230px;
        }

        .codigo-campo {
            margin-top: 20px;
        }

        .codigo-campo label {
            display: block;

            margin-bottom: 8px;

            font-size: 14px;
            font-weight: 700;

            color: #334155;
        }

        .codigo-campo input {
            width: 100%;

            padding: 12px 14px;

            border: 1px solid #cbd5e1;
            border-radius: 9px;

            font-size: 18px;
            letter-spacing: 0.25em;
            text-align: center;

            outline: none;
        }

        .codigo-campo input:focus {
            border-color: #991b1b;

            box-shadow:
                0 0 0 3px
                rgba(153, 27, 27, 0.12);
        }

        .acciones {
            display: flex;
            flex-wrap: wrap;

            gap: 10px;

            margin-top: 22px;
        }

        .boton {
            display: inline-flex;
            align-items: center;
            justify-content: center;

            min-height: 42px;
            padding: 10px 16px;

            border: 0;
            border-radius: 9px;

            font-size: 14px;
            font-weight: 700;
            text-decoration: none;

            cursor: pointer;
        }

        .boton-principal {
            background: #991b1b;
            color: #ffffff;
        }

        .boton-principal:hover {
            background: #7f1d1d;
        }

        .boton-secundario {
            background: #ffffff;
            color: #334155;

            border: 1px solid #cbd5e1;
        }

        .boton-secundario:hover {
            background: #f8fafc;
        }

        .boton-peligro {
            background: #ffffff;
            color: #b91c1c;

            border: 1px solid #fecaca;
        }

        .boton-peligro:hover {
            background: #fef2f2;
        }

        .instrucciones {
            margin: 18px 0;
            padding-left: 22px;

            color: #475569;
        }

        .instrucciones li {
            margin-bottom: 8px;
            line-height: 1.5;
        }

        @media (max-width: 600px) {
            .seguridad-page {
                padding: 24px 14px;
            }

            .seguridad-card {
                padding: 22px 18px;
            }

            .cuenta {
                align-items: flex-start;
                flex-direction: column;
            }

            .acciones {
                flex-direction: column;
            }

            .boton {
                width: 100%;
            }
        }
    </style>
</head>

<body>

    <div class="seguridad-page">

        <main class="seguridad-container">

            <header class="seguridad-header">

                <h1>
                    Seguridad de la cuenta
                </h1>

                <p>
                    Administra las opciones de protección
                    de tu cuenta de PIIC.
                </p>

            </header>


            <section class="cuenta">

                <div>

                    <strong>
                        {{ auth()->user()->usuario }}
                    </strong>

                    <small>
                        {{ auth()->user()->gerencia?->nombre
                            ?? 'Sin gerencia' }}
                    </small>

                </div>


                @if (
                    auth()->user()->two_factor_confirmed_at
                )

                    <span class="estado estado-activo">
                        2FA activada
                    </span>

                @elseif (
                    auth()->user()->two_factor_secret
                )

                    <span class="estado estado-pendiente">
                        Configuración pendiente
                    </span>

                @else

                    <span class="estado estado-desactivado">
                        2FA desactivada
                    </span>

                @endif

            </section>


            @if (session('status'))

                <div
                    class="mensaje-exito"
                    role="status"
                >
                    {{ session('status') }}
                </div>

            @endif


            <section class="seguridad-card">

                <div class="seguridad-acento"></div>

                <h2>
                    Autenticación en dos pasos
                </h2>


                {{-- ==========================================
                     ESTADO 1: 2FA DESACTIVADA
                     ========================================== --}}

                @if (
                    ! auth()->user()->two_factor_secret
                )

                    <p>
                        La autenticación en dos pasos está
                        desactivada.
                    </p>

                    <p>
                        Al activarla, además de tu usuario y
                        contraseña, necesitarás un código temporal
                        generado por Microsoft Authenticator u otra
                        aplicación compatible con TOTP.
                    </p>


                    <form
                        method="POST"
                        action="{{ url(
                            '/user/two-factor-authentication'
                        ) }}"
                    >
                        @csrf

                        <div class="acciones">

                            <button
                                type="submit"
                                class="boton boton-principal"
                            >
                                Activar autenticación en dos pasos
                            </button>

                            <a
                                href="{{ route('panel') }}"
                                class="boton boton-secundario"
                            >
                                Regresar al inicio
                            </a>

                        </div>

                    </form>


                {{-- ==========================================
                     ESTADO 2: SECRETO CREADO,
                     FALTA CONFIRMAR TOTP
                     ========================================== --}}

                @elseif (
                    ! auth()->user()
                        ->two_factor_confirmed_at
                )

                    <p>
                        La configuración está pendiente de
                        confirmación.
                    </p>

                    <p>
                        Escanea el código QR con Microsoft
                        Authenticator y después introduce el código
                        temporal de seis dígitos.
                    </p>


                    <ol class="instrucciones">

                        <li>
                            Abre Microsoft Authenticator.
                        </li>

                        <li>
                            Selecciona la opción para agregar una
                            cuenta nueva.
                        </li>

                        <li>
                            Escanea el siguiente código QR.
                        </li>

                        <li>
                            Introduce el código de seis dígitos
                            generado por la aplicación.
                        </li>

                    </ol>


                    <div class="qr-container">

                        {!!
                            auth()
                                ->user()
                                ->twoFactorQrCodeSvg()
                        !!}

                    </div>


                    <form
                        method="POST"
                        action="{{ url(
                            '/user/confirmed-two-factor-authentication'
                        ) }}"
                    >
                        @csrf

                        <div class="codigo-campo">

                            <label for="code">
                                Código de verificación
                            </label>

                            <input
                                id="code"
                                type="text"
                                name="code"
                                inputmode="numeric"
                                autocomplete="one-time-code"
                                pattern="[0-9]{6}"
                                maxlength="6"
                                placeholder="000000"
                                required
                                autofocus
                            >

                            @error('code')

                                <p class="mensaje-error">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>


                        <div class="acciones">

                            <button
                                type="submit"
                                class="boton boton-principal"
                            >
                                Confirmar configuración
                            </button>

                        </div>

                    </form>


                    <form
                        method="POST"
                        action="{{ url(
                            '/user/two-factor-authentication'
                        ) }}"
                    >
                        @csrf
                        @method('DELETE')

                        <div class="acciones">

                            <button
                                type="submit"
                                class="boton boton-peligro"
                            >
                                Cancelar configuración
                            </button>

                        </div>

                    </form>


                {{-- ==========================================
                     ESTADO 3: 2FA ACTIVADA
                     ========================================== --}}

                @else

                    <p>
                        La autenticación en dos pasos está
                        correctamente activada.
                    </p>

                    <p>
                        Cuando vuelvas a iniciar sesión, PIIC
                        solicitará un código generado por tu
                        aplicación de autenticación.
                    </p>


                    <div class="acciones">

                        <a
                            href="{{ route('panel') }}"
                            class="boton boton-secundario"
                        >
                            Regresar al inicio
                        </a>

                    </div>


                    <form
                        method="POST"
                        action="{{ url(
                            '/user/two-factor-authentication'
                        ) }}"
                    >
                        @csrf
                        @method('DELETE')

                        <div class="acciones">

                            <button
                                type="submit"
                                class="boton boton-peligro"
                            >
                                Desactivar autenticación en dos pasos
                            </button>

                        </div>

                    </form>

                @endif

            </section>

        </main>

    </div>

</body>

</html>