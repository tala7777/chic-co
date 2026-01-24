<!DOCTYPE html>
<html>
<head>
    <title>PHP Extensions Test</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        th { background-color: #4CAF50; color: white; }
        tr:nth-child(even) { background-color: #f2f2f2; }
        .success { color: green; font-weight: bold; }
        .error { color: red; font-weight: bold; }
    </style>
</head>
<body>
    <h1>PHP Extension Test - Laravel with PHP 8.5.2</h1>
    <p><strong>PHP Version:</strong> {{ phpversion() }}</p>
    
    <h2>Extension Status</h2>
    <table>
        <tr>
            <th>Category</th>
            <th>Extension</th>
            <th>Status</th>
            <th>Purpose</th>
        </tr>
        @foreach($results as $result)
        <tr>
            <td>{{ $result['category'] }}</td>
            <td><code>{{ $result['extension'] }}</code></td>
            <td class="{{ $result['loaded'] ? 'success' : 'error' }}">
                {{ $result['icon'] }} {{ $result['loaded'] ? 'Loaded' : 'Missing' }}
            </td>
            <td>{{ $result['purpose'] }}</td>
        </tr>
        @endforeach
    </table>
    
    <h2>Quick Links</h2>
    <ul>
        <li><a href="/php-perf">Performance Test</a></li>
        <li><a href="/php-info?show=all">PHP Info (Full)</a></li>
        <li><a href="/">Back to Home</a></li>
    </ul>
</body>
</html>
