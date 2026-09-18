# 🐜 PipraPay Mod — Auto-Redirect to Merchant Site on Successful Payment (return_url Fix)

> **Self-hosted payment automation platform (bKash, Nagad, Rocket, Upay & Global Gateways) — enhanced with automatic post-payment redirection to merchant sites.**

<p align="center">
    <picture>
        <source media="(prefers-color-scheme: light)" srcset="https://piprapay.com/assets/logo-light.png">
        <img src="https://piprapay.com/assets/logo-light.png" alt="PipraPay" width="200">
    </picture>
</p>

<p align="center">
  <a href="https://github.com/PipraPay/PipraPay/releases">
    <img src="https://img.shields.io/github/v/release/piprapay/piprapay?include_prereleases&style=for-the-badge" alt="Latest Release">
  </a>

  <a href="https://www.facebook.com/groups/piprapay">
    <img src="https://img.shields.io/badge/Facebook%20Group-1.3K%20Members-1877F2?logo=facebook&logoColor=white&style=for-the-badge" alt="Facebook Group">
  </a>

  <a href="https://github.com/PipraPay/PipraPay/tree/main">
    <img src="https://img.shields.io/badge/Laravel-12.x-FF2D20.svg?style=for-the-badge&logo=laravel" alt="CI Status">
  </a>

  <a href="LICENSE">
    <img src="https://img.shields.io/badge/License-AGPL--3.0-blue.svg?style=for-the-badge&logo=gnu&logoColor=white" alt="AGPL-3.0 License">
  </a>
</p>

---

## 📢 Disclaimer & Credits / ক্রেডিট ও কৃতজ্ঞতা

