"use strict";
$ = jQuery;

$(document).ready(function () {
  sortDataTable();
});
//Close Course Button Prevent defalt link and go to online paper
const backCourseButton = document.querySelector('.back-course');
if (backCourseButton) {
  backCourseButton.addEventListener('click', function(event) {
    event.preventDefault(); 
    window.location.href = '/online-paper'; 
  });
}
