jQuery(document).ready(function ($) {
  $("#wpc_qrcode_ajax_form").on("submit", function (e) {
    e.preventDefault();
    const form = $(this);
    const { action, nonce, ajax_url } = wpc_qr_code;
    const fromData = form.serialize();

    const data = {
      action: action,
      nonce: nonce,
      form_data: fromData,
    };
    console.log(ajax_url);
    $.ajax({
      type: "post",
      url: ajax_url,
      data: data,
      dataType: "json",
      success: (response) => {
        console.log(response);
      },
      error: (error) => {
        console.log(error);
      },
    });
  });
});
