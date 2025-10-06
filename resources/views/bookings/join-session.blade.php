<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Join Session</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
    <h2 class="mb-4">Join Session</h2>

    <div id="jitsi-container" style="width: 100%; height: 600px; border: 1px solid #ddd;"></div>
</div>

<!-- Jitsi API -->
<script src="https://meet.jit.si/external_api.js"></script>

<script>
    const domain = "meet.jit.si";
    const options = {
        roomName: "{{ $booking->meeting_link }}".replace('https://meet.jit.si/', ''),
        width: "100%",
        height: 600,
        parentNode: document.querySelector('#jitsi-container'),
        interfaceConfigOverwrite: {
            TOOLBAR_BUTTONS: [
                'microphone', 'camera', 'hangup', 'chat', 'tileview'
            ]
        }
    };
    const api = new JitsiMeetExternalAPI(domain, options);
</script>

</body>
</html>
