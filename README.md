<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Custom WordPress Email Plugin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 0 20px;
        }

        h1 {
            margin-top: 0;
        }

        ul {
            list-style-type: disc;
            padding-left: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Custom WordPress Email Plugin</h1>

        <h2>Installation</h2>
        <ul>
            <li>Download the plugin zip file.</li>
            <li>Upload the plugin to your WordPress site in the <code>/wp-content/plugins/</code> directory.</li>
            <li>Activate the plugin through the 'Plugins' menu in WordPress.</li>
        </ul>

        <h2>Configuration</h2>
        <ul>
            <li>Go to the plugin settings page in the WordPress admin dashboard.</li>
            <li>Set up your email settings, such as the sender name, sender email, and email subject.</li>
            <li>Save your changes.</li>
        </ul>

        <h2>Working with get_option and add_settings_field</h2>
        <p>This plugin uses <code>get_option</code> and <code>add_settings_field</code> to customize the content of the emails sent. Here's how you can use these functions with this plugin:</p>
        <ul>
            <li>In your plugin settings, use <code>add_settings_field</code> to create fields for the email subject and message content.</li>
            <li>Use <code>get_option</code> to retrieve the values of these fields when generating the email content.</li>
            <li>When you publish a custom post type, the plugin will use these values to customize the email content.</li>
        </ul>
    </div>
</body>

</html>
