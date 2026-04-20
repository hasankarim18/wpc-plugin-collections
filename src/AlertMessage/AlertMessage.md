## 📘 Chapter: Crafting a Reusable Alert System in WordPress

In the evolving world of WordPress development, simplicity and reusability are often the difference between fragile code and scalable architecture. This chapter walks through a compact yet elegant implementation of a custom alert message system using a class-based approach. At first glance, the code may seem straightforward—but beneath it lies a thoughtful design aligned with WordPress best practices.

---

## 🧩 The Namespace and Safety Check

The journey begins with a namespace:

```php
namespace Hasan\WpPluginCollections\AlertMessage;
```

This line ensures that the class lives in its own isolated space, preventing naming conflicts with other plugins or core WordPress functions. In a large ecosystem like WordPress, this is not just good practice—it’s essential.

Immediately after, a safety guard appears:

```php
if (!defined('ABSPATH')) {
    exit;
}
```

This prevents direct access to the file. If someone tries to open the PHP file via a browser, the script halts. It’s a small but critical layer of security.

---

## 🏗️ The Class Structure

The class `AlertMessage` acts as a container for all functionality related to alert messages.

```php
class AlertMessage
```

This object-oriented approach keeps everything organized and reusable. Instead of scattering functions globally, everything is encapsulated.

---

## 🔌 Hooking Into WordPress

The `register()` method serves as the entry point:

```php
public function register()
{
    add_action('init', [$this, 'init']);
}
```

Here, the class connects itself to WordPress using the `init` hook. This means that when WordPress initializes, your custom logic will run.

---

## ⚙️ Initialization: Shortcode + Assets

Inside the `init()` method, two important things happen:

```php
add_shortcode('nice_alert_message', [$this, 'wpc_alert_message_render']);
add_action('wp_enqueue_scripts', [$this, 'load_scripts']);
```

1. **Shortcode Registration**
   A shortcode `[nice_alert_message]` is registered. This allows users to place alert messages anywhere in posts or pages.

2. **CSS Enqueueing**
   The plugin loads its stylesheet when WordPress prepares frontend scripts.

---

## 🎨 Loading Styles

```php
public function load_scripts()
{
    wp_enqueue_style('alert-message-css', plugin_dir_url(__FILE__) . 'alert-message-css.css', [], 'all');
}
```

This function ensures that the alert styles are available on the frontend. The CSS file is dynamically linked using `plugin_dir_url(__FILE__)`, making the path flexible and reliable.

---

## 💬 Rendering the Alert Message

The heart of this system lies in:

```php
public function wpc_alert_message_render($atts, $content = null)
```

This function is responsible for transforming shortcode input into visible HTML.

---

### 🧾 Step 1: Handling Attributes

```php
$attributes = shortcode_atts([
    'type' => 'info',
], $atts);
```

A default attribute `type` is defined. If the user doesn’t specify it, the alert defaults to `"info"`.

---

### 🔄 Step 2: Processing Content

```php
$message = $content ? do_shortcode($content) : '';
```

This line allows nested shortcodes inside the alert. It’s a subtle but powerful feature—your alert can contain dynamic content.

---

### ✅ Step 3: Validation

```php
$allowed_types = ['success', 'warning', 'danger', 'info'];
if (!in_array($type, $allowed_types)) {
    $type = 'info';
}
```

User input is validated against a whitelist. This prevents unexpected values and keeps styling predictable.

---

### 🧱 Step 4: Building the Output

Using output buffering:

```php
ob_start();
```

The HTML structure is created:

```html
<div class="wpc-alert wpc-alert-{type}">{message}</div>
```

- The class name changes dynamically based on the alert type.
- The message is safely rendered using:

```php
echo wp_kses_post($message);
```

This ensures that only safe HTML is allowed—protecting against XSS attacks.

Finally, the buffered content is returned:

```php
return ob_get_clean();
```

---

## 🎯 Example Usage

```plaintext
[nice_alert_message type="success"]
    Your operation was successful!
[/nice_alert_message]
```

This will render a styled success alert on the frontend.

---

## 🌟 Final Thoughts

This code is more than just a shortcode—it’s a miniature system:

- It follows **WordPress standards**
- Uses **object-oriented design**
- Implements **security best practices**
- Supports **extensibility and reuse**

If you expand this further, you could:

- Add icons based on type
- Include dismiss buttons with JavaScript
- Integrate animation effects
- Allow custom classes or inline styles

What you’ve built here is not just a feature—it’s a foundation.
