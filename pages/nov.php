<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style.css">
    <title>Document</title>
    <style>
        body {
    margin: 0;
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
}

.contenedor {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 20px;
}

.titulo {
    font-size: 2rem;
    margin-bottom: 10px;
}

.imagenes {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 15px;
}

.imagenes div {
    position: relative;
    overflow: hidden;
    border-radius: 10px;
    cursor: pointer;
    transition: transform 0.3s ease;
}

.imagenes div:hover {
    transform: scale(1.05);
}

.imagenes img {
    width: 100%;
    height: auto;
    transition: transform 0.3s ease;
}

.imagenes div:hover img {
    transform: scale(1.1);
}

.imagen-expandida {
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    background-color: rgba(0, 0, 0, 0.8);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 1000;
}

.imagen-expandida img {
    max-width: 90%;
    max-height: 90%;
}

.close, .next, .prev {
    position: absolute;
    top: 10px;
    font-size: 2rem;
    color: white;
    cursor: pointer;
}

.close {
    right: 20px;
}

.next {
    right: 50px;
}

.prev {
    left: 20px;
}
    </style>
</head>
<body>
    <div class="contenedor">
        <h1 class="titulo">NOVEDADES</h1>
        <div class="imagenes">
            <div class="imagen-1" onclick="expandImage(0)">
                <img src="../cotemag/assets/img/1.png" alt="Imagen 1">
            </div>
            <div class="imagen-2" onclick="expandImage(1)">
                <img src="265162.png" alt="Imagen 2">
            </div>
            <div class="imagen-3" onclick="expandImage(2)">
                <img src="7.png" alt="Imagen 3">
            </div>
            <div class="imagen-4" onclick="expandImage(3)">
                <img src="../cotemag/assets/img/2891.png" alt="Imagen 4">
            </div>
        </div>
        <script>
            const images = ['/assets/img/1.png', '/265162.png', '/7.png', '/2891.png'];
            let currentIndex = 0;
        
            function expandImage(index) {
                currentIndex = index;
                showImage();
            }
        
            function showImage() {
                const overlay = document.createElement('div');
                overlay.className = 'imagen-expandida';
                overlay.innerHTML = `
                    <span class="close" onclick="this.parentNode.remove()">&times;</span>
                    <span class="prev" onclick="prevImage()">&#10094;</span>
                    <img src="${images[currentIndex]}" alt="Imagen ampliada">
                    <span class="next" onclick="nextImage()">&#10095;</span>
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
</body>
</html>
