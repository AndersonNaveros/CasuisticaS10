<!-- Usamos bootraps ya que nos lo piden y es conveniento por lo menos para aprender mas pero los otros estilos los hacemos aqui -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

<style>
    /* Usamos colores neutros y dejamos el verde solo para los botones. */
    body {
        font-family: Arial, sans-serif;
        background-color: #f7f8f7;
        color: #29312e;
    }

    .pagina {
        max-width: 1120px;
        margin: 42px auto;
        padding: 0 20px;
    }

    /* Separamos la cabecera con una linea sencilla. */
    .cabecera {
        padding-bottom: 22px;
        margin-bottom: 28px;
        border-bottom: 1px solid #d9dedb;
    }

    .empresa {
        margin-bottom: 8px;
        color: #58685d;
        font-size: 12px;
        font-weight: bold;
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    h1 {
        margin-bottom: 10px;
        font-size: 30px;
        font-weight: 600;
    }

    h2 {
        margin-bottom: 18px;
        font-size: 20px;
        font-weight: 600;
    }

    .cabecera p:last-of-type {
        color: #67716c;
    }

    .cabecera .boton {
        margin-top: 10px;
    }

    /* Dejamos el formulario en un solo bloque, sin decoraciones de mas. */
    .panel {
        padding: 26px;
        margin-bottom: 24px;
        background-color: #ffffff;
        border: 1px solid #dfe3e0;
        border-radius: 5px;
    }

    .campos {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
    }

    input, select {
        width: 100%;
        padding: 10px 12px;
        background-color: #ffffff;
        border: 1px solid #cbd2cd;
        border-radius: 4px;
        color: #29312e;
    }

    input:focus, select:focus {
        outline: 2px solid #97a79a;
        outline-offset: 1px;
    }

    .acciones {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 24px;
    }

    .boton {
        display: inline-block;
        padding: 10px 18px;
        color: #ffffff;
        background-color: #405c48;
        border: 1px solid #405c48;
        border-radius: 4px;
        text-decoration: none;
        cursor: pointer;
    }

    .boton:hover {
        color: #ffffff;
        background-color: #304736;
        border-color: #304736;
    }

    .boton-claro {
        color: #34413a;
        background-color: #ffffff;
        border-color: #cbd2cd;
    }

    .boton-claro:hover {
        color: #29312e;
        background-color: #f0f2f0;
        border-color: #cbd2cd;
    }

    /* Mostramos las cifras en una sola fila, sin cuatro tarjetas verdes. */
    .resumen {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        margin-bottom: 30px;
        background-color: #ffffff;
        border: 1px solid #dfe3e0;
        border-radius: 5px;
    }

    .dato {
        padding: 19px 16px;
        border-right: 1px solid #e2e6e3;
    }

    .dato:last-child {
        border-right: none;
    }

    .dato span {
        display: block;
        margin-bottom: 8px;
        color: #6d7770;
        font-size: 13px;
    }

    .dato strong {
        display: block;
        font-size: 22px;
        font-weight: 600;
    }

    /* La tabla sigue usando Bootstrap, con tonos grises mas discretos. */
    .table-responsive {
        overflow-x: auto;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
        font-size: 14px;
        --bs-table-striped-bg: #f7f8f7;
        --bs-table-hover-bg: #eef1ef;
        --bs-table-border-color: #dfe3e0;
    }

    .table thead {
        --bs-table-bg: #edf0ed;
        --bs-table-color: #29312e;
    }

    .table thead th {
        background-color: #edf0ed;
    }

    .table th, .table td {
        padding: 11px 10px;
        border-bottom: 1px solid #e0e4e1;
        vertical-align: middle;
    }

    .nota {
        margin-top: 14px;
        color: #737b76;
        font-size: 13px;
    }

    @media (max-width: 820px) {
        .resumen {
            grid-template-columns: repeat(2, 1fr);
        }

        .dato:nth-child(2) {
            border-right: none;
        }

        .dato:nth-child(-n+2) {
            border-bottom: 1px solid #e2e6e3;
        }
    }

    @media (max-width: 620px) {
        .pagina {
            margin: 25px auto;
        }

        .campos, .resumen {
            grid-template-columns: 1fr;
        }

        .dato {
            border-right: none;
            border-bottom: 1px solid #e2e6e3;
        }

        .dato:last-child {
            border-bottom: none;
        }

        h1 {
            font-size: 25px;
        }

        .panel {
            padding: 18px;
        }
    }
    /* Acomodamos el filtro al estilo del formulario que ya tenemos. */
    .filtro {
        display: flex;
        flex-wrap: wrap;
        align-items: end;
        gap: 12px;
    }

    .filtro > div {
        width: 260px;
        max-width: 100%;
    }

    /* Dejamos el reporte listo para imprimir sin recuadros ni botones. */
    @media print {
        @page {
            size: A4 landscape;
            margin: 14mm 16mm;
        }

        body {
            background: #ffffff !important;
            color: #242b27 !important;
            font-size: 10pt;
        }

        .pagina {
            max-width: none;
            width: 100%;
            padding: 0;
            margin: 0;
        }

        .no-imprimir, .cabecera .boton {
            display: none !important;
        }

        /* Una cabecera sencilla, como en un informe administrativo. */
        .cabecera {
            margin: 0 0 8mm;
            padding: 0 0 5mm;
            border-bottom: 1px solid #aab3ad;
        }

        .empresa {
            margin: 0 0 5px;
            font-size: 9pt;
            letter-spacing: 0.7px;
            color: #45564a;
        }

        h1 {
            margin: 0;
            font-size: 19pt;
            font-weight: 600;
        }

        .cabecera p:last-of-type {
            display: none;
        }

        h2 {
            margin: 0 0 4mm;
            font-size: 12pt;
            font-weight: 600;
        }

        /* Los datos del resumen van en lineas, sin tarjetas. */
        .resumen {
            display: block;
            background: none;
            border: none;
            border-radius: 0;
            margin: 0 0 8mm;
        }

        .dato, .dato:nth-child(2), .dato:nth-child(-n+2), .dato:last-child {
            display: flex;
            align-items: baseline;
            padding: 3px 0;
            border: none;
        }

        .dato span {
            width: 190px;
            flex: 0 0 190px;
            margin: 0;
            color: #414b45;
            font-size: 10pt;
        }

        .dato strong {
            font-size: 10pt;
            font-weight: 600;
        }

        /* Quitamos el cuadro de la tabla y usamos lineas finas. */
        .panel {
            padding: 0;
            margin: 0;
            border: none;
            border-radius: 0;
            background: none;
        }

        .table-responsive {
            overflow: visible;
        }

        .table {
            margin: 0;
            width: 100%;
            font-size: 9pt;
            --bs-table-striped-bg: #ffffff;
            --bs-table-border-color: #d8deda;
        }

        .table > :not(caption) > * > * {
            background-color: #ffffff !important;
            box-shadow: none !important;
            border-width: 0 0 1px !important;
        }

        .table thead th,
        .table > thead > tr > th {
            background-color: #f0f2f0 !important;
            font-weight: 600;
            border-top: 1px solid #9fa9a2 !important;
            border-bottom: 1px solid #9fa9a2 !important;
        }

        .table th, .table td {
            padding: 7px 8px;
            vertical-align: top;
        }

        .table thead {
            display: table-header-group;
        }

        .table tr {
            break-inside: avoid;
        }
    }
</style>
