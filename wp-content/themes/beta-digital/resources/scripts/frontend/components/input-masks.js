export default class InputMasks {

    constructor() {
        this.selector = '.wpcf7-form';

        this.selectors = {
            phone: 'input[type=tel]',
            cpf: '.cpf',
            cnpj: '.cnpj',
            cep: 'input[name=cep]',
            currency: '.currency-br'
        };

        this.init();
    }

    init() {
        const form = document.querySelector(this.selector);
        console.log(form);

        if (form) {
            this.initPhoneMask(form);
            this.initCpfMask(form);
            this.initCnpjMask(form);
            this.initCepMask(form);
        }
    }

    currencyBr(form) {
        const inputs = form.querySelectorAll(this.selectors.currency);
        
        inputs.forEach(input => {
            input.setAttribute('pattern', '[0-9]*');
            input.setAttribute('inputmode', 'numeric');
            input.addEventListener('keyup', (e) => {
                let valor = input.value;
                valor = valor.replace(/\D/g, '');
                valor = (valor / 100).toFixed(2).replace('.', ',');
                valor = valor.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                input.value = valor;
            });
        });
    }
    
    initPhoneMask(form) {
        const phones = form.querySelectorAll(this.selectors.phone);

        phones.forEach(phone => {
            phone.addEventListener('keyup', (e) => {
                const phoneVal = e.target;

                setTimeout(function() {
                    let value = phoneVal.value;
                    value = value.replace(/\D/g,""); 
                    value = value.replace(/^(\d{2})(\d)/g,"($1) $2"); 
                    value = value.replace(/(\d)(\d{4})$/,"$1-$2"); 
                    phoneVal.value = value;
                }, 1)
            });
        })
    }

    initCpfMask(form) {
        const cpfs = form.querySelectorAll(this.selectors.cpf);

        cpfs.forEach(cpf => {
            cpf.addEventListener('keyup', (e) => {
                const cpfVal = e.target;
                setTimeout(function() {
                    let value = cpfVal.value;
                    value = value.replace(/\D/g,"");
                    value = value.replace(/(\d{3})(\d)/,"$1.$2");
                    value = value.replace(/(\d{3})(\d)/,"$1.$2"); 
                    value = value.replace(/(\d{3})(\d{1,2})$/,"$1-$2"); 
                    cpfVal.value = value;
                }, 1)
            });
        })
    }

    initCepMask(form) {
        const ceps = form.querySelectorAll(this.selectors.cep);
    
        ceps.forEach(cep => {
            cep.addEventListener('keyup', (e) => {
                const cepVal = e.target;
                setTimeout(function() {
                    let value = cepVal.value;
                    value = value.replace(/\D/g,"");
                    value = value.replace(/(\d{5})(\d)/,"$1-$2");
                    cepVal.value = value;
                }, 1)
            });
        })
    }

    initCnpjMask(form) {
        const cnpjs = form.querySelectorAll(this.selectors.cnpj);

        cnpjs.forEach(cnpj => {
            cnpj.addEventListener('keyup', (e) => {
                const cnpjVal = e.target;

                setTimeout(function() {
                    let value = cnpjVal.value;
                    value = value.replace(/\D/g,"");
                    value = value.replace(/^(\d{2})(\d)/,"$1.$2"); 
                    value = value.replace(/^(\d{2})\.(\d{3})(\d)/,"$1.$2.$3"); 
                    value = value.replace(/\.(\d{3})(\d)/,".$1/$2"); 
                    value = value.replace(/(\d{4})(\d)/,"$1-$2");
                    cnpjVal.value = value;
                }, 1)
            });
        })
    }
}
