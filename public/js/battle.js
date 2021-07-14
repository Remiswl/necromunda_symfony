// Button Battle - gang selection
$('.js-choose-gang').click(function() {
    let selectButton = $(this);
    let selectedGang = $(this).attr('data-gangId');

    // Change the color of the gang's button
    selectButton.toggleClass('btn-success');

    // Display the button to start the battle if at least 2 gangs selected
    let startButton = $('.js-start');
    if (document.querySelectorAll('.btn-success').length >= 2) {
        startButton.removeClass('d-none');
    } else {
        startButton.addClass('d-none');
    }
});

// Start the battle
$('.js-start').click((e) => {
    e.preventDefault;

    $.ajax({
        url: $('.js-start').attr('data-url'),
        type: 'POST',
        data: { gangs : $('.btn-success') },
    });
});
