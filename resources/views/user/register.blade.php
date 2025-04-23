<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">
  <title>Register</title>
  <style>
    .step {
       position: relative;
       width: 100%;
      display: none;
    }
    .step.active {
      display: block;
    }
    
  </style>
</head>
<body>
  <div class="container">
    <header class="header-svg">
      <div class="header-info">
        <div class="name">Create Account</div>
        <div class="parag">Input the Details Correctly</div>
      </div>
      <img src="{{ asset('images/logo.jfif') }}" alt="Logo">
    </header>

    <div class="wrapper">
      <form class="form_container" id="registration-form">
        <div class="step active" id="step-1">


          <div class="form-step-title">Basic Information</div>

          <div class="input_container">
            <label class="input_label" for="firstname_field">First name</label>
            <svg fill="none" viewBox="0 0 24 24" height="24" width="24" xmlns="http://www.w3.org/2000/svg" class="icon">
  <path stroke-linejoin="round" stroke-linecap="round" stroke-width="1.5" stroke="#141B34" d="M12 14c3.866 0 7 1.5 7 4.5V19H5v-0.5c0-3 3.134-4.5 7-4.5z"></path>
  <path stroke-linejoin="round" stroke-linecap="round" stroke-width="1.5" stroke="#141B34" d="M12 12a4 4 0 1 0 0-8 4 4 0 1 0 0 8z"></path>
</svg>

            <input placeholder="juan" name="fname" type="text" class="input_field" id="firstname_field" required>
          </div>
          <div class="input_container">
            <label class="input_label" for="lastname_field">Last name</label>
            <svg fill="none" viewBox="0 0 24 24" height="24" width="24" xmlns="http://www.w3.org/2000/svg" class="icon">
  <path stroke-linejoin="round" stroke-linecap="round" stroke-width="1.5" stroke="#141B34" d="M12 14c3.866 0 7 1.5 7 4.5V19H5v-0.5c0-3 3.134-4.5 7-4.5z"></path>
  <path stroke-linejoin="round" stroke-linecap="round" stroke-width="1.5" stroke="#141B34" d="M12 12a4 4 0 1 0 0-8 4 4 0 1 0 0 8z"></path>
</svg>

            <input placeholder="cruz" name="lastname" type="lastname" class="input_field" id="lastname_field" required>
          </div>
          <div class="input_container">
            <label class="input_label" for="address_field">Address</label>
            <svg fill="none" viewBox="0 0 24 24" height="24" width="24" xmlns="http://www.w3.org/2000/svg" class="icon">
  <path stroke-linejoin="round" stroke-linecap="round" stroke-width="1.5" stroke="#141B34" d="M12 2C8.134 2 5 5.134 5 8c0 3.866 7 12 7 12s7-8.134 7-12c0-2.866-3.134-6-7-6z"></path>
  <path stroke-linejoin="round" stroke-linecap="round" stroke-width="1.5" stroke="#141B34" d="M12 11a2 2 0 1 0 0-4 2 2 0 1 0 0 4z"></path>
</svg>
            <input placeholder="Brgy XX " name="address" type="address" class="input_field" id="address_field" required>
          </div>
          <button type="button" class="sign-in_btn" onclick="nextStep(2)">Next</button>
        </div>

        <div class="step" id="step-2">
        <div class="input_container">
        <div class="form-step-title">Account Details</div>   
            <label class="input_label" for="Username_field">Username</label>
            <svg fill="none" viewBox="0 0 24 24" height="24" width="24" xmlns="http://www.w3.org/2000/svg" class="icon">
  <path stroke-linejoin="round" stroke-linecap="round" stroke-width="1.5" stroke="#141B34" d="M12 14c3.866 0 7 1.5 7 4.5V19H5v-0.5c0-3 3.134-4.5 7-4.5z"></path>
  <path stroke-linejoin="round" stroke-linecap="round" stroke-width="1.5" stroke="#141B34" d="M12 12a4 4 0 1 0 0-8 4 4 0 1 0 0 8z"></path>
