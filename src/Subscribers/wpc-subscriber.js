//console.log(wpc_s_vers);

jQuery(document).ready(function ($) {
  $("#wpc_subscriber_form").on("submit", function (e) {
    e.preventDefault();

    //  const form = $(this);
    const $form = $(this);
    const formData = $(this).serialize();

    const { nonce, action, ajax_url } = wpc_s_vers;

    const data = {
      nonce: nonce,
      action: action,
      form_data: formData,
    };

    $.ajax({
      type: "post",
      url: ajax_url,
      dataType: "json",
      data: data,
      success: function (response) {
        const $msg = $form.find("#wpc_s_success_message");
        const $errorMsg = $form.find("#wpc_s_error_message");
        console.log(response);
        if (response.success) {
          // Reset form properly
          $form[0].reset();

          // Show message
          $msg.removeClass("wpc_hide").addClass("wpc_visible");

          // Auto hide after 5s
          setTimeout(() => {
            $msg.removeClass("wpc_visible").addClass("wpc_hide");
          }, 5000);
        } else {
          $errorMsg.removeClass("wpc_hide").addClass("wpc_visible");
          $errorMsg.html(response.data.message);
          setTimeout(() => {
            $errorMsg.removeClass("wpc_visible").addClass("wpc_hide");
            $errorMsg.html("");
          }, 10000);
        }
      },
      error: function (error) {
        console.log("json error:", error);
      },
    });
    //-------------------------------//
  });
});
