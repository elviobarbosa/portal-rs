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
        let initialOffsetTop = menuContainer.offsetTop; // Armazena a posição inicial

        if (!menu) return;

        menu.addEventListener('click', e => {
            e.preventDefault();
            const target = e.currentTarget;
            const navMenu = document.querySelector('.js-nav-menu');
            target.classList.toggle('active');
            navMenu.classList.toggle('active');
        });

        window.addEventListener('scroll', () => {
            const scrollPosition = window.pageYOffset;

            if (scrollPosition > initialOffsetTop) {
                menuContainer.classList.add('fixed');
                if (!menuContainer.style.paddingTop) {
                    document.body.style.paddingTop = `${menuContainer.offsetHeight}px`
                }
            } else {
                menuContainer.classList.remove('fixed');
                document.body.style.paddingTop = '0';
            }
        });
    }
}