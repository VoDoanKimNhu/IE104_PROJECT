// Đối tượng Validator
function Validator(options) {
    var selectorRules = {};

    function validate(inputElement, rule) {
        var errorElement = inputElement.parentElement.querySelector(options.errorSelector);
        var errorMessage = rule.test(inputElement.value);

        var rules = selectorRules[rule.selector];

        for(var i=0; i < rules.length; ++i) {
            errorMessage = rules[i](inputElement.value);
            if(errorMessage) break;  
        }

        if(errorMessage) {
            errorElement.innerText = errorMessage;
            inputElement.parentElement.querySelector('.input-field').classList.add('invalid');
        }else {
            errorElement.innerText = '';
            inputElement.parentElement.querySelector('.input-field').classList.remove('invalid');
        }

        return !errorMessage;
    }
    
    var formElement = document.querySelector(options.form);
    
    if(formElement) {
        formElement.onsubmit = function (e) {
            e.preventDefault();

            var isFormValid = true;

            options.rules.forEach(function (rule) {
                var inputElement = formElement.querySelector(rule.selector);
                var isValid = validate(inputElement, rule);
                if(!isValid) {
                    isFormValid = false;
                }
            });

            if(isFormValid) {
                if(typeof options.onSubmit === 'function') {
                    var enableInputs = formElement.querySelector('[name]:not([disabled])');
                    // forEach(enableInputs) {
                    //     console.log(enableInputs);
                    // }
                    var formValues = Array.from(enableInputs).reduce(function(values, input){
                    return (values[input.name] = input.value) && values;
                    }, {});
                    console.log(formValues);

                options.onSubmit(formValues);
                }
            }
        }
        options.rules.forEach(function(rule) {
            // Lưu lại các rules cho mỗi input
            if(Array.isArray(selectorRules[rule.selector])) {
                selectorRules[rule.selector].push(rule.test); 
            }else {
                selectorRules[rule.selector] = [rule.test];
            }

            var inputElement = formElement.querySelector(rule.selector);

            if(inputElement) {
                // Xử lý trường hợp blur khỏi input
                inputElement.onblur = function () {
                    validate(inputElement, rule);
                }

                // Xử lý trường hợp khi người dùng nhập vào ô input
                inputElement.oninput = function () {
                    validate(inputElement, rule);
                }
            }
        });
    }
}

// Định nghĩa rules
// Nguyên tắc của các rules:
// 1. Khi có lỗi => Trả ra message lỗi
// 2. Khi hợp lệ => Không trả ra gì cả (undefined)
Validator.isRequired = function (selector) {
    return {
        selector: selector,
        test: function (value) {
            return value.trim() ? undefined : 'Please enter this field!';
        }
    };
}

Validator.isEmail = function (selector) {
    return {
        selector: selector,
        test: function (value) {
            var regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/; // https://www.w3resource.com/javascript/form/email-validation.php
            return regex.test(value) ? undefined : 'This field must be an email!';
        }
    };
}

Validator.minLength = function (selector, min) {
    return {
        selector: selector,
        test: function (value) {
            return value.length >= min ? undefined : 'Min length of password must be 6 characters!';
        }
    };
}

Validator.isConfirmed = function (selector, getConfirmValue) {
    return {
        selector: selector,
        test: function (value) {
            return value === getConfirmValue() ? undefined : 'Confirm password failed! Please enter it again!';
        }
    };
}