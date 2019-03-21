<?php /* Template Name:home */SESSION_start();
?>
<?php get_header(); 

/* Cast Posts */ 
$large   = get_posts(array(
        'post_type' => 'casting',
        'posts_per_page' =>4,	
        'meta_key' => 'image_size',
        'meta_value' =>'Large',
        'order' => 'DESC'		
    ));	
$small   = get_posts(array(
        'post_type' => 'casting',
        'posts_per_page' =>6,	
        'meta_key' => 'image_size',
        'meta_value' =>'Small',
        'order' => 'DESC'		
    ));	
function getDetailscast($postvlaues)
{
	$i=0;
	$details = array();
	if ($postvlaues)
	{
		foreach ($postvlaues as $cast)
		{
				$pid               = $cast->ID;
				$fields            = get_fields($pid);
				$field             = array_map("htmlspecialchars_decode", $fields);
				$detail           = $field;
				$detail['PostID'] = $pid;					
				$details[$i++]=$detail;				
		}			
   }
   return $details;
}   
$castsdetails_small=getDetailscast($small);
$castsdetails_large=getDetailscast($large);
/* End Of Cast Post*/

/* Half Screen Image */
$page=get_page_by_title("cast");
$field= get_fields($page->ID);
$image_full_size=$field['half_screen_image'];
/* End of half screen image  */


/* Gallery Posts */
$galleries   = get_posts(array(
        'post_type' => 'gallery',
        'posts_per_page' =>-1
    ));
    $details = array();
    if ($galleries):
	$i=0;
	foreach ($galleries as $gallery) {
        $pid               = $gallery->ID;
            $fields            = get_fields($pid);

            $details           = $fields;
            $details['PostID'] = $pid;
		   $galleriesdetails[$i++]=$details;
		}
		
    endif;
	

/*End of Gallery Posts */

/*Video*/
// $videos   = get_posts(array(
        // 'post_type' => 'video',
// 'meta_key' => 'sequence',
// 'orderby' => 'meta_value_num',
        // 'order' => 'DESC',
        // 'posts_per_page' =>1
    // ));
    // $details = array();
    // if ($videos):
// $i=0;
// foreach ($videos as $video) {

$page=get_page_by_title("video");
$field= get_fields($page->ID);

$values=get_post($page);
$pass=random_code(3).strrev($values->post_password).random_code(3);?>

<?php
        // $pid               = $video->ID;
            // $fields            = get_fields($pid);
            // $field             = array_map("htmlspecialchars_decode", $fields);
            // $details           = $field;
            // $details['PostID'] = $pid;
   // $videos[$i++]=$details;
// }
    // endif;

	

	
	
/* End Video*/


