$(document).ready(function () {
  $.fn.customSelect = function () {
    $(this).toggleClass("active");

    const $dropdown = $(this).parent(".dropdown");

    $dropdown.toggleClass("active");
    let $liValue = $dropdown.find("ul li").on("click", function () {
      $btn = $(this).parents(".dropdown").find("button");
      $input = $(this).parents(".dropdown").find("input");
      $btn.val($(this).html());
      $input.val($(this).html());
      $btn.removeClass("active");
      $dropdown.removeClass("active");
      $(".form").trigger("submit");
    });
  };

  $(".select-btn").on("click", function (e) {
    if ($(e.target).parents(".dropdown.columns").length == 0) {
      $(this).customSelect();
    }

    $(".dropdown").not($(this).parents(".dropdown")).removeClass("active");
    $(".select-btn").not(this).removeClass("active");
  });

  $(document).on("click", function () {
    if ($(".dropdown:hover").length == 0 && $(".dropdown").hasClass("active")) {
      $(".dropdown").removeClass("active");
      $(".select-btn").removeClass("active");
    }
  });
});
