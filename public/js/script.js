$(document).ready(() => {
  // pagination
  $(document).on("click", "#pagination a", function(event) {
    event.preventDefault();

    let page = $(this).attr("href").split("page=")[1];
    history.pushState(null, null, `?page=${page}`);

    $.ajax({
      type: "GET",
      url: "/products?page=" + page,
      success: function (response) {
          $("#products-grid").html(response);
      },
    });
  })
});
