=== Acquired.com for WooCommerce ===
Contributors: acquired
Tags: acquired, acquired payment, payments, gateway, payment gateway, credit card, card
Requires at least: 6.5
Tested up to: 6.8.3
Requires PHP: 8.1
Stable tag: 2.0.0
License: MIT License
License URI: https://opensource.org/license/mit

== Description ==

# Accept payments with Acquired.com

The Acquired.com for WooCommerce extension enables your business to securely accept payments by Card, Apple Pay & Google Pay to help you generate more sales.

== Features ==

- **Pay by Card:** Securely accept Visa, Mastercard & American Express using EMV 3-D Secure (version 2.2)
- **Digital Wallets:** Add Apple Pay & Google Pay to the Product, Cart or Checkout pages of your store to deliver a seamless checkout experience
- **Customisable Checkout:** Match your brand with full control to style the payment form to meet your requirements
- **Saved Cards:** Enable faster checkout for returning customers by letting them reuse previously stored cards
- **Manage your payments:** Update the payment statuses from within WooCommerce
- **Always available:** Excellent customer service and reliability (99.999% uptime) at our core
- **PCI DSS:** Remain fully compliant with the lowest amount of effort (SAQ-A) using our hosted solution

== Quick & Easy Setup ==

Please [contact us](https://acquired.com/contact) to get a test account so you can try out the extension.

1. Access your WordPress dashboard.
2. Select **Plugins** from the left navigation menu followed by **Add New**
3. Search for **Acquired.com** using the top right-hand corner search box
4. Select **Install Now**
5. Once Installed you can enable and configure all things payments in the WooCommerce settings
6. Configure a few basic details and you are up and running

Read our documentation [here](https://docs.acquired.com/docs/woocommerce-1) and our support teams are on hand to help with any questions you might have so please [contact us](https://acquired.com/contact).

== Screenshots ==

1. Configuration
2. Card Payment
3. Apple Pay
4. Google Pay

== Changelog ==

= 2.0.0 =
* Release version 2.0.0

= 1.3.3 - 2024/08/09 =
* Fixed: Fixed rebill request subscription
* Fixed: Remove post type transaction and create transaction
* Fixed: Fixed case declined Apple/Google Pay

= 1.3.2 - 2024/07/31 =
* Fixed: Merchant session Apple Pay

= 1.3.1 - 2024/07/02 =
* Fixed: Remove MOTO
* Fixed: Fixed merchant info for Google Pay
* Fixed: Fixed Apple Pay validation

= 1.3.0 - 2024/04/22 =
* Fixed: Fixed merchant info for Google Pay

= 1.2.9 - 2024/04/16 =
* Fixed: Set priority for Contact form on Google Pay
* Fixed: Adding Google Pay MerchantID
* Fixed: Update Billing & Shipping in Cart/Product Page on Google Pay & Apple Pay
* Fixed: Miss Payment Method detail in order confirmation email with Google Pay & Apple Pay

= 1.2.8 - 2024/03/19 =
* Fixed: Order Status for non-lottery type products will be Processing instead of Completed
* Fixed: Order notes will be created as private notes not visible to end customer
* Fixed: Billing details added by customer in the checkout flow will be prioritised and used over the default details in ApplePay or GooglePay.

= 1.2.7 - 2024/02/27 =
* Fixed: Set priority for ApplePay
* Fixed: Empty Apple Pay token issue in case of conflicting Apple Pay and Place Order Button

= 1.2.6 - 2024/02/06 =
* Fixed: CountryCode Lowercase issue
* Fixed: Amount mismatch error in Apple Pay transactions
* Fixed: My account issues
* Update: Started prioritising billing info manually added by the customer in checkout form

= 1.2.5 - 2024/01/21 =
* Fixed: E-commerce transaction gets marked as a MOTO transaction
* Fixed: Apple Pay journey & error display if TnCs are not accepted

= 1.2.4 - 2023/11/27 =
* Fixed: Fix merchant_custom_3 params for ApplePay

= 1.2.3 - 2023/11/02 =
* Fixed: Apply Uppercased CountryCode to ApplePay

= 1.2.2 - 2023/10/06 =
* Fixed: ApplePay popup does not appear
* Fixed: Declare Compatibility with Woocommerce HPOS
* Fixed: Order status stuck at Processing

= 1.2.1 - 2023/08/17 =
* Fixed: Mapped Merchant_Custom_3 as "Dynamic Descriptor" for Apple Pay
* Fixed: Removed Acquired Transaction function from Menu'

= 1.2.1 - 2023/07/20 =
* Fixed: Add new field - Dynamic Descriptor
* Fixed: Change the Flow of Order Status (Processing Issue)
* Fixed: Change the flow of VOID Issue

= 1.2.1 - 2023/05/19 =
* Fixed: Fixed get Apple Pay merchant session domain.
* Fixed: Fix Apple Pay Decline Card Flow
* Fixed: Fix Change Apple Pay button position

= 1.2.1 - 2023/05/15 =
* Fixed: Fixed Payment General tab not default value.

= 1.2.1 - 2023/04/27 =
* Fixed: Fixed Apple Pay with Shipping one option.

= 1.1.9 - 2023/03/28 =
* Fixed: Fixed Google Pay with Shipping one option.

= 1.1.8 - 2023/03/24 =
* Fixed: Fixed merchant_order_id request.

= 1.1.7 - 2023/03/23 =
* Update: Update document link.
* Update: Hidden iFrame Redirect opiton.
* Update: Remove return_url when payment with i-Frame option.
* Fixed: Fixed price format with Google Pay.

= 1.1.6 - 2023/03/21 =
* Fix: Fixed order received i-Frame option.

= 1.1.5 - 2023/03/14 =
* Fix: Fixed country code 'GB' for Apple Pay.

= 1.1.3 - 2023/02/22 =
* Fix: Fixed iFrame Pop-up no transaction outcome.

= 1.1.2 - 2023/02/20 =
* Fix: Fixed conflict amount Apple Pay with Coupon code.

= 1.1.4 - 2023/01/23 =
* Fix: Fixed Card Payments REUSE not targetting correct HPP template ID.

= 1.1.2 - 2022/12/20 =
* Fix: Fixed conflict TeraWallet - ApplePay & GooglePay transactionAmount/totalPrice not updated.

= 1.0.7 - 2022/11/24 =
* Checkout - Apple Pay & Google Pay (Enhancement).
* Fix: Update Contact info Apple Pay with virtual product in Product, Cart and Checkout page.

= 1.0.6 - 2022/11/02 =
* Configuration (Enhancement) #1.
* Configuration (Enhancement) #2.
* Configuration (Enhancement) #3.
* Configuration (Enhancement) #4.
* Configuration (Enhancement) #5.
* Card Payments - Full Page Redirect.

= 1.0.5 - 2022/10/20 =
* Configuration (Enhancement) #1.

= 1.0.4 - 2022/10/14 =
* Adding a new card processing slower than usual.

= 1.0.4 - 2022/10/11 =
* Fix Storing expiry month.

= 1.0.4 - 2022/10/10 =
* Use a new payment method text.

= 1.0.4 - 2022/10/07 =
* Order Status - Change Pending Payment to On Hold.

= 1.0.4 - 2022/10/06 =
* Change Description for All Payment Methods.

= 1.0.3 - 2022/09/21 =
* Fix Apple Pay Shipping Error with Locations not covered by your other zones.

= 1.0.2 - 2022/06/12 =
* Fix conflict with Plugin CheckoutWC.

= 1.0.1 - 2022/03/24 =
* Fix Apple Pay.

= 1.0 - 2021/01/22 =
* First Release
* Accept all major debit and credit card types, Visa®, MasterCard®, American Express®
* Support WooCommerce Subscriptions  & Accept  recurring payments
* Support 1-click checkout for seamless payment experience.
* Support Apple Pay and Google Pay
* Manage payments, captures, refunds and more directly from your WooCommerce dashboard
