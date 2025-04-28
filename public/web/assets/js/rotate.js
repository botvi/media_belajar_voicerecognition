function checkOrientation() {
    var rotateMessage = document.getElementById('rotateMessage');
    if (window.innerHeight > window.innerWidth) {
        rotateMessage.style.display = 'flex';
    } else {
        rotateMessage.style.display = 'none';
    }
}

window.addEventListener('load', checkOrientation);
window.addEventListener('resize', checkOrientation);
window.addEventListener('orientationchange', checkOrientation);