> [!IMPORTANT]
> **Full Credit goes to the original creators and maintainers of [PipraPay](https://github.com/PipraPay/PipraPay).**  
> This repository is a modified/custom community build of the open-source PipraPay platform. We made a specific enhancement to solve the missing automatic redirection issue on successful payment verification. All core features, platform architecture, intellectual property, and original rights belong strictly to the [PipraPay project](https://piprapay.com) and its team.
> 
> **সম্পূর্ণ ক্রেডিট ও কৃতজ্ঞতা মূল [PipraPay](https://github.com/PipraPay/PipraPay) প্রজেক্ট ও এর মূল ডেভলপার টিমের।**  
> এটি মূল PipraPay ওপেন সোর্স প্রজেক্টের একটি মোডিফাইড (Modified) ভার্সন। পেমেন্ট সফল হওয়ার পর স্বয়ংক্রিয়ভাবে মার্চেন্ট সাইটে রিডাইরেক্ট না হওয়ার সমস্যাটির সমাধানের জন্য এই পরিবর্তনটি যুক্ত করা হয়েছে। মূল সফটওয়্যারের যাবতীয় কৃতিত্ব PipraPay টিমের।

---

## 🔍 Problem & Solution / কী সমস্যা ছিল এবং কী সমাধান করা হয়েছে?

### ❌ Problem in Original PipraPay (কী সমস্যা ছিল):
- **English:** In the original PipraPay checkout flow, after a customer completed and verified a payment (via automated gateways, SMS matching, or manual submissions), the checkout page displayed the success/completed status, but it **did not automatically redirect** the customer back to the merchant's website (`return_url`). Customers had to manually notice and click the "Go to Site" button. If a customer closed the tab upon seeing "Payment Completed", the merchant website would often miss the customer's callback/session return.
- **বাংলা:** মূল PipraPay-তে কাস্টমার যখন পেমেন্ট সম্পন্ন এবং ভেরিফাই করত, তখন সাকসেস পেজ দেখালেও গ্রাহককে **স্বয়ংক্রিয়ভাবে মার্চেন্ট সাইটে (`return_url`) রিডাইরেক্ট করার কোনো সিস্টেম ছিল না**। গ্রাহককে নিজ দায়িত্বে "Go to Site" বাটনে ক্লিক করতে হতো। অনেক ক্ষেত্রে গ্রাহক পেমেন্ট কমপ্লিট দেখে ট্যাব বন্ধ করে দিত, ফলে মার্চেন্ট সাইটে গ্রাহক ফেরত আসত না বা অর্ডার অটোমেটিক ফাইনাল হতে সমস্যা হতো।

### ✅ Our Solution in this Mod (আমরা কী সমাধান করেছি):
- **English:**
  1. **Automatic Redirection with Visual Countdown:** When a transaction status reaches `completed`, a countdown banner is displayed (*"Redirecting to site in 3 seconds... [Redirect Now]"*). Once the timer hits zero, the browser immediately redirects to the merchant's `return_url` with parameters attached.
  2. **Configurable in Admin Theme Settings:** Added two intuitive settings in the `twenty-six` theme settings:
     - `Auto Redirect on Success`: Toggle `Enabled` or `Disabled`.
     - `Redirect Delay (seconds)`: Customize the countdown duration in seconds (e.g. `0` for instant redirection, or `3` for standard countdown).
  3. **Instant "Redirect Now" Button:** Customers who prefer not to wait for the countdown can click "Redirect Now" immediately.
  4. **Multi-Language Support:** Full translation support added in English, Bengali, Hindi, Urdu, and Arabic.
  5. **Universal Compatibility:** Handles all gateway types (automated gateways, tokenized gateways, SMS-verification, and manual verification).
- **বাংলা:**
  1. **কাউন্টডাউনসহ অটো-রিডাইরেক্ট:** পেমেন্ট ভেরিফাই বা সফল হওয়ার সাথে সাথেই চেকআউট পেজে একটি সুন্দর কাউন্টডাউন নোটিফিকেশন আসবে (*"৩ সেকেন্ডের মধ্যে সাইটে রিডাইরেক্ট করা হচ্ছে... [এখনই যান]"*) এবং কাউন্টডাউন শেষ হওয়া মাত্র গ্রাহককে স্বয়ংক্রিয়ভাবে মার্চেন্ট সাইটের `return_url`-এ নিয়ে যাবে।
  2. **অ্যাডমিন প্যানেল থেকে নিয়ন্ত্রণযোগ্য:** থিম সেটিংসে দুটি নতুন অপশন যুক্ত করা হয়েছে:
     - `Auto Redirect on Success`: রিডাইরেক্ট চালু বা বন্ধ রাখার অপশন (`Enabled` / `Disabled`)।
     - `Redirect Delay (seconds)`: কাউন্টডাউনের সেকেন্ড সংখ্যা (যেমন: `0` দিলে তৎক্ষণাৎ রিডাইরেক্ট হবে, `3` দিলে ৩ সেকেন্ড কাউন্টডাউন হবে)।
  3. **তাত্ক্ষণিক রিডাইরেক্ট বাটন:** কাস্টমার চাইলে অপেক্ষা না করে সাথে সাথে "Redirect Now" বাটনে ক্লিক করে মার্চেন্ট সাইটে চলে যেতে পারবেন।
  4. **বহুভাষিক অনুবাদ:** ইংরেজি, বাংলা, হিন্দি, উর্দু ও আরবি ভাষায় রিডাইরেক্ট মেসেজের অনুবাদ যুক্ত করা হয়েছে।
  5. **সকল গেটওয়েতে কার্যকর:** অটোমেশন, এসএমএস ভেরিফিকেশন বা যেকোনো গেটওয়ের পেমেন্ট কমপ্লিট হলেই এটি একইভাবে কাজ করবে।

---

PipraPay is the **first open-source payment automation system (AGPL-3.0)** — a self-hosted, plugin-based platform that unifies payment gateways, wallets, APIs, and SMS-based verification into one system.

It helps developers and businesses **accept, verify, and automate payments from any method — API or non-API — in a single workflow.**

Supported payment networks include: Mobile Financial Services (MFS), payment gateways, and major banking systems across Bangladesh, India, and Pakistan — with full extensibility to integrate any custom or third-party provider.

Supported ecosystems include: bKash, Nagad, Rocket, Upay, and SureCash (Bangladesh); UPI, Paytm, PhonePe, Razorpay, and major Indian banks (India); Easypaisa, JazzCash, and leading Pakistani banking networks (Pakistan). Additional global gateways like Stripe, PayPal, and others can be added via plugins or custom integrations.

The system is fully expandable — developers can build and register new payment channels, gateways, and banking connectors without modifying core logic.

[Website](https://piprapay.com) · [Documentation](https://help.piprapay.com/) · [Changelog](https://piprapay.com/changelog) · [API Reference](https://piprapay.readme.io/reference/overview) · [Community Group](https://www.facebook.com/groups/piprapay)

New install? Start here: [Getting started](https://help.piprapay.com/hc/categories/31/installation-guide)

## 💖 Sponsors

<table>
  <tr>
    <td align="center" width="16.66%">
      <a href="https://www.flexohost.com/">
        <picture>
          <source media="(prefers-color-scheme: light)" srcset="https://www.flexohost.com/_next/image?url=%2F_next%2Fstatic%2Fmedia%2FFlexoHostHorizontalWhite.b835e24f.png&w=256&q=75">
          <img src="https://www.flexohost.com/_next/image?url=%2F_next%2Fstatic%2Fmedia%2FFlexoHostHorizontalWhite.b835e24f.png&w=256&q=75" alt="" height="28">
        </picture>
      </a>
    </td>
    <td align="center" width="16.66%">
      <a href="https://hostingoxygen.com/">
        <picture>
          <source media="(prefers-color-scheme: light)" srcset="https://panel.hostingoxygen.com/assets/img/logo.png">
          <img src="https://panel.hostingoxygen.com/assets/img/logo.png" alt="" height="35">
        </picture>
      </a>
    </td>
    <td align="center" width="16.66%">
      <a href="https://banglahoster.net/">
        <picture>
          <source media="(prefers-color-scheme: light)" srcset="https://banglahoster.net/billing/templates/lagom2/assets/img/logo/logo_big.2060021846.svg">
          <img src="https://banglahoster.net/billing/templates/lagom2/assets/img/logo/logo_big.2060021846.svg" alt="" height="28">
        </picture>
      </a>
    </td>
    <td align="center" width="16.66%">
      <a href="https://zenorbd.com/">
        <picture>
          <source media="(prefers-color-scheme: light)" srcset="https://zenorbd.com/storage/2024/12/ZENOR-BD-Logo.png">
          <img src="https://zenorbd.com/storage/2024/12/ZENOR-BD-Logo.png" alt="" height="28">
        </picture>
      </a>
    </td>
    <td align="center" width="16.66%">
      <a href="https://hostsite24.com/">
        <picture>
          <source media="(prefers-color-scheme: light)" srcset="https://hostsite24.com/wp-content/uploads/2025/07/WEB-header-logo.png">
          <img src="https://hostsite24.com/wp-content/uploads/2025/07/WEB-header-logo.png" alt="" height="24">
        </picture>
      </a>
    </td>
    <td align="center" width="16.66%">
      <a href="https://dignityhost.com/">
        <picture>
          <source media="(prefers-color-scheme: light)" srcset="https://dignityhost.com/assets/images/logo/logo-dignity-black.svg">
          <img src="https://dignityhost.com/assets/images/logo/logo-dignity-black.svg" alt="" height="24">
        </picture>
      </a>
    </td>
  </tr>
</table>

## 🔔 Why PipraPay Exists

Many regions lack modern payment infrastructure:

- No Stripe/PayPal availability  
- Local wallets without APIs  
- Manual SMS-based verification  
- Slow reconciliation processes  

PipraPay solves this by:

- Automating payment verification  
- Turning SMS payments into programmable events  
- Unifying all gateways under one system  
- Removing manual transaction handling  

## ⚡ Features

- Plugin-based architecture  
- Multi-gateway support (Stripe, PayPal, bKash, Nagad, etc.)  
- SMS verification engine  
- Webhook automation  
- Custom gateway plugins  
- REST API + SDK support  
- Fully self-hosted  

## 📱 Mobile App (Android – PipraPay Companion)

The official PipraPay Android app is available on the Play Store:

[Download on Play Store](https://play.google.com/store/apps/details?id=com.qubeplug.billpax_tools)

This app acts as a secure companion tool for PipraPay payment verification and automation.


## 📖 Documentation

👉 Docs: https://help.piprapay.com/  
👉 API Reference: https://piprapay.readme.io  

- Install PipraPay  
- Build plugins & modules  
- Integrate APIs  
- Configure gateways  
- Use webhooks & automation  

## 🤝 Contributing

PipraPay is a community-first and developer-driven ecosystem.

Even if the project is still evolving, contributions are welcome across multiple areas:

- 🎨 **UI/UX Design**  
  We welcome professional designers to help shape a strong, modern fintech identity including logo design, brand system, and interface improvements.

- ⚙️ **Development & Extensions**  
  Developers can contribute ideas, plugins, integrations, and improvements to the PipraPay ecosystem.

- 🤝 **Sponsorship & Infrastructure**  
  We are open to collaborations and sponsorships in areas such as CDN, cloud infrastructure, security tools, and scaling support.

## 🌟 Star History

<a href="https://www.star-history.com/?repos=piprapay%2Fpiprapay&type=date&legend=top-left">
 <picture>
   <source media="(prefers-color-scheme: dark)" srcset="https://api.star-history.com/chart?repos=piprapay/piprapay&type=date&theme=dark&legend=top-left" />
   <source media="(prefers-color-scheme: light)" srcset="https://api.star-history.com/chart?repos=piprapay/piprapay&type=date&legend=top-left" />
   <img alt="Star History Chart" src="https://api.star-history.com/chart?repos=piprapay/piprapay&type=date&legend=top-left" />
 </picture>
</a>

---

## 🏷️ Search Keywords & Tags (SEO)

`piprapay` · `piprapay mod` · `piprapay auto redirect` · `piprapay return url fix` · `piprapay redirect to site` · `piprapay script download` · `piprapay payment gateway` · `piprapay bkash nagad rocket` · `piprapay merchant return url` · `bangladesh payment automation script` · `self hosted payment gateway bangladesh` · `piprapay checkout redirect solution` · `piprapay github` · `piprapay free download`

---

## 🛡️ License

AGPL-3.0 — You can use, modify, and self-host PipraPay.  
If you distribute modified versions, you must keep them open-source under the same license.

## ❤️ Built by the Community, for the Community
