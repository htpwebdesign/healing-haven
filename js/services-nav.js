// Get the subnav title element
let subnavTitle = document.querySelector('.subnav-title');

// Get the category list element
let categoryList = document.querySelector('.category-nav ul');

console.log(categoryList);
// Toggle the active class on click
subnavTitle.addEventListener('click', function() {
  categoryList.classList.toggle('active');
});


  