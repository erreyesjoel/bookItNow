const mostrarReservaModal = (restaurante) => {
    const modal = document.querySelector('#reservaModal');
    modal.classList.add('show'); // Añade la clase que aplica flex y animación
    document.querySelector('#nombreRestaurante').textContent = restaurante;
    document.querySelector('#restaurante').value = restaurante;
};

const cerrarReservaModal = () => {
    const modal = document.querySelector('#reservaModal');
    modal.classList.remove('show'); // Quita la clase y oculta el modal
};


document.addEventListener('click', (e) => {
    const modal = document.querySelector('#reservaModal');
    if (e.target === modal) {
        cerrarReservaModal();
    }
});
