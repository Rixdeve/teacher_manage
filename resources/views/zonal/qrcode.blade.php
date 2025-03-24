<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Teacher QR Code</title>
</head>

<body class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="text-center bg-white shadow-lg p-8 rounded-lg">
        <h2 class="text-2xl font-bold mb-4">{{ $teacher->first_name }}'s QR Code</h2>
        <div>{!! $qrCode !!}</div>
        <p class="mt-4 text-gray-600">Scan this code to check-in/check-out</p>
    </div>
</body>

</html>