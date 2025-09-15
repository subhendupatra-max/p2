// ============ sidenav js ============
function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
}
function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}
// ============ /sidenav js ============


// ============ language dropdown js ============
function toggleDropdown() {
    const dropdown = document.getElementById("iconDropdown");
    dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
}
// ============ /language dropdown js ============


// ============ page animation work sidebar js ============
function viewSidenavopen() {
    document.getElementById("view-sidebar").style.width = "400px";
}
function viewSidenavclose() {
    document.getElementById("view-sidebar").style.width = "0";
}
// ============ /page animation work sidebar js ============


// ============ screen zoom in - zoom out js ============
let zoomLevel = parseFloat(localStorage.getItem("zoomLevel")) || 1;
document.body.style.zoom = zoomLevel;

function zoomIn() {
    zoomLevel += 0.1;
    document.body.style.zoom = zoomLevel;
    localStorage.setItem("zoomLevel", zoomLevel);
}
function zoomOut() {
    zoomLevel = Math.max(0.1, zoomLevel - 0.1);
    document.body.style.zoom = zoomLevel;
    localStorage.setItem("zoomLevel", zoomLevel);
}
// ============ /screen zoom in - zoom out js ============


// ============ page image hide js ============
let isHidden = localStorage.getItem("imagesHidden") === "true";

function applyImageVisibility() {
    const box = document.getElementById('image-hide');
    if (!box) return;
    const images = box.querySelectorAll('img');
    images.forEach(img => {
        img.style.display = isHidden ? 'none' : 'inline';
    });
}

function toggleImages() {
    isHidden = !isHidden;
    localStorage.setItem("imagesHidden", isHidden);
    applyImageVisibility();
}

applyImageVisibility();
// ============ /page image hide js ============


// ============ sidenav dropdown js ============
function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
}
// ============ /sidenav dropdown js ============


// ============ merged window click handler ============
window.onclick = function (event) {
    // Language dropdown
    if (!event.target.closest('.dropdown-icon')) {
        const dropdown = document.getElementById("iconDropdown");
        if (dropdown) dropdown.style.display = "none";
    }

    // Sidenav dropdown
    if (!event.target.matches('.dropbtn')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        for (var i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
        }
    }
};
// ============ /merged window click handler ============


// ============ banner slider ============
var swiper = new Swiper(".banner-slider", {
    slidesPerView: 1,
    loop: true,
    autoplay: true,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
});
// ============ /banner slider ============


// ============ explore slider ============
var swiper = new Swiper(".explore-slider", {
    slidesPerView: 1,
    loop: true,
    autoplay: true,
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
});
// ============ /explore slider ============


// ============ paralus slider ============
var swiper = new Swiper(".paralus-slider", {
    slidesPerView: 1,
    loop: true,
    autoplay: false,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
});
// ============ /paralus slider ============


// ============ client slider ============
var swiper = new Swiper(".client-slider", {
    slidesPerView: 6,
    spaceBetween: 30,
    loop: true,
    autoplay: true,
    breakpoints: {
        100: {
            slidesPerView: 2,
            spaceBetween: 10
        },
        768: {
            slidesPerView: 3,
            spaceBetween: 10
        },
        1024: {
            slidesPerView: 4,
            spaceBetween: 10
        },
        1280: {
            slidesPerView: 6,
            spaceBetween: 10
        }
    }
});
// ============ /client slider ============


// ============ Key Offerings Tab ============
function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}
// ============ /Key Offerings Tab js ============


// ============ link highlight js ============
function applyLinkHighlight() {
    const links = document.querySelectorAll('a');
    const highlighted = localStorage.getItem("linksHighlighted") === "true";
    links.forEach(link => {
        if (highlighted) {
            link.classList.add('highlight-link');
        } else {
            link.classList.remove('highlight-link');
        }
    });
}

function highlightLinks() {
    const highlighted = localStorage.getItem("linksHighlighted") === "true";
    localStorage.setItem("linksHighlighted", !highlighted);
    applyLinkHighlight();
}

applyLinkHighlight();
// ============ /link highlight js ============