</svg>

            <input placeholder="******" type="Username" class="input_field" id="Username_field" required>
          </div>
        <div class="input_container">
            <label class="input_label" for="password_field">Password</label>
            <svg fill="none" viewBox="0 0 24 24" height="24" width="24" xmlns="http://www.w3.org/2000/svg" class="icon">
              <path stroke-linecap="round" stroke-width="1.5" stroke="#141B34" d="M18 11.0041C17.4166 9.91704 16.273 9.15775 14.9519 9.0993C13.477 9.03404 11.9788 9 10.329 9C8.67911 9 7.18091 9.03404 5.70604 9.0993C3.95328 9.17685 2.51295 10.4881 2.27882 12.1618C2.12602 13.2541 2 14.3734 2 15.5134C2 16.6534 2.12602 17.7727 2.27882 18.865C2.51295 20.5387 3.95328 21.8499 5.70604 21.9275C6.42013 21.9591 7.26041 21.9834 8 22"></path>
              <path stroke-linejoin="round" stroke-linecap="round" stroke-width="1.5" stroke="#141B34" d="M6 9V6.5C6 4.01472 8.01472 2 10.5 2C12.9853 2 15 4.01472 15 6.5V9"></path>
              <path fill="#141B34" d="M21.2046 15.1045L20.6242 15.6956V15.6956L21.2046 15.1045ZM21.4196 16.4767C21.7461 16.7972 22.2706 16.7924 22.5911 16.466C22.9116 16.1395 22.9068 15.615 22.5804 15.2945L21.4196 16.4767ZM18.0228 15.1045L17.4424 14.5134V14.5134L18.0228 15.1045ZM18.2379 18.0387C18.5643 18.3593 19.0888 18.3545 19.4094 18.028C19.7299 17.7016 19.7251 17.1771 19.3987 16.8565L18.2379 18.0387ZM14.2603 20.7619C13.7039 21.3082 12.7957 21.3082 12.2394 20.7619L11.0786 21.9441C12.2794 23.1232 14.2202 23.1232 15.4211 21.9441L14.2603 20.7619ZM12.2394 20.7619C11.6914 20.2239 11.6914 19.358 12.2394 18.82L11.0786 17.6378C9.86927 18.8252 9.86927 20.7567 11.0786 21.9441L12.2394 20.7619ZM12.2394 18.82C12.7957 18.2737 13.7039 18.2737 14.2603 18.82L15.4211 17.6378C14.2202 16.4587 12.2794 16.4587 11.0786 17.6378L12.2394 18.82ZM14.2603 18.82C14.8082 19.358 14.8082 20.2239 14.2603 20.7619L15.4211 21.9441C16.6304 20.7567 16.6304 18.8252 15.4211 17.6378L14.2603 18.82Z"></path>
            </svg>
            <input placeholder="******" type="password" class="input_field" id="password_field" required>
          </div>
          
          <div class="input_container">
            <label class="input_label" for="confirmpassword_field">Confirm password</label>
            <svg fill="none" viewBox="0 0 24 24" height="24" width="24" xmlns="http://www.w3.org/2000/svg" class="icon">
              <path stroke-linecap="round" stroke-width="1.5" stroke="#141B34" d="M18 11.0041C17.4166 9.91704 16.273 9.15775 14.9519 9.0993C13.477 9.03404 11.9788 9 10.329 9C8.67911 9 7.18091 9.03404 5.70604 9.0993C3.95328 9.17685 2.51295 10.4881 2.27882 12.1618C2.12602 13.2541 2 14.3734 2 15.5134C2 16.6534 2.12602 17.7727 2.27882 18.865C2.51295 20.5387 3.95328 21.8499 5.70604 21.9275C6.42013 21.9591 7.26041 21.9834 8 22"></path>
              <path stroke-linejoin="round" stroke-linecap="round" stroke-width="1.5" stroke="#141B34" d="M6 9V6.5C6 4.01472 8.01472 2 10.5 2C12.9853 2 15 4.01472 15 6.5V9"></path>
              <path fill="#141B34" d="M21.2046 15.1045L20.6242 15.6956V15.6956L21.2046 15.1045ZM21.4196 16.4767C21.7461 16.7972 22.2706 16.7924 22.5911 16.466C22.9116 16.1395 22.9068 15.615 22.5804 15.2945L21.4196 16.4767ZM18.0228 15.1045L17.4424 14.5134V14.5134L18.0228 15.1045ZM18.2379 18.0387C18.5643 18.3593 19.0888 18.3545 19.4094 18.028C19.7299 17.7016 19.7251 17.1771 19.3987 16.8565L18.2379 18.0387ZM14.2603 20.7619C13.7039 21.3082 12.7957 21.3082 12.2394 20.7619L11.0786 21.9441C12.2794 23.1232 14.2202 23.1232 15.4211 21.9441L14.2603 20.7619ZM12.2394 20.7619C11.6914 20.2239 11.6914 19.358 12.2394 18.82L11.0786 17.6378C9.86927 18.8252 9.86927 20.7567 11.0786 21.9441L12.2394 20.7619ZM12.2394 18.82C12.7957 18.2737 13.7039 18.2737 14.2603 18.82L15.4211 17.6378C14.2202 16.4587 12.2794 16.4587 11.0786 17.6378L12.2394 18.82ZM14.2603 18.82C14.8082 19.358 14.8082 20.2239 14.2603 20.7619L15.4211 21.9441C16.6304 20.7567 16.6304 18.8252 15.4211 17.6378L14.2603 18.82Z"></path>
            </svg>
            <input placeholder="******" type="confirmpassword" class="input_field" id="confirmpassword_field" required>
          </div>
          <button title="Sign In" type="submit" class="sign-in_btn">
    <span>Sign In</span>
  </button>
  <a href="{{ route('login') }}">
    <p class="reg-link">Already have an Account?</p>
</a>
        </div>

      </form>
    </div>
  </div>

  <script>
    let currentStep = 1;

    function nextStep(step) {
      document.getElementById('step-' + currentStep).classList.remove('active');
      document.getElementById('step-' + step).classList.add('active');
      currentStep = step;
    }
  </script>
</body>
</html>
