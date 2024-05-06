export default class Menu {
    constructor() {
        this.selector = '.js-menu';
        this.classes = {
            navContainer: '.nav-container',
        };
        this.init();
    }

    init() {
        const menu = document.querySelector(this.selector);
        const menuContainer = document.querySelector(this.classes.navContainer);

        if (!menu) return;

        menu.addEventListener('click', e => {
            e.preventDefault();
            const target = e.currentTarget;
            const navMenu = document.querySelector('.js-nav-menu');
            target.classList.toggle('active');
            navMenu.classList.toggle('active');
        });

        window.addEventListener('scroll', () => {
            if (window.pageYOffset > menuContainer.offsetTop + 150) {
                menuContainer.classList.add('fixed');
                document.body.style.marginBlockStart = `${menuContainer.clientHeight / 10}rem`;
            } else {
                menuContainer.classList.remove('fixed');
                document.body.style.marginBlockStart = '0rem';
            }
        })
    }
}
