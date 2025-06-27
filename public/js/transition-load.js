document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('a[href*="action="]').forEach(link => {
    link.addEventListener('click', function (e) {
      e.preventDefault();

      const container = document.getElementById('mainContainer');
      const loader = document.getElementById('loader');

      if (container) {
        container.classList.add('fade-out');
      }

      setTimeout(() => {
        if (loader) {
          loader.style.display = 'flex';
        }
      }, 300); // sincronizado con animación

      setTimeout(() => {
        window.location.href = this.href;
      }, 1000); 
    });
  });
});
