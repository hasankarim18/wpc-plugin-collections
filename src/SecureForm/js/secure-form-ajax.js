jQuery(document).ready(function ($) {
  $("#wpc-secure-form").on("submit", function (e) {
    e.preventDefault();
    const { sf_nonce, action, ajax_url } = sf_config;
    // console.log(this);

    const formData = $(this).serialize();

    const data = {
      nonce: sf_nonce,
      action: action,
      form_data: formData,
    };

    console.log(data);

    $.ajax({
      type: "post",
      url: ajax_url,
      data: data,
      dataType: "json",
      success: function (response) {
        console.log(response);
      },
      error: function (error) {
        console.log(error);
      },
    });

    //  console.log(data);
  });
  ////////--------------------------
});
