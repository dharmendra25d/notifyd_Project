<?php
/**
 * 
 * Template Name:  Play and learn
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
$lang=ICL_LANGUAGE_CODE;
$lang=ICL_LANGUAGE_CODE;

if($lang=='en'){
	$catslug='monthly-wines';
} else{
	$catslug='monthly-wines-'.$lang;
}

$args = array( 'post_type' => 'product', 'posts_per_page' => 2, 'product_cat' => $catslug, 'orderby' => 'ASC' );
$loop = new WP_Query( $args ); 
$date=explode('-',date('d-m-Y'));
$currmonth=$date[1];
$year=$date[2];

if((int)$month-6 > 0){
	$previous=$currmonth-6;
} else{
	$year=$date[2]-1;
	$previous=12+$currmonth-6;
}

$currentdate='1/'.$previous.'/'.$year;
$currendate=strtotime($currentdate);

$args = array(
	'post_type' => 'product',
	'meta_query' => array(
		array(
			'key' => 'wine_month_date',
			'value' => $currentdate,
			'compare' => '>',
			'type' => 'NUMERIC'
		)
	)
);

if($loop-> have_posts()) { 
	while ($loop-> have_posts() ) : $loop->the_post(); global $product; 
		$meta=get_post_meta($loop->post->ID);
		$price=get_post_meta($loop->post->ID,'_price',true);
		$newarray[$price]['html']=$product->get_price_html();
		$array[$price]=$loop->post->ID;
	endwhile;
}

ksort($array);

$date = date('Y-m-d h:i:s');
$x = new DateTime($date);
$start = new DateTime($date);
$start->modify("first day of -6 Months");
$start->modify("first second");
$start->format("Y-m-d H:i:s");
$start_time = $start->getTimestamp();
$x->modify("last day of last month");
$x->modify("last second");
$x->format("Y-m-d H:i:s");

$end_time = $x->getTimestamp();

global $wpdb;
$q = "Select distinct $wpdb->postmeta.post_id ,UNIX_TIMESTAMP(DATE_SUB(NOW(), INTERVAL 30 day)),DATE_SUB(NOW(), INTERVAL 30 day),$wpdb->postmeta.meta_value, FROM_UNIXTIME($wpdb->postmeta.meta_value) as wine_date from $wpdb->postmeta ,wpbeta_icl_translations t where $wpdb->postmeta.post_id= t.element_id  and  $wpdb->postmeta.meta_key = 'wine_month_date'  and t.language_code='".$lang."' order by $wpdb->postmeta.meta_value DESC";
$query = $wpdb->get_results($q);
$finalData = array();

if(isset($query) and is_array($query) and count($query)>0){
	foreach($query as $k=>$v){
		if($v->meta_value >= $start_time){
			$current = new DateTime($v->wine_date);
			$month = $current->format("m");
			if($month==$currmonth)
				$finalData['current-0'][] = $v;
			elseif($month==$currmonth-1)
				$finalData['current-1'][] = $v;
			elseif($month==$currmonth-2)
				$finalData['current-2'][] = $v;				
			elseif($month==$currmonth-3)
				$finalData['current-3'][] = $v;	
			elseif($month==$currmonth-4)
				$finalData['current-4'][] = $v;	
			elseif($month==$currmonth-5)
				$finalData['current-5'][] = $v;	
			else
				$finalData['current-6'][] = $v;
			unset($current);
		}
	}
}


//echo "<pre>";
//print_r($finalData);
//echo "</pre>";
//die;

$wine_challenges = get_usermeta( get_current_user_id(), 'wine_challenges');

$last_winechallenge_date = get_user_meta(get_current_user_id(), 'last_winechallenge_date', true);

$last_giveusopinion_date = get_user_meta(get_current_user_id(), 'last_giveusopinion_date', true);

$last_invitefriends_date = get_user_meta(get_current_user_id(), 'last_invitefriends_date', true);

get_header(); 
?>
<script src="http://code.jquery.com/jquery-1.4.2.min.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.validate.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.lightbox_me.js" type="text/javascript" charset="utf-8"></script>

<script type="text/javascript" charset="utf-8">
	jQuery(function() {
		function launch() {
			 jQuery('#sign_up').lightbox_me({centered: true, onLoad: function() { jQuery('#sign_up').find('input:first').focus()}});
		}
		
		jQuery('#try-1').click(function(e) {
			jQuery("#sign_up").lightbox_me({centered: true, onLoad: function() {
				$("#sign_up").find("input:first").focus();
			}});
			
			e.preventDefault();
		});
		
		
		jQuery('table tr:nth-child(even)').addClass('stripe');
	});
</script>

<script type="text/javascript" charset="utf-8">
	jQuery(function() {
		function launch() {
			 jQuery('#sign_up1').lightbox_me({centered: true, onLoad: function() { jQuery('#sign_up1').find('input:first').focus()}});
		}
		
		jQuery('#try-2').click(function(e) {
			jQuery("#sign_up1").lightbox_me({centered: true, onLoad: function() {
				jQuery("#sign_up1").find("input:first").focus();
			}});
			
			e.preventDefault();
		});
		
		
		jQuery('table tr:nth-child(even)').addClass('stripe');
	});
</script>
<script type="text/javascript" charset="utf-8">
	jQuery(function() {
		function launch() {
			 jQuery('#sign_up3').lightbox_me({centered: true, onLoad: function() { jQuery('#sign_up3').find('input:first').focus()}});
		}
		
		jQuery('#try-4').click(function(e) {
			jQuery("#sign_up3").lightbox_me({centered: true, onLoad: function() {
				jQuery("#sign_up3").find("input:first").focus();
			}});
			
			e.preventDefault();
		});
		
		
		jQuery('table tr:nth-child(even)').addClass('stripe');
	});
</script>
<script type="text/javascript" charset="utf-8">
	jQuery(function() {
		function launch() {
			 jQuery('#sign_up2').lightbox_me({centered: true, onLoad: function() { jQuery('#sign_up2').find('input:first').focus()}});
		}
		
		jQuery('#try-3').click(function(e) {
			jQuery("#sign_up2").lightbox_me({centered: true, onLoad: function() {
				jQuery("#sign_up2").find("input:first").focus();
			}});
			
			e.preventDefault();
		});
		
		
		jQuery('table tr:nth-child(even)').addClass('stripe');
	});
</script>
<script type="text/javascript" charset="utf-8">
	jQuery(function() {
		function launch() {
			 jQuery('#sign_up_no_action').lightbox_me({centered: true, onLoad: function() { jQuery('#sign_up_no_action').find('input:first').focus()}});
		}
		
		jQuery('.try-no-action').click(function(e) {
			jQuery("#sign_up_no_action").lightbox_me({centered: true, onLoad: function() {
				jQuery("#sign_up_no_action").find("input:first").focus();
			}});
			
			e.preventDefault();
		});
		
	});
</script>

<style>
#sign_up_no_action{
	background: url('<?php echo get_template_directory_uri(); ?>/img/popupback.png') repeat scroll 0 0 rgba(0, 0, 0, 0); 
	display: none; 
	height: 369px; width: 495px;
}
</style>

<div id="content"> <!--content div start here-->
	<div class="wrapper"> <!--wrapper div start here-->
		<div class="prodcut-page"> <!--productcut div start here-->

			<div id="progressbar">
				<div id="progress-wrap">
					<div style="width:<?php echo get_user_meta($current_user->id,'point',true) ?>%" id="progressed">
						<span><?php echo get_user_meta($current_user->id,'point',true) ?>%</span>
						<div id="progress-achieved-scale"></div>
					</div>
				</div>
				<ul>
					<li><?php _e('Beginner','wiineme') ?></li>
					<li><?php _e('Amateur','wiineme')?></li>
					<li><?php _e('Sommelier','wiineme')?></li>
					<li><?php _e('Wine guru','wiineme') ?></li>
				</ul>
			</div>
			<br/>
			<div class="product-image"><!--product-image div start here-->
				<h5><?php _e('Prize: A cool T-Shirt','wiineme') ?></h5>
				<img src="<?php echo get_template_directory_uri(); ?>/img/T-shirt.png"> 
			</div> <!--product-image div close here-->
			
			<div class="offers-50"> <a href="#"><img src="<?php echo get_template_directory_uri(); ?>/img/fifty.png"></a> </div>
			<div class="offers-a6"> <a href="#"><img src="<?php echo get_template_directory_uri(); ?>/img/a3.png"></a> </div>
			<div class="offers-a3"> <a href="#"><img src="<?php echo get_template_directory_uri(); ?>/img/a6.png"></a> </div>
			
			
			<!-- No Action can be done today -->
			<div id="sign_up_no_action" style=""> 
				<a id="close_x" class="close sprited" href="#"></a>
				<div class="faceboo-share-details"> <!----facebook share div start here--->
					<h5><?php echo _e('Cannot take this action more than once a day','wiineme'); ?></h5>
				</div> <!----facebook share div close here--->
			</div>

			<div class="take-action"><!--take-action div start here-->
				<h2><?php echo _e('TAKE ACTION TO WIN !','wiineme'); ?></h2>
				<div class="take-action-list"> <!--take-action-list div start here-->
					<div class="badge1"> 


						<a href="#" id="try-1"><img src="<?php echo get_template_directory_uri(); ?>/img/dadge.png"></a>


						<div id="sign_up"> 
							<a id="close_x" class="close sprited" href="#"></a>
							<div class="faceboo-share-details"> <!----facebook share div start here--->
								<h5>Share us on Twitter (+2%)</h5>
								<div class="social-share"> <a href="#" ><img src="<?php echo get_template_directory_uri(); ?>/img/twitter.png"></a></div><div class="social-share-button"> 
                                                              <textarea id="#titlecontent-twitter" rows="6" cols="25" class="share-textbox"></textarea></div>
                                                            </div>
                                                          <div class="send-buttons">
                                                            <a href="#"  id="sharecourse-twitter">Send</a>
                                                            </div>
								                
							 <!----facebook share div close here--->
							<div class="twitter-share-details"> <!---twitter share details div start here--->
								<h4>Share us on Facebook (+3%)</h4>
								<div class="social-share"> <a href="#" ><img src="<?php echo get_template_directory_uri(); ?>/img/facebook.png"></a> </div>
								<div class="social-share-button"> 
                                                              <textarea id="#titlecontent-facebook" rows="6" cols="25" class="share-textbox"></textarea></div>
                                                            </div>
                                                          <div class="send-buttons">
                                                            <a href="#" id="sharecourse-facebook">Send</a>
                                                            </div><!---twitter share details div close here--->
						</div>
						<script type="text/javascript">
						jQuery(document).ready(function(){
							jQuery("#sharecourse-facebook").click(function(){
								var titlecontent = jQuery('#titlecontent-facebook').val();
								window.open("http://www.facebook.com/sharer.php?s=100&p[title]=" + titlecontent + "&p[summary]=<?php echo $content; ?>&p[url]=<?php echo site_url(); ?>",'sharer','toolbar=0,status=0,width=548,height=325');
							});	

							jQuery("#sharecourse-twitter").click(function(){
								var titlecontent = jQuery('#titlecontent-twitter').val();
								window.open("https://twitter.com/intent/tweet?text=" + titlecontent + "&url=<?php site_url(); ?>",'sharer','toolbar=0,status=0,width=548,height=325');
							});
						});
						</script>

					</div><!---badge1 div close here--->

					<div class="badge2"><!---badge2 div start here--->
						
						<?php if($last_invitefriends_date == strtotime(date('Y-m-d'))){ ?>
						<a href="javascript:;" class="try-no-action" ><img src="<?php echo get_template_directory_uri(); ?>/img/invitefriend.png"></a>
						<?php } else { ?>
						<a href="#" id="try-2"><img src="<?php echo get_template_directory_uri(); ?>/img/invitefriend.png"></a>
						<?php } ?>

						<div id="sign_up1"><!--sign up1 div start here-->
							<a id="close_x" class="close sprited" href="#"></a>
							<div class="invite-friend"> <img src="<?php echo get_template_directory_uri(); ?>/img/invitefriend-small.png"> </div>
							<div class="invite-text-heading"><?php _e('Invite Friends (+5pts)','wiineme') ?></div>
							<div class="feedback-bg"><!---feedback bg div start here--> 
								
								<form id="frmInviteFriends" method="post" name="frmInviteFriends">
								<input type="text" placeholder="<?php _e('Email 1 (required)','wiineme')?>" value="" name="email1" class="required email textbox"/>
								<input type="text" placeholder="<?php _e('Email 2 (required)','wiineme')?>" value="" name="email2" class="required email textbox"/>
								<input type="text" placeholder="<?php _e('Email 3 (required)','wiineme')?>" value="" name="email3" class="required email textbox"/>

								  <div class="send-buttons">
                                                            
									<a href="#"  onclick="javascript: jQuery('#frmInviteFriends').submit();"> Send</a>
								</div>
								
								<?php wp_nonce_field( basename( __FILE__ ), 'wineinvitefriends_nonce' ); ?>
								<input type="hidden" name='sendinvitefriend' >
								<script type="text/javascript">
								jQuery(document).ready(function(){
									jQuery("#frmInviteFriends").validate();	
								});
								</script>

								</form>
							</div> <!---feedback bg div close here--> 
						</div> <!--sign up1 div close here-->
					</div><!---badge2 div close here--->
					
					<div class="badge3"> <!---badge3 div start here--->
						
						<?php if($last_giveusopinion_date == strtotime(date('Y-m-d'))){ ?>
						<a href="javascript:;" class="try-no-action" ><img src="<?php echo get_template_directory_uri(); ?>/img/give-us.png"></a>
						<?php } else { ?>
						<a href="#add-opinion" id="try-3"><img src="<?php echo get_template_directory_uri(); ?>/img/give-us.png"></a>
						<?php } ?>

						<div id="sign_up2">                       
							<a id="close_x" class="close sprited" href="#"></a>
							<div class="feedback-icon">
								<img src="<?php echo get_template_directory_uri(); ?>/img/thumb-icon.png"> 
							</div>

							<div class="feedback-text-heading">
							<?php _e('Your Opinion Matters','wiineme') ?>
							</div>

							<div class="feedback-bg">  
								<form id="frmWineOpinion" method="post" name="frmWineOpinion">
								<h6><?php _e('How would you rate the website?','wiineme') ?></h6>

								<div class="start-buttons">
									<ul class="starsranking ratingsite" style="left:0 !important; top: inherit !important; position: inherit !important;">
									   <li class="star_1" id='ratingsiteli1' onclick="rating('1', 'ratingsite')">*</li>
										<li class="star_2" id='ratingsiteli2'onclick="rating('2', 'ratingsite')">*</li>
										<li class="star_3" id='ratingsiteli3' onclick=" rating('3', 'ratingsite')">*</li>
										<li class="star_4" id='ratingsiteli4' onclick="rating('4', 'ratingsite')">*</li>
										<li class="star_5" id='ratingsiteli5' onclick="rating('5', 'ratingsite')">*</li>
									</ul>
									<input type='hidden' value='' name='ratingsite' id='ratingsite'/>
								</div> 

								<input type="text" class="feedback-textbox" placeholder="<?php _e('What would you improve?','wiineme')?>" value="" name="comment_site">
								<h6><?php _e('How would you rate the wines?','wiineme') ?></h6>

								<div class="start-buttons">
									<ul class="starsranking ratingwines" style="left:0 !important; top: inherit !important; position: inherit !important;">
									   <li class="star_1" id='ratingwinesli1' onclick="rating('1', 'ratingwines')">*</li>
										<li class="star_2" id='ratingwinesli2'onclick="rating('2', 'ratingwines')">*</li>
										<li class="star_3" id='ratingwinesli3' onclick=" rating('3', 'ratingwines')">*</li>
										<li class="star_4" id='ratingwinesli4' onclick="rating('4', 'ratingwines')">*</li>
										<li class="star_5" id='ratingwinesli5' onclick="rating('5', 'ratingwines')">*</li>
									</ul>
									<input type='hidden' value='' name='ratingwines' id='ratingwines'/>
								</div>
								
								<input type="text" class="feedback-textbox" placeholder="<?php _e('Why?','wiineme')?>" value="" name="comment_wines" class="required">

								<h6><?php _e('How would you rate the service?','wiineme') ?></h6>
									
								<div class="start-buttons">
									<ul class="starsranking ratingservice" style="left:0 !important; top: inherit !important; position: inherit !important;">
									   <li class="star_1" id='ratingserviceli1' onclick="rating('1', 'ratingservice')">*</li>
										<li class="star_2" id='ratingserviceli2'onclick="rating('2', 'ratingservice')">*</li>
										<li class="star_3" id='ratingserviceli3' onclick=" rating('3', 'ratingservice')">*</li>
										<li class="star_4" id='ratingserviceli4' onclick="rating('4', 'ratingservice')">*</li>
										<li class="star_5" id='ratingserviceli5' onclick="rating('5', 'ratingservice')">*</li>
									</ul>
								</div>
								<input type="text" class="feedback-textbox" placeholder="<?php _e('Comments?','wiineme')?>" value="" name="comment_services" class="required">

								<div class="send-buttons">
                                                            
												<a href="#" onclick="javascript: jQuery('#frmWineOpinion').submit();">Send</a>
								</div>
								<?php wp_nonce_field( basename( __FILE__ ), 'wineopinion_nonce' ); ?>
								<input type="hidden" name='sendwineopinion' >
								<script type="text/javascript">
								jQuery(document).ready(function(){
									jQuery("#frmWineOpinion").validate();	
								});
								</script>
								</form>
							</div>  
							
						</div>
					</div><!---badge3 div close here--->
				</div> <!--take-action-list div close here-->
	
				<hr class="clear">

				<div class="win">
					<ul id="listVins">
						<?php
						$count=0;
						foreach($finalData as $key=> $wines) { 
							$keyCountArray = explode('-', $key);
							$keyCount = (isset($keyCountArray[1]))?(int)$keyCountArray[1]:0;
							$thismonth=$currmonth-$count;
						?>
						<li>
							<ul class="monthVin" id="challenges">
								<li class="headwl">
									<h2><?php echo date("F", strtotime(date("d-$thismonth-y"))); ?></h2>
								</li>
								
								<?php foreach($wines as $keyWine =>$wine){ 
										if($keyWine>1){
											break;
										}

										$product = new WC_Product();
										$product->id = $wine->post_id;

										$productmeta = get_post_meta($wine->post_id);

										$colorTest = get_post_meta($wine->post_id, 'good_answer_for_the_eye_test', true);
										$smellTest = get_post_meta($wine->post_id, 'good_answer_for_the_smell_test', true);
										$tasteTest = get_post_meta($wine->post_id, 'good_answer_for_the_taste_test', true);
										
								?>
								<li>
									<a href="<?php echo get_permalink( $wine->post_id); ?>" class="hearwlClass">
									<?php echo get_the_post_thumbnail( $wine->post_id, 'medium', array( 75 , 265) ) ?>						
									<span class="titleVin"><?php echo get_the_title($wine->post_id); ?></span>
									<span class="locationVin"><?php echo get_post_meta($wine->post_id, 'year', true); ?></span>
									</a>

									<a href="#">
										<div class="action-buttons">
											<?php echo _e("REORDER", "wiineme"); ?>
                                        </div>
                                    </a>

									<div class="blind">
										<?php if($last_winechallenge_date == strtotime(date('Y-m-d'))){ ?>
										<a href="#challengegame" class="challenge" <?php if(array_key_exists($wine->post_id, $wine_challenges)){ echo "style='display:none;'"; } ?> onclick="javascript: alert('<?php echo _e('Cannot take this action more than once a day','wiineme'); ?>');">
											<div class="action-buttons1">
											<?php echo _e("BLIND TESTING", "wiineme"); ?>
											</div>
										</a>
										<?php } else { ?>
										<a href="#challengegame" class="challenge togglechallenge" <?php if(array_key_exists($wine->post_id, $wine_challenges)){ echo "style='display:none;'"; } ?>>
											<div class="action-buttons1">
												<?php echo _e("BLIND TESTING", "wiineme"); ?>
                                            </div>
										</a>
										<?php } ?>
										<span class="plusonepercent" <?php if(array_key_exists($wine->post_id, $wine_challenges)){ echo "style='display:block;'"; } ?>>+1%</span>
									</div>

								
									<div class="challengegame" style="display:none;">
										<h4><?php echo _e("Describe the color", "wiineme"); ?></h4>
										<select name="Color" class="wineType" name='Color' id="falsePrototype-<?php echo $wine->post_id; ?>">
											<option value="1" selected="selected" name='color'><?php echo _e("Color", "wiineme"); ?></option>
											<option value="<?php _e('White','wiineme')?>"><?php _e('White','wiine.me')?></option>
											<option value="<?php _e('Red','wiineme')?>"><?php _e('Red','wiine.me')?></option>
											<option class="" value="<?php _e('Rosé','wiineme')?>"><?php _e('Rosé','wiine.me')?></option>
											<option value="<?php _e('Sparkling wine','wiineme')?>"><?php _e('Sparkling wine','wiineme')?></option>
										</select>
										<div class="notification correct"><?php echo _e("Good answer!", "wiineme"); ?></div>
										<div class="notification false"><?php echo _e("Wrong answer :(", "wiineme"); ?></div>
										<h4><?php echo _e("Describe the smell", "wiineme"); ?></h4>
										<select name="Smell" class="wineType" name='Smell' id="correctPrototype-<?php echo $wine->post_id; ?>">
											<option value="<?php _e('Smell','wiineme')?>" selected="selected"><?php _e('Smell','wiineme')?></option>
											<option value="<?php _e('Dried fruits','wiineme')?>"><?php _e('Dried fruits','wiineme')?></option>
											<option value="<?php _e('Spicy','wiineme')?>"><?php _e('Spicy','wiineme')?></option>
											<option value="<?php _e('Floral','wiineme')?>"><?php _e('Floral','wiineme')?></option>
											<option value="<?php _e('Herbaceous','wiineme')?>"><?php _e('Herbaceous','wiineme')?></option>
											<option value="<?php _e('Nutty','wiineme')?>"><?php _e('Nutty','wiineme')?></option>
											<option value="<?php _e('Caramel','wiineme')?>"><?php _e('Caramel','wiineme')?></option>
											<option value="<?php _e('Woody','wiineme')?>"><?php _e('Woody','wiineme')?></option>
											<option value="<?php _e('Earthy','wiineme')?>"><?php _e('Earthy','wiineme')?></option>
											<option value="<?php _e('Resineous','wiineme')?>"><?php _e('Resineous','wiineme')?></option>
											<option value="<?php _e('Burned','wiineme')?>"><?php _e('Burned','wiineme')?></option>
											<option value="<?php _e('Tobacco','wiineme')?>"><?php _e('Tobacco','wiineme')?></option>
											<option value="<?php _e('Tropical fruits','wiineme')?>"><?php _e('Tropical fruits','wiineme')?></option>
											<option value="<?php _e('Citrus','wiineme')?>"><?php _e('Citrus','wiineme')?></option>
											<option value="<?php _e('Olive','wiineme')?>"><?php _e('Olive','wiineme')?></option>
											<option value="<?php _e('Mineral','wiineme')?>"><?php _e('Mineral','wiineme')?></option>
										</select>

										<h4><?php echo _e("Describe the taste", "wiineme"); ?></h4>
										<select name="Taste" class="wineType"name='Taste' id="finalPrototype-<?php echo $wine->post_id; ?>">
											<option value="1" selected="selected"><?php _e('Taste','wiineme')?></option>
											<option value="<?php _e('Sweet','wiineme')?>"><?php _e('Sweet','wiineme')?></option>
											<option value="<?php _e('Bitter','wiineme')?>"><?php _e('Bitter','wiineme')?></option>
											<option value="<?php _e('Strong tanins','wiineme')?>"><?php _e('Strong tanins','wiineme')?></option>
											<option value="<?php _e('Salty','wiineme')?>"><?php _e('Salty','wiineme')?></option>
											<option value="<?php _e('Acid','wiineme')?>"><?php _e('Acid','wiineme')?></option>
										</select>
										<div class="clear"></div>
										
										<input type="hidden" id="colortest-<?php echo $wine->post_id; ?>" value="<?php echo $colorTest; ?>" />
										<input type="hidden" id="smelltest-<?php echo $wine->post_id; ?>" value="<?php echo $smellTest; ?>" />
										<input type="hidden" id="tastetest-<?php echo $wine->post_id; ?>" value="<?php echo $tasteTest; ?>" />

										<script type="text/javascript">
										jQuery(document).ready(function ($) {
											$(".challengegame select#correctPrototype-<?php echo $wine->post_id; ?>").on('change', function(e){

												if(jQuery('#smelltest-<?php echo $wine->post_id; ?>').val() === jQuery('#correctPrototype-<?php echo $wine->post_id; ?>').val()){
													$(this).closest('.challengegame').find(".correct").css({ display: "block" }).animate({ opacity: "1", top: "-40px" }, "slow").delay(250).fadeOut();
												} else {
													$(this).closest('.challengegame').find(".false").css({ display: "block" }).animate({ opacity: "1", top: "-40px" }, "slow").delay(250).fadeOut();
												}
											});
											
											$(".challengegame select#falsePrototype-<?php echo $wine->post_id; ?>").on('change', function(e){
												if(jQuery('#colortest-<?php echo $wine->post_id; ?>').val() === jQuery('#falsePrototype-<?php echo $wine->post_id; ?>').val()){
													$(this).closest('.challengegame').find(".correct").css({ display: "block" }).animate({ opacity: "1", top: "-40px" }, "slow").delay(250).fadeOut();
												} else {
													$(this).closest('.challengegame').find(".false").css({ display: "block" }).animate({ opacity: "1", top: "-40px" }, "slow").delay(250).fadeOut();
												}
											});
											
											$(".challengegame select#finalPrototype-<?php echo $wine->post_id; ?>").on('change', function(e){

												if(jQuery('#tastetest-<?php echo $wine->post_id; ?>').val() === jQuery('#finalPrototype-<?php echo $wine->post_id; ?>').val()){
													$(this).closest('.challengegame').find(".correct").css({ display: "block" }).animate({ opacity: "1", top: "-40px" }, "slow").delay(250).fadeOut();
												} else {
													$(this).closest('.challengegame').find(".false").css({ display: "block" }).animate({ opacity: "1", top: "-40px" }, "slow").delay(250).fadeOut();
												}
												
												if(jQuery('#finalPrototype-<?php echo $wine->post_id; ?>').val() !== '' && jQuery('#correctPrototype-<?php echo $wine->post_id; ?>').val() !== '' && jQuery('#falsePrototype-<?php echo $wine->post_id; ?>').val() !== '' ){
													$(this).closest('.challengegame').delay(1500).slideUp();
													$(this).closest('li').find(".plusonepercent").delay(1500).show();
													$(this).closest('li').find(".challenge").delay(1500).hide();
													
													jQuery('#wineid').val("<?php echo $wine->post_id; ?>");
													jQuery('#frmWineChallenge').submit();
												}

											});
										});
										</script>
									</div>
									<br/>
									<div class="ad-to-wishlist heart-image">
										<img src="<?php echo get_template_directory_uri(); ?>/img/T-shirt_heart.png">
										<a href="#" id="try-4"><?php echo _e("Add to Wish List", "wiineme"); ?></a>
										
										 
                                                               
                                                      
                                        <!--<a href="#"id="try-4">Add to Wish List</a> -->
                                            
                                             <div id="sign_up3"> <!--sign up1 div start here-->
                                                               
                                                      <a id="close_x" class="close sprited" href="#"></a>
                                                               
                                                <div class="add-to-wishlist-bottle">
                                                        
                                                        <img src="<?php echo get_template_directory_uri(); ?>/img/pop-bottle.png">
                                                        </div> 
                                             
                                                <div class="add-to-text">
                                                       <h3> How many bottles do
                                      you want to add in your
                                                  wishlist ?</h3>

                                                <select class="dropdown-option">
                                                  <option value="0">----0---</option>
                                                  <option value="1">1</option>
                                                  <option value="2">2</option>
                                                  <option value="3">3</option>
                                                  <option value="4">4</option>
                                                  <option value="5">5</option>
                                                  <option value="6">6</option>
                                                  <option value="7">7</option>
                                                  <option value="8">8</option>
                                                  <option value="9">9</option>
                                                </select>

<a href="#">
                                            <div class="add-button">
                                            
                                            Add
                                            </div>
                                            </a>

                                                        </div>
                                             
                                             
                                             
                                             
                                             
                                                 </div> <!--sign up3 div close here-->
                                            
                                           
                                            
									</div>
								</li>
								<?php } ?>

								
								<li style="clear:both;float:none"></li>
							</ul>
							<div class="clear"></div>
						</li>
						<?php $count++; } ?>
					</ul>
				</div>

			</div>  <!--take-action div close here-->
		</div><!--course details div close here-->
	</div> <!--wrapper div close here-->
</div><!-- Content div close here -->

<form action="" method="post" id="frmWineChallenge">
<?php wp_nonce_field( basename( __FILE__ ), 'winechallenge_nonce' ); ?>
<input type="hidden" value="" name="wineid" id="wineid">
</form>

<script type="text/javascript">
function rating(ratingvalue, id){
	jQuery('#'+id+'').val(ratingvalue);
}
</script>
<script type="text/javascript">
		$(document).ready(function() {
			$('.fancybox').fancybox();
</script>
<?php get_footer(); ?>