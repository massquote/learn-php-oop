<!-- THIS ERROR SECTION CAN BE REFACTORED CREATED DYNAMICALLY -->
<!-- Error message for wrong quantity input -->
<div class="alert alert-danger" id="input-alert" style="display: none">
    <button type="button" class="close" data-dismiss="alert">x</button>
    <strong>Invalid input! </strong>
    Quantity should be more than 0 (zero)!
</div>

<!-- Error message for required transportaion -->
<div class="alert alert-danger" id="transport-alert" style="display: none">
    <button type="button" class="close" data-dismiss="alert">x</button>
    <strong>Transport required! </strong>
    Please choose transport before proceeding to pay.
</div>

<!-- Error message for low credit -->
<div class="alert alert-danger" id="credit-alert" style="display: none">
    <button type="button" class="close" data-dismiss="alert">x</button>
    <strong>Low credit! </strong>
    The payable amount is bigger than your available credit.
</div>

<!-- Error message for low cart -->
<div class="alert alert-danger" id="cart-alert" style="display: none">
    <button type="button" class="close" data-dismiss="alert">x</button>
    <strong>No items! </strong>
    We cannot proceed since we dont have items in the cart.
</div>

<div style="height: 20px;"></div>

<!-- section for the table items -->
<div class="card">
	<div class="card-header">
	    Your Cart
	  </div>
		 <table id="tblItems" class="table table-borderless">
		  <thead>
		    <tr>
		    <th scope="col"></th>
		      <th scope="col">ITEM</th>
		      <th scope="col">PRICE</th>
		      <th scope="col">QUANTITY</th>
		      <th scope="col">TOTAL</th>
		    </tr>
		  </thead>
		  <tbody>
		  </tbody>
		</table>
</div>
<div style="height: 20px;"></div>

<div class="row">
	<!-- Transport -->
	<div class="col-7">
		<div class="card">
		  <div class="card-body">
		  	<div class="alert alert-success" role="alert">
  				<p class="mb-0">You can remove the item or change its quantity before you click pay.</p>
			</div>
				<div class="dropdown pull-left">
					  <button id="btnTransport" class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					   Choose Transport
					  </button>
					  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
					    <a class="dropdown-item" href="javascript:setTransportFee(0,'Pick up')">Pick up</a>
					    <a class="dropdown-item" href="javascript:setTransportFee(5, 'UPS')">UPS</a>
					  </div>
				</div>
		    <a href="#" id="btnPay" class="btn btn-primary pull-right">Pay</a>
		  </div>
		</div>	
	</div>
	<!-- Summary -->
	<div class="col-5">
		<div class="card">
		  <div class="card-header"> Summary</div>
		  <div class="card-body">
		    <div class="row">
		    	<div class="container">
					<div class="row">
						<div class="col-8"> <strong>Sub-total</strong></div>
						<div class="col-4"> &#36;<span id="subtotal">0</span></div>
					</div>
					<div class="row">
						<div class="col-8"> <strong>Transport</strong></div>
						<div class="col-4"> &#36;<span id="transportFee">0</span></div>
					</div>
					<hr>
					<div class="row">
						<div class="col-8"> <strong>Grand Total</strong></div>
						<div class="col-4"><strong> &#36;<span id="grandTotal">0</span></strong></div>
					</div>
				</div>
		    </div>
		  </div>
		</div>	
	</div>
</div>

<!-- Custom Template -->
<script type="text/html" id="templateCartItems" >
	<tr id="rec${id}">
	    <th scope="row">
	    	<a href="javascript:removeItem(${id})" >
				  <span aria-hidden="true">&times;</span>
			</a>
	    </th>
	      <td> ${title}</td>
	      <td>&#36; ${price}</td>
	      <td><input class="input-qty" min="1" type="number" id="qty${id}" data-id="${id}" data-price="${price}" value="${qty}" required></td></td>
	      <td>&#36; <span id="subtotal${id}" class="subtl">${subtotal}</span></td>
	</tr>
</script>