?>
        <!--Body Content Starts-->
         <div class="overlay-toggle-body" style="display:none"></div>
         <div class="container-lg bg-black">
           
            <!--Hero Component Starts-->
            <div class="hero" id="details-overview">
               <!--Add scss in _hero-accordion.scss-->
               <div class="container-lg">
                  <div class="details-image-section">
                     <div class="scripted-details-image">
                        <picture>
                                                                                                <?php if(get_field('hero_image_desktop')){ ?>
                            <source srcset="<?php echo the_field('hero_image_desktop'); ?>" media="(min-width:992px)">
                                                                                                                <?php } else { ?>
                                                                                                                <source srcset="http://images.sales.aenetworks.com/site-images/place-holder/show-card/sample_ae_stock.png" media="(min-width:992px)">
                                                                                                                <?php } ?>
                                                                                                                <?php if(get_field('hero_image_tablet')){?>
                            <source srcset="<?php echo the_field('hero_image_tablet'); ?>" media="(min-width:768px)">
                                                                                                                <?php } else { ?>
                                                                                                                <source srcset="http://images.sales.aenetworks.com/site-images/place-holder/show-card/sample_ae_stock.png" media="(min-width:768px)">
                                                                                                                <?php } ?>
                                                                                                                <?php if(get_field('hero_image_mobile')){?>
                            <img srcset="<?php echo the_field('hero_image_mobile'); ?>" alt="mobile image" style="width:100%;"> 
                                                                                                                 <?php } else { ?>
                                                                                                                <img srcset="http://images.sales.aenetworks.com/site-images/place-holder/show-card/sample_ae_stock.png" alt="mobile image" style="width:100%;"> 
                                                                                                                 <?php } ?>
                        </picture>
                     </div>

                      <!-- Ratings Section Starts -->
                     <!-- 2 statistics class statistics-two,no-feature-stat statistics-two -->
	<!-- Ratings Section Starts -->
                     <!-- 2 statistics class statistics-two,no-feature-stat statistics-two -->   
                 <?php if(get_field('stats1') || get_field('stats2') || get_field('stats3') || get_field('stats4') || get_field('source')){ ?>                                                                 
                     <div class="box-bg-grey ratings-content">
                        <div class="container-custom">
                          <div class="statistics">
                           <div class="featured-stat detail-impressions-viewers">
                              <div class="impressions">
                                  <span class="text-gold" id="s1"><?php echo the_field('stats1_rating'); ?></span> 
								  <span id="r1"><?php echo the_field('stats1_review'); ?></span>
                              </div>
                           </div>
                           <div class="featured-stat detail-impressions-multiple">
                              <div class="impressions detail-impressions-fb">
                                 <div class="rating-statistics" id="s2"><?php echo the_field('stats2_rating'); ?></div>
                                 <div class="rating-statistics-description" id="r2"><?php echo the_field('stats2_review'); ?></div>
                              </div>
                              <div class="impressions detail-impressions-social">
                                 <div class="rating-statistics" id="s3"><?php echo the_field('stats3_rating'); ?></div>
                                 <div class="rating-statistics-description" id="r3"><?php echo the_field('stats3_review'); ?></div>
                              </div>
                              <div class="impressions detail-impressions-twitter">
                                 <div class="rating-statistics" id="s4"><?php echo the_field('stats4_rating'); ?></div>
                                 <div class="rating-statistics-description" id="r4"><?php echo the_field('stats4_review'); ?></div>
                              </div>
                           </div>
                           </div>
                           <div class="clearfix"></div>
                                 <?php if(get_field('source')) { ?>
                           <div class="ratings-source text-uppercase">
                              SOURCES: <?php echo the_field('source'); ?>
                           </div>
                            <?php } ?>
                        </div>
                                                                                                
                     </div>

                         <?php } ?>

					  
					  
					  
                     <!-- Rating section ends -->
                  </div>
                  <div class="series-details">
                  </div>
               </div>
            </div>
            <!--Hero Component Ends-->
         </div>
           <!--Episode Section Starts-->
         <section class="box-bg-grey container-lg">
            <div class="container-lg position-relative">
			<div class="overview-block">
			<?php 
			if(get_field('series_background_image')){ ?>
                  <div class="scripted-details-title-image" style="background-image:url('<?php echo the_field('series_background_image');?>');" >
                </div>
				<?php }
				else{ ?>
				<div class="scripted-details-title-image" style="background-image:url('http://images.sales.aenetworks.com/site-images/place-holder/show-card/sample_ae_stock.png');" >
                </div>
				<?php } ?>
				</div>
				
				
                     <div class="scripted-detail-title-section">
                        <div class="container-custom">

                           <div class="float-left overview-left-md">
                                <div class="scripted-details-title"><?php echo the_field('series_title'); ?></div>
                            
                            
                           </div>
                           <div class="float-left overview-right-md">
                              <div class="series-description"><?php echo the_field('series_description'); ?>
                              </div>
							  <?php if($field['video_url'])
							  { ?>
                              <button class="flex-item btn-play ae-button ae-button-primary ae-button-secondary ae-button-watch-trailer float-left">
                                    <span class="watch-series-trailer">
                                    <span class="icons icon-play-series-trailer"></span>
                                    <span><span class="visible-onload">Play </span>
                                    <span class="visible-onclick">Close</span>
                                   Trailer</span>
                                    </span>
                                 </button>
								 <?php } ?>
                           </div>
                           <div class="clearfix"></div>
                         
                           <div class="watch-series-trailer-container" style="display:none;">
                              <div class="arrow"></div>
                              <div class="more-info-section">
                                       <div class="series-trailer-block">
                                          <div class="row row-gutter-custom">                                            
                                             <div class="col-md-7 col-md-push-5 col-sm-7 col-sm-push-5 col-xs-12">
                                                <div class="videowrapper-micro">
                                                <div class="vid-link micro-vid-link" id="micro-vid-link">
                                                    <div class="series-trailer-image-microsite">
													<?php if($field['video_image_url']){ ?>
                                                        <img src="<?php echo $field['video_image_url']; ?>" class="series-trailer-image"
                                                        alt="trailer-image">
														<?php }
														else{ ?>
														<img src="http://images.sales.aenetworks.com/site-images/place-holder/show-card/sample_ae_stock.png" class="series-trailer-image"
                                                        alt="trailer-image"> <?php } ?>
														
                                                        <div class="password-protected-xs" style="display:none;">
                                                            <div class="video-password text-center visible-xs visible-sm"><span class="password-protected-icon"></span>Password Protected</div>                                                                                                                                   
                                                            
                                                        </div>
                                                        <div class="clearfix"></div>
