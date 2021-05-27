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

let gangerId;

// On click, add red borders
gangersImg.click(function() {
    $(this).removeClass('zoomImg');

    $(gangersImg).removeClass('selectedImg');
    // $(this).addClass('selectedImg');
    $(this).toggleClass('selectedImg');

    let gangerId;
});

// Edit ganger img
$('#editImage').click(() => {
    $.ajax({
        url: $('#editImage').attr('data-url'),
        type: 'POST',
        data: { id : $('.selectedImg').attr('id') }
    });
});
