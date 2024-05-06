export default class Carrosel {
    constructor() {
        this.selector = '.swiper';
        this.init();
    }

    init() {
        const sliders = document.querySelectorAll(this.selector);
        console.log('ererer')
        if (!sliders) return;
        this.initSwiper(sliders);
    }

    initSwiper(sliders) {

        let i = 1;
        sliders.forEach((sliderEl) => {
        const swiperClass = `js-swiper-${i}`;
        const params = (sliderEl.dataset.params) ? JSON.parse(sliderEl.dataset.params) : {};

        // adding class to separate each swiper
        sliderEl.classList.add(swiperClass);
        // For multiple swipers on a same page it is necessary to call different instances
        sliders = [
            ...sliders,
            new Swiper(`.${swiperClass}`, {
            ...params,
            }),
        ];
        i++;
        });
    }
}
