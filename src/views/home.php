<div class="row">
  <div class="col-12">
  	<ul class="list-inline">
	  	<?php foreach ($data['products'] as $rec) { ?>
	  		<li class="list-inline-item">
				<div class="card" style="width: 18rem;">
					<div class="card-body">
						<h5 class="card-title"><?php echo $rec['title']?></h5>
						<p class="card-text"><?php echo $rec['description'] ?></p>
						<p class="card-text">Price: <strong>$<?php echo $rec['price'] ?></strong></p>
						<a href="#" id="<?php echo $rec['id'] ?>" class="btn btn-primary">Add To Cart</a>
					</div>
				</div>
			</li>
	  	<?php } ?>
  </ul>
  </div>
</div>