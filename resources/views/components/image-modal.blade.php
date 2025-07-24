<!-- Reusable Image Modal -->
<div id="imageModal" class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50 hidden transition-opacity duration-300 ease-out opacity-0">
    <div id="imageModalContent" class="max-w-7xl mx-4 relative transform transition-all duration-300 ease-out scale-95 opacity-0">
        <!-- Close Button -->
        <button onclick="closeImageModal()" class="absolute -top-12 right-0 w-10 h-10 bg-white bg-opacity-20 rounded-full flex items-center justify-center hover:bg-opacity-30 transition-colors z-10">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
        
        <!-- Modal Content -->
        <div class="bg-white rounded-lg overflow-hidden shadow-2xl max-h-screen">
            <!-- Image Container -->
            <div class="relative">
                <img id="modalImage" src="" alt="" class="w-full h-auto max-h-[80vh] object-contain">
                
                <!-- Navigation Arrows (for gallery) -->
                <button id="prevImageBtn" class="absolute left-4 top-1/2 transform -translate-y-1/2 w-12 h-12 bg-black bg-opacity-50 rounded-full items-center justify-center hover:bg-opacity-70 transition-all duration-300 text-white hidden">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </button>
                <button id="nextImageBtn" class="absolute right-4 top-1/2 transform -translate-y-1/2 w-12 h-12 bg-black bg-opacity-50 rounded-full items-center justify-center hover:bg-opacity-70 transition-all duration-300 text-white hidden">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
            </div>
            
            <!-- Image Info -->
            <div id="imageInfo" class="p-4 border-t border-gray-200">
                <h3 id="imageTitle" class="text-lg font-medium text-blue-sda mb-2"></h3>
                <p id="imageCaption" class="text-gray-600 text-sm"></p>
                <div id="imageCounter" class="text-xs text-gray-500 mt-2 hidden"></div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let currentImages = [];
    let currentImageIndex = 0;

    // Single image modal
    window.openImageModal = function(imageSrc, title = '', caption = '') {
        currentImages = [{src: imageSrc, title: title, caption: caption}];
        currentImageIndex = 0;
        showModal();
        hideNavigationButtons();
    };

    // Gallery modal (multiple images)
    window.openImageGallery = function(images, startIndex = 0) {
        currentImages = images;
        currentImageIndex = startIndex;
        showModal();
        showNavigationButtons();
        updateCounter();
    };

    function showModal() {
        const modal = document.getElementById('imageModal');
        const modalContent = document.getElementById('imageModalContent');
        const modalImage = document.getElementById('modalImage');
        const imageTitle = document.getElementById('imageTitle');
        const imageCaption = document.getElementById('imageCaption');
        
        const current = currentImages[currentImageIndex];
        
        modalImage.src = current.src;
        modalImage.alt = current.title || current.caption || 'Image';
        imageTitle.textContent = current.title || '';
        imageCaption.textContent = current.caption || '';
        
        // Show/hide info section based on content
        const imageInfo = document.getElementById('imageInfo');
        if (current.title || current.caption) {
            imageInfo.classList.remove('hidden');
        } else {
            imageInfo.classList.add('hidden');
        }
        
        // Show modal with fade animation
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        
        // Trigger animation
        requestAnimationFrame(() => {
            modal.classList.remove('opacity-0');
            modal.classList.add('opacity-100');
            modalContent.classList.remove('scale-95', 'opacity-0');
            modalContent.classList.add('scale-100', 'opacity-100');
        });
    }

    window.closeImageModal = function() {
        const modal = document.getElementById('imageModal');
        const modalContent = document.getElementById('imageModalContent');
        
        // Start fade out animation
        modal.classList.remove('opacity-100');
        modal.classList.add('opacity-0');
        modalContent.classList.remove('scale-100', 'opacity-100');
        modalContent.classList.add('scale-95', 'opacity-0');
        
        // Hide modal after animation completes
        setTimeout(() => {
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }, 300); // Match transition duration
    };

    function showNavigationButtons() {
        const prevBtn = document.getElementById('prevImageBtn');
        const nextBtn = document.getElementById('nextImageBtn');
        
        if (currentImages.length > 1) {
            prevBtn.classList.remove('hidden');
            nextBtn.classList.remove('hidden');
            prevBtn.style.display = 'flex';
            nextBtn.style.display = 'flex';
        }
    }

    function hideNavigationButtons() {
        document.getElementById('prevImageBtn').classList.add('hidden');
        document.getElementById('nextImageBtn').classList.add('hidden');
    }

    function updateCounter() {
        const counter = document.getElementById('imageCounter');
        if (currentImages.length > 1) {
            counter.textContent = `${currentImageIndex + 1} dari ${currentImages.length}`;
            counter.classList.remove('hidden');
        } else {
            counter.classList.add('hidden');
        }
    }

    // Navigation functions
    window.showPrevImage = function() {
        if (currentImageIndex > 0) {
            currentImageIndex--;
            showModal();
            updateCounter();
        }
    };

    window.showNextImage = function() {
        if (currentImageIndex < currentImages.length - 1) {
            currentImageIndex++;
            showModal();
            updateCounter();
        }
    };

    // Event listeners
    document.getElementById('prevImageBtn').addEventListener('click', showPrevImage);
    document.getElementById('nextImageBtn').addEventListener('click', showNextImage);

    // Close modal when clicking outside image
    document.getElementById('imageModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeImageModal();
        }
    });

    // Keyboard navigation
    document.addEventListener('keydown', function(e) {
        const modal = document.getElementById('imageModal');
        if (!modal.classList.contains('hidden')) {
            switch(e.key) {
                case 'Escape':
                    closeImageModal();
                    break;
                case 'ArrowLeft':
                    showPrevImage();
                    break;
                case 'ArrowRight':
                    showNextImage();
                    break;
            }
        }
    });
});
</script>