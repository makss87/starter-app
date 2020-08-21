export default function (options) {
    var $el;
    var $full_image_container;
    var $line_up_with;

    var boot = () => {


        $el.find('.gallery__column > .gallery__item-container').on('click', function (e) {
            let full_image = $(this).attr('data-original');
            let name = $(this).attr('data-name');
            let description = $(this).attr('data-desc');
            let proportion = $(this).attr('data-proportion');
            let sold = $(this).attr('data-sold');

            $full_image_container.html('');
            $full_image_container.removeClass('square portrait landscape');

            $('.gallery__active-image-name').html(name);
            $('.gallery__active-image-desc').html(description);

            $('.gallery__active-image-link').hide();
            $('.gallery__active-sold').hide();

            if(sold){
                $('.gallery__active-sold').show();
            }else{
                $('.gallery__active-image-link').attr('href', `mailto:sales@consumeandenjoy.com?subject=${name} - ${options.author_name}`).show();
            }



            $full_image_container.addClass(proportion);

            let $img = $('<img />', {
                alt: name,
                src: full_image,
            });

            if (proportion === 'landscape') {
                $img.css('margin-top', $line_up_with.position().top);
            }

            $img.appendTo($full_image_container);
        });

        $el.find('.gallery__column > .gallery__item-container')[0].click();


    };


    var init = () => {
        $el = $(options.selector);
        $full_image_container = $(options.show_full_image_in);
        $line_up_with = $(options.line_up_with);

        if ($el.length) boot();
    };
    init();
}