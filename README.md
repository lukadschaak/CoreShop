# pimcore-coreshop

[![Join the chat at https://gitter.im/dpfaffenbauer/pimcore-coreshop](https://badges.gitter.im/Join%20Chat.svg)](https://gitter.im/dpfaffenbauer/pimcore-coreshop?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge)
Onlineshop Plugin for Pimcore

# Demo
Take a look at [coreshop.lineofcode.at](http://coreshop.lineofcode.at)

(Still under Development - Pimcore Login will follow)

You can setup your own example:

* Download Plugin and place it in your plugins directory
* Open Extension Manager in Pimcore and enable/install Plugin
* After Installation within Pimcore Extension Manager, you have to reload Pimcore
* Now the CoreShop Icon will appear in the Menu
* You now have to let CoreShop install itself
* finished
* Go To http://yourdomain/en/shop

___

# Features
* Product Management
* Variants of Products
* Countries with Currencies
* Currency conversion
* Country Taxes (not yet implemented)
* Category Management
* Abstract Payment
* Price Rules for Vouchers/Discounts
* Carrier Management
* Extendable Carriers
* Different Payment Providers
* Multiple Themes supported
* PDF-Invoice Generation
* Different Order Steps
* Overwrite CoreShop Classes
* Overwrite CoreShop Controllers
____

# Themes
Themes are installed within plugins/CoreShop/views/template/[Name]

A Theme is basically a Zend Module with the Namespace CoreShopTheme. All views and controllers specific for this theme are placed inside the theme-folder.

____

# Plugins
Coreshop was designed to make use of other Pimcore-Plugins. 

Every Payment Provider or Delivery Provider is a Pimcore-Plugin that integrates with CoreShop.

## Hooks
CoreShop uses Hooks to call Pimcore-Plugins from template files.

**Hooks are currently not consistently implemented.**

For example on the product-detail template file (in Demo Shop):

```
<?=\CoreShop\Plugin::hook("product-detail-bottom", array("product" => $this->product))?>
```

# Payment
A Payment Provider is implemented using a Pimcore-Plugin.

To implement a new Payment Plugin you need to extend the class CoreShop\Plugin\Payment.

For example take a look at the pimcore-payunity Plugin: [https://github.com/dpfaffenbauer/pimcore-payunity](https://github.com/dpfaffenbauer/pimcore-payunity)

# Carrier
Carriers can be extended with your own plugin. For more information take a look at the Demo implementation: [https://github.com/dpfaffenbauer/coreshop-carrier-custom](https://github.com/dpfaffenbauer/coreshop-carrier-custom)

To implement a new Carrier you need to extend the class CoreShop\Model\Carrier.

# GeoIP v2
CoreShop can use GeoIP to locate visitors countries using IP-Addresses.

CoreShop uses the already existing Pimcore GeoIP Database located in website/var/GeoLite2-City.mmdb

```
/website/var/config/GeoIP/GeoIP.dat
```

# Extending CoreShop

## CoreShop Classes
All CoreShop Classes except Carriers classes can be extended using Pimcore Classmaps

[https://www.pimcore.org/wiki/display/PIMCORE4/Class-Mappings+-+Overwrite+pimcore+models](https://www.pimcore.org/wiki/display/PIMCORE4/Class-Mappings+-+Overwrite+pimcore+models)

For Example
```
<CoreShop_Model_Country>\Website\Model\Country</CoreShop_Model_Country>
```

## CoreShop Controller
CoreShop Controller can be extended using the Template.

If the controller class is available in your templates controller directory. Your controller will be dispatched