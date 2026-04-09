<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package empath
 */

get_header();
	

	$shop_details_breadcrumb = is_single() && 'product' == get_post_type() ? ' no-breadcrumb-ttile' : '';
	$bg_url = !empty($bg_img) ? $bg_img : get_template_directory_uri() . '/assets/img/breadcrumb-mask.webp';
?>
<section class="empath__breadcrumb-wrapper authore_br" style="background-image:url(<?php echo esc_url($bg_url); ?>)">
	<div class="container">
		<div class="empath__bacrumb-inner">
			<?php echo empath_breadcrumb_callback();?>
		</div>
		<div class="authore__info">			
			<?php byteflows_theme_author_page();?>
		</div>
	</div>
</section>	
<section class="empath__blog-wrapper internal__pading">
	<div class="container-fluid">
		<div class="row">
		<?php while ( have_posts() ) : the_post(); ?>
			<div class="col-lg-3 col-xl-3 col-md-6">
				<div class="bytf__post-grid-clm-item search__page-post-item">
					<div class="bytf__feature-image">
						<a aria-label="name" href="<?php the_permalink();?>">
							<?php the_post_thumbnail( 'full' );?>
						</a>
						<?php 
						if('video' == get_post_format( get_the_ID() )){ ?>
							<span class="post_frmt_icon"><i class="far fa-play"></i></span>
						<?php 
						}elseif('gallery' == get_post_format( get_the_ID() )){ ?>
							<span class="post_frmt_icon">
								<svg width="20" height="19" viewBox="0 0 20 19" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M14.7524 18.3724C14.595 18.3724 14.4341 18.3524 14.2748 18.3108L1.38779 14.8598C0.393663 14.5856 -0.198852 13.5572 0.0611938 12.5639L1.47783 7.13134C1.56451 6.79789 1.90538 6.59539 2.24035 6.68469C2.57376 6.77137 2.77454 7.11302 2.68712 7.44721L1.27033 12.8806C1.1829 13.2156 1.38205 13.5613 1.71545 13.6531L14.595 17.1024C14.9258 17.1898 15.2674 16.9932 15.3541 16.664L15.794 14.8889C15.8775 14.5539 16.2158 14.3506 16.5508 14.4323C16.8858 14.5157 17.09 14.854 17.0074 15.1889L16.5658 16.9724C16.3432 17.8165 15.5833 18.3724 14.7524 18.3724L14.7524 18.3724Z" fill="black"/>
								<path d="M18.125 13.3723H5.20793C4.17384 13.3723 3.33289 12.5314 3.33289 11.4973V1.91362C3.33289 0.879533 4.17384 0.0385742 5.20793 0.0385742H18.125C19.1591 0.0385742 20 0.879533 20 1.91362V11.4973C20 12.5314 19.1591 13.3723 18.125 13.3723ZM5.20793 1.28861C4.86292 1.28861 4.58292 1.56861 4.58292 1.91362V11.4973C4.58292 11.8423 4.86292 12.1223 5.20793 12.1223H18.125C18.47 12.1223 18.75 11.8423 18.75 11.4973V1.91362C18.75 1.56861 18.47 1.28861 18.125 1.28861H5.20793Z" fill="black"/>
								<path d="M7.49974 5.8721C6.58054 5.8721 5.83298 5.12454 5.83298 4.20534C5.83298 3.28613 6.58054 2.53857 7.49974 2.53857C8.41895 2.53857 9.16635 3.28613 9.16635 4.20534C9.16635 5.12454 8.41899 5.8721 7.49974 5.8721ZM7.49974 3.78861C7.26966 3.78861 7.08302 3.97537 7.08302 4.20534C7.08302 4.4353 7.26966 4.62206 7.49974 4.62206C7.72971 4.62206 7.91632 4.4353 7.91632 4.20534C7.91632 3.97537 7.72971 3.78861 7.49974 3.78861ZM3.97458 12.5222C3.81465 12.5222 3.65461 12.4613 3.53296 12.3389C3.28882 12.0948 3.28882 11.6988 3.53296 11.4547L7.2997 7.68796C7.86979 7.11787 8.79724 7.11787 9.36639 7.68796L10.374 8.69549L13.469 4.98035C13.7456 4.64863 14.1516 4.45698 14.5825 4.45456C15.0458 4.42874 15.4208 4.63945 15.6999 4.96707L19.8484 9.80716C20.0733 10.0688 20.0425 10.4639 19.7808 10.6888C19.5183 10.9139 19.1242 10.883 18.8991 10.6214L14.7491 5.77963C14.694 5.71369 14.6266 5.71705 14.589 5.70533C14.5533 5.70533 14.484 5.71615 14.4291 5.78116L10.8957 10.0231C10.7831 10.1579 10.619 10.2397 10.444 10.2472C10.2656 10.2571 10.0973 10.1888 9.97387 10.0647L8.48231 8.57298C8.37641 8.46708 8.28894 8.46708 8.18308 8.57298L4.41635 12.3389C4.35849 12.3972 4.28965 12.4434 4.21382 12.4748C4.13799 12.5063 4.05667 12.5224 3.97458 12.5222Z" fill="black"/>
								</svg>
							</span>
						<?php } elseif('audio' == get_post_format( get_the_ID() )){?>
							<span class="post_frmt_icon">
								<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
								<g clip-path="url(#clip0_9653_21)">
								<path d="M11.5299 0.190362C10.6432 -0.183545 9.66422 0.00157259 8.9752 0.673448C8.95899 0.689268 8.94348 0.705752 8.92872 0.722901L4.50411 5.85954H3.12778C1.40536 5.85954 0.00402832 7.26087 0.00402832 8.98329V11.0137C0.00402832 12.7361 1.40536 14.1375 3.12778 14.1375H4.50415L8.92876 19.2741C8.94352 19.2913 8.95903 19.3078 8.97524 19.3236C9.43063 19.7676 10.0116 20 10.6091 20C10.9189 20 11.2332 19.9374 11.5365 19.8095C12.4192 19.4374 12.9675 18.6105 12.9675 17.6517C12.9675 17.2203 12.6179 16.8707 12.1866 16.8707C11.7552 16.8707 11.4056 17.2203 11.4056 17.6517C11.4056 18.1324 11.0414 18.3233 10.9297 18.3704C10.8182 18.4174 10.433 18.5431 10.0866 18.2252L5.45383 12.8469C5.38052 12.7618 5.28971 12.6935 5.1876 12.6467C5.08549 12.5999 4.97448 12.5757 4.86215 12.5757H3.12778C2.26657 12.5757 1.5659 11.875 1.5659 11.0138V8.98337C1.5659 8.12216 2.26657 7.42149 3.12778 7.42149H4.86215C4.97448 7.42149 5.08549 7.39725 5.1876 7.35044C5.2897 7.30363 5.38052 7.23534 5.45383 7.15024L10.0866 1.77192C10.4292 1.45767 10.8122 1.58286 10.9231 1.62958C11.0363 1.67728 11.4056 1.87083 11.4056 2.35673V13.747C11.4056 14.1784 11.7552 14.528 12.1866 14.528C12.6179 14.528 12.9675 14.1784 12.9675 13.747V2.35673C12.9676 1.39435 12.4167 0.564268 11.5299 0.190362ZM16.27 12.2455L16.2879 12.2126C16.4922 11.838 16.8723 11.1408 16.8723 9.99872C16.8723 8.81403 16.461 8.08833 16.2633 7.73954C16.0506 7.36435 15.5741 7.23251 15.1988 7.44521C14.8236 7.6579 14.6918 8.13446 14.9045 8.5097C15.0661 8.79485 15.3104 9.22587 15.3104 9.99872C15.3104 10.7426 15.0734 11.1773 14.9166 11.465L14.8975 11.5C14.6916 11.879 14.832 12.3532 15.211 12.559C15.3252 12.6213 15.4531 12.6539 15.5831 12.6539C15.86 12.6539 16.1284 12.5061 16.27 12.2455Z" fill="black"/>
								<path d="M17.4218 3.84134C17.1154 3.53783 16.6209 3.54017 16.3174 3.84662C16.0139 4.15306 16.0162 4.64751 16.3227 4.95103C17.6843 6.2997 18.4341 8.09122 18.4341 9.99552C18.4341 11.9037 17.6843 13.6974 16.3227 15.0461C16.0162 15.3496 16.0139 15.8441 16.3174 16.1505C16.3899 16.2239 16.4763 16.2822 16.5716 16.3219C16.6669 16.3616 16.7691 16.382 16.8723 16.3818C17.0781 16.3821 17.2757 16.3008 17.4218 16.1557C19.0818 14.5115 19.9959 12.3237 19.9959 9.99548C19.996 7.67115 19.0818 5.48556 17.4218 3.84134Z" fill="black"/>
								</g>
								<defs>
								<clipPath id="clip0_9653_21">
								<rect width="20" height="20" fill="white"/>
								</clipPath>
								</defs>
								</svg>

							</span>
						<?php }
						?>
					</div>
					<div class="bytf__content">
						<?php if(function_exists('empath_category_badge')){empath_category_badge();}?>
						<h3 class="bytf_post_title"><a aria-label="name" href="<?php the_permalink();?>"><?php the_title();?></a></h3>
						<div class="bytf__postmeta-info-wrapper">
							<div class="bytf__postmeta meta__dark">
								<ul class="d-flex align-items-center">
										<li class="authore"><?php empath_post_author_avatars(25); the_author_posts_link(); ?></li>

										<li><i class="fal fa-calendar"></i> <?php echo esc_html(get_the_time( get_option('date_format')));?></li>
								</ul>
							</div>
							<div class="bytf__bookmark bookmark__dark">
								<?php if(function_exists('empath_bookmark_trigger')){empath_bookmark_trigger();}?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php endwhile; ?> 
			<div class="empath-pagination">
                <?php
                empath_pagination( '
                <i class="fal fa-chevron-double-left"></i>',
                '<i class="fal fa-chevron-double-right"></i>',
                '',
                ['class' => ''] );
                ?>
            </div>
		</div>
	</div>
</section>
<?php
get_footer();