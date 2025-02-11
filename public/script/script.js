document.addEventListener("DOMContentLoaded", function() {
    // Obtener todos los botones de reproducción
    const botonesReproducir = document.querySelectorAll('.play-btn');
    
    // Obtener el reproductor de audio y el título
    const audioPlayer = document.getElementById('audio-player');
    const songTitle = document.getElementById('song-title');

    // Iterar sobre cada botón y añadir el evento de clic
    botonesReproducir.forEach(boton => {
        boton.addEventListener('click', () => {
            // Obtener los atributos de cada botón
            const audioSrc = boton.getAttribute('data-audio');  // Obtener la URL del audio
            const titulo = boton.getAttribute('data-titulo');  // Obtener el título de la canción

            // Actualizar el título en el reproductor
            songTitle.textContent = titulo;
            
            // Cambiar la fuente del reproductor de audio
            audioPlayer.src = audioSrc;

            // Reproducir la canción
            audioPlayer.play();
        });
    });
});
