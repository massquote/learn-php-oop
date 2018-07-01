/*
* Handles home scripts
* 
* @Author: Felix Notarte
* @Date:   2018-07-01 14:15:15
* @Last Modified by:   Felix Notarte
* @Last Modified time: 2018-07-01 18:11:13
*/

/**
 * lets attach events 
 * @return none
 */
$(function() {
    renderCount();

    $(".btn").click(function()
    {
    	addCart(this.id);
    });
});

/**
 * function will send data to server
 * and update the cart
 * @param {[type]} id [description]
 */
function addCart(id){
	const postData = {"id":id};
	// access the declared api
	mainShopCart.addToCart(
		postData,
		function(resp)
		{
			$("#cartCount").attr('data-count',resp.data.count);
		});
}