// Javascript ở HTML
// Validator({
//     form: '#form-1',
//     errorSelector: '.form-message',
//     rules: [
//         Validator.isRequired('#fullname'),
//         Validator.isEmail('#email'),
//         Validator.isRequired('#password', 6),
//         Validator.isRequired('#password'),
//         Validator.isConfirmed('#password_confirmation', function() {
//              return document.querySelector('#form-1 #password').value;
//         }, 'Confirm password failed!'), 
//     ]
// });


// Đối tượng Validator
function Validator(options) {

    var selectorRules = {};

    function validate(inputElement, rule) {
        var errorElement = inputElement.parentElement.querySelector('options.errorSelector');
        var errorMessage;

        var rules =selectorRules[rule.selector];

        for(var i=0; i < rules.length; ++i) {
            errorMessage = rules[i](inputElement.value);
            if(errorMessage) break; 
        }

        if(errorMessage) {
            errorMessage.innerText = errorMessage;
            inputElement.parentElement.classList.add('invalid');
        }else {
            errorMessage.innerText = '';
            inputElement.parentElement.classList.remove('invalid');
        }
    }
    

    var formElement = document.querySelector(options.form);
    
    if(formElement) {
        options.rules.forEach(function (rule) {

            // Lưu lại các rules cho mỗi input
            if(Array.isArray(selectorRules[rule.selector])) {
                selectorRules[rule.selector].push(rule.test); 
            }else {
                selectorRules[rule.selector] = [rule.test];
            }

            selectorRules[rule.selector] = rule.test;

            var inputElement = formElement.querySelector(rule.selector);

            if(inputElement) {
                // Xử lý trường hợp blur khỏi input
                inputElement.onblur = function () {
                    validate(inputElement, rule);
                }

                // Xử lý trường hợp khi người dùng nhập vào ô input
                inputElement.oninput = function () {
                    var errorElement = inputElement.parentElement.querySelector('options.errorSelector');
                    errorMessage.innerText = '';
                    inputElement.parentElement.classList.remove('invalid');
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

Validator.isConfirmed = function (selector, getConfirmValue, message) {
    return {
        selector: selector,
        test: function (value) {
            return value === getConfirmValue() ? undefined : message || 'Confirm password failed! Please enter it again!';
        }
    };

}