/*
* Handles all the function needed to
* function the cart page
* 
* @Author: Felix Notarte
* @Date:   2018-07-01 17:42:15
* @Last Modified by:   Felix Notarte
* @Last Modified time: 2018-07-02 00:36:40
*/
let selectTransport =null;
/**
 * lets attach events 
 * @return none
 */
$(function() {    
    renderCount();
    getCartItems();

    $("#btnPay").click(pay);
});


/**
 * function that will show and 
 * hide alert message depending on type
 * @return {none} 
 */
function showError(type)
{
	$("#"+type+"-alert")
			.fadeTo(3000, 500)
			.slideUp(600, 
				function()
				{
		    		$("#"+type+"-alert").slideUp(600);
				}
			);
}

/**
 * this will compute the summary then
 * render in view page
 * @return {none} 
 */
function renderSummary()
{
	//lets loop to all subtotal
	let subtotal = 0;
	$( ".subtl" ).each(function( index ) {
  		subtotal = subtotal + parseFloat($( this ).text()) ;
	});
	$("#subtotal").text(subtotal.toFixed(2));
	
	// lets get transport
	let transportFee = $("#transportFee").text();
	let grandTotal = parseFloat(subtotal) + parseFloat(transportFee);

	$("#grandTotal").text(grandTotal.toFixed(2));
}

/**
 * function that is responsible of paying
 * @return {none} 
 */
function pay()
{
	// check if there is selected tranport
	if (selectTransport == null)
	{
		showError('transport');
		return;
	}

	// if no items
	let subtotal = parseFloat($("#subtotal").text());
	if (subtotal == 0)
	{
		showError('cart');
		return;
	}


	let postData = {transport: selectTransport};

	mainShopCart.pay(
		postData,
		// function success
		function(resp)
		{
			// lets get it from globally declare variable
			location.replace(mainDomain+"success/index/"+ resp.data.token);
		},
		// function erorr
		function(resp)
		{
			showError('credit');
		});
}

/**
 * this will set the transport fee depending
 * on the selection choosed
 * @param {float} fee         
 * @param {string} description 
 */
function setTransportFee(fee, description)
{
	$("#transportFee").text(fee.toFixed(2));
	selectTransport = fee;
	// lets change the caption
	$("#btnTransport").text("Transport: "+description);

	renderSummary();	
}

/**
 * functin that handles on change event
 * of the quantity
 * @return {[type]} [description]
 */
function onChageQuantity()
{
	if ($(this).val() ==0){
		showError('input');
		$(this).val(1);
	}
	let id = $(this).attr('data-id');

	let subtotal = $(this).val() * $(this).attr('data-price');	
	$("#subtotal"+id).html(subtotal.toFixed(2));

	renderSummary();

	// lets update our server
	let postData = {
		action	:'update',
		'id'	:id,
		qty 	:$(this).val()
		};

	mainShopCart.updateCart(
		postData,
		function(resp){
			renderCount();
		});
}

/**
 * Funtion that will remove the item in the cart
 * @return {[type]} 
 */
function removeItem(id)
{
	let postData = {
		action	:'delete',
		'id'	:id
		};

	mainShopCart.updateCart(
		postData,
		function(resp){
			renderCount();
			$("#rec"+id).remove();
			renderSummary();
		});
}

/**
 * function that will query the server of the 
 * items and render it the page
 * @return {none} 
 */
function getCartItems()
{
	// lets get the script template in the view
	let tmpl = getScriptTemplate("templateCartItems");

	// query the items in server
	mainShopCart.getItems(
		function(resp)
		{
			// reset table
            $("#tblItems  > tbody").empty();

            $.each(resp.data, function(i, row)
            {
            	// lets assign so that we can us dom function
            	let rec =[row];

				$("#tblItems > tbody:last-child").append(
				    rec.map(function(item) {
				        return tmpl.map(bindTemplateValue(item)).join("");
				    })
				);
            });

			// on change on the quatity
    		$(document).on("change", ".input-qty", onChageQuantity);
    		renderSummary();
		});
}