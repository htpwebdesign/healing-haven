let accordionTitles = document.querySelectorAll('.accordion-title');

accordionTitles.forEach(function(title){
  title.addEventListener('click', function(){
    let index = this.getAttribute('data-index');
    let content = document.querySelector('.accordion-content[data-index="' + index + '"]');
    content.classList.toggle('active');
    this.querySelector('.accordion-icon').classList.toggle('active');
  }); 
});