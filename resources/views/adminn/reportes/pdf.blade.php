<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Reporte de Nómina #{{ $reporte->ID_reporte }} | {{ config('app.name') }}</title>
    <style>
        @page {
            size: A4;
            margin: 15mm;
        }

        body {
            font-family: 'Montserrat', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #2c3e50;
            background-color: #f4f6f9;
            margin: 0;
            padding: 0;
        }

        .container {
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.1);
            max-width: 100%;
        }

        .header {
            text-align: center;
            margin-bottom: 40px;
            padding-bottom: 20px;
            border-bottom: 2px solid #dcdcdc;
            position: relative;
        }

        .company-logo {
            height: 100px;
            margin-bottom: 15px;
            object-fit: contain;
        }

        .title {
            font-size: 30px;
            font-weight: 800;
            color: #2c3e50;
            margin-bottom: 5px;
        }

        .subtitle {
            font-size: 18px;
            color: #7f8c8d;
        }

        .report-id {
            position: absolute;
            top: 20px;
            right: 20px;
            background: #3498db;
            color: white;
            padding: 6px 18px;
            border-radius: 25px;
            font-weight: bold;
            font-size: 14px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
            margin-bottom: 40px;
        }

        .table th {
            background-color: #3498db;
            color: white;
            padding: 14px;
            text-align: left;
            font-size: 14px;
            text-transform: uppercase;
        }

        .table td {
            padding: 14px;
            font-size: 15px;
            border-bottom: 1px solid #eaeaea;
        }

        .table tr:nth-child(even) {
            background-color: #f9fbfd;
        }

        .text-right {
            text-align: right;
        }

        .footer {
            display: flex;
            justify-content: space-between;
            border-top: 2px solid #dcdcdc;
            padding-top: 25px;
            font-size: 14px;
            color: #7f8c8d;
            margin-top: 50px;
        }

        .total-row {
            background-color: #ecf6fd;
            font-weight: bold;
        }

        .total-row td {
            border-top: 2px solid #2980b9;
        }

        .signature-area {
            margin-top: 80px;
            display: flex;
            justify-content: space-evenly;
        }

        .signature-box {
            width: 300px;
            text-align: center;
        }

        .signature-line {
            border-top: 2px solid #aaa;
            margin: 60px auto 10px;
            width: 70%;
        }

        .watermark {
            position: fixed;
            bottom: 50%;
            right: 50%;
            transform: translate(50%, 50%);
            opacity: 0.05;
            font-size: 100px;
            font-weight: bold;
            color: #3498db;
            z-index: -1;
        }

        .text-primary {
            color: #2980b9;
        }

        .text-danger {
            color: #e74c3c;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="watermark">{{ config('app.name') }}</div>

    <div class="header">
        <img src="https://i.etsystatic.com/16458179/r/il/41b210/3704355302/il_570xN.3704355302_e52a.jpg"
             class="company-logo"
             alt="Logo Restaurante"
             onerror="this.style.display='none'">
        <div class="report-id">Reporte #{{ $reporte->ID_reporte }}</div>
        <div class="title">REPORTE DE NÓMINA</div>
        <div class="subtitle">Periodo: {{ $reporte->fecha_reporte->format('d/m/Y') }}</div>
    </div>

    <table class="table">
        <thead>
        <tr>
            <th>Empleado</th>
            <th>Puesto</th>
            <th class="text-right">Sueldo Diario</th>
            <th class="text-right">Días Trabajados</th>
            <th class="text-right">Descuentos</th>
            <th class="text-right">Total</th>
        </tr>
        </thead>
        <tbody>
        @foreach($detalles as $detalle)
            <tr>
                <td>{{ $detalle['nombre'] ?? 'N/A' }}</td>
                <td>{{ $detalle['puesto'] ?? 'N/A' }}</td>
                <td class="text-right">${{ number_format($detalle['sueldo_diario'] ?? 0, 2) }}</td>
                <td class="text-right">{{ $detalle['dias_trabajados'] ?? 0 }}</td>
                <td class="text-right text-danger">${{ number_format($detalle['descuentos'] ?? 0, 2) }}</td>
                <td class="text-right text-primary">${{ number_format($detalle['pago_total'] ?? 0, 2) }}</td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr class="total-row">
            <td colspan="5" class="text-right"><strong>TOTAL NÓMINA:</strong></td>
            <td class="text-right"><strong>${{ number_format($reporte->total_nomina, 2) }}</strong></td>
        </tr>
        </tfoot>
    </table>

    <div class="signature-area">
        <div class="signature-box">
            <div class="signature-line"></div>
            <div>FIRMA DEL EMPLEADO</div>
        </div>
        <div class="signature-box">
            <div class="signature-line"></div>
            <div>FIRMA DEL RESPONSABLE</div>
        </div>
    </div>

    <div class="footer">
        <div>
            <strong>Generado por:</strong> {{ $reporte->creador->name ?? 'Sistema' }}<br>
            <strong>Departamento:</strong> Recursos Humanos
        </div>
        <div class="text-right">
            <strong>Fecha:</strong> {{ now()->format('d/m/Y H:i') }}<br>
            <strong class="text-primary">DOCUMENTO CONFIDENCIAL</strong>
        </div>
    </div>
</div>
</body>
</html>
