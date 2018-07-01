<nav class="navbar navbar-light" style="background-color: #e3f2fd;">
  <h1 class="navbar-brand mb-0"><a href="<?php echo baseUrl() ?>"> Internet Shop</a></h1>
    <div class="topnav-right">
    	<ul class="list-inline">
    		<li class="list-inline-item">
    			<a href="<?php echo baseUrl() ?>cart/">
			    	<div id="ex4">
					  <span id="cartCount" class="p1 fa-stack fa-2x has-badge" data-count="0">
					    <i class="p3 fa fa-shopping-cart fa-stack-1x xfa-inverse" data-count="4b"></i>
					  </span>
					</div>
				</a>
			</li>
			<li class="list-inline-item">
				 <i class="fa fa-money"></i> <strong>$<?php echo $data['credit'] ?></strong>
			</li>
	   </ul>
  </div>
</nav>

