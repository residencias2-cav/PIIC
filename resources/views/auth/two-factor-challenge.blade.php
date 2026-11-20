<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Verificación en dos pasos | Grupo CAVI
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

        .twofa-page {
            position: relative;

            min-height: 100vh;

            display: flex;
            align-items: center;
            justify-content: center;

            overflow: hidden;

            padding: 24px;
        }

        /* ==============================================
           DECORACIÓN
           ============================================== */

        .decoracion {
            position: absolute;

            width: 420px;
            height: 420px;

            background: #991b1b;

            transform: rotate(45deg);

            opacity: .96;
        }

        .decoracion-superior {
            top: -300px;
            right: -190px;
        }

        .decoracion-inferior {
            bottom: -320px;
            left: -200px;
        }

        .linea {
            position: absolute;

            width: 360px;
            height: 2px;

            background: rgba(153, 27, 27, .18);

            transform: rotate(-35deg);
        }

        .linea-1 {
            top: 115px;
            right: -70px;
        }

        .linea-2 {
            bottom: 115px;
            left: -70px;
        }

        /* ==============================================
           TARJETA
           ============================================== */

        .twofa-card {
            position: relative;
            z-index: 2;

            width: 100%;
            max-width: 460px;

            overflow: hidden;

            padding: 36px;

            background: #ffffff;

            border: 1px solid #e2e8f0;
            border-radius: 16px;

            box-shadow:
                0 18px 45px
                rgba(15, 23, 42, .10);
        }

        .twofa-acento {
            position: absolute;

            top: 0;
            left: 0;

            width: 100%;
            height: 5px;

            background: #991b1b;
        }

        /* ==============================================
           IDENTIDAD
           ============================================== */

        .twofa-logo {
            margin-bottom: 27px;

            color: #991b1b;

            font-size: 15px;
            font-weight: 800;

            letter-spacing: .12em;
        }

        .twofa-header h1 {
            margin: 0 0 10px;

            color: #0f172a;

            font-size: 27px;
        }

        .twofa-header p {
            margin: 0;

            color: #64748b;

            font-size: 14px;
            line-height: 1.6;
        }

        .twofa-linea {
            width: 56px;
            height: 3px;

            margin: 18px 0 26px;

            background: #991b1b;

            border-radius: 50px;
        }

        /* ==============================================
           INDICACIÓN
           ============================================== */

        .twofa-info {
            margin-bottom: 22px;
            padding: 13px 15px;

            background: #f8fafc;

            border: 1px solid #e2e8f0;
            border-radius: 9px;

            color: #475569;

            font-size: 13px;
            line-height: 1.6;
        }

        /* ==============================================
           CAMPOS
           ============================================== */

        .twofa-campo {
            margin-bottom: 18px;
        }

        .twofa-campo label {
            display: block;

            margin-bottom: 8px;

            color: #334155;

            font-size: 14px;
            font-weight: 700;
        }

        .twofa-campo input {
            width: 100%;

            padding: 13px 14px;

            border: 1px solid #cbd5e1;
            border-radius: 9px;

            background: #ffffff;

            color: #0f172a;

            font-size: 16px;

            outline: none;

            transition:
                border-color .15s ease,
                box-shadow .15s ease;
        }

        .twofa-campo input:focus {
            border-color: #991b1b;

            box-shadow:
                0 0 0 3px
                rgba(153, 27, 27, .12);
        }

        #code {
            text-align: center;

            font-size: 22px;
            font-weight: 700;

            letter-spacing: .30em;
        }

        .twofa-error {
            margin: 7px 0 0;

            color: #b91c1c;

            font-size: 13px;
        }

        /* ==============================================
           SEPARADOR
           ============================================== */

        .twofa-separador {
            display: flex;
            align-items: center;

            gap: 12px;

            margin: 23px 0;

            color: #94a3b8;

            font-size: 12px;
            font-weight: 700;

            text-transform: uppercase;
        }

        .twofa-separador::before,
        .twofa-separador::after {
            content: "";

            flex: 1;

            height: 1px;

            background: #e2e8f0;
        }

        /* ==============================================
           BOTÓN
           ============================================== */

        .twofa-submit {
            width: 100%;

            padding: 13px 18px;

            border: 0;
            border-radius: 9px;

            background: #991b1b;
            color: #ffffff;

            font-size: 14px;
            font-weight: 700;

            cursor: pointer;

            transition: background .15s ease;
        }

        .twofa-submit:hover {
            background: #7f1d1d;
        }

        /* ==============================================
           RECOVERY
           ============================================== */

        .recovery-details {
            margin-top: 18px;

            border-top: 1px solid #e2e8f0;

            padding-top: 18px;
        }

        .recovery-details summary {
            color: #64748b;

            font-size: 13px;
            font-weight: 700;

            cursor: pointer;
        }

        .recovery-form {
            margin-top: 18px;
        }

        .twofa-footer {
            margin-top: 27px;

            color: #94a3b8;

            font-size: 12px;
            text-align: center;
        }

        @media (max-width: 520px) {

            .twofa-page {
                padding: 16px;
            }

            .twofa-card {
                padding: 30px 20px;
            }

        }

    </style>
</head>

<body>

    <div class="twofa-page">

        {{-- Decoración --}}
        <div
            class="decoracion decoracion-superior"
            aria-hidden="true"
        ></div>

        <div
            class="decoracion decoracion-inferior"
            aria-hidden="true"
        ></div>

        <div
            class="linea linea-1"
            aria-hidden="true"
        ></div>

        <div
            class="linea linea-2"
            aria-hidden="true"
        ></div>


        <main class="twofa-card">

            <div class="twofa-acento"></div>


            {{-- Identidad --}}
            <div class="twofa-logo">
                GRUPO CAVI
            </div>


            <header class="twofa-header">

                <h1>
                    Verificación en dos pasos
                </h1>

                <p>
                    Confirma que eres la persona que está
                    intentando acceder a PIIC.
                </p>

                <div class="twofa-linea"></div>

            </header>


            <div class="twofa-info">

                Abre tu aplicación de autenticación y utiliza
                el código temporal de seis dígitos asociado
                a PIIC.

            </div>


            {{-- ==========================================
                 CÓDIGO AUTENTICADOR
                 ========================================== --}}

            <form
                method="POST"
                action="{{ url('/two-factor-challenge') }}"
            >

                @csrf


                <div class="twofa-campo">

                    <label for="code">
                        Código del autenticador
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
                        autofocus
                    >


                    @error('code')

                        <p class="twofa-error">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                <button
                    type="submit"
                    class="twofa-submit"
                >
                    Verificar identidad
                </button>

            </form>


            {{-- ==========================================
                 RECUPERACIÓN
                 ========================================== --}}

            <details class="recovery-details">

                <summary>
                    No tengo acceso al autenticador
                </summary>


                <div class="twofa-separador">
                    Recuperación
                </div>


                <p class="twofa-info">
                    Introduce uno de los códigos de recuperación
                    generados cuando activaste la autenticación
                    en dos pasos.
                </p>


                <form
                    method="POST"
                    action="{{ url('/two-factor-challenge') }}"
                    class="recovery-form"
                >

                    @csrf


                    <div class="twofa-campo">

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

                            <p class="twofa-error">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>


                    <button
                        type="submit"
                        class="twofa-submit"
                    >
                        Usar código de recuperación
                    </button>

                </form>

            </details>


            <footer class="twofa-footer">
                Sistema PIIC · Grupo CAVI
            </footer>

        </main>

    </div>

</body>

</html>