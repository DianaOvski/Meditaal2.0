
  document.addEventListener('DOMContentLoaded', () => {
    const rows = document.querySelectorAll('.task-table tbody tr');

    const filterDate = document.getElementById('filter-date');
    const filterPriority = document.getElementById('filter-priority');
    const filterStatus = document.getElementById('filter-status');

    function applyFilters() {
      const date = filterDate.value;
      const priority = filterPriority.value;
      const status = filterStatus.value;

      rows.forEach(row => {
        const rowDate = row.children[2].textContent.trim();
        const rowPriority = row.children[3].textContent.trim();
        const rowStatus = row.children[4].textContent.trim();

        const matchDate = !date || rowDate === date;
        const matchPriority = !priority || rowPriority === priority;
        const matchStatus = !status || rowStatus === status;

        row.style.display = (matchDate && matchPriority && matchStatus) ? '' : 'none';
      });
    }

    filterDate.addEventListener('change', applyFilters);
    filterPriority.addEventListener('change', applyFilters);
    filterStatus.addEventListener('change', applyFilters);
  });
