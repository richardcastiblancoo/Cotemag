<!-- Contenido de las noticias -->
<div class="container-text">
     <div class="container">
         <h2 class="h2">Blog Entérate de nuestras actividades</h2>
     </div>
 </div>
 <div class="container mt-4">
     <div class="row">
         <?php 
         $counter = 0;
         while ($post = mysqli_fetch_assoc($resultado)): 
             $counter++;
             $hideClass = $counter > 3 ? 'hidden-post d-none' : '';
         ?>
             <div class="col-md-4 mb-4 publicacion-blog <?php echo $hideClass; ?>">
                 <div class="tarjeta">
                     <?php if ($post['imagen']): ?>
                         <img src="<?php echo $post['imagen']; ?>" class="imagen-tarjeta" alt="<?php echo $post['titulo']; ?>">
                     <?php endif; ?>
                     <div class="cuerpo-tarjeta">
                         <h5 class="titulo-tarjeta"><?php echo $post['titulo']; ?></h5>
                         <p class="texto-tarjeta"><?php echo substr($post['contenido'], 0, 200) . '...'; ?></p>
                         <button type="button" class="btn btn-primary btn-sm boton-leer-mas" 
                             onclick="mostrarDetallesPost('<?php echo htmlspecialchars($post['titulo'], ENT_QUOTES); ?>', 
                                           '<?php echo htmlspecialchars($post['contenido'], ENT_QUOTES); ?>', 
                                           '<?php echo htmlspecialchars($post['imagen'], ENT_QUOTES); ?>', 
                                           '<?php echo htmlspecialchars($post['username'], ENT_QUOTES); ?>', 
                                           '<?php echo htmlspecialchars($post['fecha_publicacion'], ENT_QUOTES); ?>')">
                             Leer más
                         </button>
                         <p class="texto-muted mt-2">
                             Por: <?php echo $post['username']; ?><br>
                             Publicado el: <?php echo $post['fecha_publicacion']; ?>
                         </p>
                     </div>
                 </div>
             </div>


             <!-- Modal for each post -->
             <div class="modal fade" id="modal<?php echo $post['id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                 <div class="modal-dialog modal-lg">
                     <div class="modal-content">
                         <div class="modal-header">
                             <h5 class="modal-title"><?php echo $post['titulo']; ?></h5>
                             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                             </button>
                         </div>
                         <div class="modal-body">
                             <?php if ($post['imagen']): ?>
                                 <img src="<?php echo $post['imagen']; ?>" class="img-fluid mb-3" alt="<?php echo $post['titulo']; ?>">
                             <?php endif; ?>
                             <?php echo $post['contenido']; ?>
                             <hr>
                             <p class="text-muted">
                                 Por: <?php echo $post['username']; ?><br>
                                 Publicado el: <?php echo $post['fecha_publicacion']; ?>
                             </p>
                         </div>
                     </div>
                 </div>
             </div>
         <?php endwhile; ?>
     </div>
 </div>

 <div class="container text-center mb-4">
     <button id="botonCargarMas" class="btn btn-primary">Ver más publicaciones</button>
 </div>

<script>
function mostrarDetallesPost(titulo, contenido, imagen, usuario, fecha) {
    Swal.fire({
        title: titulo,
        html: `
            ${imagen ? `<img src="${imagen}" class="imagen-fluida mb-3" alt="${titulo}">` : ''}
            <div class="contenido-modal">${contenido}</div>
            <hr>
            <p class="texto-muted">
                Por: ${usuario}<br>
                Publicado el: ${fecha}
            </p>
        `,
        width: '800px',
        heightAuto: false,
        height: '80vh',
        showCloseButton: true,
        showConfirmButton: false,
        customClass: {
            popup: 'modal-ancho',
            content: 'texto-izquierda contenido-scrollable',
            closeButton: 'boton-cerrar',
            htmlContainer: 'contenedor-html'
        }
    });
}

let contadorPosts = 3;
const incremento = 3;

document.getElementById('botonCargarMas').addEventListener('click', function() {
    const postsOcultos = document.querySelectorAll('.publicacion-blog.d-none');
    
    for(let i = 0; i < incremento && i < postsOcultos.length; i++) {
        postsOcultos[i].classList.remove('d-none');
    }
    
    if (postsOcultos.length <= incremento) {
        this.style.display = 'none';
    }
});
</script>

<style>
.modal-ancho {
    max-width: 800px !important;
    max-height: 90vh !important;
}

.contenido-scrollable {
    overflow-y: auto;
    max-height: calc(80vh - 100px);
    padding-right: 10px;
}

.contenedor-html {
    margin: 0;
    padding: 15px;
}

.contenido-modal {
    margin-top: 20px;
    margin-bottom: 20px;
    word-wrap: break-word;
    overflow-wrap: break-word;
}

</style>
