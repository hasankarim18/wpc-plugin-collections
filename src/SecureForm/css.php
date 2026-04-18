<style>
    /* WPC Secure Form - Modern & Clean Design */

    #wpc-secure-form {
        max-width: 600px;
        margin: 40px auto;
        padding: 40px;
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    #wpc-secure-form label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #333;
        font-size: 15px;
    }

    #wpc-secure-form input[type="text"],
    #wpc-secure-form input[type="number"],
    #wpc-secure-form textarea {
        width: 100%;
        padding: 14px 16px;
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        font-size: 16px;
        transition: all 0.3s ease;
        box-sizing: border-box;
    }

    #wpc-secure-form input[type="text"]:focus,
    #wpc-secure-form input[type="number"]:focus,
    #wpc-secure-form textarea:focus {
        border-color: #4a6cf7;
        outline: none;
        box-shadow: 0 0 0 4px rgba(74, 108, 247, 0.15);
    }

    #wpc-secure-form textarea {
        resize: vertical;
        min-height: 140px;
    }

    #wpc-secure-form input[type="submit"] {
        margin-top: 25px;
        padding: 14px 32px;
        background: linear-gradient(135deg, #4a6cf7, #3b5bd9);
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(74, 108, 247, 0.3);
    }

    #wpc-secure-form input[type="submit"]:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(74, 108, 247, 0.4);
        background: linear-gradient(135deg, #3b5bd9, #2e4ac4);
    }

    #wpc-secure-form>div {
        margin-bottom: 22px;
    }

    /* Optional: Make it more beautiful with subtle improvements */

    #wpc-secure-form {
        position: relative;
    }

    #wpc-secure-form::before {
        content: '';
        position: absolute;
        top: -3px;
        left: -3px;
        right: -3px;
        bottom: -3px;
        background: linear-gradient(135deg, #4a6cf7, #8b5cf6);
        border-radius: 18px;
        z-index: -1;
        opacity: 0.1;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        #wpc-secure-form {
            margin: 20px 15px;
            padding: 30px 25px;
        }
    }
</style>