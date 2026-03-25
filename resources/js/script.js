// Carosello immagini pagina dettaglio articolo
function changeSlide(direction) {
    const images = document.querySelectorAll('.article-carousel-img');
    if (!images.length) return;

    // Trova l'immagine attiva
    let currentIndex = [...images].findIndex(img => img.classList.contains('active'));

    // Rimuove active dall'immagine corrente
    images[currentIndex].classList.remove('active');

    // Calcola il nuovo indice in modo circolare
    currentIndex = (currentIndex + direction + images.length) % images.length;

    // Aggiunge active alla nuova immagine
    images[currentIndex].classList.add('active');
}

// # Script per nascondere il messaggio dopo 5 secondi

document.addEventListener('DOMContentLoaded', () => {
    // Cerca l'elemento con ID 'flash-message'
    const flashMessage = document.getElementById('flash-message');

    // Se l'elemento esiste in questa pagina, fa partire il timer
    if (flashMessage) {
        setTimeout(() => {
            // Effetto dissolvenza
            flashMessage.style.transition = 'opacity 0.5s ease';
            flashMessage.style.opacity = '0';

            // Rimuove l'elemento dopo la transizione
            setTimeout(() => flashMessage.remove(), 500);
        }, 4000);
    }
});

