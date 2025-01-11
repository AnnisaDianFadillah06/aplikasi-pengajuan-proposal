<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error Notification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
        }
        .header {
            font-size: 18px;
            font-weight: bold;
            color: #c0392b;
            text-align: center;
            margin-bottom: 20px;
        }
        .section {
            margin-bottom: 20px;
        }
        .label {
            font-weight: bold;
            color: #555;
        }
        .trace {
            background: #f4f4f4;
            padding: 10px;
            border-radius: 4px;
            font-family: monospace;
            font-size: 14px;
            overflow-x: auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">Error Notification</div>

        <div class="section">
            <p><span class="label">Message:</span> {{ $exceptionMessage }}</p>
        </div>
        <div class="section">
            <p><span class="label">File:</span> {{ $exceptionFile }}</p>
        </div>
        <div class="section">
            <p><span class="label">Line:</span> {{ $exceptionLine }}</p>
        </div>
        <div class="section">
            <p><span class="label">Trace:</span></p>
            <pre class="trace">{{ $exceptionTrace }}</pre>
        </div>
    </div>
</body>
</html>