<span id="vauth" vid-auth="<?php echo $pass ?>" ></span>
                                                                <div class="password-protected-container text-center" style="display:none;">
                                                                        <div class="pwd-protected-content">
                                                                        <div class="row row-no-gutter">
                                                                            <div class="pwd-protected-row hidden-sm hidden-xs">
                                                                                            <div class="col-md-3">
                                                                                            </div>
                                                                                            <div class="col-md-9">
                                                                                                    <div class="video-password text-center"><span class="password-protected-icon"></span>Password Protected</div>                                                                       
                                                                                                </div>
                                                                                            <div class="clearfix"></div>
                                                                            </div>
                                                                            
                                                                            <?php echo custom_password_form(); ?>
                                                                     <div class="ms-alert" style="display:none" id="ms-video-alert">Incorrect password</div>
                                                                            <div class="clearfix"></div>
                                                                    </div>
                                                                </div>
                                                                </div>
																
                                                        <span class="play-btn on-click-login"></span>
														
                                                  
                                                </div>
                                                </div>
                                                <div class="details-video-wrapper protected-video" id="protected-video" style="display:none">
                                                    <div class="video-box">
                                                        <iframe class="iframe-video-box video-player-pop left" id="screener-one" width="100%" height="100%" scrolling="no" src="<?php echo $field['video_url'];?>" framepadding="0" frameborder="0" allowtransparency="true" seamless="" allowfullscreen="" mozallowfullscreen="" msallowfullscreen="" webkitallowfullscreen="">Your browser does not support iframes.</iframe>
                       
                                                    </div>
                                                </div>
                                                </div>
                                             </div>
                                             <div class="col-md-5 col-md-pull-7 col-sm-5 col-sm-pull-7 col-xs-12 video-details">
                                                <div class="trailer-title"><?php echo $field['video_title']; ?></div>
                                                <div class="trialer-details">
                                                   <div class="trailer-type">Trailer</div>
                                                   <div class="trailer-duration">Duration <?php echo $field['video_duration']; ?></div>
                                                   <div class="trailer-description"><?php echo $field['video_description'];?>
                                                   </div>
                                                </div>
                                              
                                             </div>
                                          </div>
                                       </div>
                              </div>
                           </div>
                        </div>
                     </div>
                 
            </div>
         </section>
         <!--Episode Section ends-->
        
        <!--Cast Section starts-->
		<?php if(count($castsdetails_large)!=0 || count($castsdetails_small)!=0){?>
         <section class="box-bg-grey container-lg details-cast"  id="details-cast">
            <div class="container-lg">
               <div class="container-custom">
                  <div class="details-cast-heading">cast</div>
				  <div class="details-cast-thumbnail-wrapper">
                  <div class="row row-no-gutter">
				  <div class="cast-more-info-container" style="display:none">
                                <div class="more-info-container">
                                   <div class="more-info-section">
                                      <div class="crew-info-block">
                                         <div class="close-button">
                                            <div class="close-btn float-right"></div>
                                         </div>
                                         <div class="actor-name"  id="cn1">
                                         </div>
                                         <div class="character-name" id="CN"></div>
                                         <div class="actor-awards" id="CD"></div>
                                      </div>
                                   </div>
                                </div>
								
                        </div>
						
				  <?php 
				  /* First Row  */
				 
		for($i=0;$i<2;$i++)
		{	
			if(count($castsdetails_large) >= ($i*2 + 2)) 
			{  				
			
	for($j=0;$j<2;$j++)
			{        
				$cast=$castsdetails_large[$i* 2+$j];
				?> 	
                      
				 
				   <div class="col-md-6 col-sm-6 col-xs-12 cast-thumbnail">
                            <div class="thumbnail-one" style="background-image:url('<?php echo $cast['image'] ?>');"></div>
                            <div class="headshot-details-container">
                            <div class="cast-actor-name"><?php echo $cast['actors_name']; ?></div>
                            <div class="cast-featured-work"><?php echo $cast['roles_in']; ?></div>
                            <div class="cast-info-notselected" onClick="info('<?php echo $cast['actors_name']; ?>','<?php echo $cast['character'];?>','<?php echo $cast['character_description'];?>')"></div>
                            <div class="arrow" style="display:none;"></div>
                            </div>    
                   </div>
	  <?php } ?>
                         <div class="clearfix"></div>  
                  
	  <?php } }
		
		/* End of First row */
		
					/* Second row start */
					if(count($castsdetails_small) >= 4 ) 
					{  	
 $x=0;
				   for($m=0;$m<4;$m++)
				   {	
$x++;
					$cast=$castsdetails_small[$m]; ?>	
		
		
		
                       <div class="col-md-3 col-sm-3 col-xs-6 cast-thumbnail">
                            <div class="thumbnail-two" style="background-image:url('<?php echo $cast['image'] ?>');"></div>
                            <div class="headshot-details-container">
                            <div class="cast-actor-name"><?php echo $cast['actors_name']; ?></div>
                            <div class="cast-featured-work"><?php echo $cast['roles_in']; ?></div>
                            <div class="cast-info-notselected" onClick="info('<?php echo $cast['actors_name']; ?>','<?php echo $cast['character'];?>','<?php echo $cast['character_description'];?>')"></div>
                            <div class="arrow" style="display:none;"></div>
                            </div>    
					 </div>
					<?php	if($x==2){  ?><div class="clearfix visible-xs"></div> <?php } ?>
						
						<?php } ?>
                       
                         <div class="clearfix"></div>  
 				  <?php } 
				
				if(count($castsdetails_large)<2 && count($castsdetails_small) < 4)
				{
				if(count($castsdetails_large)<2){
				for($m=0;$m<1;$m++)
				   {	

					$cast=$castsdetails_large[$m]; ?>
					 
                      <div class="col-md-6 col-sm-6 col-xs-12 cast-thumbnail">
                            <div class="thumbnail-two" style="background-image:url('<?php echo $cast['image'] ?>');"></div>
                            <div class="headshot-details-container">
                            <div class="cast-actor-name"><?php echo $cast['actors_name']; ?></div>
                            <div class="cast-featured-work"><?php echo $cast['roles_in']; ?></div>
                            <div class="cast-info-notselected" onClick="info('<?php echo $cast['character'];?>','<?php echo $cast['character_description'];?>')"></div>
                            <div class="arrow" style="display:none;"></div>
                            </div>    
					 </div>
						
						
						<?php } ?>
<div class="clearfix visible-xs"></div>
				<?php }
				
				
				if(count($castsdetails_small)<4){
				for($m=0;$m<2;$m++)
				   {	

					$cast=$castsdetails_small[$m]; ?>	
		
		
		
                       <div class="col-md-3 col-sm-3 col-xs-6 cast-thumbnail">
                            <div class="thumbnail-two" style="background-image:url('<?php echo $cast['image'] ?>');"></div>
                            <div class="headshot-details-container">
                            <div class="cast-actor-name"><?php echo $cast['actors_name']; ?></div>
                            <div class="cast-featured-work"><?php echo $cast['roles_in']; ?></div>
                            <div class="cast-info-notselected" onClick="info('<?php echo $cast['actors_name']; ?>','<?php echo $cast['character'];?>','<?php echo $cast['character_description'];?>')"></div>
                            <div class="arrow" style="display:none;"></div>
                            </div>    
					 </div>
						
						
						<?php } ?>
                       <div class="clearfix visible-xs"></div>
                         <div class="clearfix"></div>  
				<?php }?>
				
				</div>
		<?php	} 	
		
				  
				  
				  $count = count($castsdetails_small);
		if(($count >= 2 && $count < 4  && $image_full_size ) || ($count == 6 && $image_full_size))
		{
			$k = ($count >= 2 && $count < 4) ? 0 : 4;

			?>
	<?php 
		for($m=$k;$m<$k+2;$m++)
		{	
			$cast=$castsdetails_small[$m]; 
	?>
                       <div class="col-md-3 col-sm-3 col-xs-6 cast-thumbnail test1">
                            <div class="thumbnail-two" style="background-image:url('<?php echo $cast['image'] ?>');"></div>
							
                            <div class="headshot-details-container">
                            <div class="cast-actor-name"> <?php echo $cast['actors_name']; ?> </div>
                            <div class="cast-featured-work"><?php echo $cast['roles_in']; ?></div>
                            <div class="cast-info-notselected" onClick="info('<?php echo $cast['actors_name']; ?>','<?php echo $cast['character'];?>','<?php echo $cast['character_description'];?>')"></div>
                            <div class="arrow" style="display:none;"></div>
                      </div>    
 						<div class="clearfix visible-xs"></div>
						</div>
						<?php }  ?>     
				   <div class="col-md-6 col-sm-12 cast-thumbnail test">
				   <div class="thumbnail-one" style="background-image:url('<?php echo $image_full_size ?>');">
                            
							</div>
                        </div>
						 <div class="clearfix"></div>  
                  
				  <?php } ?> 
			</div>
      </div>
            </div>
	
      </section>
		<?php }?>
	  	
  <!--Cast Section ends-->
      <!--Crew Section starts-->
	  <?php if(get_field('produced_by') || get_field('directed_by') || get_field('written_by')){ ?>
      <section class="box-bg-grey container-lg details-crew" id="details-crew">
         <div class="container-lg position-relative">
		 <div class="crew-block-bw">
            <?php if(get_field('crew_background_image')){ ?>
            <div class="scripted-details-crew-image crew-block" style="background-image:url('<?php echo the_field('crew_background_image')?>');">
            </div>
			<?php } else{ ?>
			<div class="scripted-details-crew-image crew-block" style="background-image:url('http://images.sales.aenetworks.com/site-images/place-holder/show-card/sample_ae_stock.png');">
              </div> <?php } ?></div>
			<div class="details-crew-container">
                     <div class="container-custom">
                        <div class="details-crew-heading">Crew</div>
						<?php if(get_field('produced_by')) { ?>
                        <div class="details-wrapper">
						
                           <div class="crew-label">
                              <span class="float-right float-left-xs">produced by</span>
                           </div>
						   
                           <div class="crew-details">
                             <?php echo the_field('produced_by'); ?>
                           </div>
                           <div class="clearfix"></div>
                        </div>
						<?php } ?>
						
						<?php if(get_field('directed_by')) { ?>
                        <div class="details-wrapper">
                           <div class="crew-label">
                              <span class="float-right float-left-xs">directed by</span>
                           </div>
                           <div class="crew-details">
                              <?php echo the_field('directed_by'); ?>
                           </div>
                           <div class="clearfix"></div>
                        </div>
						<?php } ?>
						
						<?php if(get_field('written_by') ){ ?>
                        <div>
                           <div class="crew-label">
                              <span class="float-right float-left-xs">written by</span>
                           </div>
                           <div class="crew-details">
                              <?php echo the_field('written_by'); ?>
                           </div>
                           <div class="clearfix"></div>
                        </div>
						<?php } ?>
                     </div>
                  </div>
         </div>
      </section>
	  <?php } ?>
      <!--Crew Section ends-->
      
       <!--gallery Section starts-->
	  <?php
	  if(is_array($galleriesdetails)){ ?>
      <span class="anchor" id="details-gallery"></span>
      <section class="box-bg-grey container-lg details-gallery">
         <div class="container-lg">
            <div class="container-custom">
               <div class="details-gallery-heading">
                  image gallery
               </div>
            </div>
            <!-- CONTAINER -->
            <div class="container-custom">
                <div class=" full-gallery-image-container visible-lg visible-md hidden-sm hidden-xs" >
				<?php if(is_array($galleriesdetails)){  ?>
                    <div class="full-gallery-image active " >					
					<img src="<?php echo $galleriesdetails[0]['image_url']; ?>"  id="img-one" class="suggestions-img" alt="swiper-image"/>
                    
					</div>
                    
                </div>
            </div>
             </div>
               <!-- swiper start -->
               <div class="swiper-container-parent">
                  <!-- swiper container parent -->
                  <div class="swiper-container aswiper-two">
                     <div class="swiper-wrapper image-thumbnails-wrapper">
					 
					 <?php 	
							
							foreach ($galleriesdetails as $gallery) 
							{  
								if($gallery['image_url'])
								{
								?>
								
                        <a class="swiper-slide test" href="#img-one" onClick="image('<?php echo $gallery['image_url'];?>');">
						
                           <div class="swiper-slide-image position-relative" >
						   
                              <!--<img src="<?php //echo $gallery['image_url']; ?>" class="suggestions-img" alt="swiper-image" >-->
							  <picture>
                                       <source srcset="<?php echo $gallery['image_url']; ?>"  media="(min-width:992px)">
                                        <source srcset="<?php echo $gallery['image_url']; ?>" media="(min-width:768px)">
                                        <img src="<?php echo $gallery['image_url']; ?>" alt="swiper-image" style="width:100%;">
								</picture>
							  
                            <?php //$_SESSION=$gallery['gallery_id']; ?>
                            </div>
                        </a>
                        <?php } }  ?>
						<div style="display:block;color:white;"><p></p></div>
                     </div>
                     
                     <!-- Add Pagination -->
                     <div class="swiper-custom-pagination-tablet">
                        <div class="swiper-button-prev">
                           <div class="nav-left">
                              <i class="fa fa-angle-left" aria-hidden="true"></i>
                           </div>
                        </div>
                        <div class="swiper-pagination hidden-lg hidden-md"> </div>
                        <!-- Add Arrows -->
                        <div class="swiper-button-next">
                           <div class="nav-right">
                              <i class="fa fa-angle-right" aria-hidden="true"></i>
                           </div>
                        </div>
                     </div>
                     <!-- Add Pagination -->
                     <div class="swiper-custom-pagination-desktop">
                        <div class="swiper-pagination hidden-lg hidden-md"> </div>
                        <!-- Add Arrows -->
                        <div class="swiper-button-next">
                           <div class="nav-right">
                              <i class="fa fa-angle-right" aria-hidden="true"></i>
                           </div>
                        </div>
                        <div class="swiper-button-prev">
                           <div class="nav-left">
                              <i class="fa fa-angle-left" aria-hidden="true"></i>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- swiper end -->
            <?php } ?>
      </section>
	  <?php } ?>
      <!--gallery Section Ends-->
	
   <script>
   //Ratings script
      // var r1 = $("#r1").text().trim().length;
            // var s1 = $("#s1").text().trim().length;
            // var r2 = $("#r2").text().trim().length;
            // var s2 = $("#s2").text().trim().length;
            // var r3 = $("#r3").text().trim().length;
            // var s3 = $("#s3").text().trim().length;
            // var r4 = $("#r4").text().trim().length;
            // var s4 = $("#s4").text().trim().length;

            // if (((r1 || s1) != 0 && r2 == 0 && s2 == 0 && r3 == 0 && s3 == 0 && r4 == 0 && s4 == 0) ||
                // ((r2 || s2) != 0 && r1 == 0 && s1 == 0 && r3 == 0 && s3 == 0 && r4 == 0 && s4 == 0) ||
                // ((r3 || s3) != 0 && r2 == 0 && s2 == 0 && r1 == 0 && s1 == 0 && r4 == 0 && s4 == 0) ||
                // ((r4 || s4) != 0 && r2 == 0 && s2 == 0 && r3 == 0 && s3 == 0 && r1 == 0 && s1 == 0)) {
                // $('.statistics').addClass('statistics-one');
                // if(s2!=0 || s3!=0 || s4!=0){
                    // $(this).find('rating-statistics').addClass('test');
                // }
                
            // }
            // if ((r1 || s1) != 0 && (
                // ((r2 || s2) != 0 && r3 == 0 && s3 == 0 && r4 == 0 && s4 == 0) ||
                // (r2 == 0 && s2 == 0 && (r3 || s3) != 0 && r4 == 0 && s4 == 0) ||
                // (r2 == 0 && s2 == 0 && r3 == 0 && s3 == 0 && (r4 || s4) != 0))) {
                // $('.statistics').addClass('statistics-two');
            // }
            // if (r1 == 0 && s1 == 0 && (
                // ((r2 || s2) != 0 && (r3 || s3) != 0 && r4 == 0 && s4 == 0) ||
                // (r2 == 0 && s2 == 0 && (r3 || s3) != 0 && (r4 || s4) != 0) ||
                // ((r2 || s2) != 0 && r3 == 0 && s3 == 0 && (r4 || s4) != 0))) {
                // $('.statistics').addClass('no-feature-stat statistics-two');
            // }
            // if (r1 == 0 && s1 == 0 && (
                // ((r2 || s2) != 0 && (r3 || s3) != 0 && (r4 || s4) != 0) ||
                // ((r2 || s2) != 0 && (r3 || s3) != 0 && (r4 || s4) != 0) ||
                // ((r2 || s2) != 0 && (r3 || s3) != 0 && (r4 || s4) != 0))) {
                // $('.statistics').addClass('no-feature-stat');
            // }
			
			
			 var r1 = $("#r1").text().trim().length;
            var s1 = $("#s1").text().trim().length;
            var r2 = $("#r2").text().trim().length;
            var s2 = $("#s2").text().trim().length;
            var r3 = $("#r3").text().trim().length;
            var s3 = $("#s3").text().trim().length;
            var r4 = $("#r4").text().trim().length;
            var s4 = $("#s4").text().trim().length;

            if (((r1 || s1) != 0 && r2 == 0 && s2 == 0 && r3 == 0 && s3 == 0 && r4 == 0 && s4 == 0) ||
                ((r2 || s2) != 0 && r1 == 0 && s1 == 0 && r3 == 0 && s3 == 0 && r4 == 0 && s4 == 0) ||
                ((r3 || s3) != 0 && r2 == 0 && s2 == 0 && r1 == 0 && s1 == 0 && r4 == 0 && s4 == 0) ||
                ((r4 || s4) != 0 && r2 == 0 && s2 == 0 && r3 == 0 && s3 == 0 && r1 == 0 && s1 == 0)) {
                $('.statistics').addClass('statistics-one');
                if(s2!=0 || s3!=0 || s4!=0){
                    $(this).find('rating-statistics').addClass('test');
                }
                
            }
            if ((r1 || s1) != 0 && (
                ((r2 || s2) != 0 && r3 == 0 && s3 == 0 && r4 == 0 && s4 == 0) ||
                (r2 == 0 && s2 == 0 && (r3 || s3) != 0 && r4 == 0 && s4 == 0) ||
                (r2 == 0 && s2 == 0 && r3 == 0 && s3 == 0 && (r4 || s4) != 0))) {
                $('.statistics').addClass('statistics-two');
            }
            if (r1 == 0 && s1 == 0 && (
                ((r2 || s2) != 0 && (r3 || s3) != 0 && r4 == 0 && s4 == 0) ||
                (r2 == 0 && s2 == 0 && (r3 || s3) != 0 && (r4 || s4) != 0) ||
                ((r2 || s2) != 0 && r3 == 0 && s3 == 0 && (r4 || s4) != 0))) {
                $('.statistics').addClass('no-feature-stat statistics-two');
            }
            if (r1 == 0 && s1 == 0 && (
                ((r2 || s2) != 0 && (r3 || s3) != 0 && (r4 || s4) != 0) ||
                ((r2 || s2) != 0 && (r3 || s3) != 0 && (r4 || s4) != 0) ||
                ((r2 || s2) != 0 && (r3 || s3) != 0 && (r4 || s4) != 0))) {
                $('.statistics').addClass('no-feature-stat');
            }

   //Cast
   function image(value)
{
   
                document.getElementById("img-one").src=value;
   
}
   function info(value1,value2,value3)
{
  
                document.getElementById("cn1").innerHTML=value1;
                document.getElementById("CN").innerHTML="as" + " " + value2;
                
                document.getElementById("CD").innerHTML=value3;

}
//Avoid Expand search
$("#nav-search-click").click(function () {               
                $('.navbar-right').css("display", "block");
                $('.auto-search').css("display", "none");

            });
                                                
                                                
                                                
