document.addEventListener("DOMContentLoaded", () => {
    const cards = document.querySelectorAll('.card-container');

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                } else {
                    entry.target.classList.remove('visible'); // Reset animation when out of view
                }
            });
        },
        {
            threshold: 0.1, // Trigger when 10% of the element is visible
        }
    );

    cards.forEach((card) => observer.observe(card));
});
