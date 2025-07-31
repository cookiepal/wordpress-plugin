=== CookiePal Banner ===
Contributors: cookiepal
Tags: cookies, consent, gdpr
Requires at least: 5.0
Tested up to: 6.6
Stable tag: 1.1
Requires PHP: 7.0
License: AGPLv3
License URI: https://www.gnu.org/licenses/agpl-3.0.html

Add a custom consent banner to your WordPress site for privacy compliance. Easily stay compliant with CookiePal in just a few clicks!

== Description ==

Welcome to **CookiePal Banner**, a WordPress plugin designed to easily add the CookiePal cookie consent banner to your website. This plugin allows administrators to input their CookiePal Website ID, enabling users to manage their consent preferences and comply with privacy regulations seamlessly.

*This plugin requires a CookiePal account and an active Website ID, which you can obtain from your CookiePal dashboard. Ensure your account is configured for proper functionality.*

Starting from version 1.1, this plugin requires the [WP Consent API](https://wordpress.org/plugins/wp-consent-api/) plugin to be installed and active. It uses the WP Consent API to register and manage user consent in a standardized way across your WordPress site.

== Use of External Service ==

This plugin relies on [CookiePal](https://app.cookiepal.io/), an external service for managing cookie consent banners. For the plugin to function, users must enter their CookiePal Website ID, which allows the consent banner to load dynamically. When using CookiePal Banner, user consent information may be sent to CookiePal's service to manage preferences.

For more details, refer to:
- [CookiePal Privacy Policy](https://app.cookiepal.io/privacy-policy/cookiepal.io)
- [CookiePal Terms of Use](https://app.cookiepal.io/terms-and-conditions)

These disclosures help ensure that users are aware of where data is sent and are informed of data transmission requirements under privacy laws.

== Features ==

- Automatically adds the CookiePal consent banner to your website's header.
- Simple setup through a user-friendly settings page in the WordPress admin dashboard.
- Allows you to input your CookiePal Website ID and dynamically load the banner script.

== Installation ==

1. Install and activate the [WP Consent API](https://wordpress.org/plugins/wp-consent-api/) plugin.
2. Ensure you have an active CookiePal account and have configured your settings in the CookiePal dashboard.
3. Download the CookiePal Banner plugin.
4. Activate the plugin in your WordPress admin dashboard.

== Setup & Configuration ==

1. Go to **Settings > CookiePal Banner** in your WordPress dashboard.
2. Enter your **CookiePal Website ID** in the provided field.
3. Click **Save Settings**.
4. The CookiePal consent banner will now automatically load on your website!

== How It Works ==

The plugin registers a settings page in the WordPress admin where you can input your **Website ID**. This ID is used to dynamically insert the CookiePal consent banner script into your website's header.

Here’s a high-level overview of the process:

1. **Admin Configuration**: You provide the Website ID via the plugin settings.
2. **Banner Injection**: The plugin injects the CookiePal banner script using the ID you provided.
3. **User Consent**: Users visiting your site can manage their privacy preferences using the banner.

== Frequently Asked Questions ==

= Where can I get my CookiePal Website ID? =

You can obtain your Website ID from your CookiePal account dashboard. If you’re unsure, please visit [CookiePal](https://app.cookiepal.io).

= How do I customise the banner? =

Customisation options are available in your CookiePal account. This plugin only handles the integration of the banner into your WordPress site.

= Will this plugin slow down my site? =

No, the CookiePal script is loaded asynchronously, ensuring minimal impact on your site's performance.

= What happens if WP Consent API is not installed? =

If the WP Consent API plugin is not installed or active, CookiePal Banner will not initialize and will display an admin notice prompting you to install it.

== Changelog ==

= 1.1 =
* Initial public release.
* Requires [WP Consent API](https://wordpress.org/plugins/wp-consent-api/).
* Integrates with the WordPress consent system for GDPR compliance.

== License ==

This plugin is licensed under the AGPLv3 or later.
