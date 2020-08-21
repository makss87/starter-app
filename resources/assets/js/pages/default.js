import Gallery from '../components/gallery.component';

const main = () => {
    new Gallery({
        selector: '#gallery',
        show_full_image_in: '.full_image',
        line_up_with: '.artist_info',
        author_name:document.head.querySelector('meta[name="artist"]').content,
    });


};
$(main);