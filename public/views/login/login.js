const togglePassword = () => {
    const passwordField = document.querySelector('#password');
    const toggleIcon = document.querySelector('#toggle-password');

    if (passwordField.type === 'password') {
        passwordField.type = 'text';
        toggleIcon.textContent = '🙈'; // Puedes cambiar el ícono cuando se muestra la contraseña
    } else {
        passwordField.type = 'password';
        toggleIcon.textContent = '👁️'; // Ícono para ocultar la contraseña
    }
};
