"use strict";
$ = jQuery;

$(document).ready(function () {
  sortDataTable();
});
//Close Course Button Prevent defalt link and go to online paper
document.querySelector('.back-course').addEventListener('click', function(event) {
  event.preventDefault(); 
  window.location.href = '/online-paper'; 
});
