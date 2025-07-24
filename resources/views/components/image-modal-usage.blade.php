{{--
REUSABLE IMAGE MODAL - Usage Documentation

Component ini sudah include di layouts/app.blade.php dan layouts/detail.blade.php
Jadi bisa langsung digunakan di semua halaman tanpa perlu include lagi.

=== SINGLE IMAGE MODAL ===
Untuk menampilkan 1 gambar saja:

HTML:
<img src="image.jpg" onclick="openImageModal('{{ asset('storage/image.jpg') }}', 'Title', 'Caption')" class="cursor-pointer">

JavaScript:
openImageModal(imageSrc, title, caption);

Contoh:
openImageModal('/storage/photos/image1.jpg', 'Foto Kegiatan', 'Dokumentasi kegiatan BWS');

=== GALLERY MODAL ===
Untuk gallery dengan navigasi next/prev:

JavaScript:
const galleryImages = [
    {src: '/storage/image1.jpg', title: 'Foto 1', caption: 'Keterangan foto 1'},
    {src: '/storage/image2.jpg', title: 'Foto 2', caption: 'Keterangan foto 2'},
    {src: '/storage/image3.jpg', title: 'Foto 3', caption: 'Keterangan foto 3'}
];

// Buka gallery dari index tertentu (0 = gambar pertama)
function openGallery(startIndex = 0) {
    openImageGallery(galleryImages, startIndex);
}

HTML:
<div class="grid grid-cols-3 gap-4">
    @foreach($photos as $index => $photo)
        <img src="{{ asset('storage/' . $photo->path) }}" 
             onclick="openGallery({{ $index }})" 
             class="cursor-pointer hover:scale-105 transition-transform">
    @endforeach
</div>

=== FEATURES ===
✅ HD Image Display
✅ Responsive Design
✅ Keyboard Navigation (Arrow keys, Escape)
✅ Click outside to close
✅ Gallery counter (1 dari 5)
✅ Smooth transitions
✅ Navigation arrows for gallery
✅ Image title and caption support

=== KEYBOARD CONTROLS ===
- ESC: Close modal
- Arrow Left: Previous image (gallery mode)
- Arrow Right: Next image (gallery mode)

=== STYLING ===
Modal menggunakan Tailwind classes dan fully responsive.
Background overlay: bg-black bg-opacity-75
Close button: Absolute positioned top-right
Image: Max height 80vh untuk tidak overflow

=== USAGE EXAMPLES ===

1. Artikel Detail (sudah implemented):
   - Photo gallery dengan navigasi
   
2. Halaman Galeri (contoh):
   const allPhotos = @json($photos->map(function($photo) {
       return [
           'src' => asset('storage/' . $photo->path),
           'title' => $photo->title,
           'caption' => $photo->description
       ];
   }));

3. Infografis popup (sudah ada, tapi bisa diubah ke image modal):
   openImageModal('/storage/infografis.jpg', 'Infografis BWS', 'Informasi terbaru');

4. Profile team photos:
   <img src="team-photo.jpg" onclick="openImageModal('team-photo.jpg', 'Tim BWS', 'Foto tim terbaru')" class="cursor-pointer">

Modal ini sekarang bisa digunakan di mana saja tanpa perlu setup tambahan!
--}}