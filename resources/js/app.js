//
document.querySelectorAll('.menu-item').forEach(element => {
    element.addEventListener('click', () => {
        document.querySelectorAll('.menu-item').forEach(element2 => {
            element2.classList.remove('active');
        });
        element.classList.add('active');
    });
});