// Active Navigation Link Handler
document.addEventListener('DOMContentLoaded', function() {
    const currentUrl = window.location.pathname;
    const navLinks = document.querySelectorAll('.menu-link-navbar a');
    
    navLinks.forEach(link => {
        const href = link.getAttribute('href');
        
        // Check if current URL matches link href
        if (href === '/' && currentUrl === '/') {
            link.classList.add('active');
        } else if (href !== '/' && currentUrl.startsWith(href)) {
            link.classList.add('active');
        } else {
            link.classList.remove('active');
        }
    });
});

// Password Show/Hide Toggle
const showPassBtn = document.getElementById('showPass');
if (showPassBtn) {
    showPassBtn.addEventListener('click', function(e) {
        e.preventDefault();
        const passwordInput = document.getElementById('password');
        const icon = this.querySelector('i');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    });
}

// Loading Bar Functionality
const loadingBar = document.querySelector('.loading-bar');

function startLoadingProgress() {
    loadingBar.style.transition = 'width 0.2s ease';
    loadingBar.style.width = '30%';
    loadingBar.classList.remove('complete');
    loadingBar.classList.add('active');
}

function completeLoadingProgress() {
    if (!loadingBar) return;
    
    loadingBar.style.transition = 'width 0.5s ease';
    loadingBar.style.width = '100%';
    
    setTimeout(() => {
        loadingBar.style.transition = 'opacity 0.5s ease';
        loadingBar.classList.add('complete');
        
        setTimeout(() => {
            loadingBar.classList.remove('active', 'complete');
            loadingBar.style.transition = 'width 0.2s ease';
            loadingBar.style.width = '0%';
        }, 600);
    }, 300);
}

// Complete loading saat page selesai load
window.addEventListener('load', () => {
    completeLoadingProgress();
});

// Handle back/forward button navigation lebih agresif
window.addEventListener('popstate', () => {
    completeLoadingProgress();
});

// Mulai loading saat klik link eksternal
document.addEventListener('click', (e) => {
    const link = e.target.closest('a');
    if (link && !link.target && !link.href.includes('#') && !link.href.includes('javascript:')) {
        startLoadingProgress();
    }
});

// Fallback: complete loading jika masih loading setelah 5 detik
setInterval(() => {
    if (loadingBar && loadingBar.classList.contains('active') && !loadingBar.classList.contains('complete')) {
        // Loading terlalu lama, complete saja
        completeLoadingProgress();
    }
}, 5000);

let startBorrow = document.getElementById("start_borrow")

startBorrow.addEventListener("change", function(){
    let date = new Date(`${this.value}`);

    let getDateStart = date.getDate();

    let endDate = date.setDate(getDateStart + 3);

    let endBorrow = document.getElementById("end_borrow");
    
    let endBorrowValue = `${new Date(endDate).getFullYear()}-${new Date(endDate).getMonth() + 1 < 10 ? `0${new Date(endDate).getMonth() +1}` : new Date(endDate).getMonth() + 1}-${new Date(endDate).getDate() < 10 ? `0${new Date(endDate).getDate()}` : new Date(endDate).getDate()}`

    endBorrow.value = endBorrowValue
})


