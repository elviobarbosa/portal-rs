function domReady(fn) {
    // If we're early to the party

    const close = document.querySelector('.js-cookies-bar-close');
    const barClose = document.querySelector('.js-bd-cookies-bar');
    const accept = document.querySelector('.js-bd-cookies-bar-accept');
    const refuse = document.querySelector('.js-bd-cookies-bar-refuse');
    const cookiesAct = localStorage.getItem('cookiesAct');

    if (cookiesAct === 'false') {
        barClose.classList.add('bd-cookies-bar__fade-out');
        gtag('config', 'G-0BZF1Z7LZD', { 'anonymize_ip': true });
    } else if (cookiesAct === 'true') {
        barClose.classList.add('bd-cookies-bar__fade-out');
    }

    accept.addEventListener('click', () => {
        localStorage.setItem('cookiesAct', true);
        barClose.classList.add('bd-cookies-bar__fade-out');
    });

    refuse.addEventListener('click', () => {
        localStorage.setItem('cookiesAct', false);
        gtag('config', 'G-0BZF1Z7LZD', { 'anonymize_ip': true });
        barClose.classList.add('bd-cookies-bar__fade-out');
    });

    close.addEventListener('click', () => {
        barClose.classList.add('bd-cookies-bar__fade-out');
    });

    document.addEventListener("DOMContentLoaded", fn);

    if (document.readyState === "interactive" || document.readyState === "complete" ) {
      console.log('dom ready');
      
    }
}

domReady(() => { })