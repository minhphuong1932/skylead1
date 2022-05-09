document.addEventListener('DOMContentLoaded', function () {
    // Mong muốn của chúng ta
    const x = document.querySelector(".lang").value
    if(x === "vn"){
      Validator({
        form: '#plane-form',
        formGroupSelector: '.plane-form__group',
        errorSelector: '.plane-form__message',
        rules: [
          Validator.isRequired('#plane-name', 'Vui lòng nhập tên của bạn'),
          Validator.minLength('#plane-phone', 10, `Vui lòng nhập tối thiểu 10 kí tự`),
          Validator.maxLength('#plane-phone', 10, `Vui lòng nhập tối đa 10 kí tự`),
          Validator.isEmail('#plane-email', 'Vui lòng nhập đúng email', "Vui lòng nhập email")
        ],
        submit: false,
        onSubmit: function (data) {
          // Call API
          // console.log(data);
        }
      });
    }else{
      Validator({
        form: '#plane-form',
        formGroupSelector: '.plane-form__group',
        errorSelector: '.plane-form__message',
        rules: [
          Validator.isRequired('#plane-name', 'Please enter your full name.'),
          Validator.minLength('#plane-phone', 10, "Please enter at least 10 characters."),
          Validator.maxLength('#plane-phone', 10, "Please enter at maximum 10 characters."),
          Validator.isEmail('#plane-email',"Please enter a valid email.", 'Please enter your email.')
        ],
        submit: false,
        onSubmit: function (data) {
          // Call API
          // console.log(data);
        }
      });
    }
  
  });
  