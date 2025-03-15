const togglePassword = (id) => {
    const passwordField = document.querySelector(`#${id}`);
    const toggleIcon = document.querySelector(`#toggle-${id}`);

    if (passwordField.type === 'password') {
        passwordField.type = 'text';
        toggleIcon.textContent = '🙈'; // Cambia el ícono cuando se muestra la contraseña
    } else {
        passwordField.type = 'password';
        toggleIcon.textContent = '👁️'; // Ícono para ocultar la contraseña
    }
};

// Para los eventos de toggle en ambos campos de contraseña
document.querySelector('#toggle-password').addEventListener('click', () => togglePassword('password'));
document.querySelector('#toggle-confirm_password').addEventListener('click', () => togglePassword('confirm_password'));
