const progressBar = document.querySelector('.reading-progress');

function updateProgress() {
    const totalHeight = document.body.clientHeight;
    const windowHeight = document.documentElement.clientHeight;
    const position = window.scrollY;
    const progress = position / (totalHeight - windowHeight) * 100;
    progressBar.setAttribute('value', progress);
    requestAnimationFrame(updateProgress);
}

requestAnimationFrame(updateProgress);

function copyTextToClipboard() {
    event.preventDefault();
    event.stopPropagation();
    var copyUrl = window.location.href;
    navigator.clipboard.writeText(copyUrl);
    event.target.classList.add('done');
}

document.querySelector('a.social__button.toclipboard').addEventListener('click', function() {
    copyTextToClipboard();
});
