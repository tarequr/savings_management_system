<!DOCTYPE html>
<html>
<head>
    <title>{{ $pageTitle }}</title>
    <style>
        body { font-family: 'Helvetica', sans-serif; font-size: 11px; color: #333; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #444; padding-bottom: 10px; }
        .header h2 { margin: 0; color: #2c3d94; }
        .header p { margin: 5px 0; color: #666; }
        .summary { margin-bottom: 20px; padding: 10px; background-color: #f8f9fa; border: 1px solid #dee2e6; }
        .summary-box { display: inline-block; width: 48%; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #dee2e6; padding: 6px; text-align: left; }
        th { background-color: #f1f1f1; font-weight: bold; }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .badge { padding: 3px 6px; border-radius: 4px; color: #fff; font-size: 9px; }
        .bg-success { background-color: #28a745; }
        .bg-warning { background-color: #ffc107; color: #000; }
        .bg-danger { background-color: #dc3545; }
        .footer { position: fixed; bottom: 0; width: 100%; text-align: center; font-size: 10px; color: #999; border-top: 1px solid #eee; padding-top: 5px; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Savings Management System</h2>
        <h3>{{ $pageTitle }}</h3>
        <p>Generated on: {{ now()->format('d M, Y h:i A') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th class="text-center">#SL</th>
                <th class="text-center">Date</th>
                <th class="text-center">Member ID</th>
                <th>Name</th>
                <th class="text-right">Amount</th>
                <th class="text-right">Payable</th>
                <th class="text-right">Repaid</th>
                <th class="text-center">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($loans as $key => $loan)
                <tr>
                    <td class="text-center">{{ $key + 1 }}</td>
                    <td class="text-center">{{ $loan->disbursed_date ? $loan->disbursed_date->format('d M, Y') : 'N/A' }}</td>
                    <td class="text-center">{{ $loan->user->member_id ?? 'N/A' }}</td>
                    <td>{{ $loan->user->name ?? 'N/A' }}</td>
                    <td class="text-right">{{ number_format($loan->amount) }}</td>
                    <td class="text-right">{{ number_format($loan->total_payable) }}</td>
                    <td class="text-right">{{ number_format($loan->paid_amount) }}</td>
                    <td class="text-center">
                        {{ ucfirst($loan->status) }}
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" class="text-right"><strong>Totals:</strong></td>
                <td class="text-right"><strong>{{ number_format($totalLoans) }}</strong></td>
                <td></td>
                <td class="text-right"><strong>{{ number_format($totalPaid) }}</strong></td>
                <td></td>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        This is a computer generated report.
    </div>
</body>
</html>
