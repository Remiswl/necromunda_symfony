// List of numbers of dices to roll
// Roll up to 10 dices
for (let i = 0; i < 10; i++) {
    if (i != 1) {
        $('.js-dice-number').append(`<option value="${ i + 1 }">${ i + 1 }</option>`);
    } else {
        $('.js-dice-number').append('<option value="2" selected="selected">2</option>');
    }
}

// Display result
$('.js-dice-roll').click(() => {
    let nbrDices = parseInt($('option:selected').attr('value'));
    $('.js-dice-result').empty();

    for (let i = 0; i < nbrDices; i++) {
    	let dice = Math.floor(Math.random() * 6) + 1;
        $('.js-dice-result').append(`<img src="/img/dice/dice${ dice }.png" alt="dice"/>`);
    }
});

