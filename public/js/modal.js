document.addEventListener('DOMContentLoaded', () => {
  // MODAL DE EDICIÓN
  const editModal = document.getElementById('editModal');
  const editCloseBtn = editModal?.querySelector('.close');
  const editButtons = document.querySelectorAll('.edit-btn');

  editButtons.forEach(button => {
    button.addEventListener('click', () => {
      document.getElementById('edit-id').value = button.dataset.id;
      document.getElementById('edit-title').value = button.dataset.title;
      document.getElementById('edit-description').value = button.dataset.description;
      document.getElementById('edit-due_date').value = button.dataset.due_date;
      document.getElementById('edit-priority').value = button.dataset.priority;

      editModal.style.display = 'flex';
    });
  });

  editCloseBtn?.addEventListener('click', () => {
    editModal.style.display = 'none';
  });

  window.addEventListener('click', (e) => {
    if (e.target === editModal) {
      editModal.style.display = 'none';
    }
  });

  // MODAL DE ELIMINACIÓN
  const deleteModal = document.getElementById('deleteModal');
  const closeDeleteBtn = document.querySelector('.close-delete');
  const cancelBtn = document.querySelector('.btn-cancel');
  const deleteButtons = document.querySelectorAll('.delete-btn');
  const deleteIdInput = document.getElementById('delete-id');

  deleteButtons.forEach(button => {
    button.addEventListener('click', () => {
      const taskId = button.getAttribute('data-id');
      deleteIdInput.value = taskId;
      deleteModal.style.display = 'flex';
    });
  });

  closeDeleteBtn?.addEventListener('click', () => {
    deleteModal.style.display = 'none';
  });

  cancelBtn?.addEventListener('click', () => {
    deleteModal.style.display = 'none';
  });

  window.addEventListener('click', (e) => {
    if (e.target === deleteModal) {
      deleteModal.style.display = 'none';
    }
  });
});

document.addEventListener('DOMContentLoaded', () => {
  const viewModal = document.getElementById('viewModal');
  const closeViewBtn = document.querySelector('.close-view');
  const viewButtons = document.querySelectorAll('.view-btn');

  viewButtons.forEach(button => {
    button.addEventListener('click', () => {
      document.getElementById('view-title').value = button.dataset.title;
      document.getElementById('view-description').value = button.dataset.description;
      document.getElementById('view-comentario').value = button.dataset.comentario;

      const archivo = button.dataset.archivo;
      const archivoHTML = archivo
        ? `<a href="/gestion-tareas-diana/public/uploads/${archivo}" target="_blank">${archivo}</a>`
        : '-';
      document.getElementById('view-archivo').innerHTML = archivoHTML;

      viewModal.style.display = 'flex';
    });
  });

  closeViewBtn.onclick = () => viewModal.style.display = 'none';
  window.onclick = e => { if (e.target === viewModal) viewModal.style.display = 'none'; };
});
