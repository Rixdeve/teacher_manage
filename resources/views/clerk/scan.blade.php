<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Scan QR | TLMS</title>
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex flex-col items-center justify-center min-h-screen bg-gray-100">
    <h1 class="text-2xl font-bold mb-4">Scan Teacher QR Code</h1>

    <div id="qr-reader" class="w-80 border rounded p-2 bg-white shadow"></div>
    <p id="result" class="mt-4 text-center font-semibold text-green-600"></p>

    <script>
        function logAttendance(id) {
            fetch(`/teacher/log-attendance/${id}`)
                .then(res => res.json())
                .then(data => {
                    document.getElementById('result').textContent = data.message;
                })
                .catch(err => {
                    document.getElementById('result').textContent = 'Error logging attendance.';
                    console.error(err);
                });
        }

        const qrReader = new Html5Qrcode("qr-reader");

        qrReader.start({
                facingMode: "environment"
            }, {
                fps: 10,
                qrbox: 250
            },
            qrCodeMessage => {
                qrReader.stop();
                logAttendance(qrCodeMessage);

                setTimeout(() => {
                    qrReader.start({
                        facingMode: "environment"
                    }, {
                        fps: 10,
                        qrbox: 250
                    }, qrCodeMessage => {
                        qrReader.stop();
                        logAttendance(qrCodeMessage);
                    });
                }, 5000); // Restart after 5 seconds
            },
            error => {}
        );
    </script>
</body>

</html>