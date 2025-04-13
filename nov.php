
<link rel="stylesheet" href="/cotemag/nov.css">

<section class="novedad">
    <div class="contenedor">
        <h1 class="titulo">NOVEDADES</h1>
        <div class="imagenes">
            <div class="imagen-1" onclick="expandImage(0)">
                <img src="/cotemag/assets/img/1.png" alt="">
            </div>
            <div class="imagen-2" onclick="expandImage(1)">
                <img src="/cotemag/assets/img/265162.png" alt="">
            </div>
            <div class="imagen-3" onclick="expandImage(2)">
            <img src="/cotemag/assets/img/7.png" alt="">
            </div>
            <div class="imagen-4" onclick="expandImage(3)">
                <img src="/cotemag/assets/img/2891.png" alt="">
            </div>
        </div>
        <script>
            const images = ['/cotemag/assets/img/1.png', '/cotemag/assets/img/265162.png', '/cotemag/assets/img/7.png', '/cotemag/assets/img/2891.png'];
            let currentIndex = 0;
        
            function expandImage(index) {
                currentIndex = index;
                showImage();
            }
        
            function showImage() {
                const overlay = document.createElement('div');
                overlay.className = 'imagen-expandida';
                overlay.innerHTML = `
                    <span class="cerrar" onclick="this.parentNode.remove()">&times;</span>
                    <span class="previa" onclick="prevImage()">&#10094;</span>
                    <img src="${images[currentIndex]}" alt="Imagen ampliada">
                    <span class="pasar" onclick="nextImage()">&#10095;</span>
                `;
                document.body.appendChild(overlay);
            }
        
            function nextImage() {
                currentIndex = (currentIndex + 1) % images.length;
                document.querySelector('.imagen-expandida').remove();
                showImage();
            }
        
            function prevImage() {
                currentIndex = (currentIndex - 1 + images.length) % images.length;
                document.querySelector('.imagen-expandida').remove();
                showImage();
            }
        </script>
</section>
