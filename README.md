# 🌐 Universal Query Param Tracker for Elementor Forms

A lightweight WordPress plugin that automatically captures all query parameters from incoming URLs, stores them in cookies, and appends them to Elementor Pro form submissions — without requiring hidden fields in your forms.

---

## 🔧 Features

- ✅ Tracks **all** query parameters (e.g., `utm_source`, `campaign`, `ref`, `gclid`, `anything=123`)
- ✅ Works with **Elementor Pro Forms** (no hidden fields required)
- ✅ Stores parameters in cookies for **up to 7 days**
- ✅ Automatically adds parameters to form submissions
- ✅ Zero configuration — install and go!

---

## 🚀 Use Case

Perfect for marketers and advertisers who want to track:

- UTM tags (`utm_source`, `utm_medium`, `utm_campaign`, etc.)
- Paid ad click IDs (`gclid`, `fbclid`)
- Affiliate/referral parameters
- Custom campaign tags

Even if a user navigates through multiple pages or submits a form days later — their original tracking data is still captured.

---

## 🏗️ Installation

1. Clone or download this repository.
2. Upload the plugin to your WordPress site at: `/wp-content/plugins/universal-query-param-tracker/`
3. Activate the plugin from your **WordPress Admin > Plugins**.
4. That’s it! No setup required.

---

## 🧪 How It Works

1. **User lands** on a page like: `https://example.com/landing-page?utm_source=google&campaign=sale&ref=partner123`
2. The plugin stores all query parameters (with a `qp_` prefix) in cookies for 7 days.
3. On any Elementor Pro form submission, the plugin:
   - Reads all cookies starting with `qp_`
   - Adds them as fields to the form entry

---

## 💼 About

**Plugin Name:** Universal Query Param Tracker for Elementor Pro Forms
**Author:** Techrays Labs Private Limited  
**License:** GPLv2 or later  
**Version:** 1.0

Crafted with ❤️ by [Techrays Labs Private Limited](https://techrayslabs.com) to simplify ad and campaign tracking in WordPress.

---

## 📦 Roadmap

- [ ] Support for other form plugins (WPForms, Gravity Forms, etc.)
- [ ] Admin settings panel to configure cookie duration or exclusions
- [ ] Optional sessionStorage/localStorage mode
- [ ] Toggle for disabling certain params

---

## 📜 License

This plugin is licensed under the [GNU General Public License v2.0](https://www.gnu.org/licenses/old-licenses/gpl-2.0.html) or later.

---

## 🤝 Contributing

We welcome contributions! Feel free to open issues or pull requests.  
Let’s make campaign tracking smarter together.

---

## 📬 Contact

Have questions or feature requests?  
Reach out at [tech@techrayslabs.com](mailto:tech@techrayslabs.com)
