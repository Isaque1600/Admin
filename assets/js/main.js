$(document).ready(function () {
  let elementClicked = false;

  function toggleDropdown($className) {
    if ($className.is(":hidden")) {
      $className.slideToggle(150, "linear");
      $className.css("display", "flex");
    } else {
      $className.slideToggle(150, "linear");
    }
  }

  function verifyInvalid($element) {
    if ($($element).is(":invalid")) {
      $($element).css("color", "red");
    } else {
      $($element).css("color", "var(--text-color)");
    }
  }

  function toggleSelect($className, $inputName) {
    const listOfOptions = document.querySelectorAll(
      $className + "> .options > .option"
    );

    listOfOptions.forEach((option) => {
      $(option).on("click", function () {
        if ($(option).text() == "Nenhum") {
          $($inputName).attr("placeholder", "Nenhum");
          $($inputName).attr("value", "");
        } else {
          $($inputName).attr("value", $(option).text());
        }
        $($inputName).trigger("change");
      });
    });

    $($className).toggleClass("opened");
  }

  function closeSelectFromOutside(className) {
    if (className.hasClass("opened") && className.is(":not(:hover)")) {
      className.toggleClass("opened");
    }
  }

  function toggleVenCert() {
    if ($("#nfe").is(":checked") || $("#sped").is(":checked")) {
      $(".ven_cert").show("fast");
    } else {
      $(".ven_cert").hide("fast");
    }
  }

  function toggleSerial() {
    const sistema = $("#sistema").val();
    if (
      ["GDOOR PRO", "GDOOR SLIM", "GDOOR MICRO"].includes(sistema.toUpperCase())
    ) {
      $(".serial").show("fast");
    } else {
      $(".serial").hide("fast");
    }
  }

  function showPopUp(title, message) {
    elementClicked = true;
    $(".popUp").fadeIn("fast", function () {
      $(".popUp-title").text(title);
      $(".popUp-text").text(message);
      $(".popUp").css("visibility", "visible");
      setTimeout(() => {
        elementClicked = false;
      }, 1000);
    });
  }

  $(document).on("click", function () {
    closeSelectFromOutside($(".dropdown-type"));
    closeSelectFromOutside($(".dropdown-sistema"));
    closeSelectFromOutside($(".dropdown-contador"));
    if (
      $(".icon-perfil").is(":not(:hidden)") &&
      $(".icon-perfil").is(":not(:hover)") &&
      $(".dropdown-perfil").is(":not(:hover)")
    ) {
      $(".dropdown-perfil").hide("fast");
    }
    if (
      $(".notification-perfil").is(":not(:hidden)") &&
      $(".notification-perfil").is(":not(:hover)") &&
      $(".dropdown-notification").is(":not(:hover)")
    ) {
      $(".dropdown-notification").hide("fast");
    }
    if ($(".popUp-content:not(:hover)")) {
      if (!elementClicked) {
        $(".popUp").fadeOut("fast", function () {
          $(".popUp").css("display", "none");
          elementClicked = false;
        });
      }
    }
  });

  $(window).on("resize", function () {
    if ($(this).width() > 1024) {
      $(".sidebar").css("left", "0px");
      $(".wrapper > .content").css("left", "150px");
      $(".wrapper > .content").css("width", "calc(100% - 170px)");
    } else if ($(this).width() <= 768) {
      $(".sidebar").css("left", "-100%");
      $(".wrapper > .content").css("left", "0px");
      $(".wrapper > .content").css("width", "100%");
    } else {
      $(".sidebar").css("left", "0px");
      $(".wrapper > .content").css("left", "45px");
      $(".wrapper > .content").css("width", "calc(100% - 65px)");
    }
  });

  /* Header And Sidebar */

  $(".sidebar-btn").on("click", function () {
    if ($(".sidebar").css("left") == "0px") {
      $(".sidebar").css("left", "-100%");
      $(".wrapper > .content").css("left", "0px");
      $(".wrapper > .content").css("width", "100%");
    } else {
      if ($(window).width() > 1024) {
        $(".sidebar").css("left", "0px");
        $(".wrapper > .content").css("left", "150px");
        $(".wrapper > .content").css("width", "calc(100% - 170px)");
      } else {
        $(".sidebar").css("left", "0px");
        $(".wrapper > .content").css("left", "45px");
        $(".wrapper > .content").css("width", "calc(100% - 65px)");
      }
    }
  });

  $(".icon-perfil img").on("click", function () {
    toggleDropdown($(".dropdown-perfil"));
    if (!$(".dropdown-notification").is(":hidden")) {
      toggleDropdown($(".dropdown-notification"));
    }
  });

  $(".notification-perfil").on("click", function () {
    toggleDropdown($(".dropdown-notification"));
    if (!$(".dropdown-perfil").is(":hidden")) {
      toggleDropdown($(".dropdown-perfil"));
    }
  });

  $(".sidebar-dropdown.users").on("click", function () {
    if ($(".users-pages").is(":hidden")) {
      toggleDropdown($(".users-pages"));
      $(".dropdown-icon.users-icon").replaceWith(
        feather.icons["chevron-up"].toSvg({ class: "dropdown-icon users-icon" })
      );
      $(".users-pages").css("display", "flex");
    } else {
      toggleDropdown($(".users-pages"));
      $(".dropdown-icon.users-icon").replaceWith(
        feather.icons["chevron-down"].toSvg({
          class: "dropdown-icon users-icon",
        })
      );
    }
  });

  $(".sidebar-dropdown.systems").on("click", function () {
    if ($(".systems-pages").is(":hidden")) {
      toggleDropdown($(".systems-pages"));
      $(".dropdown-icon.systems-icon").replaceWith(
        feather.icons["chevron-up"].toSvg({
          class: "dropdown-icon systems-icon",
        })
      );
      $(".systems-pages").css("display", "flex");
    } else {
      toggleDropdown($(".systems-pages"));
      $(".dropdown-icon.systems-icon").replaceWith(
        feather.icons["chevron-down"].toSvg({
          class: "dropdown-icon systems-icon",
        })
      );
    }
  });

  /* Header And Sidebar End */

  /* Main Content */

  /* Form */

  $(document).on("keypress", function (e) {
    if (e.which == 13 && !$("input").is(":focus")) {
      e.preventDefault();

      $(".submitBtn").trigger("click");
    }
  });

  $(".dropdown-type").on("click", function () {
    toggleSelect(".dropdown-type", ".type");
  });

  $(".dropdown-sistema").on("click", function () {
    toggleSelect(".dropdown-sistema", ".sistema");
  });

  $(".dropdown-contador").on("click", function () {
    toggleSelect(".dropdown-contador", ".contador-box");
  });

  /* $(".btn-close").on("click", function () {
    $(".users-section").css({ filter: "none" });
  }); */

  $("input").on("focusout keyup keydown", function (e) {
    if (e.which) {
    }
    verifyInvalid(this);
  });

  $(".row:first-child() input").on("change", function () {
    if ($(this).val() == "Cliente") {
      $(".cliente").show();
      $(".cliente").css("display", "flex");
      $("#senha").removeAttr("required");
      $(".contador").hide();
    } else {
      $(".contador").show();
      $(".contador").css("display", "flex");
      $("#senha").attr("required", "req");
      $(".cliente").hide();
    }
  });

  if ($(".row:first-child() input").val() == "Cliente") {
    $(".cliente").show();
    $(".cliente").css("display", "flex");
    $("#senha").removeAttr("required");
    $(".contador").hide();
  } else {
    $(".contador").show();
    $(".contador").css("display", "flex");
    $("#senha").attr("required", "req");
    $(".cliente").hide();
  }

  $("#sistema").on("change", function () {
    toggleSerial();
  });

  $("#nfe").on("click", function () {
    toggleVenCert();
  });

  $("#sped").on("click", function () {
    toggleVenCert();
  });

  toggleSerial();
  toggleVenCert();

  $(".popUp-close", ".popUp").on("click", function () {
    $(".popUp").fadeOut("fast", function () {
      $(".popUp").css("display", "none");
    });
  });

  /* Form End */

  /* Pop Up Delete */

  $(".delete").on("click", function () {
    var type = $(".type").text() != "" ? $(".type").text() : "Clientes";
    var id = $(this).closest("tr").find("td:first-child").text();
    var name = $(this).closest("tr").find("td:nth-child(2)").text();
    showPopUp("Atenção!", "Realmente deseja deletar o usuário " + name + "?");
    $(".popUp-btn").on("click", function () {
      $(window).attr("location", `deletar?id=${id}&name=${name}&type=${type}`);
    });
  });

  $(".delete-system").on("click", function () {
    var id = $(this).closest("tr").find("td:first-child").text();
    var name = $(this).closest("tr").find("td:nth-child(2)").text();
    showPopUp("Atenção!", "Realmente deseja deletar o usuário " + name + "?");
    $(".popUp-btn").on("click", function () {
      $(window).attr("location", `deletar?id=${id}&name=${name}`);
    });
  });

  /* Main Content End */
});
