<!DOCTYPE html>
<html lang="en">

<head>
    <title>Directorate of Ordnance</title>
    <meta charset="utf-8" />
    <link rel="canonical" href="{{ asset('assets/logo/custom-2.svg') }}" />
    <link rel="shortcut icon" href="{{ asset('assets/media/images/fav.png') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/cdn/fonts.googleapis.css') }}" />
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" href="{{ asset('assets/css/cdn/bootstrap.min.css') }}" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/cdn/toastr.css') }}" />
    <script src="{{ asset('assets/js/custom_js/cdn/jquery.min.js') }}"></script>
</head>

<body id="kt_body" class="app-blank bgi-size-cover bgi-position-center">
    @include('layout.partials.loader')
    <div class="d-flex flex-column flex-root" id="kt_app_root">
<?php
    // Generate a random CAPTCHA text (no session)
    $captchaText = substr(str_shuffle('abcdefghijklmnopqrstuvwxyz1234567890'), 0, 6);
    ?>
        <div class="page-main w-100">
            <img src="{{ asset('assets/media/images/bg2.jpg') }}" alt="User Image" class="img-bg">
            <div class="container d-flex align-items-center justify-content-center w-100">
                <div class="page-wrapper">
                    <div class="row align-items-center">
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="page-text-sec">
                                <div class="text-center mb-11">
                                    <img alt="Logo" src="{{ asset('assets/media/logos/logo.png') }}"
                                        class="app-sidebar-logo-default" />
                                </div>
                                <div class="text-center mb-11">
                                    <h1 class="mb-3 h1-1">
                                        Directorate of Ordnance (Coordination and Services)
                                    </h1>
                                    <p class="p-1">
                                        आयुध निदेशालय (समन्वय एवं सेवाएं)
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="page-form-sec">
                                <form class="form w-100 formSubmit" novalidate="novalidate" id="kt_sign_in_form"
                                    action="{{ route('admin.otp-verification') }}" method="POST">
                                    @csrf
                                    @php
                                        $email = request()->get('email');
                                        $email_DECODE = base64_decode($email);
                                        $otp = DB::table('users')->where('email', $email_DECODE)->first();
                                    @endphp
                                    <input type="hidden" name="email" value="{{ $email }}">
                                    <div class="login-right">
                                        <div class="text-center mb-11">
                                            <img alt="Logo" src="{{ asset('assets/media/logos/logo.png') }}"
                                                class="h-90px app-sidebar-logo-default" />
                                        </div>
                                        <div class="text-center mb-11">
                                            <h1 class="text-dark fw-bolder mb-3">Verify OTP</h1>
                                        </div>
                                        <div class="fv-row mb-8">
                                            <label>Enter Your OTP</label>
                                            <input type="text" placeholder="Enter 6 Digit OTP" name="otp"
                                                id="otp" autocomplete="off" class="form-control bg-transparent"
                                                pattern="\d{6}" maxlength="6" minlength="6"
                                                title="Please enter a valid 6 digit OTP"
                                                oninput="this.value=this.value.replace(/[^0-9]/g,'').slice(0,6);"
                                                required />
                                        </div>
                                        <div class="capcha-sec">
                                            <input type="hidden"
                                                value="{{ base64_encode(route('admin.refresh.captcha')) }}"
                                                id="captcharefreshAction">
                                            <div class="imag" id="captcha-container">
                                                <span id="captchaImg" aria-label="Captcha image">
                                                    <p id="captcha-text" aria-hidden="true"
                                                        style="text-align-last: center;"></p>
                                                </span>
                                            </div>
                                            <button type="button" title="Refresh the CAPTCHA code"
                                                class="btn btn-set-1 btn-refresh" onclick="refreshCaptcha()">
                                                <i class="fa fa-refresh"></i>
                                            </button>
                                            <div role="alert" id="announce" class="visually-hidden"></div>
                                            <button type="button" title="Speak the CAPTCHA code" id="refresh"
                                                class="btn btn-set-1 btn-refresh" onclick="playCombinedAudio()">
                                                <i class="fa fa-play"></i>
                                            </button>
                                            <input type="text" class="form-control" name="captcha" id="captcha"
                                                placeholder="Enter Captcha" required>
                                        </div>
                                        <h3>OTP : {{ $otp->verification_code }}</h3>
                                        <div class="mb-4 text-center">
                                            <span id="otp-timer" class="text-danger fw-bold fs-5"></span>
                                        </div>
                                        <p class="note">
                                            🔐 <strong>Note:</strong>
                                            - This OTP is valid for <strong>30 minutes</strong>.<br>
                                            - After <strong>3 incorrect attempts</strong>, the OTP will expire and
                                            you’ll need to request a new one.
                                        </p>
                                        <div class="d-grid mb-10">
                                            <button type="submit" id="kt_sign_in_submit" class="btn btn-set-1 mt-4">
                                                <span class="indicator-label">Verify</span>
                                                <span class="indicator-progress">Please wait...
                                                    <span
                                                        class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                            </button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/js/custom_js/cdn/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/toastr.js') }}"></script>
    <script src="{{ asset('assets/js/operations.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let timerDisplay = document.getElementById('otp-timer');
            let submitBtn = document.getElementById('kt_sign_in_submit');
            const OTP_TIMER_KEY = 'otp_timer_expires_at';

            // Set timer duration (in seconds)
            const duration = 1800;

            // Get expiry timestamp from localStorage or set it
            let expiresAt = localStorage.getItem(OTP_TIMER_KEY);
            if (!expiresAt || isNaN(Number(expiresAt)) || Number(expiresAt) < Date.now()) {
                expiresAt = Date.now() + duration * 1000;
                localStorage.setItem(OTP_TIMER_KEY, expiresAt);
            } else {
                expiresAt = Number(expiresAt);
            }

            function updateTimer() {
                let now = Date.now();
                let remaining = Math.max(0, Math.floor((expiresAt - now) / 1000));
                const minutes = Math.floor(remaining / 60);
                const seconds = remaining % 60;
                if (remaining > 0) {
                    timerDisplay.innerHTML =
                        `<span style="color: blue;">OTP expires in ${minutes}:${seconds.toString().padStart(2, '0')}</span>`;
                    submitBtn.disabled = false;
                    setTimeout(updateTimer, 1000);
                } else {
                    timerDisplay.innerHTML =
                        '<span style="color: red;">OTP expired. Please request a new one.</span>';
                    window.location.href = "{{ route('admin.otp-login') }}"; // Redirect to OTP login page
                }
            }
            updateTimer();
        });
    </script>
    <script>
        $(window).on('load', function() {
            $("#preloader").fadeOut(0);
        });
    </script>
    <script type="text/javascript">
    $('#refresh-captcha').click(function() {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content'),
            },
        });
        $.ajax({
            type: 'POST',
            url: "{{ route('admin.refresh.captcha') }}",
            success: function(data) {
                $("#captcha").val("");
                $('#captchaImg').html(data.captcha);
            }
        });
    });
