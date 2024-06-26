$(document).ready(function () {
  if ($(".multi-select input").val() == "") {
    const $input = $(".multi-select input");

    $columns = $(".selectBox ul li");

    $columns.each(function (index, element) {
      if ($(element).hasClass("active")) {
        $input.val($input.val() + $(element).html() + ";");
      }
    });

    // .forEach((element) => {
    //   if ($input.val().search(element.innerHTML + ";") != -1) {
    //     $input.val($input.val() + element.innerHTML + ";");
    //   }
    // });
  }
  $(".multi-select").on("click", function (e) {
    if (!$(this).children(".selectBox").is(":hover")) {
      $(this).toggleClass("active");
      $(".selectBox").toggleClass("active");
    }
  });

  $(".selectBox ul li").on("click", function () {
    const $input = $(this).parents(".multi-select").find("input");

    $(this).toggleClass("active");

    if ($input.val() !== "") {
      if ($input.val().search($(this).html() + ";") == -1) {
        $input.val($input.val() + $(this).html() + ";");
      } else {
        newString = $input.val().replace($(this).html() + ";", "");
        $input.val(newString);
      }
    } else {
      $input.val($(this).html() + ";");
    }

    console.log($input.val());
  });

  $(document).on("click", function () {
    if (
      $(".multi-select:hover").length == 0 &&
      $(".multi-select").hasClass("active")
    ) {
      $(".multi-select").removeClass("active");
      $(".selectBox").removeClass("active");
      $(".form").submit();
    }
  });
});
