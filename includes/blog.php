<?php
// Ensure database connection is available
if (!isset($conexion)) {
    $conexion = mysqli_connect("localhost", "root", "", "cotemag");
}

// Fetch all posts ordered by publication date
$query = "SELECT n.*, u.username 
          FROM noticias n 
          JOIN usuarios u ON n.autor_id = u.id 
          ORDER BY n.fecha_publicacion DESC";
$resultado = mysqli_query($conexion, $query);
?>

<div class="container mt-4">
    <h1 class="text-center mb-4">Blog Cotemag</h1>
    <div class="row">
        <?php 
        $counter = 0;
        while ($post = mysqli_fetch_assoc($resultado)): 
            $visibility = $counter >= 3 ? 'style="display: none;"' : '';
        ?>
            <div class="col-md-4 post-item" <?php echo $visibility; ?>>
                <div class="card post-card mb-4">
                    <?php if (!empty($post['imagen'])): ?>
                        <img src="<?php echo $post['imagen']; ?>" class="card-img-top post-image" alt="Post image">
                    <?php endif; ?>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($post['titulo']); ?></h5>
                        <p class="card-text"><?php echo substr(htmlspecialchars($post['contenido']), 0, 150) . '...'; ?></p>
                        <p class="card-text">
                            <small class="text-muted">
                                Por: <?php echo htmlspecialchars($post['username']); ?><br>
                                <?php echo date('d M Y', strtotime($post['fecha_publicacion'])); ?>
                            </small>
                        </p>
                        <a href="post.php?id=<?php echo $post['id']; ?>" class="btn btn-primary">Leer más</a>
                    </div>
                </div>
            </div>
        <?php 
            $counter++;
        endwhile; 
        ?>
    </div>
    
    <?php if ($counter > 3): ?>
        <div class="text-center mt-4 mb-5">
            <button id="loadMore" class="btn btn-outline-primary btn-lg">
                <i class="fas fa-plus-circle mr-2"></i>Ver más posts
            </button>
        </div>
    <?php endif; ?>
</div>

<!-- Add jQuery if not already included -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    jQuery(document).ready(function($) {
        let postsShown = 3;
        const postsPerLoad = 3;
        const posts = $('.post-item');
        const totalPosts = posts.length;
        
        if (totalPosts <= 3) {
            $('#loadMore').hide();
        }
        
        $('#loadMore').on('click', function() {
            posts.slice(postsShown, postsShown + postsPerLoad).fadeIn('slow');
            postsShown += postsPerLoad;
            
            if (postsShown >= totalPosts) {
                $(this).fadeOut('slow');
            }
        });
    });
</script>