//Video password Protected Script

$(".on-click-login").click(function(){
        $(this).removeClass("play-btn");
        $(".password-protected-container").show();
        $(".password-protected-xs").show();
                                if($(window).width() < 768){
                var overViewHeight = $('.scripted-detail-title-section').outerHeight();
                $('.overview-block,.scripted-details-title-image').css("height",overViewHeight);
            }   

    });

$('#video-signin').click(function () {

    var vpass=$('#vauth').attr("vid-auth");
var val1=vpass.slice(3);
var val2=val1.split('').reverse().join('');
var val=val2.slice(3);
var videoPasswordVal = $('.video1').val();

//var x=document.getElementById("mobile-playframe").innerHTML;
if (videoPasswordVal === val) {
$('#protected-video').show();
    $('#micro-vid-link').hide();
                if($(window).width() < 768){
                var overViewHeight = $('.scripted-detail-title-section').outerHeight();
                $('.overview-block,.scripted-details-title-image').css("height",overViewHeight);
    }   

}
else{
    // $('.ms-alert').css("display", "block");
                $('.video1').addClass('validation-error');
}

    
    }); 
 
 $(".video1").keypress(function(e) {
    if(e.which == 13) {
       $("#video-signin").click();
   
    }
}); 
                                  
                                      $(".image-thumbnails-wrapper .swiper-slide").eq(0).addClass("selected");
             $(".swiper-slide-image").click(function () {
                                                                  $(".image-thumbnails-wrapper .swiper-slide").eq(0).removeClass("selected");
                                                                  $(this).parent().addClass("selected").siblings().removeClass("selected");
                var id=$('.swiper-slide.selected').attr('href');
                $(id).parent().addClass('active').siblings().removeClass('active');
             });
                                  
                                  
                                
</script>


     
       <?php get_footer(); ?>