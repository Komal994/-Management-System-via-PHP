function validateForm() {
    
    const errors = document.querySelectorAll('.error');
    errors.forEach(error => error.textContent = '');

    let isValid = true;

    
    const name = document.getElementById('name').value.trim();
    if (name === '') {
        document.getElementById('nameError').textContent = 'Name is required.';
        isValid = false;
    }

    
    const email = document.getElementById('email').value.trim();
    const emailPattern = /^[^\s@]+@[^\s@]+\.[a-zA-Z]{2,3}$/;
    if (email === '') {
        document.getElementById('emailError').textContent = 'Email is required.';
        isValid = false;
    } else if (!emailPattern.test(email)) {
        document.getElementById('emailError').textContent = 'Invalid email address.';
        isValid = false;
    }

    
    const phone = document.getElementById('phone').value.trim();
    const phonePattern = /^\d{10}$/;
    if (phone === '') {
        document.getElementById('phoneError').textContent = 'Phone number is required.';
        isValid = false;
    } else if (!phonePattern.test(phone)) {
        document.getElementById('phoneError').textContent = 'Phone number must be 10 digits.';
        isValid = false;
    }

    
    const zipcode = document.getElementById('zipcode').value.trim();
    const zipcodePattern = /^[1-9]\d{5}$/;

    if (zipcode === '') {
        document.getElementById('zipcodeError').textContent = 'Zip code is required.';
        isValid = false;
    } else if (!zipcodePattern.test(zipcode)) {
        document.getElementById('zipcodeError').textContent = 'Zip code must be 6 digits and cannot start with 0.';
        isValid = false;
    }
    

    
    const state = document.getElementById('state').value;
    if (state === '') {
        document.getElementById('stateError').textContent = 'State is required.';
        isValid = false;
    }

    
    const gender = document.querySelector('input[name="gender"]:checked');
    if (!gender) {
        document.getElementById('genderError').textContent = 'Gender is required.';
        isValid = false;
    }

    
    const password = document.getElementById('password').value;
    const passwordPattern = /^(?=.*[A-Z])(?=.*\d)(?=.*[&$#@])[A-Za-z\d&$#@]{7,}$/;
    if (password === '') {
        document.getElementById('passwordError').textContent = 'Password is required.';
        isValid = false;
    } else if (!passwordPattern.test(password)) {
        document.getElementById('passwordError').textContent = 'Password must be at least 7 characters long, include one uppercase letter, one digit, and one special character (&, $, #, @).';
        isValid = false;
    }

    
    const confirmPassword = document.getElementById('confirmPassword').value;
    if (confirmPassword !== password) {
        document.getElementById('confirmPasswordError').textContent = 'Passwords do not match.';
        isValid = false;
    }

    
    if (isValid) {
        window.location.href = 'thankYou.html';
    }

    return false; 
}
