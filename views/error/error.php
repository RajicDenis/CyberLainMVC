<?php include APPROOT .'/views/partials/header.php'; ?>

<?php if(isset($error)): ?>
<div class="error-wrap">
	<div class="d-flex justify-content-center err-box">
		<div class="item">
	
			<?php if(isset($extraError)): ?>
				<h3 class="text-center white mb-4"><?php echo $extraError; ?></h3>
			<?php endif; ?>

		    <div class="image-box">
		    	<i class="far fa-frown-open"></i>
		    </div>

		    <div class="content">
		    	<?php if(isset($error['type'])): ?>
		    		<h4 class="header text-center mt-4"><strong>ERROR: <?php echo $error['type']; ?></strong></h4>
				<?php endif; ?>

		    	<div class="description mt-4">
		    		<?php if(isset($error['message'])): ?>
		        		<p><?php echo nl2br(str_replace('Uncaught Error: ', '', $error['message'])); ?></p>
		        	<?php endif; ?>
		    	</div>
		    
		    </div>
		</div>

	</div>
</div>

<?php endif; ?>	

<?php include APPROOT .'/views/partials/footer.php'; ?>