</script>
<script>
    let currentCaptchaText = ''; // Variable to store the current CAPTCHA text

    function refreshCaptcha() {


        // Generate new CAPTCHA text
        const newCaptchaText = generateRandomCaptchaText();

        // Announce the refresh
        const announceElement = document.getElementById("announce");
        announceElement.textContent = "Captcha is refreshed";
        //announceElement.style.visibility = "visible"; // Ensure the message is visible

        // Dismiss the announcement after 1 second
        setTimeout(function() {
            //announceElement.style.visibility = "hidden"; // Hide the message after 1 second
            announceElement.textContent = "";
        }, 1000);

        // Update the CAPTCHA display
        applyRandomFontsAndColors(newCaptchaText);
        currentCaptchaText = newCaptchaText;
        //document.getElementById("captcha").focus();


    }


    function generateRandomCaptchaText() {
        const chars = "abcdefghijklmnopqrstuvwxyz1234567890";
        let captcha = "";
        for (let i = 0; i < 6; i++) {
            captcha += chars.charAt(Math.floor(Math.random() * chars.length));
        }
        return captcha;
    }

    const fonts = [
        "ABeeZee_regular",
        "Asap_700",
        "Khand_500",
        "Open_Sans_regular",
        "Roboto_regular",
        "Ubuntu_regular"
    ];
    const fontColors = [
        '#2c3e50', '#c0392b', '#16a085', '#c0392b', '#8e44ad', '#303f9f', '#f57c00', '#795548'
    ];

    function applyRandomFontsAndColors(captchaText) {
        let captchaHTML = '';

        // Loop through each character of the captcha text and assign a random font and color
        for (let i = 0; i < captchaText.length; i++) {
            const randomFont = fonts[Math.floor(Math.random() * fonts.length)]; // Select random font
            const randomColor = fontColors[Math.floor(Math.random() * fontColors.length)]; // Select random color
            const randomAngle = Math.floor(Math.random() * 50) - 20; // Random angle between -15 and 15 degrees
            const randomFontSize = Math.floor(Math.random() * 20) + 20; // Random font size between 20px and 40px

            captchaHTML +=
                `<span class="captcha-text" style="font-family: ${randomFont}; color: ${randomColor}; transform: rotate(${randomAngle}deg); font-size: ${randomFontSize}px; display: inline-block;">${captchaText[i]}</span>`;
        }

        // Set the captcha text in the captcha container
        document.getElementById('captcha-text').innerHTML = captchaHTML;
    }

    document.addEventListener('DOMContentLoaded', function() {
        const initialCaptchaText = "<?php echo $captchaText; ?>"; // Use PHP to print the initial CAPTCHA text
        applyRandomFontsAndColors(initialCaptchaText); // Apply styles and display the initial CAPTCHA

        // Call playCombinedAudio for the initial CAPTCHA
        currentCaptchaText = initialCaptchaText; // Update the currentCaptchaText to the initial CAPTCHA

    });

    // Array of background image URLs
         const backgroundImages = [
        '/dpdoo-new/public/backgrounds/01.png',
        '/dpdoo-new/public/backgrounds/02.png',
        '/dpdoo-new/public/backgrounds/03.png',
        '/dpdoo-new/public/backgrounds/04.png',
        '/dpdoo-new/public/backgrounds/05.png',
        '/dpdoo-new/public/backgrounds/06.png',
        '/dpdoo-new/public/backgrounds/07.png',
        '/dpdoo-new/public/backgrounds/08.png',
        '/dpdoo-new/public/backgrounds/09.png',
        '/dpdoo-new/public/backgrounds/10.png',
        '/dpdoo-new/public/backgrounds/11.png',
        '/dpdoo-new/public/backgrounds/12.png'
    ];

    function setRandomBackground() {
        const randomImage = backgroundImages[Math.floor(Math.random() * backgroundImages.length)];
        document.querySelector('.imag').style.backgroundImage = `url(${randomImage})`;
    }
    document.addEventListener('DOMContentLoaded', setRandomBackground);
    const audioContext = new(window.AudioContext || window.webkitAudioContext)();

    // Function to play combined audio for the captcha characters
    function playCombinedAudio() {
        // Disable the button when the audio starts playing
        const playButton = document.querySelector('#refresh');
        playButton.disabled = true;

        let audioBuffers = []; // Array to store audio buffers
        let promises = []; // Array to store promises for fetching audio

        // Fetch audio for each character and decode it
        currentCaptchaText.split('').forEach((char, index) => {
               const audioUrl = `/dpdoo-new/public/audio/${char}.mp3`;// Assuming each character has a corresponding mp3 file
            const promise = fetch(audioUrl)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`Audio file for ${char} not found`);
                    }
                    return response.arrayBuffer(); // Get the audio as an ArrayBuffer
                })
                .then(data => audioContext.decodeAudioData(data)) // Decode the audio
                .then(buffer => {
                    audioBuffers[index] = buffer; // Store the decoded audio buffer at the correct index
                })
                .catch(error => {
                    console.error('Error loading audio for character:', char, error);
                });

            promises.push(promise); // Add the fetch promise to the array
        });

        // Once all audio files are fetched and decoded, combine them
        Promise.all(promises)
            .then(() => {
                // Filter out null buffers (for missing audio)
                const validBuffers = audioBuffers.filter(buffer => buffer !== null);
                if (validBuffers.length > 0) {
                    combineAndPlayAudio(validBuffers, playButton);
                } else {
                    console.error('No valid audio buffers to play');
                }
            })
            .catch(error => console.error('Error processing audio:', error));
    }

    // Function to combine multiple audio buffers and play them sequentially
    function combineAndPlayAudio(buffers, playButton) {
        const outputBuffer = audioContext.createBuffer(
            2, // Number of channels (stereo)
            buffers.reduce((sum, buffer) => sum + buffer.length, 0), // Total length of all audio buffers
            audioContext.sampleRate // Sample rate (same as input)
        );

        let offset = 0;

        // Copy all audio buffers into the output buffer
        buffers.forEach(buffer => {
            for (let channel = 0; channel < buffer.numberOfChannels; channel++) {
                const outputData = outputBuffer.getChannelData(channel);
                const inputData = buffer.getChannelData(channel);
                outputData.set(inputData, offset);
            }
            offset += buffer.length;
        });

        // Play the combined audio buffer
        const source = audioContext.createBufferSource();
        source.buffer = outputBuffer;
        source.connect(audioContext.destination);

        // Re-enable the button after the audio finishes playing
        source.onended = () => {
            playButton.disabled = false; // Enable the button after audio ends
        };

        source.start();
    }
</script>
</body>

</html>
