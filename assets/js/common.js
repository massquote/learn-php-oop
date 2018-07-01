/*
* This will be a holder of the
* commonly wide use functions
* 
* @Author: Felix Notarte
* @Date:   2018-07-01 18:09:33
* @Last Modified by:   Felix Notarte
* @Last Modified time: 2018-07-01 21:43:14
*/

/**
 * query the server and get the cart count
 * @return {none} 
 */
function renderCount()
{
	// access the declared api
	mainShopCart.getCount(function(resp)
		{
			$("#cartCount").attr('data-count',resp.data.count);
		});
}

/**
 * This will assignt the variables with 
 * value
 * @param  {[type]} items 
 * @return {[type]}       
 */
function bindTemplateValue(items) {
    return function(val, i) {
        return i % 2 ? items[val] : val;
    };
}

/**
 * This will render the js template
 * @param {[type]}  scriptId 
 * @param {Boolean} isScript 
 */
function getScriptTemplate(scriptId, isScript = true) {
    if (isScript == true) {
        return $('script[id="' + scriptId + '"]')
            .text()
            .split(/\$\{(.+?)\}/g);
    } else {
        return $("#" + scriptId)
            .text()
            .split(/\$\{(.+?)\}/g);
    }
}