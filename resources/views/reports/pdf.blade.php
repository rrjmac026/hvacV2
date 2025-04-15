<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $title }}</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { position: relative; padding: 20px; }
        .header-content {
            display: flex;
            align-items: center;
            margin-bottom: 30px;
        }
        .logo-container {
            width: 80px;
            margin-right: 20px;
        }
        .logo-image {
            width: 100%;
            border-radius: 8px;
        }
        .header-text { 
            flex: 1; 
            text-align: center;
        }
        h1 { 
            color: #219fa3; 
            margin: 0 0 5px 0;
            text-align: center;
            font-size: 24px;
        }
        .report-info { margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f4f4f4; }
        .footer { text-align: center; font-size: 12px; margin-top: 30px; }
    </style>
</head>
<body>
    <div class="header">
        <div class="header-content">
            <div class="logo-container">
                <img src="data:image/jpeg;base64,{{ base64_encode(file_get_contents(public_path('images/hero.jpg'))) }}" 
                     class="logo-image" alt="HVAC Logo">
            </div>
            <div class="header-text">
                <h1>{{ $title }}</h1>
                <p>Generated on {{ now()->format('F d, Y') }}</p>
            </div>
        </div>
    </div>

    <div class="report-info">
        <p>Period: {{ \Carbon\Carbon::parse($params['start_date'])->format('M d, Y') }} - {{ \Carbon\Carbon::parse($params['end_date'])->format('M d, Y') }}</p>
        <p>Total Records: {{ $data->count() }}</p>
    </div>

    @if($data->isNotEmpty())
        <table>
            <thead>
                <tr>
                    @foreach(array_keys($data->first()) as $header)
                        <th>{{ $header }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($data as $row)
                    <tr>
                        @foreach($row as $value)
                            <td>{{ $value }}</td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No data available for this period.</p>
    @endif

    <div class="footer">
        <p>Generated by Highland Vets Animal Clinic</p>
    </div>
</body>
</html>
