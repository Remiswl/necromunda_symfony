// Button Battle - gang selection
$('.js-choose-gang').click(function() {
    let selectButton = $(this);
    let selectedGang = $(this).attr('data-gangId');

    selectButton.toggleClass('btn-success');
});

// Start the battle
$('.js-start').click((e) => {
    e.preventDefault;
    console.log($('.btn-success'));
    $.ajax({
        url: $('.js-start').attr('href'),
        type: 'POST',
        data: { gangs : $('.btn-success') },
    });
});
