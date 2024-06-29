$(document).ready(function () {
  $(".copy-pass").on("click", function () {
    navigator.clipboard.writeText(
      $(this).parent(".pass").children("input").val()
    );
  });
  $(".copy-email").on("click", function () {
    navigator.clipboard.writeText(
      $(this).parent(".email").children("p").html()
    );
  });
});
