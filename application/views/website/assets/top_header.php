 <header>
    	<!--Top Strip Wrap Start-->
        <div class="top_strip">
        	<div class="container">
                <div class="top_location_wrap">
                    <p><i class="fa fa-map-marker"></i>

                        <?php
                            echo $this->db->get_where('settings',array('type' => 'address'))->row()->description;
                        ?>

                    </p>
                </div>
                <div class="top_ui_element">
                    <ul>
                        <li><i class="fa fa-envelope"></i><a href="mailto:<?php
                            echo $this->db->get_where('settings',array('type' => 'system_email'))->row()->description;
                        ?>"> 

                        <?php
                            echo $this->db->get_where('settings',array('type' => 'system_email'))->row()->description;
                        ?>
                            

                        </a>

                    </li>
                        <li><i class="fa fa-phone"></i> <a href="tel:<?php
                            echo $this->db->get_where('settings',array('type' => 'phone'))->row()->description;
                        ?>">

                         <?php
                            echo $this->db->get_where('settings',array('type' => 'phone'))->row()->description;
                        ?>
                            
                        </a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!--Top Strip Wrap End-->
        
        <!--Navigation Wrap Start-->
        <div class="logo_nav_outer_wrap">
        	<div class="container">
                <div class="logo_wrap">
                    <a href="#"><img src="<?php echo base_url() ?>uploads/logo.png" width = "100px" height = "60px" alt=""></a>
                </div>
                
               
                <nav class="main_navigation">
                    <ul>
                        <li><a href="<?php echo base_url() ?>website/index">Home<span>MAIN PAGE</span></a></li>
                       <li><a href="<?php echo base_url() ?>website/about">About<span>ABOUT US</span></a></li>
                        <li><a href="<?php echo base_url() ?>website/teacher">Teachers<span>OUR TEACHERS</span></a></li>
						<li><a href="<?php echo base_url() ?>website/contact">Contact<span>Contact Us</span></a></li>
						<li><a href="<?php echo base_url() ?>login">Login<span>ALL USERS LOGIN</span></a></li>
						<li><a href="#">Language<span>SELECT LANGUAGE</span></a>
                        	<ul>
                            	<li><a href="">English</a></li>
                                <li><a href="">Arabic</a></li>
                            </ul>
                        </li>

                    </ul>
                </nav>
                <!--DL Menu Start-->
                <div id="kode-responsive-navigation" class="dl-menuwrapper">
                    <button class="dl-trigger">Open Menu</button>
                    <ul class="dl-menu">
                        <li class="active"><a href="<?php echo base_url() ?>welcome/index">Home</a></li>
						 <li class="menu-item kode-parent-menu"><a href="<?php echo base_url() ?>welcome/about">About Us</a></li>
                        <li class="menu-item kode-parent-menu"><a href="<?php echo base_url() ?>welcome/teacher">Teachers</a></li>
                        <li class="menu-item kode-parent-menu"><a href="<?php echo base_url() ?>welcome/contact">Contact Us</a></li>
						<li class="menu-item kode-parent-menu"><a href="<?php echo base_url() ?>login">Login</a></li>
						 <li class="menu-item kode-parent-menu"><a href="#">Language</a>
                            <ul class="dl-submenu">
                                <li><a href="">English</a></li>
                                <li><a href="">Arabic</a></li>
                            </ul>
                        </li>

                    </ul>
                </div>
                <!--DL Menu END-->
            </div>
        </div>
        <!--Navigation Wrap End-->
    </header>