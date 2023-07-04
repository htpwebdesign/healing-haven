// Get the subnav title element
let subnavTitle = document.querySelector('.subnav-title');

// Get the category list element
let categoryList = document.querySelector('.category-nav ul');

// Get the svg icon
let arrow = document.querySelector('.category-nav svg');

console.log(categoryList);
// Toggle the active class on click
subnavTitle.addEventListener('click', function() {
  categoryList.classList.toggle('active');
  arrow.classList.toggle('active');
});


  