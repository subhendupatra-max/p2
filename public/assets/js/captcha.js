$('#refresh-captcha').click(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content'),
        },
    });
    $.ajax({
        type: 'POST',
        url: "{{ route('admin.refresh.captcha') }}",
        success: function (data) {
            $("#captcha").val("");
            $('#captchaImg').html(data.captcha);
        }
    });
});

let currentCaptchaText = ''; // Variable to store the current CAPTCHA text

function refreshCaptcha() {
    const newCaptchaText = generateRandomCaptchaText();
    applyRandomFontsAndColors(newCaptchaText);
    currentCaptchaText = newCaptchaText;
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

document.addEventListener('DOMContentLoaded', function () {
    const initialCaptchaText = document.getElementById('captchaText').value; // Use PHP to print the initial CAPTCHA text
    applyRandomFontsAndColors(initialCaptchaText); // Apply styles and display the initial CAPTCHA

    // Call playCombinedAudio for the initial CAPTCHA
    currentCaptchaText = initialCaptchaText; // Update the currentCaptchaText to the initial CAPTCHA

});

// Array of background image URLs
const backgroundImages = [
    '/backgrounds/01.png',
    '/backgrounds/02.png',
    '/backgrounds/03.png',
    '/backgrounds/04.png',
    '/backgrounds/05.png',
    '/backgrounds/06.png',
    '/backgrounds/07.png',
    '/backgrounds/08.png',
    '/backgrounds/09.png',
    '/backgrounds/10.png',
    '/backgrounds/11.png',
    '/backgrounds/12.png'
];

function setRandomBackground() {
    const randomImage = backgroundImages[Math.floor(Math.random() * backgroundImages.length)];
    document.querySelector('.imag').style.backgroundImage = `url(${randomImage})`;
}
document.addEventListener('DOMContentLoaded', setRandomBackground);
const audioContext = new (window.AudioContext || window.webkitAudioContext)();

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
            `/audio/${char}.mp3`; // Assuming each character has a corresponding mp3 file
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
