/*global $*/
$('a.active').click(function (e) {
  e.preventDefault();
});
$('*[goto]').click(function () {
  window.location.href = $(this).attr('goto');
});

$('.article-content p').each(function(){
  if($(this).html().trim() === '&nbsp;'){
    $(this).remove();
  }
});

$('*[collapse-section]').click(function () {
  let section = $(this).attr('collapse-section');
  $(section).slideToggle();
  console.log(section);
});

setTimeout(() => {
  $('.alert:not(.disable-hide-alert)').fadeOut();
}, 2000);

