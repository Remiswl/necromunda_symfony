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

/*
 * Popup to edit gang's stash
 */
let popup = $('#popup');

popup.click((e) => {
    e.preventDefault;
    let newstash = window.prompt('Enter a new amount');

    $.ajax({
        url: $('#popup').attr('data-url'),
        type: 'POST',
        data: { newstash : newstash }
    });
});
