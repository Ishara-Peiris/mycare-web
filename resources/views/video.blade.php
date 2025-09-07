<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Video Chat</title>

    <!-- Axios & Pusher -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: #f5f7fa;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            min-height: 100vh;
            padding: 40px 20px;
            margin: 0;
            color: #333;
        }
        h2 {
            color: #2c3e50;
            margin-bottom: 30px;
            text-align: center;
        }
        button {
            padding: 12px 24px;
            font-size: 16px;
            font-weight: 500;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s ease;
            background: #4e73df;
            color: #fff;
            margin-bottom: 10px;
        }
        button:hover { background: #2e59d9; }

        #videoContainer {
            display: none;
            background: #fff;
            border-radius: 12px;
            padding: 30px 20px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            max-width: 750px;
            width: 100%;
            margin-top: 20px;
            text-align: center;
        }

        #videoContainer video {
            width: 320px;
            height: 240px;
            border-radius: 8px;
            border: 2px solid #ccc;
            margin: 10px;
            background: #000;
        }

        .video-grid {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
        }

        @media (max-width: 700px) {
            #videoContainer video { width: 90%; height: auto; }
        }

        .info-text { font-size: 14px; color: #666; margin-top: 10px; }
    </style>
</head>
<body>
    <h2>myCare Video Chat</h2>

    <button id="joinCall">Join Video Call</button>
    <p class="info-text">Click to allow camera and microphone</p>

    <div id="videoContainer">
        <div class="video-grid">
            <video id="localVideo" autoplay muted playsinline></video>
            <video id="remoteVideo" autoplay playsinline></video>
        </div>
        <button id="startCall">Start Call</button>
    </div>

    <script>
        let pc, localVideo, remoteVideo;

        document.getElementById("joinCall").onclick = async () => {
            document.getElementById("videoContainer").style.display = "block";
            localVideo = document.getElementById("localVideo");
            remoteVideo = document.getElementById("remoteVideo");

            pc = new RTCPeerConnection();

            // Handle remote stream
            pc.ontrack = event => { remoteVideo.srcObject = event.streams[0]; };

            // ICE candidates
            pc.onicecandidate = event => {
                if (event.candidate) {
                    axios.post("/send-candidate", { candidate: event.candidate });
                }
            };

            // Get local stream
            try {
                const stream = await navigator.mediaDevices.getUserMedia({ video: true, audio: true });
                localVideo.srcObject = stream;
                stream.getTracks().forEach(track => pc.addTrack(track, stream));
            } catch (err) {
                console.error("Error accessing camera/microphone", err);
            }

            // Pusher setup
            const pusher = new Pusher("{{ env('PUSHER_APP_KEY') }}", {
                cluster: "{{ env('PUSHER_APP_CLUSTER') }}",
                forceTLS: true
            });

            const channel = pusher.subscribe("video-channel");

            channel.bind("VideoOffer", async data => {
                await pc.setRemoteDescription(new RTCSessionDescription(data.offer));
                const answer = await pc.createAnswer();
                await pc.setLocalDescription(answer);
                axios.post("/send-answer", { answer });
            });

            channel.bind("VideoAnswer", async data => {
                await pc.setRemoteDescription(new RTCSessionDescription(data.answer));
            });

            channel.bind("VideoCandidate", async data => {
                try { await pc.addIceCandidate(new RTCIceCandidate(data.candidate)); }
                catch (e) { console.error(e); }
            });

            document.getElementById("startCall").onclick = async () => {
                const offer = await pc.createOffer();
                await pc.setLocalDescription(offer);
                axios.post("/send-offer", { offer });
            };
        };
    </script>
</body>
</html>
