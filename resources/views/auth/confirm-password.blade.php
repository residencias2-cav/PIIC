<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Confirmar contraseña | Grupo CAVI
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

        .confirmacion-page {
            min-height: 100vh;

            display: flex;
            align-items: center;
            justify-content: center;

            padding: 24px;
        }

        .confirmacion-card {
            position: relative;

            width: 100%;
            max-width: 440px;

            overflow: hidden;

            padding: 34px;

            background: #ffffff;

            border: 1px solid #e2e8f0;
            border-radius: 16px;

            box-shadow:
                0 12px 30px
                rgba(15, 23, 42, 0.08);
        }

        .confirmacion-acento {
            position: absolute;

            top: 0;
            left: 0;

            width: 100%;
            height: 5px;

            background: #991b1b;
        }

        .confirmacion-logo {
            margin-bottom: 25px;

            color: #991b1b;

            font-size: 14px;
            font-weight: 800;
            letter-spacing: 0.12em;
        }

        .confirmacion-card h1 {
            margin: 0 0 10px;

            font-size: 25px;
            color: #0f172a;
        }

        .confirmacion-descripcion {
            margin: 0 0 25px;

            line-height: 1.6;

            font-size: 14px;
            color: #64748b;
        }

        .confirmacion-campo {
            margin-bottom: 20px;
        }

        .confirmacion-campo label {
            display: block;

            margin-bottom: 8px;

            font-size: 14px;
            font-weight: 700;

            color: #334155;
        }

        .password-wrapper {
            position: relative;
        }

        .password-wrapper input {
            width: 100%;

            padding: 12px 48px 12px 14px;

            border: 1px solid #cbd5e1;
            border-radius: 9px;

            font-size: 15px;

            outline: none;
        }

        .password-wrapper input:focus {
            border-color: #991b1b;

            box-shadow:
                0 0 0 3px
                rgba(153, 27, 27, 0.12);
        }

        .password-toggle {
            position: absolute;

            top: 50%;
            right: 10px;

            transform: translateY(-50%);

            border: 0;
            background: transparent;

            color: #64748b;

            font-size: 13px;
            font-weight: 700;

            cursor: pointer;
        }

        .mensaje-error {
            margin: 8px 0 0;

            color: #b91c1c;
            font-size: 13px;
        }

        .acciones {
            display: flex;

            gap: 10px;

            margin-top: 24px;
        }

        .boton {
            display: inline-flex;
            align-items: center;
            justify-content: center;

            min-height: 44px;
            padding: 11px 16px;

            border: 0;
            border-radius: 9px;

            font-size: 14px;
            font-weight: 700;
            text-decoration: none;

            cursor: pointer;
        }

        .boton-principal {
            flex: 1;

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

        @media (max-width: 480px) {
            .confirmacion-page {
                padding: 16px;
            }

            .confirmacion-card {
                padding: 28px 20px;
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

    <div class="confirmacion-page">

        <main class="confirmacion-card">

            <div class="confirmacion-acento"></div>

            <div class="confirmacion-logo">
                GRUPO CAVI
            </div>


            <h1>
                Confirma tu contraseña
            </h1>


            <p class="confirmacion-descripcion">
                Esta es una operación sensible. Para continuar
                con la configuración de seguridad de tu cuenta,
                confirma tu contraseña de acceso a PIIC.
            </p>


            <form
                method="POST"
                action="{{ url('/user/confirm-password') }}"
            >
                @csrf


                <div class="confirmacion-campo">

                    <label for="password">
                        Contraseña
                    </label>


                    <div class="password-wrapper">

                        <input
                            id="password"
                            type="password"
                            name="password"
                            autocomplete="current-password"
                            required
                            autofocus
                        >


                        <button
                            type="button"
                            class="password-toggle"
                            id="password-toggle"
                            aria-label="Mostrar contraseña"
                        >
                            Mostrar
                        </button>

                    </div>


                    @error('password')

                        <p class="mensaje-error">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                <div class="acciones">

                    <a
                        href="{{ route('seguridad') }}"
                        class="boton boton-secundario"
                    >
                        Cancelar
                    </a>


                    <button
                        type="submit"
                        class="boton boton-principal"
                    >
                        Confirmar contraseña
                    </button>

                </div>

            </form>

        </main>

    </div>


    <script>
        const password = document.getElementById(
            'password'
        );

        const passwordToggle = document.getElementById(
            'password-toggle'
        );

        passwordToggle.addEventListener(
            'click',
            function () {
                const mostrando =
                    password.type === 'text';

                password.type = mostrando
                    ? 'password'
                    : 'text';

                passwordToggle.textContent = mostrando
                    ? 'Mostrar'
                    : 'Ocultar';

                passwordToggle.setAttribute(
                    'aria-label',
                    mostrando
                        ? 'Mostrar contraseña'
                        : 'Ocultar contraseña'
                );
            }
        );
    </script>

</body>

</html>