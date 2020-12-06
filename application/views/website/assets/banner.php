<div class="banner_outer_wrap">
    	<ul class="main_slider">
		<?php
            $banners = $this->db->get('banners')->result_array();
            foreach ($banners as $key => $banner):
               
        ?>
        	<li>
            	<img src="<?php echo base_url() ?>uploads/banner_image/<?php echo $banner['banner_image'] ?>" alt="" height = "100%">
                <div class="ct_banner_caption">
                    <p class="fadeInDown" style="color:white">
					<br><br><br><br><br>
					<?php echo $banner['banner_text']; ?>
					</p>
                    <a class="fadeInDown" href="#">DISCOVER MORE</a>
                </div>
            </li>
			<?php endforeach; ?>
        </ul>
    </div>