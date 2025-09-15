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
</head>


<?php
// Generate a random CAPTCHA text (no session)
$captchaText = substr(str_shuffle('abcdefghijklmnopqrstuvwxyz1234567890'), 0, 6);
?>

<body id="kt_body" class="app-blank bgi-size-cover bgi-position-center">
    @include('layout.partials.loader')
    <div class="d-flex flex-column flex-root" id="kt_app_root">
        <div class="page-main h-100">
            <img src="{{ asset('assets/media/images/bg2.jpg') }}" alt="User Image" class="img-bg">
            <div class="container d-flex align-items-center justify-content-center h-100">
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
                                    action="{{ route('admin.login') }}" method="POST">
                                    @csrf
                                    <input type="hidden" value="{{ base64_encode(route('admin.refresh.captcha')) }}"
                                        id="captcharefreshAction">
                                    <div class="login-right">
                                        <div class="text-center mb-11">
                                            <h1 class="text-dark fw-bolder mb-3">LOG IN</h1>
                                        </div>
                                        <div class="fv-row mb-8">
                                            <label>Username</label>
                                            <input type="text" placeholder="Email" name="email" id="email"
                                                autocomplete="off" class="form-control bg-transparent" />
                                        </div>
                                        <div class="fv-row mb-3">
                                            <label>Password</label>
                                            <div class="input-group">
                                                <input id="password" type="password" placeholder="Password"
                                                    name="password" autocomplete="off"
                                                    class="form-control bg-transparent" />
                                                <button type="button" class="btn btn-set-1" id="togglePassword">
                                                    <i class="fas fa-eye text-white" id="eyeIcon"></i>
                                                </button>
                                            </div>
                                            <div class="text-end">
                                                <a href="{{ route('admin.forgot.password.page') }}"
                                                    class="link-primary mt-2">Forgot Password ?</a>
                                            </div>
                                        </div>
                                        <div class="capcha-sec">
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




                                        <div class="d-grid mb-10">
                                            <button type="submit" id="kt_sign_in_submit" class="btn btn-set-1 mt-4">
                                                <span class="indicator-label">Sign In</span>
                                                <span class="indicator-progress">Please wait...
                                                    <span
                                                        class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                                </span>
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

    <script src="{{ asset('assets/js/custom_js/cdn/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom_js/cdn/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/toastr.js') }}"></script>
    <script src="{{ asset('assets/js/operations.js') }}"></script>

    <script>
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.remove('fas', 'fa-eye');
                eyeIcon.classList.add('fas', 'fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('fas', 'fa-eye-slash');
                eyeIcon.classList.add('fas', 'fa-eye');
            }
        });

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
            '/ddpdoo/public/backgrounds/01.png',
            '/ddpdoo/public/backgrounds/02.png',
            '/ddpdoo/public/backgrounds/03.png',
            '/ddpdoo/public/backgrounds/04.png',
            '/ddpdoo/public/backgrounds/05.png',
            '/ddpdoo/public/backgrounds/06.png',
            '/ddpdoo/public/backgrounds/07.png',
            '/ddpdoo/public/backgrounds/08.png',
            '/ddpdoo/public/backgrounds/09.png',
            '/ddpdoo/public/backgrounds/10.png',
            '/ddpdoo/public/backgrounds/11.png',
            '/ddpdoo/public/backgrounds/12.png'
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
                const audioUrl =
                    `/dpdoo/public/audio/${char}.mp3`; // Assuming each character has a corresponding mp3 file
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
