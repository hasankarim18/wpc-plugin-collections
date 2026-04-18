<style>
    /* Subscriber Form - Modern & Clean Design */

    .wpc_subscriber_form_container {
        max-width: 520px;
        margin: 40px auto;
        padding: 40px 30px;
        background: linear-gradient(145deg, #ffffff, #f8f9ff);
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08);
        border: 1px solid #e8e8f0;
    }

    .wpc_subscriber_form_container form {
        width: 100%;
    }

    .wpc_subscriber_form_container label {
        display: block;
        margin-bottom: 18px;
        position: relative;
    }

    .wpc_subscriber_form_container input[type="text"],
    .wpc_subscriber_form_container input[type="email"] {
        width: 100%;
        padding: 16px 20px;
        font-size: 16px;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        background: #ffffff;
        transition: all 0.3s ease;
        font-family: inherit;
        color: #333;
    }

    .wpc_subscriber_form_container input[type="text"]:focus,
    .wpc_subscriber_form_container input[type="email"]:focus {
        outline: none;
        border-color: #6366f1;
        box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.15);
        transform: translateY(-2px);
    }

    /* Placeholder styling */
    .wpc_subscriber_form_container input::placeholder {
        color: #94a3b8;
        font-weight: 400;
    }

    /* Submit Button */
    .wpc_subscriber_form_submit {
        margin-top: 10px;
    }

    .wpc_subscriber_form_submit input[type="button"] {
        width: 100%;
        padding: 16px 24px;
        background: linear-gradient(135deg, #6366f1, #4f46e5);
        color: white;
        font-size: 17px;
        font-weight: 600;
        border: none;
        border-radius: 12px;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 8px 20px rgba(99, 102, 241, 0.3);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .wpc_subscriber_form_submit input[type="submit"] {
        width: 100%;
        padding: 16px 24px;
        background: linear-gradient(135deg, #6366f1, #4f46e5);
        color: white;
        font-size: 17px;
        font-weight: 600;
        border: none;
        border-radius: 12px;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 8px 20px rgba(99, 102, 241, 0.3);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .wpc_subscriber_form_submit input[type="button"]:hover {
        background: linear-gradient(135deg, #4f46e5, #4338ca);
        transform: translateY(-3px);
        box-shadow: 0 12px 25px rgba(99, 102, 241, 0.4);
    }

    .wpc_subscriber_form_submit input[type="button"]:active {
        transform: translateY(1px);
        box-shadow: 0 4px 10px rgba(99, 102, 241, 0.3);
    }

    /* Responsive Design */
    @media (max-width: 576px) {
        .wpc_subscriber_form_container {
            margin: 20px 15px;
            padding: 30px 20px;
            border-radius: 16px;
        }

        .wpc_subscriber_form_container input[type="text"],
        .wpc_subscriber_form_container input[type="email"] {
            padding: 14px 18px;
            font-size: 15px;
        }
    }

    #wpc_s_success_message {
        text-align: center;
        font-size: 18px;
        font-weight: 700;
        color: green;
        padding: 20px;
    }

    #wpc_s_error_message {
        text-align: center;
        font-size: 18px;
        font-weight: 700;
        color: red;
        padding: 20px;

    }

    .wpc_visible {
        display: block;
    }

    .wpc_hide {
        display: none;
    }
</style>