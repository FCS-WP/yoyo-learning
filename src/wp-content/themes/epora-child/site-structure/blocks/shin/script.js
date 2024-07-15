function sortDataTable() {
  $("body").on("click ", "th.sorting", function (e) {
    e.preventDefault();
    //active class
    let sortCol = $(this).attr("data-col");
    if ($(this).hasClass("sorting_asc")) {
      var order = "desc";
    } else {
      var order = "asc";
    }
    const urlParams = new URLSearchParams(window.location.search);
  
    urlParams.set("orderby", sortCol);
    urlParams.set("order", order);

    window.location.search = urlParams;
  });
}
