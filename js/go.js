var menu = document.querySelector('#mobileMenu');
var mbutton = document.querySelector('.mobile-menu__open');
var body = document.querySelector('body');

document.querySelector('.mobile-menu__open').addEventListener('click', function(e) {
    e.preventDefault();
    menu.classList.toggle('active');
    mbutton.classList.toggle('active');
    body.classList.toggle('fixed');
});
