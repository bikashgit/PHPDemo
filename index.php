<!DOCTYPE html>
<html>
<head>
  <title>PHP Demo By Bikash Ranjan Nayak</title>
  <script src="jquery-2.1.4.js"></script>
  <style>
  #outside {
width:400px;
height:150px;
border-style:dashed; border-width:3px;
position: relative; 
}
#inside {
background-color: white;
width:404px;
height:154px;
position: absolute;
top:-2px;
left:-2px;
}
#process {
    background-color: #E3E1B8; 
    padding: 2px 4px;
    font: 13px sans-serif;
    text-decoration: none;
    border: 1px solid #000;
    border-color: #aaa #444 #444 #aaa;
    color: #000;
	cursor:pointer;
	font-weight:bold;
}
input[type="text"], textarea {

  background-color : #d1d1d1; 

}
  </style>
</head>
<body>
<div id="outside">
<div id="inside" style="text-align:center">
<h1>Your answer can use the form below</h1>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="target">
  <input type="text" name="product_txt" />
  <button type="submit" name="submit" id="process">Check Unit</button>
</form>
</div>
</div>
<div class="result">
	<?php 
		include 'terminalClass.php';
		include 'inventoryClass.php';

		// Initialize inventory, listings, and terminal objects.
		$product_inventory = new Inventory();

		// add products and prices here. 
		$product_inventory->add("A", 2.00, array('4'=>'7.00'));
		$product_inventory->add("B", 12.00);
		$product_inventory->add("C", 1.25, array('6'=>'6.00'));
		$product_inventory->add("D", 0.15);


		$product_listing = new Listing($product_inventory);
		$terminal = new Terminal($product_listing);

		//$terminal->setUnitPricing("A", 3.50);
		//$terminal->setVolumePricing("A", [2=>2.40, 7=>10.00]);

		// process form data
		if (isset($_POST["submit"])) {
			$products = $_POST["product_txt"];

			for ($i = 0; $i < strlen($products); $i++) {

				if ($products[$i] != " ")
					$scannable = $terminal->scan($products[$i]);

				// did the product go into the system?
				if (!$scannable)
					echo "Unable to get price for: " . $products[$i] . "<br>";
			}

			echo "<b>The total cost of: " . $products . " is: $" . number_format($terminal->getTotalCost(), 2, '.', ',') . "</b>";
		}
	?>
</div>
  <h1>Question</h1>
  <pre>Consider a store where items have prices per unit but also volume
prices. For example, apples may be $1.00 each or 4 for $3.00.

Implement a point-of-sale scanning API that accepts an arbitrary
ordering of products (similar to what would happen at a checkout line)
and then returns the correct total price for an entire shopping cart
based on the per unit prices or the volume prices as applicable.

Here are the products listed by code and the prices to use (there is
no sales tax):
Product Code | Price
--------------------
A            | $2.00 each or 4 for $7.00
B            | $12.00
C            | $1.25 or $6 for a six pack
D            | $0.15

There should be a top level point of sale terminal service object that
looks something like the pseudo-code below. You are free to design and
implement the rest of the code however you wish, including how you
specify the prices in the system:

terminal->setPricing(...)
terminal->scan("A")
terminal->scan("C")
... etc.
result = terminal->total

Here are the minimal inputs you should use for your test cases. These
test cases must be shown to work in your program:

Scan these items in this order: ABCDABAA; Verify the total price is $32.40.
Scan these items in this order: CCCCCCC; Verify the total price is $7.25.
Scan these items in this order: ABCD; Verify the total price is $15.40.

</pre>


</body>
</html>