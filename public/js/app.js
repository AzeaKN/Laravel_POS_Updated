document.querySelectorAll('.search-box input').forEach((input) => {
    const rows = input.closest('.data-card').querySelectorAll('tbody tr');

    input.addEventListener('input', () => {
        const query = input.value.trim().toLowerCase();

        rows.forEach((row) => {
            row.hidden = !row.textContent.toLowerCase().includes(query);
        });
    });
});
