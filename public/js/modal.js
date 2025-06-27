document.addEventListener('DOMContentLoaded', () => {
  // -------------------------------
  // MODAL DE EDICIÓN
  // -------------------------------
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
      document.getElementById('edit-completed').checked = button.dataset.completed == 1;

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

  // -------------------------------
  // MODAL DE ELIMINACIÓN
  // -------------------------------
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