// ============ dark bg js ============
if (localStorage.getItem("darkMode") === "true") {
    document.body.classList.add("dark");
}
function toggleDark() {
    document.body.classList.toggle("dark");
    localStorage.setItem("darkMode", document.body.classList.contains("dark"));
}
// ============ /dark bg js ============

// ============ invert bg js ============
if (localStorage.getItem("darkInvertMode") === "true") {
    document.body.classList.add("dark2");
    document.body.classList.add("invert2");
}

function toggleDarkInvert() {
    document.body.classList.toggle("dark2");
    document.body.classList.toggle("invert2");

    const isActive = document.body.classList.contains("dark2") && document.body.classList.contains("invert2");
    localStorage.setItem("darkInvertMode", isActive);
}
// ============ /invert bg js ============

// ============ saturation js ============
window.onload = function () {
    if (localStorage.getItem("saturation") === "on") {
        document.body.classList.add("saturation");
    }
};

function toggleSaturation() {
    document.body.classList.toggle("saturation");

    if (document.body.classList.contains("saturation")) {
        localStorage.setItem("saturation", "on");
    } else {
        localStorage.setItem("saturation", "off");
    }
}
// ============ /saturation js ============

// ============ curser change js ============
const btn = document.getElementById('toggleCursorBtn');
let enabled = false;

function setEnabled(on) {
    enabled = !!on;
    document.body.classList.toggle('custom-cursor', enabled);
    btn.textContent = enabled ? 'Disable Custom Cursor' : 'Enable Custom Cursor';
    btn.setAttribute('aria-pressed', String(enabled));
}

btn.addEventListener('click', () => setEnabled(!enabled));

window.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && enabled) setEnabled(false);
});
// ============ /curser change js ============

// ============ Reset Accessibility js ============
function resetAccessibility() {
    // Remove all accessibility-related classes
    document.body.classList.remove("dark", "dark2", "invert2", "colorMode", "highlight-link", "saturation");

    // Reset zoom
    zoomLevel = 1;
    document.body.style.zoom = 1;

    // Reset image visibility
    isHidden = false;
    const box = document.getElementById('image-hide');
    if (box) {
        const images = box.querySelectorAll('img');
        images.forEach(img => {
            img.style.display = 'inline';
        });
    }

    // Reset link highlight
    const links = document.querySelectorAll('a');
    links.forEach(link => {
        link.classList.remove('highlight-link');
    });

    // Clear all accessibility-related settings from localStorage
    localStorage.removeItem("darkMode");
    localStorage.removeItem("darkMode2");
    localStorage.removeItem("darkInvertMode");
    localStorage.removeItem("invertMode2");
    localStorage.removeItem("colorMode");
    localStorage.removeItem("zoomLevel");
    localStorage.removeItem("imagesHidden");
    localStorage.removeItem("linksHighlighted");
    localStorage.setItem("saturation", "off");
}

// ============ /Reset Accessibility js ============
// ============ /highlight text js ============
function removeHighlights() {
    document.querySelectorAll("span.highlight").forEach(el => {
        el.outerHTML = el.innerText;
    });
}

// Function to highlight across whole page
function highlightAll() {
    let text = document.getElementById("searchBox").value.trim();
    removeHighlights();

    if (text === "") return;

    let regex = new RegExp("(" + text.replace(/[.*+?^${}()|[\]\\]/g, "\\$&") + ")", "gi");

    // Walk through all text nodes
    function walk(node) {
        if (node.nodeType === 3) { // text node
            let match = node.nodeValue.match(regex);
            if (match) {
                let span = document.createElement("span");
                span.innerHTML = node.nodeValue.replace(regex, '<span class="highlight">$1</span>');
                node.parentNode.replaceChild(span, node);
            }
        } else if (node.nodeType === 1 && node.nodeName !== "SCRIPT" && node.nodeName !== "STYLE") {
            for (let i = 0; i < node.childNodes.length; i++) {
                walk(node.childNodes[i]);
            }
        }
    }

    walk(document.body);
}

// ============ /highlight text js ============

window.addEventListener('load', function () {
    const loader = document.getElementById('loader-frontend');
    if (loader) {
        loader.style.display = 'none';
    }
});








