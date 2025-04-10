<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte de Nómina #{{ $reporte->ID_reporte }}</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { text-align: center; margin-bottom: 20px; }
        .title { font-size: 18px; font-weight: bold; }
        .table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        .table th, .table td { border: 1px solid #ddd; padding: 8px; }
        .table th { background-color: #f2f2f2; text-align: left; }
        .text-right { text-align: right; }
        .footer { margin-top: 30px; font-size: 12px; text-align: right; }
    </style>
</head>
<body>
<div class="header">
    <div class="title">Reporte de Nómina #{{ $reporte->ID_reporte }}</div>
    <div>Fecha: {{ $reporte->fecha_reporte->format('d/m/Y') }}</div>
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
            <td class="text-right">${{ number_format($detalle['descuentos'] ?? 0, 2) }}</td>
            <td class="text-right">${{ number_format($detalle['pago_total'] ?? 0, 2) }}</td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <th colspan="5" class="text-right">Total Nómina:</th>
        <th class="text-right">${{ number_format($reporte->total_nomina, 2) }}</th>
    </tr>
    </tfoot>
</table>

<div class="footer">
    Generado por: {{ $reporte->creador->name ?? 'Sistema' }}<br>
    Fecha de generación: {{ now()->format('d/m/Y H:i') }}
</div>
</body>
</html>
