document.addEventListener('DOMContentLoaded', function() {
    // Real-time search functionality
    const searchPost = document.getElementById('searchPost');
    if (searchPost) {
        searchPost.addEventListener('input', function(e) {
            const searchText = e.target.value.toLowerCase();
            const posts = document.getElementsByClassName('post-item');
            
            Array.from(posts).forEach(post => {
                const title = post.querySelector('.card-title').textContent.toLowerCase();
                const content = post.querySelector('.card-text').textContent.toLowerCase();
                const date = post.querySelector('.text-muted').textContent.toLowerCase();
                
                if (title.includes(searchText) || 
                    content.includes(searchText) || 
                    date.includes(searchText)) {
                    post.style.display = '';
                } else {
                    post.style.display = 'none';
                }
            });
        });
    }

    // Confirm delete action
    const deleteButtons = document.querySelectorAll('button[name="eliminar"]');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            if (!confirm('¿Estás seguro de eliminar esta publicación?')) {
                e.preventDefault();
            }
        });
    });

    // Image preview before upload
    const imageInputs = document.querySelectorAll('input[type="file"]');
    imageInputs.forEach(input => {
        input.addEventListener('change', function(e) {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                const preview = document.createElement('img');
                preview.className = 'img-fluid mt-2';
                preview.style.maxHeight = '200px';
                
                reader.onload = function(e) {
                    preview.src = e.target.result;
                }
                
                reader.readAsDataURL(file);
                
                // Remove old preview if exists
                const oldPreview = this.parentElement.querySelector('img');
                if (oldPreview) {
                    oldPreview.remove();
                }
                this.parentElement.appendChild(preview);
            }
        });
    });
});

//scroll effect
window.addEventListener('scroll', function() {
    const header = document.querySelector('.header');
    if (window.scrollY > 50) {
        header.classList.add('scrolled');
    } else {
        header.classList.remove('scrolled');
    }
});