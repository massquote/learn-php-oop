/*
* Holds all function that is related to 
* shopping cart data
* 
* @Author: Felix Notarte
* @Date:   2018-07-01 13:30:19
* @Last Modified by:   Felix Notarte
* @Last Modified time: 2018-07-01 23:40:11
*/
class ShopApiError extends Error
{
    constructor(message, cause)
    {
        super(message);
        this.cause = cause;
        this.name = "shop api";
    }
}

/**
 * For instantiating the class
 * @param {string} token
 * @param {string} baseUrl
 * @return {[type]} [description]
 */
function shopApi(token, baseUrl)
{
    /** incase forgot to add new */
    if (new.target) {
    } else {
        return new shopApi();
    }

    this._token  = token;
    this._domain = baseUrl;
}

/**
 * This will get current item count
 * @param  {[type]} onSuccessFn [description]
 * @param  {[type]} onFailFn    [description]
 * @return {[type]}             [description]
 */
shopApi.prototype.getCount = function(onSuccessFn, onFailFn)
{
    $.ajax({
        type: "post",
        url:  this._domain + "cart/count/" + this._token,
        data: [],
        success: function(data) {
            if (data.status == "success") {
                if (onSuccessFn) {
                    onSuccessFn(data);
                }
            } else {
                if (onFailFn) {
                    onFailFn(data);
                } else {
                    throw new ShopApiError("getCount error!");
                }
            }
        },
        error: function(xhr, status, error) {
            throw new ShopApiError(error);
        }
    });
};

/**
 * This function will send add item request
 * @param {json array} args     data to be posted
 * @param {function} onSuccessFn on success function
 * @param {function} onFailFn    on fail function optional
 * @return {[type]} [description]
 */
shopApi.prototype.addToCart = function(args, onSuccessFn, onFailFn)
{
    if (!args.id) {
        throw new ShopApiError("id required");
    }

    $.ajax({
        type: "post",
        url:  this._domain + "cart/add/" + this._token,
        data: args,
        success: function(data) {
            if (data.status == "success") {
                if (onSuccessFn) {
                    onSuccessFn(data);
                }
            } else {
                if (onFailFn) {
                    onFailFn(data);
                } else {
                    throw new ShopApiError("addToCart error!");
                }
            }
        },
        error: function(xhr, status, error) {
            throw new ShopApiError(error);
        }
    });
};

/**
 * This function will send the final cart for process
 * @param {json array} args     data to be posted
 * @param {function} onSuccessFn on success function
 * @param {function} onFailFn    on fail function optional
 * @return {[type]} [description]
 */
shopApi.prototype.pay = function(args, onSuccessFn, onFailFn)
{
    $.ajax({
        type: "post",
        url:  this._domain + "cart/checkout/" + this._token,
        data: args,
        success: function(data) {
            if (data.status == "success") {
                if (onSuccessFn) {
                    onSuccessFn(data);
                }
            } else {
                if (onFailFn) {
                    onFailFn(data);
                } else {
                    throw new ShopApiError("pay error!");
                }
            }
        },
        error: function(xhr, status, error) {
            throw new ShopApiError(error);
        }
    });
}

/**
 * This will update the cart in session
 * @param {json array} args     data to be posted
 * @param {function} onSuccessFn on success function
 * @param {function} onFailFn    on fail function optional
 * @return {[type]} [description]
 */
shopApi.prototype.updateCart = function(args, onSuccessFn, onFailFn)
{
	if (!args.id || !args.action) {
        throw new ShopApiError("id/action required");
    }

    $.ajax({
        type: "post",
        url:  this._domain + "cart/update/" + this._token,
        data: args,
        success: function(data) {
            if (data.status == "success") {
                if (onSuccessFn) {
                    onSuccessFn(data);
                }
            } else {
                if (onFailFn) {
                    onFailFn(data);
                } else {
                    throw new ShopApiError("updateCart error!");
                }
            }
        },
        error: function(xhr, status, error) {
            throw new ShopApiError(error);
        }
    });
}

/**
 * This function will get cart items
 * @param {function} onSuccessFn on success function
 * @param {function} onFailFn    on fail function optional
 * @return {[type]} [description]
 */
shopApi.prototype.getItems = function(onSuccessFn, onFailFn)
{
    $.ajax({
        type: "post",
        url: this._domain + "cart/items/" + this._token,
        data: [],
        success: function(data) {
            if (data.status == "success") {
                if (onSuccessFn) {
                    onSuccessFn(data);
                }
            } else {
                if (onFailFn) {
                    onFailFn(data);
                } else {
                    throw new ShopApiError("getItems error!");
                }
            }
        },
        error: function(xhr, status, error) {
            throw new ShopApiError(error);
        }
    });
};

