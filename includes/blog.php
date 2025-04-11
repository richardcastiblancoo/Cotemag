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
             <div class="col-md-4 mb-4 blog-post <?php echo $hideClass; ?>">
                 <div class="card">
                     <?php if ($post['imagen']): ?>
                         <img src="<?php echo $post['imagen']; ?>" class="card-img-top" alt="<?php echo $post['titulo']; ?>">
                     <?php endif; ?>
                     <div class="card-body">
                         <h5 class="card-title"><?php echo $post['titulo']; ?></h5>
                         <p class="card-text"><?php echo substr($post['contenido'], 0, 200) . '...'; ?></p>
                         <button type="button" class="btn btn-primary btn-sm btn-read-more" data-toggle="modal" data-target="#modal<?php echo $post['id']; ?>">
                             Leer más
                         </button>
                         <p class="text-muted mt-2">
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
     <button id="loadMoreBtn" class="btn btn-primary">Ver más posts</button>
 </div>

<script>
document.getElementById('loadMoreBtn').addEventListener('click', function() {
    const hiddenPosts = document.querySelectorAll('.hidden-post');
    hiddenPosts.forEach(post => {
        post.classList.remove('d-none');
    });
    
    // Hide the button after showing all posts
    this.style.display = 'none';
});
</script>
