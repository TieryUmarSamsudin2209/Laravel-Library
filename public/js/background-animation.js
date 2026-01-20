const canvas = document.getElementById("starfield");

// Ensure canvas exists and has proper 2D context
if (!canvas) {
    console.error("Canvas element not found!");
}

const ctx = canvas ? canvas.getContext("2d") : null;

if (!ctx) {
    console.error("Could not get 2D context from canvas");
}

let stars = [];
let meteors = [];

const STAR_COUNT = 180;
const METEOR_CHANCE = 0.01;
const STORAGE_KEY = "starfield_stars";

function resizeCanvas() {
    if (canvas) {
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;
    }
}
resizeCanvas();
window.addEventListener("resize", resizeCanvas);

function createStars() {
    stars = [];
    for (let i = 0; i < STAR_COUNT; i++) {
        stars.push({
            x: Math.random() * canvas.width,
            y: Math.random() * canvas.height,
            r: Math.random() * 1.2 + 0.3,
            speed: Math.random() * 0.4 + 0.1
        });
    }
    // Simpan ke localStorage
    saveStars();
}

function saveStars() {
    try {
        localStorage.setItem(STORAGE_KEY, JSON.stringify(stars));
    } catch (e) {
        console.warn("Could not save stars to localStorage:", e);
    }
}

function loadStars() {
    try {
        const saved = localStorage.getItem(STORAGE_KEY);
        if (saved) {
            stars = JSON.parse(saved);
            return true;
        }
    } catch (e) {
        console.warn("Could not load stars from localStorage:", e);
    }
    return false;
}

// Load stars from storage, jika tidak ada maka buat baru
if (!loadStars()) {
    createStars();
}

function createMeteor() {
    const startX = Math.random() * canvas.width;
    const startY = -50;

    meteors.push({
        x: startX,
        y: startY,
        length: Math.random() * 300 + 150,
        speed: Math.random() * 10 + 8,
        angle: Math.PI / 4,
        alpha: 1
    });
}

function drawStars() {
    ctx.fillStyle = "#ffffff";
    stars.forEach(star => {
        ctx.beginPath();
        ctx.arc(star.x, star.y, star.r, 0, Math.PI * 2);
        ctx.fill();
    });
}

function drawMeteors() {
    meteors.forEach((m, i) => {
        const dx = Math.cos(m.angle) * m.length;
        const dy = Math.sin(m.angle) * m.length;

        ctx.strokeStyle = `rgba(255,255,225,${m.alpha})`;
        ctx.lineWidth = 2;
        ctx.beginPath();
        ctx.moveTo(m.x, m.y);
        ctx.lineTo(m.x - dx, m.y - dy);
        ctx.stroke();

        m.x += Math.cos(m.angle) * m.speed;
        m.y += Math.sin(m.angle) * m.speed;
        m.alpha -= 0.015;

        if (m.alpha <= 0) meteors.splice(i, 1);
    });
}

function animate() {
    if (!ctx || !canvas) return;
    
    ctx.clearRect(0, 0, canvas.width, canvas.height);

    drawStars();
    drawMeteors();

    if (Math.random() < METEOR_CHANCE) {
        createMeteor();
    }

    requestAnimationFrame(animate);
}

animate();
