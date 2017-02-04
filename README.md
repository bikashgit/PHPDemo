@Created Date	:	02/4/2017
@Author		:	Bikash Ranjan Nayak
@Purpose	:	Code test

My point-of-sale scanner program required the classes to make scanner product:
Terminal class in terminalClass.php
This class is an interface for scanning products and getting total cost (volume + unit) for products.

Invoice class in invoiceClass.php
This class tallys the number of times each product is scanned and calculates the total cost of all scanned products.

Product class in productClass.php
Represents a product object. Contains information about that product's name, volume and unit prices.

Inventory class in inventoryClass.php
Stores the products, including adding and removing products.

Listing class in listingClass.php
This class provides operations to update a product unit and volume costs and other information about the product, such
as whether the product is in the inventory.
---
How the program works
Use the Inventory class to create and stores product object.

The Listing class will will manage prices for all products stored in the Inventory class.

The Terminal will use the Listing class to get price data for a specific object and set prices. It will
use the Invoice class to calculate total cost of scanned products.
 
The Invoice class will also use the Listing class given by Terminal to perform calculations.

NOTE:
I did not handle all possibie exceptions if someone tries inputting non-numeric or negative unit and volume prices, except for the add() method in Inventory class.  