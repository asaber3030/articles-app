/*global $*/
$('a.active').click(function (e) {
  e.preventDefault();
});
$('*[goto]').click(function () {
  window.location.href = $(this).attr('goto');
});
$('.ui.dropdown')
  .dropdown();

setTimeout(function () {
  $(".alert-float").fadeOut();
}, 2000);

let inputSearchBox = '.show-search-in-focus';

$('.clickable').click(function() {
  $('.clickable svg').toggleClass('transRotate');
});
$('.top.menu .item').tab();

$('*[open-model]').click(function () {
  let clas = $(this).attr('open-model');
  $(clas).modal('show');
});

$('#submit-data').click(function () {
  $('#submitForm').click();
})
