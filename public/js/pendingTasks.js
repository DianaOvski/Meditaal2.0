document.addEventListener('DOMContentLoaded', () => {
  const modal = document.getElementById('completeModal');
  const closeBtn = document.querySelector('.close-complete');
  const completeButtons = document.querySelectorAll('.complete-btn');
  const idInput = document.getElementById('complete-id');
  const titleInput = document.getElementById('complete-title');
  const descriptionInput = document.getElementById('complete-description');
  const form = document.getElementById('complete-form');

  completeButtons.forEach(btn => {
    btn.addEventListener('click', () => {
      idInput.value = btn.dataset.id;
      titleInput.value = btn.dataset.title;
      descriptionInput.value = btn.dataset.description;
      modal.style.display = 'flex';
    });
  });

  closeBtn.addEventListener('click', () => {
    modal.style.display = 'none';
  });

  window.addEventListener('click', (e) => {
    if (e.target === modal) {
      modal.style.display = 'none';
    }
  });

  form.addEventListener('submit', async (e) => {
    e.preventDefault();

    const formData = new FormData(form);

    try {
      const response = await fetch('/gestion-tareas-diana/public/index.php?action=completeTask', {
        method: 'POST',
        body: formData
      });

      if (response.ok) {
        modal.style.display = 'none';
        location.reload();
      } else {
        alert('Error al completar la tarea');
      }
    } catch (err) {
      console.error(err);
      alert('Error inesperado');
    }
  });
});
