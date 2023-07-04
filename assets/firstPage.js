const raitingContainers = document.querySelectorAll('.star-rating-container');


raitingContainers.forEach(function(container) {
  // Get all star elements
  const stars = container.querySelectorAll('.star-rating span');

  // Attach click event listener to each star
  stars.forEach((star) => {
    star.addEventListener('click', () => {
      // Remove 'selected' class from all stars
      stars.forEach((star) => {
        star.classList.remove('selected');
      });

      // Add 'selected' class to the clicked star and all preceding stars
      star.classList.add('selected');
      let prevStar = star.previousElementSibling;
      while (prevStar) {
        prevStar.classList.add('selected');
        prevStar = prevStar.previousElementSibling;
      }

      // Update the hidden input value with the selected rating
      const ratingValue = star.dataset.value;
      container.querySelector('#rating_value').value = ratingValue;
    });
  });
});


// Get the textarea element and the counter element
let textarea = document.getElementsByClassName("review-text-area")[0];
let counter = document.getElementById("charCounter");

// Update the character count on keyup event
textarea.addEventListener('keyup', (e) => {
    counter.innerText = textarea.value.length + '/1000';
});