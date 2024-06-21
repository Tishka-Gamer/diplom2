const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('auth-container');
const check = document.getElementById('flexCheckDefault');

signUpButton.addEventListener('click', () =>
container.classList.add('right-panel-active'));

signInButton.addEventListener('click', () =>
container.classList.remove('right-panel-active'));

check.addEventListener('change', function() {
    const button = document.getElementById('mybtn');
    if (this.checked) {
        button.style.display = 'inline';
    } else {
        button.style.display = 'none';
    }
});
