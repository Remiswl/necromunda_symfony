/*
 * Animation on ganger's img
 */
let gangersImg = $('.gangers-profils');

// On mouseover, zoom x1.5
gangersImg.mouseover(function() {
    $(this).addClass('zoomImg');
});

gangersImg.mouseout(function() {
    $(this).removeClass('zoomImg');
});

// On click, add red borders
gangersImg.click(function() {
    $(this).removeClass('zoomImg');

    $(gangersImg).removeClass('selectedImg');
    $(this).toggleClass('selectedImg');
});

// Edit ganger img
$('#editImage').click(() => {
    $.ajax({
        url: $('#editImage').attr('data-url'),
        type: 'POST',
        data: { id : $('.selectedImg').attr('id') }
    });
});
