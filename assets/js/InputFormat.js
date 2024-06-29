$(document).ready(function () {
  $("#cnpj").on("focus", function (e) {
    e.preventDefault();

    $(this).attr("placeholder", "00.000.000/0000-00");
  });

  $("#cep").on("focus", function (e) {
    e.preventDefault();

    $(this).attr("placeholder", "00000-000");
  });

  $("#uf").on("keyup", function () {
    $(this).val($(this).val().toUpperCase());
  });

  $("#uf").inputmask("aa", {
    placeholder: "",
    showMaskOnHover: false,
    showMaskOnFocus: false,
    clearIncomplete: true,
    clearMaskOnLostFocus: true,
  });
  $("#cnpj").inputmask("99.999.999/0009-99", {
    placeholder: "",
    showMaskOnHover: false,
    showMaskOnFocus: false,
    clearIncomplete: true,
    clearMaskOnLostFocus: true,
    jitMasking: true,
  });
  $("#cep").inputmask("99999-999", {
    placeholder: "",
    showMaskOnHover: false,
    showMaskOnFocus: false,
    clearIncomplete: true,
    clearMaskOnLostFocus: true,
    jitMasking: true,
  });
  $("#ven_cert").inputmask("datetime", {
    inputFormat: "dd/mm/yyyy",
    placeholder: "",
    showMaskOnHover: false,
    showMaskOnFocus: false,
    clearIncomplete: true,
    clearMaskOnLostFocus: true,
    jitMasking: true,
  });
});
