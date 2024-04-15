import './bootstrap';
import 'regenerator-runtime/runtime';

async function cargarUsuariosPaginados(page) {
    try {
        const response = await fetch(`/usuarios/paginado?page=${page}`); // Cambio aquí: Usa la ruta '/usuarios/paginado'
        if (!response.ok) {
            throw new Error('Ocurrió un error al cargar los usuarios paginados.');
        }
        const data = await response.json();
        
        // Renderizar la lista de usuarios
        const userList = document.getElementById('user-list');
        userList.innerHTML = ''; // Limpiar el contenido existente
        data.data.forEach(user => {
            userList.innerHTML += `
                <tr>
                    <td>${user.strNombreUsuario}</td>
                    <td>${user.estado ? user.estado.strDescripcion : 'Sin estado'}</td>
                    <td>${user.tipoUsuario ? user.tipoUsuario.strNombre : 'Tipo de usuario no disponible'}</td>
                    <td>
                        <button class="edit-btn" onclick="editarUsuario(${user.id})">Editar</button>
                        <button class="delete-btn" onclick="eliminarUsuario(${user.id})">Eliminar</button>
                    </td>
                </tr>
            `;
        });
        
        // Renderizar los enlaces de paginación
        const paginationLinks = document.getElementById('pagination-links');
        paginationLinks.innerHTML = data.links;
    } catch (error) {
        console.error(error);
    }
}

document.addEventListener('click', function(event) {
    if (event.target.matches('.pagination a')) {
        event.preventDefault();
        const page = event.target.getAttribute('href').split('page=')[1];
        cargarUsuariosPaginados(page);
    }
});

cargarUsuariosPaginados(1);
