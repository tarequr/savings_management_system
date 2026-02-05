<!DOCTYPE html>
<html>
<head>
    <title>{{ $pageTitle }}</title>
    <style>
        body { font-family: 'Helvetica', sans-serif; font-size: 12px; color: #333; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #444; padding-bottom: 10px; }
        .header h2 { margin: 0; color: #2c3d94; }
        .header p { margin: 5px 0; color: #666; }
        .summary { margin-bottom: 20px; padding: 10px; background-color: #f8f9fa; border: 1px solid #dee2e6; }
        .summary table { width: 100%; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #dee2e6; padding: 8px; text-align: left; }
        th { background-color: #f1f1f1; font-weight: bold; }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
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
                <th class="text-center" width="5%">#SL</th>
                <th class="text-center" width="15%">Date</th>
                <th class="text-center" width="15%">Member ID</th>
                <th>Name</th>
                <th class="text-center" width="15%">Month/Year</th>
                <th class="text-right" width="15%">Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach($savings as $key => $saving)
                <tr>
                    <td class="text-center">{{ $key + 1 }}</td>
                    <td class="text-center">{{ $saving->payment_date ? $saving->payment_date->format('d M, Y') : 'N/A' }}</td>
                    <td class="text-center">{{ $saving->user->member_id ?? 'N/A' }}</td>
                    <td>{{ $saving->user->name ?? 'N/A' }}</td>
                    <td class="text-center">{{ $saving->month }} {{ $saving->year }}</td>
                    <td class="text-right">{{ number_format($saving->amount) }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5" class="text-right"><strong>Total Savings:</strong></td>
                <td class="text-right"><strong>{{ number_format($totalAmount) }}</strong></td>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        Page {PAGENO} | This is a computer generated report.
    </div>
</body>
</html>
