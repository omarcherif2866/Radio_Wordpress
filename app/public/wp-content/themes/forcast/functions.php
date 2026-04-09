<?php
/**
 * empath functions and definitions
 * @package empath
 */

define( 'QUBAR_THEME_DRI', get_template_directory() );
define( 'QUBAR_INC_DRI', get_template_directory() . '/inc/' );
define( 'QUBAR_THEME_URI', get_template_directory_uri() );
define( 'QUBAR_CSS_PATH', QUBAR_THEME_URI . '/assets/css' );
define( 'QUBAR_JS_PATH', QUBAR_THEME_URI . '/assets/js' );
define( 'QUBAR_IMG_PATH', QUBAR_THEME_URI . '/assets/images' );
define( 'QUBAR_ADMIN_DRI', QUBAR_THEME_DRI . '/admin' );

function qubar_setup() {
	load_theme_textdomain( 'forcast', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_image_size('empath-img-size', 873, 450, true);
	add_theme_support( 'title-tag' );
	remove_theme_support( 'widgets-block-editor' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support('post-formats', array('standard','image','video','gallery','audio'));
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
	register_nav_menus( array('menu-1' => esc_html__( 'Primary', 'forcast' )));
	add_theme_support( 'html5', array('search-form','comment-form','comment-list','gallery','caption','style','script'));
	add_theme_support( 'custom-background', apply_filters( 'empath_custom_background_args', array('default-color'=>'ffffff','default-image'=>'')));
	add_theme_support( 'customize-selective-refresh-widgets' );
}
add_action( 'after_setup_theme', 'qubar_setup' );

function empath_content_width() { $GLOBALS['content_width'] = apply_filters( 'empath_content_width', 640 ); }
add_action( 'after_setup_theme', 'empath_content_width', 0 );

function empath_widgets_init() {
	register_sidebar(array('name'=>esc_html__('Sidebar','forcast'),'id'=>'sidebar-1','description'=>esc_html__('Add widgets here.','forcast'),'before_widget'=>'<div id="%1$s" class="empath__sidebar-item %2$s">','after_widget'=>'</div>','before_title'=>'<h3 class="widget-title">','after_title'=>'</h3>'));
	register_sidebar(array('name'=>esc_html__('Shop Siderbar','forcast'),'id'=>'shop-sidebar-1','description'=>esc_html__('Add widgets here.','forcast'),'before_widget'=>'<div id="%1$s" class="widget mt-30 %2$s">','after_widget'=>'</div>','before_title'=>'<h2 class="widget__title">','after_title'=>'</h2>'));
}
add_action( 'widgets_init', 'empath_widgets_init' );

function tre_enable_registration() { update_option('users_can_register', 1); }
add_action('init', 'tre_enable_registration');

if ( ! function_exists( 'empath_fonts_url' ) ) :
function empath_fonts_url() {
	$fonts_url=''; $font_families=array(); $subsets='latin';
	if('off'!==_x('on','Inter: on or off','forcast')) $font_families[]='Inter:100,200,300,400,500,600,700,800,900';
	if('off'!==_x('on','Outfit: on or off','forcast')) $font_families[]='Outfit:100,200,300,400,500,600,700,800,900';
	if($font_families) $fonts_url=add_query_arg(array('family'=>urlencode(implode('|',$font_families)),'subset'=>urlencode($subsets)),'https://fonts.googleapis.com/css');
	return esc_url_raw($fonts_url);
}
endif;

function empath_scripts() {
	wp_enqueue_style('empath-google-fonts',empath_fonts_url(),array(),null);
	wp_enqueue_style('bootstrap',QUBAR_CSS_PATH.'/bootstrap.min.css');
	wp_enqueue_style('fontawesome',QUBAR_CSS_PATH.'/fontawesome.css');
	wp_enqueue_style('empath-swiper',QUBAR_CSS_PATH.'/swiper.min.css');
	wp_enqueue_style('mb-ytplayer',QUBAR_CSS_PATH.'/mb-ytplayer.min.css');
	wp_enqueue_style('metis-menu',QUBAR_CSS_PATH.'/metis-menu.css');
	wp_enqueue_style('e-animations',QUBAR_CSS_PATH.'/animate.css');
	wp_enqueue_style('slick',QUBAR_CSS_PATH.'/slick.css');
	wp_enqueue_style('forcast-core',QUBAR_CSS_PATH.'/forcast-core.css');
	$your_curnt_lang=apply_filters('wpml_current_language',NULL);
	if(is_rtl()&&$your_curnt_lang!='en') wp_enqueue_style('forcast-rtl',QUBAR_CSS_PATH.'/rtl.css');
	wp_enqueue_style('forcast-style',get_stylesheet_uri(),array());
	wp_enqueue_script('jquery-ui-core');
	wp_enqueue_script('jquery-ui-slider');
	wp_enqueue_script('bootstrap',QUBAR_JS_PATH.'/bootstrap.min.js',array('jquery'),'1.0',true);
	wp_enqueue_script('jquery-marquee',QUBAR_JS_PATH.'/jquery.marquee.min.js',array('jquery'),'1.0',true);
	wp_enqueue_script('empath-swiper-bundle',QUBAR_JS_PATH.'/swiper-bundle.min.js',array('jquery'),'1.0',true);
	wp_enqueue_script('mb-YTPlayer',QUBAR_JS_PATH.'/mb-YTPlayer.min.js',array('jquery'),'1.0',true);
	wp_enqueue_script('metisMenu',QUBAR_JS_PATH.'/metisMenu.min.js',array('jquery'),'1.0',true);
	wp_enqueue_script('slick',QUBAR_JS_PATH.'/slick.min.js',array('jquery'),'1.0',true);
	wp_enqueue_script('forcast-core',QUBAR_JS_PATH.'/forcast-core.js',array('jquery'),time(),true);
	wp_localize_script('forcast-core','bookmarkAjax',array('ajaxurl'=>admin_url('admin-ajax.php'),'nonce'=>wp_create_nonce('bookmark_nonce')));
	wp_localize_script('forcast-core','empath_ajax',array('ajax_url'=>admin_url('admin-ajax.php'),'post_scroll_limit'=>5,'nonce'=>wp_create_nonce('empath-nonce')));
	if(is_singular()&&comments_open()&&get_option('thread_comments')) wp_enqueue_script('comment-reply');
}
add_action('wp_enqueue_scripts','empath_scripts');

function qubar_add_defer_attribute($tag,$handle) {
	$scripts_to_defer=array('bootstrap','jquery-marquee','empath-swiper-bundle','mb-YTPlayer','metisMenu','slick','forcast-core');
	if(in_array($handle,$scripts_to_defer)) return str_replace(' src',' defer src',$tag);
	return $tag;
}
add_filter('script_loader_tag','qubar_add_defer_attribute',10,2);

require QUBAR_THEME_DRI.'/inc/custom-header.php';
require QUBAR_THEME_DRI.'/inc/template-tags.php';
require QUBAR_THEME_DRI.'/inc/breadcrumb-core.php';
require QUBAR_THEME_DRI.'/inc/class-wp-qubar-navwalker.php';
require QUBAR_THEME_DRI.'/inc/template-functions.php';
require QUBAR_THEME_DRI.'/inc/qubar-functions.php';
require QUBAR_THEME_DRI.'/inc/cs-framework-functions.php';
require QUBAR_THEME_DRI.'/inc/dynamic-style.php';
require QUBAR_THEME_DRI.'/inc/qubar-helper-class.php';
require QUBAR_THEME_DRI.'/inc/admin/class-admin-dashboard.php';
require QUBAR_THEME_DRI.'/inc/admin/demo-import/functions.php';
require QUBAR_THEME_DRI.'/inc/customizer.php';
require QUBAR_THEME_DRI.'/bookmark/functions.php';

if(defined('JETPACK__VERSION')) require QUBAR_THEME_DRI.'/inc/jetpack.php';

function empath_woo_theme_init() {
	$empath_exlude_hooks=require QUBAR_THEME_DRI.'/inc/remove_actions.php';
	foreach($empath_exlude_hooks as $k=>$v) foreach($v as $value) remove_action($k,$value[0],$value[1]);
}
add_action('init','empath_woo_theme_init');

function empath_megamenu_enable() { return true; }
add_filter('th_enable_megamenu','empath_megamenu_enable');

function bytf_filter_search_query($query) {
	if($query->is_search&&!is_admin()) $query->set('post_type','post');
	return $query;
}

function tre_radio_custom_logout() {
	if(isset($_GET['tre_logout'])&&$_GET['tre_logout']=='1'&&is_user_logged_in()) {
		wp_logout(); wp_redirect(home_url()); exit;
	}
}
add_action('init','tre_radio_custom_logout');

function tre_radio_header_buttons() {
	if(is_user_logged_in()) {
		$current_user=wp_get_current_user();
		$display_name=esc_js($current_user->display_name);
		$logout_url=esc_js(add_query_arg('tre_logout','1',home_url()));
		$logged_in='true';
	} else { $display_name=''; $logout_url=''; $logged_in='false'; }
	$login_url=esc_url(home_url('/login'));
	$register_url=esc_url(home_url('/register'));
    ?>
    <script>
document.addEventListener("DOMContentLoaded",function(){
	var nav=document.getElementById("byteflows-category-nav");
	if(!nav)return;
	if(<?php echo $logged_in;?>){
		var userBtn=document.createElement("div");
		userBtn.className="btn-user-connected";
		userBtn.innerHTML = '<a href="<?php echo home_url('/mon-profil'); ?>" class="user-name" style="text-decoration:none;color:inherit;">&#128100; <?php echo $display_name;?></span><a href="<?php echo $logout_url;?>" class="btn-logout">&#9099; D&eacute;connexion</a>';
		nav.appendChild(userBtn);
	}else{
		var register=document.createElement("a");
		register.href="<?php echo $register_url;?>";register.className="btn-register";register.innerText="S'INSCRIRE";nav.appendChild(register);
		var signin=document.createElement("a");
		signin.href="<?php echo $login_url;?>";signin.className="btn-signin";signin.innerText="SE CONNECTER";nav.appendChild(signin);
	}
});
</script>
<?php
}
add_action('wp_footer','tre_radio_header_buttons');

function tre_radio_no_redirect_logged_in() {
	if(!is_user_logged_in())return;
	global $post; if(!isset($post))return;
	$restricted_slugs=array('login','register','sign-in','signup','inscription');
	if(in_array($post->post_name,$restricted_slugs)){
		remove_action('template_redirect','wppb_redirect_to_custom_login',10);
		remove_action('template_redirect','wppb_redirect_to_custom_register',10);
	}
}
add_action('template_redirect','tre_radio_no_redirect_logged_in',1);
add_filter('wppb_redirect_after_login_url',function($url){return '';});
add_filter('pre_get_posts','bytf_filter_search_query');

// ================================================================
// HELPER COMMUN
// ================================================================
function tre_sel($saved, $val) {
	return (isset($saved) && $saved === $val) ? 'selected' : '';
}

// CSS commun pour les 3 espaces
function tre_common_css() { ?>
<style>
.tre-espace { max-width: 820px; margin: 0 auto; font-family: 'Segoe UI', sans-serif; }
.tre-progress { display: flex; align-items: center; justify-content: center; margin-bottom: 36px; }
.tre-step { display: flex; flex-direction: column; align-items: center; gap: 6px; }
.tre-step-circle { width: 38px; height: 38px; border-radius: 50%; background: #eee; border: 2px solid #ddd; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 15px; color: #aaa; transition: all 0.3s; }
.tre-step.active .tre-step-circle { background: #e74c3c; border-color: #e74c3c; color: #fff; }
.tre-step.done .tre-step-circle { background: #27ae60; border-color: #27ae60; color: #fff; }
.tre-step-label { font-size: 11px; font-weight: 700; color: #aaa; text-transform: uppercase; }
.tre-step.active .tre-step-label { color: #e74c3c; }
.tre-step.done .tre-step-label { color: #27ae60; }
.tre-step-line { flex: 1; height: 2px; background: #ddd; min-width: 40px; max-width: 80px; margin-bottom: 22px; transition: background 0.3s; }
.tre-step-line.done { background: #27ae60; }
.tre-fiche { display: none; background: #fff; border: 1px solid #e8e8e8; border-radius: 14px; padding: 32px; box-shadow: 0 2px 20px rgba(0,0,0,0.06); }
.tre-fiche.active { display: block; animation: treSlide 0.3s ease; }
@keyframes treSlide { from{opacity:0;transform:translateX(20px)} to{opacity:1;transform:translateX(0)} }
.tre-fiche-title { margin: 0 0 24px; font-size: 20px; font-weight: 800; color: #222; border-left: 4px solid #e74c3c; padding-left: 14px; }
.tre-grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 0 20px; }
.tre-field { margin-bottom: 18px; }
.tre-field label { display: block; font-size: 12px; font-weight: 700; color: #777; text-transform: uppercase; letter-spacing: 0.8px; margin-bottom: 7px; }
.tre-field .req { color: #e74c3c; }
.tre-field input[type="text"],.tre-field input[type="email"],.tre-field input[type="tel"],.tre-field select,.tre-field textarea { width: 100%; padding: 11px 14px; border: 1.5px solid #ddd; border-radius: 8px; font-size: 14px; color: #333; box-sizing: border-box; transition: border-color 0.2s; font-family: inherit; background: #fafafa; }
.tre-field input:focus,.tre-field select:focus,.tre-field textarea:focus { outline: none; border-color: #e74c3c; background: #fff; }
.tre-checkboxes { display: flex; flex-wrap: wrap; gap: 10px; }
.tre-checkboxes label { display: flex; align-items: center; gap: 8px; padding: 9px 16px; border: 1.5px solid #ddd; border-radius: 8px; cursor: pointer; font-size: 14px; color: #555; transition: all 0.2s; background: #fafafa; font-weight: 600; }
.tre-checkboxes label:hover { border-color: #e74c3c; color: #e74c3c; }
.tre-checkboxes input[type="checkbox"] { accent-color: #e74c3c; width: 16px; height: 16px; }
.tre-info-box { background: #fff5f5; border: 1px solid #fcc; border-radius: 10px; padding: 14px 18px; color: #c0392b; font-size: 13px; font-weight: 600; margin: 16px 0; }
.tre-footer { display: flex; align-items: center; gap: 14px; margin-top: 24px; padding-top: 20px; border-top: 1px solid #eee; }
.tre-btn { background: #e74c3c; color: #fff; padding: 13px 30px; border: none; border-radius: 8px; font-weight: 700; font-size: 14px; cursor: pointer; transition: background 0.2s; }
.tre-btn:hover { background: #c0392b; }
.tre-btn:disabled { background: #ccc; cursor: not-allowed; }
.tre-btn-back { background: none; border: 1.5px solid #ddd; color: #888; padding: 12px 20px; border-radius: 8px; font-size: 14px; font-weight: 600; cursor: pointer; transition: all 0.2s; }
.tre-btn-back:hover { border-color: #e74c3c; color: #e74c3c; }
.tre-msg-success { color: #27ae60; font-weight: 700; font-size: 14px; margin-top: 16px; display: none; padding: 12px 16px; background: #f0fff4; border-radius: 8px; border: 1px solid #b2dfdb; }
.tre-msg-error { color: #e74c3c; font-weight: 700; font-size: 14px; margin-top: 16px; display: none; padding: 12px 16px; background: #fff5f5; border-radius: 8px; border: 1px solid #fcc; }
@media(max-width:640px){.tre-grid-2{grid-template-columns:1fr}.tre-fiche{padding:20px}.tre-step-line{min-width:20px}.tre-step-label{font-size:9px}}
</style>
<?php }

// JS wizard commun
function tre_wizard_js($prefix) { ?>
<script>
(function(){
	var prefix = '<?php echo $prefix; ?>';
	var steps  = document.querySelectorAll('#' + prefix + '-wrap .tre-step');
	var lines  = document.querySelectorAll('#' + prefix + '-wrap .tre-step-line');

	function showFiche(index) {
		document.querySelectorAll('#' + prefix + '-wrap .tre-fiche').forEach(function(f){f.classList.remove('active');});
		var el = document.getElementById(prefix + '-fiche-' + index);
		if(el) el.classList.add('active');
		steps.forEach(function(s,i){
			s.classList.remove('active','done');
			if(i < index) s.classList.add('done');
			if(i === index) s.classList.add('active');
		});
		lines.forEach(function(l,i){ l.classList.toggle('done', i < index); });
		window.scrollTo({top:0,behavior:'smooth'});
	}

	document.querySelectorAll('#' + prefix + '-wrap .tre-btn-next').forEach(function(btn){
		btn.addEventListener('click',function(){ showFiche(parseInt(this.dataset.next)); });
	});
	document.querySelectorAll('#' + prefix + '-wrap .tre-btn-back').forEach(function(btn){
		btn.addEventListener('click',function(){ showFiche(parseInt(this.dataset.prev)); });
	});

	var saveBtn = document.getElementById(prefix + '-save');
	if(!saveBtn) return;
	var successMsg = document.getElementById(prefix + '-success');
	var errorMsg   = document.getElementById(prefix + '-error');

	saveBtn.addEventListener('click', function(){
		saveBtn.disabled = true;
		saveBtn.innerText = 'Enregistrement...';
		successMsg.style.display = 'none';
		errorMsg.style.display   = 'none';

		var formData = new FormData();
		formData.append('action', 'tre_save_' + prefix);
		document.querySelectorAll('#' + prefix + '-wrap input, #' + prefix + '-wrap select, #' + prefix + '-wrap textarea').forEach(function(el){
			if(!el.name) return;
			if(el.type === 'checkbox'){ if(el.checked) formData.append(el.name, el.value); }
			else formData.append(el.name, el.value);
		});

		fetch('<?php echo admin_url('admin-ajax.php'); ?>', {method:'POST', body:formData})
		.then(function(r){return r.json();})
		.then(function(res){
			saveBtn.disabled = false;
			saveBtn.innerText = '✅ Enregistrer toutes les fiches';
			if(res.success){ successMsg.style.display='block'; errorMsg.style.display='none'; }
			else { errorMsg.style.display='block'; successMsg.style.display='none'; }
		})
		.catch(function(){
			saveBtn.disabled = false;
			saveBtn.innerText = '✅ Enregistrer toutes les fiches';
			errorMsg.style.display = 'block';
		});
	});
})();
</script>
<?php }

// ================================================================
// 1. ESPACE MEMBRE
// ================================================================
function tre_create_membre_table() {
	global $wpdb;
	$charset = $wpdb->get_charset_collate();
	$table   = $wpdb->prefix . 'tre_membre';
	$wpdb->query("CREATE TABLE IF NOT EXISTS $table (
		id INT AUTO_INCREMENT PRIMARY KEY,
		user_id INT NOT NULL,
		nom VARCHAR(100), prenom VARCHAR(100), pays VARCHAR(100), ville VARCHAR(100),
		telephone VARCHAR(30), email VARCHAR(150), situation VARCHAR(100), secteur_activite VARCHAR(100),
		type_projet VARCHAR(100), secteur_projet VARCHAR(100), description_projet TEXT,
		region_tunisie VARCHAR(100), delai_projet VARCHAR(100),
		services TEXT, budget VARCHAR(100), type_entreprise VARCHAR(100), details_admin TEXT,
		type_partenaire TEXT, profil_investisseur VARCHAR(100), secteur_cible VARCHAR(100), message TEXT,
		created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
		updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
		UNIQUE KEY unique_user (user_id)
	) $charset");
}
add_action('init','tre_create_membre_table');

function tre_save_membre() {
	if(!is_user_logged_in()){wp_send_json_error('Non connecté');return;}
	global $wpdb; $user_id=get_current_user_id(); $table=$wpdb->prefix.'tre_membre';
	$services=(!empty($_POST['services'])&&is_array($_POST['services']))?implode(', ',array_map('sanitize_text_field',$_POST['services'])):'';
	$partenaire=(!empty($_POST['type_partenaire'])&&is_array($_POST['type_partenaire']))?implode(', ',array_map('sanitize_text_field',$_POST['type_partenaire'])):'';
	$data=array('user_id'=>$user_id,'nom'=>sanitize_text_field($_POST['nom']??''),'prenom'=>sanitize_text_field($_POST['prenom']??''),'pays'=>sanitize_text_field($_POST['pays']??''),'ville'=>sanitize_text_field($_POST['ville']??''),'telephone'=>sanitize_text_field($_POST['telephone']??''),'email'=>sanitize_email($_POST['email']??''),'situation'=>sanitize_text_field($_POST['situation']??''),'secteur_activite'=>sanitize_text_field($_POST['secteur_activite']??''),'type_projet'=>sanitize_text_field($_POST['type_projet']??''),'secteur_projet'=>sanitize_text_field($_POST['secteur_projet']??''),'description_projet'=>sanitize_textarea_field($_POST['description_projet']??''),'region_tunisie'=>sanitize_text_field($_POST['region_tunisie']??''),'delai_projet'=>sanitize_text_field($_POST['delai_projet']??''),'services'=>$services,'budget'=>sanitize_text_field($_POST['budget']??''),'type_entreprise'=>sanitize_text_field($_POST['type_entreprise']??''),'details_admin'=>sanitize_textarea_field($_POST['details_admin']??''),'type_partenaire'=>$partenaire,'profil_investisseur'=>sanitize_text_field($_POST['profil_investisseur']??''),'secteur_cible'=>sanitize_text_field($_POST['secteur_cible']??''),'message'=>sanitize_textarea_field($_POST['message']??''));
	$existing=$wpdb->get_row($wpdb->prepare("SELECT id FROM $table WHERE user_id=%d",$user_id));
	if($existing) $wpdb->update($table,$data,array('user_id'=>$user_id));
	else $wpdb->insert($table,$data);
	wp_send_json_success('Toutes vos fiches ont été enregistrées avec succès');
}
add_action('wp_ajax_tre_save_membre','tre_save_membre');

function tre_espace_membre_shortcode() {
	if(!is_user_logged_in()) return '<div style="text-align:center;padding:40px"><p>Veuillez <a href="'.home_url('/login').'" style="color:#e74c3c;font-weight:700">vous connecter</a> pour accéder à votre espace membre.</p></div>';
	global $wpdb; $user_id=get_current_user_id(); $d=$wpdb->get_row($wpdb->prepare("SELECT * FROM {$wpdb->prefix}tre_membre WHERE user_id=%d",$user_id));
	ob_start();
	tre_common_css();
	?>
	<div class="tre-espace" id="membre-wrap">
		<div class="tre-progress">
			<div class="tre-step active" data-step="0"><div class="tre-step-circle">1</div><div class="tre-step-label">Profil</div></div>
			<div class="tre-step-line"></div>
			<div class="tre-step" data-step="1"><div class="tre-step-circle">2</div><div class="tre-step-label">Projet</div></div>
			<div class="tre-step-line"></div>
			<div class="tre-step" data-step="2"><div class="tre-step-circle">3</div><div class="tre-step-label">Besoins</div></div>
			<div class="tre-step-line"></div>
			<div class="tre-step" data-step="3"><div class="tre-step-circle">4</div><div class="tre-step-label">Relation</div></div>
		</div>

		<!-- FICHE 1 : PROFIL -->
		<div class="tre-fiche active" id="membre-fiche-0">
			<h3 class="tre-fiche-title">👤 Fiche Profil</h3>
			<div class="tre-grid-2">
				<div class="tre-field"><label>Nom <span class="req">*</span></label><input type="text" name="nom" value="<?php echo esc_attr($d->nom??'');?>" required></div>
				<div class="tre-field"><label>Prénom <span class="req">*</span></label><input type="text" name="prenom" value="<?php echo esc_attr($d->prenom??'');?>" required></div>
				<div class="tre-field"><label>Pays de résidence <span class="req">*</span></label>
					<select name="pays" required><option value="">— Sélectionner —</option>
					<?php foreach(array('France','Canada','Allemagne','Belgique','Italie','Espagne','Suisse','Pays-Bas','Royaume-Uni','États-Unis','Émirats Arabes Unis','Autre') as $p) echo "<option ".tre_sel($d->pays??'',$p).">$p</option>"; ?>
					</select>
				</div>
				<div class="tre-field"><label>Ville</label><input type="text" name="ville" value="<?php echo esc_attr($d->ville??'');?>"></div>
				<div class="tre-field"><label>Téléphone</label><input type="tel" name="telephone" value="<?php echo esc_attr($d->telephone??'');?>"></div>
				<div class="tre-field"><label>Email <span class="req">*</span></label><input type="email" name="email" value="<?php echo esc_attr($d->email??'');?>" required></div>
			</div>
			<div class="tre-field"><label>Situation professionnelle</label>
				<select name="situation"><option value="">— Sélectionner —</option>
				<?php foreach(array('Salarié','Entrepreneur','Freelance','Étudiant','En recherche d\'emploi','Retraité') as $s) echo "<option ".tre_sel($d->situation??'',$s).">$s</option>"; ?>
				</select>
			</div>
			<div class="tre-field"><label>Secteur d'activité</label>
				<select name="secteur_activite"><option value="">— Sélectionner —</option>
				<?php foreach(array('IT & Tech','Finance','Santé','BTP & Ingénierie','Commerce','Éducation','Hôtellerie','Agriculture','Autre') as $s) echo "<option ".tre_sel($d->secteur_activite??'',$s).">$s</option>"; ?>
				</select>
			</div>
			<div class="tre-footer"><button type="button" class="tre-btn tre-btn-next" data-next="1">Passer à la fiche suivante →</button></div>
		</div>

		<!-- FICHE 2 : PROJET -->
		<div class="tre-fiche" id="membre-fiche-1">
			<h3 class="tre-fiche-title">📋 Fiche Projet</h3>
			<div class="tre-field"><label>Type de projet</label>
				<select name="type_projet"><option value="">— Sélectionner —</option>
				<?php foreach(array('Investissement','Création d\'entreprise','Partenariat','Immobilier','Autre') as $t) echo "<option ".tre_sel($d->type_projet??'',$t).">$t</option>"; ?>
				</select>
			</div>
			<div class="tre-field"><label>Secteur</label>
				<select name="secteur_projet"><option value="">— Sélectionner —</option>
				<?php foreach(array('Technologie','Agriculture','Tourisme','Immobilier','Industrie','Services','Commerce','Énergie','Autre') as $s) echo "<option ".tre_sel($d->secteur_projet??'',$s).">$s</option>"; ?>
				</select>
			</div>
			<div class="tre-field"><label>Description du projet</label><textarea name="description_projet" rows="4"><?php echo esc_textarea($d->description_projet??'');?></textarea></div>
			<div class="tre-grid-2">
				<div class="tre-field"><label>Région en Tunisie</label>
					<select name="region_tunisie"><option value="">— Sélectionner —</option>
					<?php foreach(array('Tunis','Sfax','Sousse','Bizerte','Nabeul','Monastir','Gabès','Médenine','Autre') as $r) echo "<option ".tre_sel($d->region_tunisie??'',$r).">$r</option>"; ?>
					</select>
				</div>
				<div class="tre-field"><label>Délai du projet</label>
					<select name="delai_projet"><option value="">— Sélectionner —</option>
					<?php foreach(array('Moins de 6 mois','6 à 12 mois','1 à 2 ans','Plus de 2 ans') as $dl) echo "<option ".tre_sel($d->delai_projet??'',$dl).">$dl</option>"; ?>
					</select>
				</div>
			</div>
			<div class="tre-footer"><button type="button" class="tre-btn-back" data-prev="0">← Retour</button><button type="button" class="tre-btn tre-btn-next" data-next="2">Passer à la fiche suivante →</button></div>
		</div>

		<!-- FICHE 3 : BESOINS -->
		<div class="tre-fiche" id="membre-fiche-2">
			<h3 class="tre-fiche-title">🎯 Fiche Besoins</h3>
			<div class="tre-field"><label>Type de service recherché</label>
				<div class="tre-checkboxes">
				<?php $ss=isset($d->services)?explode(', ',$d->services):array(); foreach(array('Investissement','Création entreprise','Accompagnement administratif') as $sv) { $c=in_array($sv,$ss)?'checked':''; echo "<label><input type='checkbox' name='services[]' value='$sv' $c> $sv</label>"; } ?>
				</div>
			</div>
			<div class="tre-field"><label>Budget estimé</label>
				<select name="budget"><option value="">— Sélectionner —</option>
				<?php foreach(array('Moins de 10 000€','10 000 – 50 000€','50 000 – 100 000€','Plus de 100 000€') as $b) echo "<option ".tre_sel($d->budget??'',$b).">$b</option>"; ?>
				</select>
			</div>
			<div class="tre-field"><label>Type d'entreprise</label>
				<select name="type_entreprise"><option value="">— Sélectionner —</option>
				<?php foreach(array('SARL','SA','Startup','Auto-entrepreneur','Joint-venture') as $t) echo "<option ".tre_sel($d->type_entreprise??'',$t).">$t</option>"; ?>
				</select>
			</div>
			<div class="tre-field"><label>Détails accompagnement administratif</label><textarea name="details_admin" rows="3"><?php echo esc_textarea($d->details_admin??'');?></textarea></div>
			<div class="tre-footer"><button type="button" class="tre-btn-back" data-prev="1">← Retour</button><button type="button" class="tre-btn tre-btn-next" data-next="3">Passer à la fiche suivante →</button></div>
		</div>

		<!-- FICHE 4 : RELATION (DERNIÈRE) -->
		<div class="tre-fiche" id="membre-fiche-3">
			<h3 class="tre-fiche-title">🤝 Fiche Mise en Relation</h3>
			<div class="tre-field"><label>Type de partenaire recherché</label>
				<div class="tre-checkboxes">
				<?php $pp=isset($d->type_partenaire)?explode(', ',$d->type_partenaire):array(); foreach(array('Investisseur','Entreprise','Consultant','Institution financière') as $p) { $c=in_array($p,$pp)?'checked':''; echo "<label><input type='checkbox' name='type_partenaire[]' value='$p' $c> $p</label>"; } ?>
				</div>
			</div>
			<div class="tre-grid-2">
				<div class="tre-field"><label>Profil investisseur</label>
					<select name="profil_investisseur"><option value="">— Sélectionner —</option>
					<?php foreach(array('Business Angel','Fonds d\'investissement','Investisseur privé','Institution publique') as $pi) echo "<option ".tre_sel($d->profil_investisseur??'',$pi).">$pi</option>"; ?>
					</select>
				</div>
				<div class="tre-field"><label>Secteur cible</label>
					<select name="secteur_cible"><option value="">— Sélectionner —</option>
					<?php foreach(array('Technologie','Agriculture','Tourisme','Industrie','Services','Commerce') as $sc) echo "<option ".tre_sel($d->secteur_cible??'',$sc).">$sc</option>"; ?>
					</select>
				</div>
			</div>
			<div class="tre-field"><label>Message / Présentation</label><textarea name="message" rows="4"><?php echo esc_textarea($d->message??'');?></textarea></div>
			<div class="tre-info-box">📢 Votre fiche sera visible par les membres de la communauté TRE Radio après validation.</div>
			<div class="tre-footer">
				<button type="button" class="tre-btn-back" data-prev="2">← Retour</button>
				<button type="button" class="tre-btn" id="membre-save">✅ Enregistrer toutes les fiches</button>
			</div>
			<div class="tre-msg-success" id="membre-success">✅ Toutes vos fiches ont été enregistrées avec succès !</div>
			<div class="tre-msg-error" id="membre-error">❌ Une erreur est survenue. Veuillez réessayer.</div>
		</div>
	</div>
	<?php
	tre_wizard_js('membre');
	return ob_get_clean();
}
add_shortcode('espace_membre','tre_espace_membre_shortcode');


// ================================================================
// 2. ESPACE PARTENAIRE
// ================================================================
function tre_create_partenaire_table() {
	global $wpdb;
	$charset = $wpdb->get_charset_collate();
	$table   = $wpdb->prefix . 'tre_partenaire';
	$wpdb->query("CREATE TABLE IF NOT EXISTS $table (
		id INT AUTO_INCREMENT PRIMARY KEY,
		user_id INT NOT NULL,

		-- Fiche Profil Partenaire
		nom_entreprise VARCHAR(150),
		nom_contact VARCHAR(100),
		fonction VARCHAR(100),
		pays VARCHAR(100),
		telephone VARCHAR(30),
		email VARCHAR(150),
		type_service VARCHAR(100),

		-- Fiche Offres
		type_offre VARCHAR(100),
		description_service TEXT,
		public_cible TEXT,
		conditions TEXT,

		-- Fiche Partenariat
		type_partenariat TEXT,
		zone_intervention VARCHAR(100),
		secteurs_cibles TEXT,
		message_partenariat TEXT,

		-- Fiche Demandes Reçues
		membres_interesses TEXT,
		type_demande TEXT,

		created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
		updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
		UNIQUE KEY unique_user (user_id)
	) $charset");
}
add_action('init','tre_create_partenaire_table');

function tre_save_partenaire() {
	if(!is_user_logged_in()){wp_send_json_error('Non connecté');return;}
	global $wpdb; $user_id=get_current_user_id(); $table=$wpdb->prefix.'tre_partenaire';
	$public_cible=(!empty($_POST['public_cible'])&&is_array($_POST['public_cible']))?implode(', ',array_map('sanitize_text_field',$_POST['public_cible'])):sanitize_text_field($_POST['public_cible']??'');
	$type_partenariat=(!empty($_POST['type_partenariat'])&&is_array($_POST['type_partenariat']))?implode(', ',array_map('sanitize_text_field',$_POST['type_partenariat'])):sanitize_text_field($_POST['type_partenariat']??'');
	$secteurs_cibles=(!empty($_POST['secteurs_cibles'])&&is_array($_POST['secteurs_cibles']))?implode(', ',array_map('sanitize_text_field',$_POST['secteurs_cibles'])):sanitize_text_field($_POST['secteurs_cibles']??'');
	$data=array(
		'user_id'             => $user_id,
		'nom_entreprise'      => sanitize_text_field($_POST['nom_entreprise']??''),
		'nom_contact'         => sanitize_text_field($_POST['nom_contact']??''),
		'fonction'            => sanitize_text_field($_POST['fonction']??''),
		'pays'                => sanitize_text_field($_POST['pays']??''),
		'telephone'           => sanitize_text_field($_POST['telephone']??''),
		'email'               => sanitize_email($_POST['email']??''),
		'type_service'        => sanitize_text_field($_POST['type_service']??''),
		'type_offre'          => sanitize_text_field($_POST['type_offre']??''),
		'description_service' => sanitize_textarea_field($_POST['description_service']??''),
		'public_cible'        => $public_cible,
		'conditions'          => sanitize_textarea_field($_POST['conditions']??''),
		'type_partenariat'    => $type_partenariat,
		'zone_intervention'   => sanitize_text_field($_POST['zone_intervention']??''),
		'secteurs_cibles'     => $secteurs_cibles,
		'message_partenariat' => sanitize_textarea_field($_POST['message_partenariat']??''),
		'membres_interesses'  => sanitize_textarea_field($_POST['membres_interesses']??''),
		'type_demande'        => sanitize_textarea_field($_POST['type_demande']??''),
	);
	$existing=$wpdb->get_row($wpdb->prepare("SELECT id FROM $table WHERE user_id=%d",$user_id));
	if($existing) $wpdb->update($table,$data,array('user_id'=>$user_id));
	else $wpdb->insert($table,$data);
	wp_send_json_success('Toutes vos fiches partenaire ont été enregistrées avec succès');
}
add_action('wp_ajax_tre_save_partenaire','tre_save_partenaire');

function tre_espace_partenaire_shortcode() {
	if(!is_user_logged_in()) return '<div style="text-align:center;padding:40px"><p>Veuillez <a href="'.home_url('/login').'" style="color:#e74c3c;font-weight:700">vous connecter</a> pour accéder à votre espace partenaire.</p></div>';
	global $wpdb; $user_id=get_current_user_id(); $d=$wpdb->get_row($wpdb->prepare("SELECT * FROM {$wpdb->prefix}tre_partenaire WHERE user_id=%d",$user_id));
	ob_start();
	tre_common_css();
	?>
	<div class="tre-espace" id="partenaire-wrap">
		<div class="tre-progress">
			<div class="tre-step active"><div class="tre-step-circle">1</div><div class="tre-step-label">Profil</div></div>
			<div class="tre-step-line"></div>
			<div class="tre-step"><div class="tre-step-circle">2</div><div class="tre-step-label">Offres</div></div>
			<div class="tre-step-line"></div>
			<div class="tre-step"><div class="tre-step-circle">3</div><div class="tre-step-label">Partenariat</div></div>
			<div class="tre-step-line"></div>
			<div class="tre-step"><div class="tre-step-circle">4</div><div class="tre-step-label">Demandes</div></div>
		</div>

		<!-- FICHE 1 : PROFIL PARTENAIRE -->
		<div class="tre-fiche active" id="partenaire-fiche-0">
			<h3 class="tre-fiche-title">🏢 Fiche Profil Partenaire</h3>
			<div class="tre-grid-2">
				<div class="tre-field"><label>Nom de l'entreprise <span class="req">*</span></label><input type="text" name="nom_entreprise" value="<?php echo esc_attr($d->nom_entreprise??'');?>" required></div>
				<div class="tre-field"><label>Nom du contact <span class="req">*</span></label><input type="text" name="nom_contact" value="<?php echo esc_attr($d->nom_contact??'');?>" required></div>
				<div class="tre-field"><label>Fonction</label><input type="text" name="fonction" value="<?php echo esc_attr($d->fonction??'');?>"></div>
				<div class="tre-field"><label>Pays</label>
					<select name="pays"><option value="">— Sélectionner —</option>
					<?php foreach(array('France','Canada','Allemagne','Belgique','Italie','Espagne','Suisse','Pays-Bas','Royaume-Uni','États-Unis','Émirats Arabes Unis','Tunisie','Autre') as $p) echo "<option ".tre_sel($d->pays??'',$p).">$p</option>"; ?>
					</select>
				</div>
				<div class="tre-field"><label>Téléphone</label><input type="tel" name="telephone" value="<?php echo esc_attr($d->telephone??'');?>"></div>
				<div class="tre-field"><label>Email <span class="req">*</span></label><input type="email" name="email" value="<?php echo esc_attr($d->email??'');?>" required></div>
			</div>
			<div class="tre-field"><label>Type de service <span class="req">*</span></label>
				<select name="type_service" required><option value="">— Sélectionner —</option>
				<?php foreach(array('Banque','Assurance','Immobilier','Juridique / Notariat','Conseil financier','Transport & Logistique','Télécommunications','Services numériques','Autre') as $t) echo "<option ".tre_sel($d->type_service??'',$t).">$t</option>"; ?>
				</select>
			</div>
			<div class="tre-footer"><button type="button" class="tre-btn tre-btn-next" data-next="1">Passer à la fiche suivante →</button></div>
		</div>

		<!-- FICHE 2 : OFFRES -->
		<div class="tre-fiche" id="partenaire-fiche-1">
			<h3 class="tre-fiche-title">📦 Fiche Offres</h3>
			<div class="tre-field"><label>Type d'offre</label>
				<select name="type_offre"><option value="">— Sélectionner —</option>
				<?php foreach(array('Offre bancaire','Assurance santé','Assurance habitation','Crédit immobilier','Transfert d\'argent','Accompagnement juridique','Autre') as $t) echo "<option ".tre_sel($d->type_offre??'',$t).">$t</option>"; ?>
				</select>
			</div>
			<div class="tre-field"><label>Description du service</label><textarea name="description_service" rows="4" placeholder="Décrivez votre offre en détail..."><?php echo esc_textarea($d->description_service??'');?></textarea></div>
			<div class="tre-field"><label>Public cible</label>
				<div class="tre-checkboxes">
				<?php $pc=isset($d->public_cible)?explode(', ',$d->public_cible):array(); foreach(array('Diaspora tunisienne','Investisseurs','Étudiants à l\'étranger','Retraités expatriés','Entreprises') as $pub) { $c=in_array($pub,$pc)?'checked':''; echo "<label><input type='checkbox' name='public_cible[]' value='$pub' $c> $pub</label>"; } ?>
				</div>
			</div>
			<div class="tre-field"><label>Conditions</label><textarea name="conditions" rows="3" placeholder="Conditions d'accès, eligibilité, tarifs..."><?php echo esc_textarea($d->conditions??'');?></textarea></div>
			<div class="tre-footer"><button type="button" class="tre-btn-back" data-prev="0">← Retour</button><button type="button" class="tre-btn tre-btn-next" data-next="2">Passer à la fiche suivante →</button></div>
		</div>

		<!-- FICHE 3 : PARTENARIAT -->
		<div class="tre-fiche" id="partenaire-fiche-2">
			<h3 class="tre-fiche-title">🤝 Fiche Partenariat</h3>
			<div class="tre-field"><label>Type de partenariat souhaité</label>
				<div class="tre-checkboxes">
				<?php $tp=isset($d->type_partenariat)?explode(', ',$d->type_partenariat):array(); foreach(array('Convention commerciale','Accord de distribution','Partenariat institutionnel','Co-marketing','Parrainage / Sponsoring') as $pt) { $c=in_array($pt,$tp)?'checked':''; echo "<label><input type='checkbox' name='type_partenariat[]' value='$pt' $c> $pt</label>"; } ?>
				</div>
			</div>
			<div class="tre-field"><label>Zone d'intervention</label>
				<select name="zone_intervention"><option value="">— Sélectionner —</option>
				<?php foreach(array('Europe','Amérique du Nord','Moyen-Orient','Afrique du Nord','Monde entier','Autre') as $z) echo "<option ".tre_sel($d->zone_intervention??'',$z).">$z</option>"; ?>
				</select>
			</div>
			<div class="tre-field"><label>Secteurs cibles</label>
				<div class="tre-checkboxes">
				<?php $sc=isset($d->secteurs_cibles)?explode(', ',$d->secteurs_cibles):array(); foreach(array('Immobilier','Finance','Technologie','Agriculture','Commerce','Tourisme','Santé','Éducation') as $sec) { $c=in_array($sec,$sc)?'checked':''; echo "<label><input type='checkbox' name='secteurs_cibles[]' value='$sec' $c> $sec</label>"; } ?>
				</div>
			</div>
			<div class="tre-field"><label>Message</label><textarea name="message_partenariat" rows="4" placeholder="Présentez votre proposition de partenariat..."><?php echo esc_textarea($d->message_partenariat??'');?></textarea></div>
			<div class="tre-footer"><button type="button" class="tre-btn-back" data-prev="1">← Retour</button><button type="button" class="tre-btn tre-btn-next" data-next="3">Passer à la fiche suivante →</button></div>
		</div>

		<!-- FICHE 4 : DEMANDES REÇUES (DERNIÈRE) -->
		<div class="tre-fiche" id="partenaire-fiche-3">
			<h3 class="tre-fiche-title">📬 Fiche Demandes Reçues</h3>
			<div class="tre-info-box">ℹ️ Cette fiche sera remplie automatiquement lorsque des membres expriment leur intérêt pour vos offres.</div>
			<div class="tre-field"><label>Membres intéressés</label><textarea name="membres_interesses" rows="3" placeholder="Noms ou identifiants des membres intéressés..."><?php echo esc_textarea($d->membres_interesses??'');?></textarea></div>
			<div class="tre-field"><label>Type de demande</label><textarea name="type_demande" rows="3" placeholder="Ex: demande d'information, souscription, rendez-vous..."><?php echo esc_textarea($d->type_demande??'');?></textarea></div>
			<div class="tre-footer">
				<button type="button" class="tre-btn-back" data-prev="2">← Retour</button>
				<button type="button" class="tre-btn" id="partenaire-save">✅ Enregistrer toutes les fiches</button>
			</div>
			<div class="tre-msg-success" id="partenaire-success">✅ Toutes vos fiches partenaire ont été enregistrées avec succès !</div>
			<div class="tre-msg-error" id="partenaire-error">❌ Une erreur est survenue. Veuillez réessayer.</div>
		</div>
	</div>
	<?php
	tre_wizard_js('partenaire');
	return ob_get_clean();
}
add_shortcode('espace_partenaire','tre_espace_partenaire_shortcode');


// ================================================================
// 3. ESPACE INVESTISSEUR
// ================================================================
function tre_create_investisseur_table() {
	global $wpdb;
	$charset = $wpdb->get_charset_collate();
	$table   = $wpdb->prefix . 'tre_investisseur';
	$wpdb->query("CREATE TABLE IF NOT EXISTS $table (
		id INT AUTO_INCREMENT PRIMARY KEY,
		user_id INT NOT NULL,

		-- Fiche Profil Investisseur
		nom VARCHAR(100),
		prenom VARCHAR(100),
		pays_residence VARCHAR(100),
		telephone VARCHAR(30),
		email VARCHAR(150),
		type_investisseur VARCHAR(100),

		-- Fiche Investissement
		budget_investissement VARCHAR(100),
		secteurs_recherches TEXT,
		type_projet_invest TEXT,
		region_cible VARCHAR(100),

		-- Fiche Opportunités
		projets_recherches TEXT,
		niveau_participation VARCHAR(100),
		horizon_investissement VARCHAR(100),

		-- Fiche Mise en Relation
		entrepreneurs_recherches TEXT,
		partenaires_financiers TEXT,
		institutions_banques TEXT,

		created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
		updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
		UNIQUE KEY unique_user (user_id)
	) $charset");
}
add_action('init','tre_create_investisseur_table');

function tre_save_investisseur() {
	if(!is_user_logged_in()){wp_send_json_error('Non connecté');return;}
	global $wpdb; $user_id=get_current_user_id(); $table=$wpdb->prefix.'tre_investisseur';
	$secteurs=(!empty($_POST['secteurs_recherches'])&&is_array($_POST['secteurs_recherches']))?implode(', ',array_map('sanitize_text_field',$_POST['secteurs_recherches'])):sanitize_text_field($_POST['secteurs_recherches']??'');
	$type_proj=(!empty($_POST['type_projet_invest'])&&is_array($_POST['type_projet_invest']))?implode(', ',array_map('sanitize_text_field',$_POST['type_projet_invest'])):sanitize_text_field($_POST['type_projet_invest']??'');
	$projets=(!empty($_POST['projets_recherches'])&&is_array($_POST['projets_recherches']))?implode(', ',array_map('sanitize_text_field',$_POST['projets_recherches'])):sanitize_text_field($_POST['projets_recherches']??'');
	$data=array(
		'user_id'               => $user_id,
		'nom'                   => sanitize_text_field($_POST['nom']??''),
		'prenom'                => sanitize_text_field($_POST['prenom']??''),
		'pays_residence'        => sanitize_text_field($_POST['pays_residence']??''),
		'telephone'             => sanitize_text_field($_POST['telephone']??''),
		'email'                 => sanitize_email($_POST['email']??''),
		'type_investisseur'     => sanitize_text_field($_POST['type_investisseur']??''),
		'budget_investissement' => sanitize_text_field($_POST['budget_investissement']??''),
		'secteurs_recherches'   => $secteurs,
		'type_projet_invest'    => $type_proj,
		'region_cible'          => sanitize_text_field($_POST['region_cible']??''),
		'projets_recherches'    => $projets,
		'niveau_participation'  => sanitize_text_field($_POST['niveau_participation']??''),
		'horizon_investissement'=> sanitize_text_field($_POST['horizon_investissement']??''),
		'entrepreneurs_recherches' => sanitize_textarea_field($_POST['entrepreneurs_recherches']??''),
		'partenaires_financiers'   => sanitize_textarea_field($_POST['partenaires_financiers']??''),
		'institutions_banques'     => sanitize_textarea_field($_POST['institutions_banques']??''),
	);
	$existing=$wpdb->get_row($wpdb->prepare("SELECT id FROM $table WHERE user_id=%d",$user_id));
	if($existing) $wpdb->update($table,$data,array('user_id'=>$user_id));
	else $wpdb->insert($table,$data);
	wp_send_json_success('Toutes vos fiches investisseur ont été enregistrées avec succès');
}
add_action('wp_ajax_tre_save_investisseur','tre_save_investisseur');

function tre_espace_investisseur_shortcode() {
	if(!is_user_logged_in()) return '<div style="text-align:center;padding:40px"><p>Veuillez <a href="'.home_url('/login').'" style="color:#e74c3c;font-weight:700">vous connecter</a> pour accéder à votre espace investisseur.</p></div>';
	global $wpdb; $user_id=get_current_user_id(); $d=$wpdb->get_row($wpdb->prepare("SELECT * FROM {$wpdb->prefix}tre_investisseur WHERE user_id=%d",$user_id));
	ob_start();
	tre_common_css();
	?>
	<div class="tre-espace" id="investisseur-wrap">
		<div class="tre-progress">
			<div class="tre-step active"><div class="tre-step-circle">1</div><div class="tre-step-label">Profil</div></div>
			<div class="tre-step-line"></div>
			<div class="tre-step"><div class="tre-step-circle">2</div><div class="tre-step-label">Investissement</div></div>
			<div class="tre-step-line"></div>
			<div class="tre-step"><div class="tre-step-circle">3</div><div class="tre-step-label">Opportunités</div></div>
			<div class="tre-step-line"></div>
			<div class="tre-step"><div class="tre-step-circle">4</div><div class="tre-step-label">Relation</div></div>
		</div>

		<!-- FICHE 1 : PROFIL INVESTISSEUR -->
		<div class="tre-fiche active" id="investisseur-fiche-0">
			<h3 class="tre-fiche-title">💼 Fiche Profil Investisseur</h3>
			<div class="tre-grid-2">
				<div class="tre-field"><label>Nom <span class="req">*</span></label><input type="text" name="nom" value="<?php echo esc_attr($d->nom??'');?>" required></div>
				<div class="tre-field"><label>Prénom <span class="req">*</span></label><input type="text" name="prenom" value="<?php echo esc_attr($d->prenom??'');?>" required></div>
				<div class="tre-field"><label>Pays de résidence <span class="req">*</span></label>
					<select name="pays_residence" required><option value="">— Sélectionner —</option>
					<?php foreach(array('France','Canada','Allemagne','Belgique','Italie','Espagne','Suisse','Pays-Bas','Royaume-Uni','États-Unis','Émirats Arabes Unis','Autre') as $p) echo "<option ".tre_sel($d->pays_residence??'',$p).">$p</option>"; ?>
					</select>
				</div>
				<div class="tre-field"><label>Téléphone</label><input type="tel" name="telephone" value="<?php echo esc_attr($d->telephone??'');?>"></div>
				<div class="tre-field"><label>Email <span class="req">*</span></label><input type="email" name="email" value="<?php echo esc_attr($d->email??'');?>" required></div>
				<div class="tre-field"><label>Type d'investisseur <span class="req">*</span></label>
					<select name="type_investisseur" required><option value="">— Sélectionner —</option>
					<?php foreach(array('Investisseur privé','Entreprise','Fonds d\'investissement','Business Angel','Institution financière') as $t) echo "<option ".tre_sel($d->type_investisseur??'',$t).">$t</option>"; ?>
					</select>
				</div>
			</div>
			<div class="tre-footer"><button type="button" class="tre-btn tre-btn-next" data-next="1">Passer à la fiche suivante →</button></div>
		</div>

		<!-- FICHE 2 : INVESTISSEMENT -->
		<div class="tre-fiche" id="investisseur-fiche-1">
			<h3 class="tre-fiche-title">📈 Fiche Investissement</h3>
			<div class="tre-field"><label>Budget d'investissement</label>
				<select name="budget_investissement"><option value="">— Sélectionner —</option>
				<?php foreach(array('Moins de 50 000€','50 000 – 100 000€','100 000 – 500 000€','500 000 – 1M€','Plus de 1M€') as $b) echo "<option ".tre_sel($d->budget_investissement??'',$b).">$b</option>"; ?>
				</select>
			</div>
			<div class="tre-field"><label>Secteurs recherchés</label>
				<div class="tre-checkboxes">
				<?php $sr=isset($d->secteurs_recherches)?explode(', ',$d->secteurs_recherches):array(); foreach(array('Technologie','Agriculture','Tourisme','Immobilier','Industrie','Services','Commerce','Énergie','Santé','Éducation') as $sec) { $c=in_array($sec,$sr)?'checked':''; echo "<label><input type='checkbox' name='secteurs_recherches[]' value='$sec' $c> $sec</label>"; } ?>
				</div>
			</div>
			<div class="tre-field"><label>Type de projet</label>
				<div class="tre-checkboxes">
				<?php $tp=isset($d->type_projet_invest)?explode(', ',$d->type_projet_invest):array(); foreach(array('Startup','Immobilier','Industrie','Agriculture','Commerce','Infrastructure') as $t) { $c=in_array($t,$tp)?'checked':''; echo "<label><input type='checkbox' name='type_projet_invest[]' value='$t' $c> $t</label>"; } ?>
				</div>
			</div>
			<div class="tre-field"><label>Région cible en Tunisie</label>
				<select name="region_cible"><option value="">— Sélectionner —</option>
				<?php foreach(array('Tunis','Sfax','Sousse','Bizerte','Nabeul','Monastir','Gabès','Médenine','Toutes les régions','Autre') as $r) echo "<option ".tre_sel($d->region_cible??'',$r).">$r</option>"; ?>
				</select>
			</div>
			<div class="tre-footer"><button type="button" class="tre-btn-back" data-prev="0">← Retour</button><button type="button" class="tre-btn tre-btn-next" data-next="2">Passer à la fiche suivante →</button></div>
		</div>

		<!-- FICHE 3 : OPPORTUNITÉS -->
		<div class="tre-fiche" id="investisseur-fiche-2">
			<h3 class="tre-fiche-title">🔍 Fiche Opportunités</h3>
			<div class="tre-field"><label>Projets recherchés</label>
				<div class="tre-checkboxes">
				<?php $pr=isset($d->projets_recherches)?explode(', ',$d->projets_recherches):array(); foreach(array('Projets à financer','Projets en démarrage','Projets en expansion','Rachats d\'entreprises','Partenariats stratégiques') as $proj) { $c=in_array($proj,$pr)?'checked':''; echo "<label><input type='checkbox' name='projets_recherches[]' value='$proj' $c> $proj</label>"; } ?>
				</div>
			</div>
			<div class="tre-field"><label>Niveau de participation souhaité</label>
				<select name="niveau_participation"><option value="">— Sélectionner —</option>
				<?php foreach(array('Minoritaire (< 25%)','Majoritaire (> 50%)','Égalitaire (50/50)','Actionnaire passif','Co-fondateur') as $n) echo "<option ".tre_sel($d->niveau_participation??'',$n).">$n</option>"; ?>
				</select>
			</div>
			<div class="tre-field"><label>Horizon d'investissement</label>
				<select name="horizon_investissement"><option value="">— Sélectionner —</option>
				<?php foreach(array('Court terme (< 2 ans)','Moyen terme (2–5 ans)','Long terme (> 5 ans)') as $h) echo "<option ".tre_sel($d->horizon_investissement??'',$h).">$h</option>"; ?>
				</select>
			</div>
			<div class="tre-footer"><button type="button" class="tre-btn-back" data-prev="1">← Retour</button><button type="button" class="tre-btn tre-btn-next" data-next="3">Passer à la fiche suivante →</button></div>
		</div>

		<!-- FICHE 4 : MISE EN RELATION (DERNIÈRE) -->
		<div class="tre-fiche" id="investisseur-fiche-3">
			<h3 class="tre-fiche-title">🤝 Fiche Mise en Relation</h3>
			<div class="tre-field"><label>Entrepreneurs recherchés</label><textarea name="entrepreneurs_recherches" rows="3" placeholder="Profil d'entrepreneur, secteur, localisation..."><?php echo esc_textarea($d->entrepreneurs_recherches??'');?></textarea></div>
			<div class="tre-field"><label>Partenaires financiers</label><textarea name="partenaires_financiers" rows="3" placeholder="Type de partenaires financiers souhaités..."><?php echo esc_textarea($d->partenaires_financiers??'');?></textarea></div>
			<div class="tre-field"><label>Institutions ou banques</label><textarea name="institutions_banques" rows="3" placeholder="Institutions publiques, banques, fonds souverains..."><?php echo esc_textarea($d->institutions_banques??'');?></textarea></div>
			<div class="tre-info-box">📢 Votre fiche sera visible par les porteurs de projets et partenaires après validation par TRE Radio.</div>
			<div class="tre-footer">
				<button type="button" class="tre-btn-back" data-prev="2">← Retour</button>
				<button type="button" class="tre-btn" id="investisseur-save">✅ Enregistrer toutes les fiches</button>
			</div>
			<div class="tre-msg-success" id="investisseur-success">✅ Toutes vos fiches investisseur ont été enregistrées avec succès !</div>
			<div class="tre-msg-error" id="investisseur-error">❌ Une erreur est survenue. Veuillez réessayer.</div>
		</div>
	</div>
	<?php
	tre_wizard_js('investisseur');
	return ob_get_clean();
}
add_shortcode('espace_investisseur','tre_espace_investisseur_shortcode');

function tre_auteurs_shortcode() {
    $auteurs = get_users(array(
        'role__in'  => array('author', 'editor', 'administrator', 'contributor'),
        'orderby'   => 'post_count',
        'order'     => 'DESC',
        'number'    => 7, // 7 auteurs au total
    ));

    ob_start(); ?>
    <div class="tre-carousel-wrap">
        <div class="tre-carousel-track" id="treCarousel">
            <?php foreach ($auteurs as $auteur) :
                $count  = count_user_posts($auteur->ID, 'post');
                $avatar = get_avatar_url($auteur->ID, array('size' => 120));
                $name   = esc_html($auteur->display_name);
                $role   = esc_html(ucfirst(array_values($auteur->roles)[0]));
                $url    = esc_url(get_author_posts_url($auteur->ID));
                $bio    = esc_html(get_the_author_meta('description', $auteur->ID));
            ?>
            <div class="tre-auteur-slide">
                <div class="tre-auteur-card">
                    <img src="<?php echo $avatar; ?>" alt="<?php echo $name; ?>">
                    <div class="tre-auteur-body">
                        <h3><?php echo $name; ?></h3>
                        <?php if ($bio) : ?>
                        <p class="tre-bio"><?php echo $bio; ?></p>
                        <?php endif; ?>
                        <div class="tre-auteur-meta">
                            <span class="tre-count"><?php echo $count; ?> article<?php echo $count > 1 ? 's' : ''; ?></span>
                            <span class="tre-role"><?php echo $role; ?></span>
                        </div>
                        <a href="<?php echo $url; ?>" class="tre-voir">Voir les articles →</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- Flèches -->
        <button class="tre-arrow tre-prev" onclick="treSlide(-1)">&#8592;</button>
        <button class="tre-arrow tre-next" onclick="treSlide(1)">&#8594;</button>

        <!-- Indicateurs -->
        <div class="tre-dots" id="treDots"></div>

        <!-- Bouton voir tous -->
        <div style="text-align:center;margin-top:20px;">
            <a href="<?php echo home_url('/tous-les-auteurs'); ?>" class="tre-btn-auteurs">
                Voir tous les auteurs →
            </a>
        </div>
    </div>

    <style>
    .tre-carousel-wrap {
        max-width: 100%; margin: 0 auto;
        font-family: 'Segoe UI', sans-serif;
        position: relative; overflow: hidden;
        padding: 0 40px;
        box-sizing: border-box;
    }
    .tre-carousel-track {
        display: flex;
        transition: transform 0.4s ease; /* glissage rapide */
        will-change: transform;
    }
    .tre-auteur-slide {
        min-width: 20%; /* 5 visibles à la fois = 100/5 */
        box-sizing: border-box;
        padding: 0 6px;
    }
    .tre-auteur-card {
        background: #fff;
        border: 1px solid #eee;
        border-radius: 14px;
        padding: 16px 12px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.07);
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        height: 100%;
        transition: box-shadow 0.2s;
    }
    .tre-auteur-card:hover { box-shadow: 0 6px 24px rgba(0,0,0,0.12); }
    .tre-auteur-card img {
        width: 64px; height: 64px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #e74c3c;
        margin-bottom: 12px;
    }
    .tre-auteur-body { width: 100%; }
    .tre-auteur-body h3 {
        margin: 0 0 6px;
        font-size: 13px;
        font-weight: 800;
        color: #222;
    }
    .tre-bio {
        font-size: 11px; color: #888;
        margin: 0 0 8px; line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .tre-auteur-meta {
        display: flex; justify-content: center;
        gap: 6px; margin-bottom: 12px; flex-wrap: wrap;
    }
    .tre-count {
        background: #fff0f0; color: #e74c3c;
        font-size: 11px; font-weight: 700;
        padding: 3px 10px; border-radius: 20px;
    }
    .tre-role {
        background: #f5f5f5; color: #888;
        font-size: 10px; font-weight: 600;
        padding: 3px 10px; border-radius: 20px;
        text-transform: uppercase; letter-spacing: 0.5px;
    }
    .tre-voir {
        display: inline-block;
        color: #fff; background: #e74c3c;
        padding: 7px 14px; border-radius: 8px;
        font-size: 11px; font-weight: 700;
        text-decoration: none; transition: background 0.2s;
    }
    .tre-voir:hover { background: #c0392b; color: #fff; }

    /* Flèches */
    .tre-arrow {
        position: absolute; top: 40%;
        transform: translateY(-50%);
        background: #e74c3c; color: #fff;
        border: none; width: 32px; height: 32px;
        border-radius: 50%; font-size: 15px;
        cursor: pointer; z-index: 10;
        transition: background 0.2s;
        display: flex; align-items: center; justify-content: center;
    }
    .tre-arrow:hover { background: #c0392b; }
    .tre-prev { left: 4px; }
    .tre-next { right: 4px; }

    /* Dots */
    .tre-dots {
        display: flex; justify-content: center;
        gap: 8px; margin-top: 16px;
    }
    .tre-dot {
        width: 8px; height: 8px; border-radius: 50%;
        background: #ddd; cursor: pointer;
        transition: background 0.3s;
    }
    .tre-dot.active { background: #e74c3c; }

    /* Bouton voir tous */
    .tre-btn-auteurs {
        display: inline-block; background: #222; color: #fff;
        padding: 11px 32px; border-radius: 8px; font-weight: 700;
        font-size: 13px; text-decoration: none; transition: background 0.2s;
    }
    .tre-btn-auteurs:hover { background: #e74c3c; color: #fff; }

    /* Responsive */
    @media(max-width: 1024px) {
        .tre-auteur-slide { min-width: 25%; } /* 4 visibles */
    }
    @media(max-width: 768px) {
        .tre-auteur-slide { min-width: 33.33%; } /* 3 visibles */
    }
    @media(max-width: 480px) {
        .tre-auteur-slide { min-width: 100%; } /* 1 visible */
    }
    </style>

    <script>
    (function() {
        var track    = document.getElementById('treCarousel');
        var slides   = track ? track.querySelectorAll('.tre-auteur-slide') : [];
        var total    = slides.length;
        var current  = 0;
        var visible  = 5; // 5 visibles par défaut
        var maxIndex = total - visible;
        var timer;

        // Responsive visible count
        function getVisible() {
            if (window.innerWidth <= 480)  return 1;
            if (window.innerWidth <= 768)  return 3;
            if (window.innerWidth <= 1024) return 4;
            return 5;
        }

        // Créer les dots
        var dotsWrap = document.getElementById('treDots');

        function buildDots() {
            visible  = getVisible();
            maxIndex = total - visible;
            if (!dotsWrap) return;
            dotsWrap.innerHTML = '';
            for (var i = 0; i <= maxIndex; i++) {
                var dot = document.createElement('span');
                dot.className = 'tre-dot' + (i === 0 ? ' active' : '');
                dot.setAttribute('data-i', i);
                dot.addEventListener('click', function() {
                    goTo(parseInt(this.getAttribute('data-i')));
                });
                dotsWrap.appendChild(dot);
            }
        }

        buildDots();

        function goTo(index) {
            visible  = getVisible();
            maxIndex = total - visible;
            if (index < 0)        index = maxIndex;
            if (index > maxIndex) index = 0;
            current = index;
            // Déplacement = (100 / total) * current
            var offset = (100 / total) * current;
            track.style.transform = 'translateX(-' + offset + '%)';
            // Mise à jour dots
            var dots = dotsWrap ? dotsWrap.querySelectorAll('.tre-dot') : [];
            dots.forEach(function(d, i) {
                d.classList.toggle('active', i === current);
            });
        }

        // Auto-slide toutes les 1.5 secondes (rapide)
        function startAuto() {
            timer = setInterval(function() {
                goTo(current + 1);
            }, 1500);
        }

        function stopAuto() { clearInterval(timer); }

        startAuto();

        // Pause au survol
        if (track) {
            track.addEventListener('mouseenter', stopAuto);
            track.addEventListener('mouseleave', startAuto);
        }

        // Recalcul au resize
        window.addEventListener('resize', function() {
            buildDots();
            goTo(0);
        });

        // Exposer pour les flèches
        window.treSlide = function(dir) {
            stopAuto();
            goTo(current + dir);
            startAuto();
        };
    })();
    </script>
    <?php
    return ob_get_clean();
}
add_shortcode('tre_auteurs', 'tre_auteurs_shortcode');


// Shortcode [tre_tous_auteurs] - affiche TOUS les auteurs
function tre_tous_auteurs_shortcode() {
    $tous_auteurs = get_users(array(
        'role__in' => array('author', 'editor', 'administrator', 'contributor'),
        'orderby'  => 'post_count',
        'order'    => 'DESC',
    ));

    $par_page  = 5;
    $total     = count($tous_auteurs);
    $nb_pages  = ceil($total / $par_page);
    $page_actuelle = isset($_GET['auteur_page']) ? max(1, intval($_GET['auteur_page'])) : 1;
    $offset    = ($page_actuelle - 1) * $par_page;
    $auteurs   = array_slice($tous_auteurs, $offset, $par_page);

    ob_start(); ?>
    <div class="tre-auteurs-wrap">
        <h2 style="font-size:24px;font-weight:800;margin-bottom:8px;border-left:4px solid #e74c3c;padding-left:14px;">
            👥 Tous nos auteurs
        </h2>
        <p style="color:#888;font-size:13px;margin-bottom:24px;padding-left:18px;">
            <?php echo $total; ?> auteur<?php echo $total > 1 ? 's' : ''; ?> au total —
            Page <?php echo $page_actuelle; ?> / <?php echo $nb_pages; ?>
        </p>

        <?php foreach ($auteurs as $auteur) :
            $count  = count_user_posts($auteur->ID, 'post');
            $avatar = get_avatar_url($auteur->ID, array('size' => 120));
            $name   = esc_html($auteur->display_name);
            $role   = esc_html(ucfirst(array_values($auteur->roles)[0]));
            $url    = esc_url(get_author_posts_url($auteur->ID));
            $bio    = esc_html(get_the_author_meta('description', $auteur->ID));
        ?>
        <div class="tre-auteur-card">
            <div class="tre-auteur-avatar">
                <img src="<?php echo $avatar; ?>" alt="<?php echo $name; ?>">
            </div>
            <div class="tre-auteur-info">
                <h3><?php echo $name; ?></h3>
                <?php if ($bio) : ?>
                <p class="tre-auteur-bio"><?php echo $bio; ?></p>
                <?php endif; ?>
                <div class="tre-auteur-meta">
                    <span class="tre-count"><?php echo $count; ?> article<?php echo $count > 1 ? 's' : ''; ?></span>
                    <span class="tre-role"><?php echo $role; ?></span>
                </div>
            </div>
            <a href="<?php echo $url; ?>" class="tre-auteur-link">Voir les articles →</a>
        </div>
        <?php endforeach; ?>

        <!-- PAGINATION -->
        <?php if ($nb_pages > 1) : ?>
        <div class="tre-pagination">
            <?php
            $base_url = get_permalink();

            // Bouton Précédent
            if ($page_actuelle > 1) :
                $prev = add_query_arg('auteur_page', $page_actuelle - 1, $base_url);
            ?>
            <a href="<?php echo esc_url($prev); ?>" class="tre-page-btn tre-page-prev">← Précédent</a>
            <?php endif; ?>

            <?php
            // Numéros de pages
            for ($i = 1; $i <= $nb_pages; $i++) :
                $url_page = add_query_arg('auteur_page', $i, $base_url);
                $active   = ($i === $page_actuelle) ? 'active' : '';
            ?>
            <a href="<?php echo esc_url($url_page); ?>" class="tre-page-num <?php echo $active; ?>">
                <?php echo $i; ?>
            </a>
            <?php endfor; ?>

            <?php
            // Bouton Suivant
            if ($page_actuelle < $nb_pages) :
                $next = add_query_arg('auteur_page', $page_actuelle + 1, $base_url);
            ?>
            <a href="<?php echo esc_url($next); ?>" class="tre-page-btn tre-page-next">Suivant →</a>
            <?php endif; ?>
        </div>
        <?php endif; ?>

    </div>

    <style>
    .tre-auteurs-wrap { max-width: 820px; margin: 0 auto; font-family: 'Segoe UI', sans-serif; }
    .tre-auteur-card {
        display: flex; align-items: center; gap: 16px;
        padding: 18px; margin-bottom: 12px;
        background: #fff; border: 1px solid #eee;
        border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        transition: box-shadow 0.2s;
    }
    .tre-auteur-card:hover { box-shadow: 0 4px 20px rgba(0,0,0,0.10); }
    .tre-auteur-avatar img {
        width: 64px; height: 64px; border-radius: 50%;
        object-fit: cover; border: 3px solid #e74c3c; flex-shrink: 0;
    }
    .tre-auteur-info { flex: 1; }
    .tre-auteur-info h3 { margin: 0 0 6px; font-size: 16px; font-weight: 700; color: #222; }
    .tre-auteur-bio { font-size: 13px; color: #666; margin: 0 0 8px; line-height: 1.5; }
    .tre-auteur-meta { display: flex; gap: 8px; flex-wrap: wrap; }
    .tre-count {
        background: #fff0f0; color: #e74c3c;
        font-size: 12px; font-weight: 700; padding: 3px 10px; border-radius: 20px;
    }
    .tre-role {
        background: #f5f5f5; color: #888;
        font-size: 11px; font-weight: 600; padding: 3px 10px;
        border-radius: 20px; text-transform: uppercase; letter-spacing: 0.5px;
    }
    .tre-auteur-link {
        color: #e74c3c; font-size: 13px; font-weight: 700;
        text-decoration: none; white-space: nowrap; flex-shrink: 0;
    }
    .tre-auteur-link:hover { color: #c0392b; }

    /* PAGINATION */
    .tre-pagination {
        display: flex; align-items: center; justify-content: center;
        gap: 8px; margin-top: 32px; flex-wrap: wrap;
    }
    .tre-page-num {
        display: inline-flex; align-items: center; justify-content: center;
        width: 38px; height: 38px; border-radius: 8px;
        background: #f5f5f5; color: #444; font-weight: 700;
        font-size: 14px; text-decoration: none;
        border: 1.5px solid #eee; transition: all 0.2s;
    }
    .tre-page-num:hover { background: #e74c3c; color: #fff; border-color: #e74c3c; }
    .tre-page-num.active { background: #e74c3c; color: #fff; border-color: #e74c3c; }
    .tre-page-btn {
        display: inline-flex; align-items: center;
        padding: 8px 18px; border-radius: 8px;
        background: #222; color: #fff; font-weight: 700;
        font-size: 13px; text-decoration: none;
        transition: background 0.2s;
    }
    .tre-page-btn:hover { background: #e74c3c; color: #fff; }
    </style>
    <?php
    return ob_get_clean();
}
add_shortcode('tre_tous_auteurs', 'tre_tous_auteurs_shortcode');


// =============================================
// WIDGET MÉTÉO EN DIRECT
// =============================================
function tre_meteo_shortcode($atts) {
    ob_start(); ?>
    <div class="tre-meteo-wrap">

        <!-- Sélecteurs -->
        <div class="tre-meteo-selectors">
            <select id="treMeteoCountry" onchange="treLoadCities()">
                <option value="">🌍 Choisir un pays</option>
            </select>
            <select id="treMeteoCity" onchange="treGetMeteo()" disabled>
                <option value="">🏙️ Choisir une ville</option>
            </select>
        </div>

        <!-- Widget météo -->
        <div id="treMeteoResult"></div>
    </div>

    <style>
    .tre-meteo-wrap { font-family: 'Segoe UI', sans-serif; max-width: 500px; }
    .tre-meteo-selectors { display: flex; gap: 8px; margin-bottom: 16px; flex-wrap: wrap; }
    .tre-meteo-selectors select {
        flex: 1; min-width: 140px; padding: 10px 12px;
        border: 1.5px solid #ddd; border-radius: 8px;
        font-size: 13px; color: #333; background: #fafafa;
        cursor: pointer; outline: none; transition: border-color 0.2s;
    }
    .tre-meteo-selectors select:focus { border-color: #e74c3c; }
    .tre-meteo-selectors select:disabled { opacity: 0.5; cursor: not-allowed; }
.tre-meteo-card {
    border-radius: 16px; padding: 24px; color: #fff;
    box-shadow: 0 8px 32px rgba(0,0,0,0.3);
    position: relative; overflow: hidden; min-height: 280px;
}
.tre-meteo-bg {
    position: absolute; top: 0; left: 0;
    width: 100%; height: 100%; z-index: 0;
    overflow: hidden;
}
.tre-meteo-content { position: relative; z-index: 2; }

/* ======================== */
/* SOLEIL                   */
/* ======================== */
.meteo-bg-soleil { background: linear-gradient(160deg, #f7971e, #ffd200); }
.meteo-bg-soleil .soleil-circle {
    position: absolute; top: -40px; right: -40px;
    width: 160px; height: 160px; border-radius: 50%;
    background: rgba(255,220,50,0.9);
    box-shadow: 0 0 60px 30px rgba(255,200,0,0.5);
    animation: soleilPulse 3s ease-in-out infinite;
}
.meteo-bg-soleil .soleil-ray {
    position: absolute; top: 50px; right: 50px;
    width: 200px; height: 200px;
    background: conic-gradient(
        rgba(255,255,255,0.3) 0deg, transparent 20deg,
        rgba(255,255,255,0.3) 40deg, transparent 60deg,
        rgba(255,255,255,0.3) 80deg, transparent 100deg,
        rgba(255,255,255,0.3) 120deg, transparent 140deg,
        rgba(255,255,255,0.3) 160deg, transparent 180deg,
        rgba(255,255,255,0.3) 200deg, transparent 220deg,
        rgba(255,255,255,0.3) 240deg, transparent 260deg,
        rgba(255,255,255,0.3) 280deg, transparent 300deg,
        rgba(255,255,255,0.3) 320deg, transparent 340deg,
        rgba(255,255,255,0.3) 360deg
    );
    border-radius: 50%;
    animation: soleilRotate 12s linear infinite;
}
@keyframes soleilPulse {
    0%,100% { transform: scale(1); box-shadow: 0 0 60px 30px rgba(255,200,0,0.5); }
    50%      { transform: scale(1.08); box-shadow: 0 0 80px 40px rgba(255,200,0,0.7); }
}
@keyframes soleilRotate { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }
.meteo-bg-soleil .tre-meteo-ville,
.meteo-bg-soleil .tre-meteo-temp-main,
.meteo-bg-soleil .tre-meteo-desc { color: #333 !important; }
.meteo-bg-soleil .tre-meteo-date,
.meteo-bg-soleil .tre-meteo-detail-label { color: #555 !important; }
.meteo-bg-soleil .tre-meteo-detail-val { color: #222 !important; }
.meteo-bg-soleil .tre-meteo-detail { background: rgba(0,0,0,0.12) !important; }

/* ======================== */
/* PLUIE                    */
/* ======================== */
.meteo-bg-pluie { background: linear-gradient(160deg, #1c3b5a, #2c5f8a); }
.meteo-bg-pluie .goutte {
    position: absolute;
    width: 2px; border-radius: 2px;
    background: rgba(150,200,255,0.7);
    animation: tomber linear infinite;
}
@keyframes tomber {
    0%   { transform: translateY(-20px); opacity: 0; }
    10%  { opacity: 1; }
    100% { transform: translateY(320px); opacity: 0.3; }
}

/* ======================== */
/* NUAGEUX                  */
/* ======================== */
.meteo-bg-nuageux { background: linear-gradient(160deg, #b0bec5, #78909c); }
.meteo-bg-nuage-soleil { background: linear-gradient(160deg, #4da0b0, #d39d38); }
.meteo-bg-nuageux .nuage,
.meteo-bg-nuage-soleil .nuage {
    position: absolute;
    background: rgba(255,255,255,0.85);
    border-radius: 50px;
    animation: flotter linear infinite;
}
.meteo-bg-nuageux .nuage::before,
.meteo-bg-nuage-soleil .nuage::before,
.meteo-bg-nuageux .nuage::after,
.meteo-bg-nuage-soleil .nuage::after {
    content: '';
    position: absolute;
    background: inherit;
    border-radius: 50%;
}
.nuage-1 { width: 120px; height: 40px; top: 20px; left: -140px; animation-duration: 18s; opacity: 0.9; }
.nuage-1::before { width: 60px; height: 60px; top: -30px; left: 15px; }
.nuage-1::after  { width: 45px; height: 45px; top: -20px; left: 50px; }
.nuage-2 { width: 90px; height: 30px; top: 60px; left: -110px; animation-duration: 25s; animation-delay: -8s; opacity: 0.7; }
.nuage-2::before { width: 45px; height: 45px; top: -22px; left: 12px; }
.nuage-2::after  { width: 35px; height: 35px; top: -15px; left: 38px; }
.nuage-3 { width: 150px; height: 50px; top: 10px; left: -180px; animation-duration: 30s; animation-delay: -15s; opacity: 0.6; }
.nuage-3::before { width: 70px; height: 70px; top: -35px; left: 20px; }
.nuage-3::after  { width: 55px; height: 55px; top: -25px; left: 65px; }
@keyframes flotter { from { transform: translateX(0); } to { transform: translateX(700px); } }
.meteo-bg-nuageux .tre-meteo-ville,
.meteo-bg-nuageux .tre-meteo-temp-main,
.meteo-bg-nuageux .tre-meteo-detail-val { color: #222 !important; }
.meteo-bg-nuageux .tre-meteo-date,
.meteo-bg-nuageux .tre-meteo-desc,
.meteo-bg-nuageux .tre-meteo-detail-label { color: #444 !important; }
.meteo-bg-nuageux .tre-meteo-detail { background: rgba(0,0,0,0.1) !important; }

/* ======================== */
/* ORAGE                    */
/* ======================== */
.meteo-bg-orage { background: linear-gradient(160deg, #0f0c29, #302b63); }
.meteo-bg-orage .goutte {
    position: absolute; width: 2px; border-radius: 2px;
    background: rgba(150,200,255,0.6);
    animation: tomber linear infinite;
}
.meteo-bg-orage .eclair {
    position: absolute; top: 10px; right: 40px;
    width: 8px; height: 50px;
    background: #fff700;
    clip-path: polygon(60% 0%, 100% 0%, 40% 50%, 80% 50%, 0% 100%, 30% 50%, 0% 50%);
    animation: eclairFlash 4s ease-in-out infinite;
    filter: drop-shadow(0 0 10px #fff700);
}
@keyframes eclairFlash {
    0%,90%,100% { opacity: 0; }
    91%,93%     { opacity: 1; }
    92%,94%     { opacity: 0; }
    95%         { opacity: 1; }
}

/* ======================== */
/* NEIGE                    */
/* ======================== */
.meteo-bg-neige { background: linear-gradient(160deg, #c9d6e3, #e8f0f7); }
.meteo-bg-neige .flocon {
    position: absolute;
    color: #fff;
    font-size: 18px;
    animation: neiger linear infinite;
    opacity: 0.8;
    user-select: none;
}
@keyframes neiger {
    0%   { transform: translateY(-20px) rotate(0deg); opacity: 0; }
    10%  { opacity: 0.8; }
    100% { transform: translateY(320px) rotate(360deg); opacity: 0; }
}
.meteo-bg-neige .tre-meteo-ville,
.meteo-bg-neige .tre-meteo-temp-main,
.meteo-bg-neige .tre-meteo-detail-val { color: #222 !important; }
.meteo-bg-neige .tre-meteo-date,
.meteo-bg-neige .tre-meteo-desc,
.meteo-bg-neige .tre-meteo-detail-label { color: #444 !important; }
.meteo-bg-neige .tre-meteo-detail { background: rgba(0,0,0,0.08) !important; }

/* ======================== */
/* NUIT                     */
/* ======================== */
.meteo-bg-nuit { background: linear-gradient(160deg, #0f0c29, #302b63, #24243e); }
.meteo-bg-nuit-nuage { background: linear-gradient(160deg, #1a1a2e, #16213e, #0f3460); }
.meteo-bg-nuit .etoile,
.meteo-bg-nuit-nuage .etoile {
    position: absolute; background: #fff;
    border-radius: 50%;
    animation: etoileScintille ease-in-out infinite;
}
@keyframes etoileScintille {
    0%,100% { opacity: 0.2; transform: scale(1); }
    50%     { opacity: 1;   transform: scale(1.4); }
}
.meteo-bg-nuit .lune,
.meteo-bg-nuit-nuage .lune {
    position: absolute; top: 15px; right: 20px;
    width: 55px; height: 55px; border-radius: 50%;
    background: #fffde7;
    box-shadow: 0 0 20px 8px rgba(255,253,200,0.4);
    animation: luneGlow 4s ease-in-out infinite;
}
.meteo-bg-nuit .lune::after,
.meteo-bg-nuit-nuage .lune::after {
    content: '';
    position: absolute; top: 5px; right: -8px;
    width: 45px; height: 45px; border-radius: 50%;
    background: inherit; filter: brightness(0.7);
    box-shadow: none;
}
@keyframes luneGlow {
    0%,100% { box-shadow: 0 0 20px 8px rgba(255,253,200,0.4); }
    50%     { box-shadow: 0 0 35px 15px rgba(255,253,200,0.6); }
}

/* ======================== */
/* BROUILLARD               */
/* ======================== */
.meteo-bg-brouillard { background: linear-gradient(160deg, #606c88, #3f4c6b); }
.meteo-bg-brouillard .brume {
    position: absolute; left: -100%;
    height: 20px; border-radius: 20px;
    background: rgba(255,255,255,0.15);
    animation: brumeFlotter linear infinite;
}
@keyframes brumeFlotter {
    from { left: -100%; }
    to   { left: 120%; }
}
    .tre-meteo-header {
        display: flex; justify-content: space-between;
        align-items: flex-start; margin-bottom: 16px;
    }
    .tre-meteo-ville { font-size: 20px; font-weight: 800; margin: 0 0 4px; }
    .tre-meteo-date  { font-size: 12px; color: #aaa; margin: 0; }
    .tre-meteo-icon  { font-size: 52px; line-height: 1; }
    .tre-meteo-temp-main { font-size: 56px; font-weight: 900; line-height: 1; }
    .tre-meteo-temp-main span { font-size: 28px; font-weight: 400; color: #ccc; }
    .tre-meteo-desc { font-size: 14px; color: #ccc; text-transform: capitalize; margin: 8px 0 20px; }
    .tre-meteo-details { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; }
    .tre-meteo-detail {
        background: rgba(255,255,255,0.08); border-radius: 10px;
        padding: 12px; display: flex; align-items: center; gap: 10px;
    }
    .tre-meteo-detail-icon { font-size: 20px; }
    .tre-meteo-detail-label {
        font-size: 10px; color: #aaa; text-transform: uppercase;
        letter-spacing: 0.5px; display: block; margin-bottom: 2px;
    }
    .tre-meteo-detail-val { font-size: 15px; font-weight: 700; color: #fff; }
    .tre-meteo-footer {
        margin-top: 16px; text-align: right;
        font-size: 10px; color: rgba(255,255,255,0.3);
    }
    .tre-meteo-loading { text-align: center; padding: 20px; color: #aaa; font-size: 14px; }
    .tre-meteo-error {
        text-align: center; padding: 20px; color: #e74c3c;
        font-size: 13px; background: #fff5f5; border-radius: 12px;
    }
    </style>

    <script>
    var TRE_API_KEY = '41e4719bdb4d538ccf2b563dc70105ac';

    var TRE_ICONES = {
        '01d':'☀️','01n':'🌙','02d':'⛅','02n':'⛅',
        '03d':'☁️','03n':'☁️','04d':'☁️','04n':'☁️',
        '09d':'🌧️','09n':'🌧️','10d':'🌦️','10n':'🌦️',
        '11d':'⛈️','11n':'⛈️','13d':'❄️','13n':'❄️',
        '50d':'🌫️','50n':'🌫️'
    };
    var JOURS = ['Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi'];
    var MOIS  = ['Jan','Fév','Mar','Avr','Mai','Jun','Jul','Aoû','Sep','Oct','Nov','Déc'];

    // =====================
    // Charger tous les pays
    // =====================
    function treLoadCountries() {
        fetch('https://countriesnow.space/api/v0.1/countries')
        .then(function(r) { return r.json(); })
        .then(function(res) {
            if (res.error) return;
            var sel = document.getElementById('treMeteoCountry');
            var countries = res.data.sort(function(a, b) {
                return a.country.localeCompare(b.country);
            });

            // Tunisie en premier
            sel.innerHTML = '<option value="">🌍 Choisir un pays</option>';
            sel.innerHTML += '<option value="Tunisia">🇹🇳 Tunisie (par défaut)</option>';
            sel.innerHTML += '<option disabled>──────────────</option>';

            countries.forEach(function(c) {
                if (c.country === 'Tunisia') return; // déjà ajouté
                var opt = document.createElement('option');
                opt.value = c.country;
                opt.textContent = c.country;
                sel.appendChild(opt);
            });

            // Charger Tunis par défaut
            treLoadCitiesForCountry('Tunisia', 'Tunis');
        })
        .catch(function() {
            console.log('Erreur chargement pays');
        });
    }

    // =====================
    // Charger les villes
    // =====================
    function treLoadCities() {
        var country = document.getElementById('treMeteoCountry').value;
        if (!country) return;
        treLoadCitiesForCountry(country, null);
    }

    function treLoadCitiesForCountry(country, defaultCity) {
        var citySelect = document.getElementById('treMeteoCity');
        citySelect.disabled = true;
        citySelect.innerHTML = '<option value="">⏳ Chargement...</option>';

        fetch('https://countriesnow.space/api/v0.1/countries/cities', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ country: country })
        })
        .then(function(r) { return r.json(); })
        .then(function(res) {
            citySelect.innerHTML = '<option value="">🏙️ Choisir une ville</option>';
            if (res.error || !res.data || !res.data.length) {
                citySelect.innerHTML = '<option value="">❌ Aucune ville trouvée</option>';
                return;
            }

            res.data.sort().forEach(function(city) {
                var opt = document.createElement('option');
                opt.value = city;
                opt.textContent = city;
                if (city === defaultCity) opt.selected = true;
                citySelect.appendChild(opt);
            });

            citySelect.disabled = false;

            // Afficher météo par défaut si ville spécifiée
            if (defaultCity) {
                treAfficherMeteo(defaultCity, country);
            }
        })
        .catch(function() {
            citySelect.innerHTML = '<option value="">❌ Erreur</option>';
        });
    }

    function treGetMeteo() {
        var ville   = document.getElementById('treMeteoCity').value;
        var country = document.getElementById('treMeteoCountry').value;
        if (!ville) return;
        treAfficherMeteo(ville, country);
    }

    // =====================
    // Afficher météo
    // =====================
function treAfficherMeteo(ville, country) {
    var result = document.getElementById('treMeteoResult');
    result.innerHTML = '<div class="tre-meteo-loading">⏳ Chargement de la météo...</div>';

    // Essai 1 : ville seule
    var url1 = 'https://api.openweathermap.org/data/2.5/weather'
             + '?q=' + encodeURIComponent(ville)
             + '&appid=' + TRE_API_KEY
             + '&units=metric&lang=fr';

    fetch(url1)
    .then(function(r) { return r.json(); })
    .then(function(data) {

        if (data.cod === 200) {
            treAfficherCarte(data, result);
            return;
        }

        // Essai 2 : ville + pays si le premier échoue
        var url2 = 'https://api.openweathermap.org/data/2.5/weather'
                 + '?q=' + encodeURIComponent(ville + ',' + country)
                 + '&appid=' + TRE_API_KEY
                 + '&units=metric&lang=fr';

        return fetch(url2)
        .then(function(r) { return r.json(); })
        .then(function(data2) {
            if (data2.cod === 200) {
                treAfficherCarte(data2, result);
            } else {
                result.innerHTML =
                    '<div class="tre-meteo-error">' +
                        '⚠️ Météo non disponible pour <strong>' + ville + '</strong>.<br>' +
                        '<small style="color:#aaa">Cette ville n\'est pas répertoriée dans OpenWeatherMap.</small>' +
                    '</div>';
            }
        });
    })
    .catch(function() {
        result.innerHTML = '<div class="tre-meteo-error">❌ Impossible de charger la météo.</div>';
    });
}


function treGetBackground(icon) {
    var configs = {
        '01d': { cls: 'meteo-bg-soleil',      html: '<div class="soleil-ray"></div><div class="soleil-circle"></div>' },
        '01n': { cls: 'meteo-bg-nuit',         html: treGenEtoiles() + '<div class="lune"></div>' },
        '02d': { cls: 'meteo-bg-nuage-soleil', html: treGenNuages() },
        '02n': { cls: 'meteo-bg-nuit-nuage',   html: treGenEtoiles() + '<div class="lune"></div>' + treGenNuages() },
        '03d': { cls: 'meteo-bg-nuageux',      html: treGenNuages() },
        '03n': { cls: 'meteo-bg-nuit-nuage',   html: treGenNuages() },
        '04d': { cls: 'meteo-bg-nuageux',      html: treGenNuages() },
        '04n': { cls: 'meteo-bg-nuit-nuage',   html: treGenNuages() },
        '09d': { cls: 'meteo-bg-pluie',        html: treGenPluie(30) },
        '09n': { cls: 'meteo-bg-pluie',        html: treGenPluie(30) },
        '10d': { cls: 'meteo-bg-pluie',        html: treGenNuages() + treGenPluie(20) },
        '10n': { cls: 'meteo-bg-pluie',        html: treGenPluie(20) },
        '11d': { cls: 'meteo-bg-orage',        html: treGenPluie(25) + '<div class="eclair"></div>' },
        '11n': { cls: 'meteo-bg-orage',        html: treGenPluie(25) + '<div class="eclair"></div>' },
        '13d': { cls: 'meteo-bg-neige',        html: treGenNeige(20) },
        '13n': { cls: 'meteo-bg-neige',        html: treGenNeige(20) },
        '50d': { cls: 'meteo-bg-brouillard',   html: treGenBrume() },
        '50n': { cls: 'meteo-bg-brouillard',   html: treGenBrume() },
    };
    return configs[icon] || { cls: 'meteo-bg-nuit', html: treGenEtoiles() + '<div class="lune"></div>' };
}

function treGenPluie(n) {
    var html = '';
    for (var i = 0; i < n; i++) {
        var left   = Math.random() * 100;
        var delay  = Math.random() * 2;
        var dur    = 0.5 + Math.random() * 0.7;
        var height = 10 + Math.random() * 15;
        html += '<div class="goutte" style="left:' + left + '%;height:' + height + 'px;animation-delay:' + delay + 's;animation-duration:' + dur + 's;"></div>';
    }
    return html;
}

function treGenNeige(n) {
    var html = '';
    var flocons = ['❄','✦','*','·','❅'];
    for (var i = 0; i < n; i++) {
        var left  = Math.random() * 100;
        var delay = Math.random() * 5;
        var dur   = 3 + Math.random() * 4;
        var size  = 10 + Math.random() * 14;
        var f     = flocons[Math.floor(Math.random() * flocons.length)];
        html += '<div class="flocon" style="left:' + left + '%;font-size:' + size + 'px;animation-delay:' + delay + 's;animation-duration:' + dur + 's;">' + f + '</div>';
    }
    return html;
}

function treGenNuages() {
    return '<div class="nuage nuage-1"></div><div class="nuage nuage-2"></div><div class="nuage nuage-3"></div>';
}

function treGenEtoiles() {
    var html = '';
    for (var i = 0; i < 25; i++) {
        var x     = Math.random() * 100;
        var y     = Math.random() * 60;
        var size  = 1 + Math.random() * 2.5;
        var delay = Math.random() * 4;
        var dur   = 2 + Math.random() * 3;
        html += '<div class="etoile" style="left:' + x + '%;top:' + y + '%;width:' + size + 'px;height:' + size + 'px;animation-duration:' + dur + 's;animation-delay:' + delay + 's;"></div>';
    }
    return html;
}

function treGenBrume() {
    var html = '';
    var tops  = [15, 35, 55, 75, 90];
    var widths = [200, 280, 180, 250, 210];
    var durs   = [8, 12, 10, 15, 9];
    var delays = [0, -3, -6, -2, -8];
    for (var i = 0; i < 5; i++) {
        html += '<div class="brume" style="top:' + tops[i] + '%;width:' + widths[i] + 'px;height:' + (12 + i*3) + 'px;animation-duration:' + durs[i] + 's;animation-delay:' + delays[i] + 's;"></div>';
    }
    return html;
}

function treAfficherCarte(data, result) {
    var now      = new Date();
    var jour     = JOURS[now.getDay()];
    var date     = now.getDate() + ' ' + MOIS[now.getMonth()] + ' ' + now.getFullYear();
    var heure    = now.getHours() + ':' + String(now.getMinutes()).padStart(2,'0');
    var icon     = TRE_ICONES[data.weather[0].icon] || '🌡️';
    var temp     = Math.round(data.main.temp);
    var ressenti = Math.round(data.main.feels_like);
    var humidity = data.main.humidity;
    var wind     = Math.round(data.wind.speed * 3.6);
    var pression = data.main.pressure;
    var visib    = data.visibility ? Math.round(data.visibility / 1000) + ' km' : 'N/A';

var bg = treGetBackground(data.weather[0].icon);

result.innerHTML =
    '<div class="tre-meteo-card ' + bg.cls + '">' +
        '<div class="tre-meteo-bg">' + bg.html + '</div>' +
        '<div class="tre-meteo-content">' +
            '<div class="tre-meteo-header">' +
                '<div>' +
                    '<p class="tre-meteo-ville">📍 ' + data.name + '</p>' +
                    '<p class="tre-meteo-date">' + jour + ' ' + date + ' · ' + heure + '</p>' +
                '</div>' +
                '<div class="tre-meteo-icon">' + icon + '</div>' +
            '</div>' +
            '<div class="tre-meteo-temp-main">' + temp + '<span>°C</span></div>' +
            '<p class="tre-meteo-desc">' + data.weather[0].description + ' · Ressenti ' + ressenti + '°C</p>' +
            '<div class="tre-meteo-details">' +
                '<div class="tre-meteo-detail"><span class="tre-meteo-detail-icon">💧</span><div><span class="tre-meteo-detail-label">Humidité</span><span class="tre-meteo-detail-val">' + humidity + '%</span></div></div>' +
                '<div class="tre-meteo-detail"><span class="tre-meteo-detail-icon">💨</span><div><span class="tre-meteo-detail-label">Vent</span><span class="tre-meteo-detail-val">' + wind + ' km/h</span></div></div>' +
                '<div class="tre-meteo-detail"><span class="tre-meteo-detail-icon">🌡️</span><div><span class="tre-meteo-detail-label">Pression</span><span class="tre-meteo-detail-val">' + pression + ' hPa</span></div></div>' +
                '<div class="tre-meteo-detail"><span class="tre-meteo-detail-icon">👁️</span><div><span class="tre-meteo-detail-label">Visibilité</span><span class="tre-meteo-detail-val">' + visib + '</span></div></div>' +
            '</div>' +
            '<div class="tre-meteo-footer">Mis à jour à ' + heure + ' · OpenWeatherMap</div>' +
        '</div>' +
    '</div>';

    setTimeout(function() { treAfficherMeteo(data.name, ''); }, 600000);
}

    // Démarrer
    document.addEventListener('DOMContentLoaded', function() {
        treLoadCountries();
    });
    </script>
    <?php
    return ob_get_clean();
}
add_shortcode('meteo', 'tre_meteo_shortcode');

function tre_header_radio_social() {
?>
<style>
.tre-radio-player {
    display: flex; align-items: center; gap: 10px;
    padding: 4px 14px 4px 8px;
    background: rgba(255,255,255,0.08);
    border-radius: 30px;
    border: 1px solid rgba(255,255,255,0.15);
    cursor: pointer;
    transition: background 0.2s;
    flex-shrink: 0;
}
.tre-radio-player:hover { background: rgba(255,255,255,0.15); }
.tre-onair {
    display: flex; align-items: center; gap: 5px;
    background: #e74c3c; color: #fff;
    font-size: 10px; font-weight: 900;
    padding: 4px 10px; border-radius: 20px;
    letter-spacing: 1.5px; text-transform: uppercase;
    flex-shrink: 0;
}
.tre-onair-dot {
    width: 7px; height: 7px; border-radius: 50%;
    background: #fff;
    animation: trePulse 1s ease-in-out infinite;
}
@keyframes trePulse {
    0%,100% { opacity: 1; transform: scale(1); }
    50%      { opacity: 0.3; transform: scale(0.7); }
}
.tre-radio-info { overflow: hidden; max-width: 160px; }
.tre-radio-title {
    font-size: 11px; font-weight: 700; color: #fff;
    white-space: nowrap; overflow: hidden;
    text-overflow: ellipsis; line-height: 1.3;
}
.tre-radio-sub { font-size: 10px; color: rgba(255,255,255,0.6); white-space: nowrap; }
.tre-play-btn {
    width: 30px; height: 30px; border-radius: 50%;
    background: #fff; border: none; cursor: pointer;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0; transition: transform 0.2s;
    font-size: 12px; padding: 0;
}
.tre-play-btn:hover { transform: scale(1.1); }
.tre-volume { display: flex; align-items: center; gap: 6px; flex-shrink: 0; }
.tre-vol-icon { font-size: 14px; color: rgba(255,255,255,0.7); }
.tre-vol-slider {
    -webkit-appearance: none; appearance: none;
    width: 60px; height: 3px;
    background: rgba(255,255,255,0.3);
    border-radius: 3px; outline: none; cursor: pointer;
}
.tre-vol-slider::-webkit-slider-thumb {
    -webkit-appearance: none; appearance: none;
    width: 12px; height: 12px; border-radius: 50%;
    background: #e74c3c; cursor: pointer;
}
.tre-social-links {
    display: flex; align-items: center; gap: 6px; flex-shrink: 0;
}
.tre-social-link {
    display: flex; align-items: center; justify-content: center;
    width: 32px; height: 32px; border-radius: 50%;
    background: rgba(255,255,255,0.1);
    color: #fff; text-decoration: none;
    font-size: 14px; transition: all 0.2s;
    border: 1px solid rgba(255,255,255,0.15);
    flex-shrink: 0;
}
.tre-social-link:hover { transform: translateY(-2px); color: #fff; }
.tre-social-link.fb:hover { background: #1877F2; border-color: #1877F2; }
.tre-social-link.tw:hover { background: #1DA1F2; border-color: #1DA1F2; }
.tre-social-link.yt:hover { background: #FF0000; border-color: #FF0000; }
.tre-social-link.ig:hover { background: linear-gradient(45deg,#f09433,#e6683c,#dc2743,#cc2366,#bc1888); border-color: #dc2743; }
.tre-social-link.tg:hover { background: #0088cc; border-color: #0088cc; }
.tre-social-link.ml:hover { background: #e74c3c; border-color: #e74c3c; }
.tre-header-sep { width: 1px; height: 24px; background: rgba(255,255,255,0.2); flex-shrink: 0; margin: 0 4px; }

@media(max-width: 768px) {
    .tre-radio-info, .tre-volume { display: none !important; }
    .tre-radio-player { padding: 4px 8px; }
    .tre-social-links { gap: 4px; }
    .tre-social-link { width: 28px; height: 28px; font-size: 12px; }
}
@media(max-width: 480px) {
    .tre-social-links { gap: 2px; }
    .tre-social-link { width: 24px; height: 24px; font-size: 11px; }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {

    var blackBar = document.querySelector('.header__menu-wrapper .header__category-maenu');
    if (!blackBar) return;

    var radioUrl = 'https://radio.mosaiquefm.net/mosalive'; // ← REMPLACE
    var audio    = new Audio();
    audio.preload = 'none';
    var isPlaying = false;

    var playerHTML =
        '<div class="tre-radio-player" id="treRadioPlayer">' +
            '<div class="tre-onair"><span class="tre-onair-dot"></span> ON AIR</div>' +
            '<button class="tre-play-btn" id="trePlayBtn" title="Lecture / Pause">▶</button>' +
            '<div class="tre-radio-info">' +
                '<div class="tre-radio-title" id="treRadioTitle">TRE Radio</div>' +
                '<div class="tre-radio-sub">Radio Tunisiens R&eacute;sidents &agrave; l\'&Eacute;tranger</div>' +
            '</div>' +
            '<div class="tre-volume">' +
                '<span class="tre-vol-icon">🔊</span>' +
                '<input type="range" class="tre-vol-slider" id="treVolume" min="0" max="1" step="0.05" value="0.8">' +
            '</div>' +
        '</div>';

    var socialHTML =
        '<div class="tre-header-sep"></div>' +
        '<div class="tre-social-links">' +
            '<a href="https://facebook.com/TRERadio" target="_blank" class="tre-social-link fb" title="Facebook">' +
                '<svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"/></svg>' +
            '</a>' +
            '<a href="https://twitter.com/TRERadio" target="_blank" class="tre-social-link tw" title="Twitter / X">' +
                '<svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"/></svg>' +
            '</a>' +
            '<a href="https://youtube.com/TRERadio" target="_blank" class="tre-social-link yt" title="YouTube">' +
                '<svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M22.54 6.42a2.78 2.78 0 00-1.95-1.96C18.88 4 12 4 12 4s-6.88 0-8.59.46a2.78 2.78 0 00-1.95 1.96A29 29 0 001 12a29 29 0 00.46 5.58A2.78 2.78 0 003.41 19.6C5.12 20 12 20 12 20s6.88 0 8.59-.46a2.78 2.78 0 001.95-1.95A29 29 0 0023 12a29 29 0 00-.46-5.58zM9.75 15.02V8.98L15.5 12l-5.75 3.02z"/></svg>' +
            '</a>' +
            '<a href="https://instagram.com/TRERadio" target="_blank" class="tre-social-link ig" title="Instagram">' +
                '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="1" fill="currentColor" stroke="none"/></svg>' +
            '</a>' +
            '<a href="https://t.me/TRERadio" target="_blank" class="tre-social-link tg" title="Telegram">' +
                '<svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M22 2L11 13M22 2L15 22l-4-9-9-4 20-7z"/></svg>' +
            '</a>' +
            '<a href="mailto:contact@tre-radio.com" class="tre-social-link ml" title="Email">' +
                '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>' +
            '</a>' +
        '</div>';

    // ============================================================
    // Mise en page flex de la barre noire
    // ============================================================
    blackBar.style.cssText = 'display:flex !important; align-items:center !important; justify-content:space-between !important; width:100% !important; padding:6px 16px !important;';

    // Menu centré
    var navUl = blackBar.querySelector('#byteflows-category-nav');
    if (navUl) {
        navUl.style.cssText = 'flex:1 !important; display:flex !important; justify-content:center !important; align-items:center !important;';
    }

    // GAUCHE → Lecteur radio
    var playerDiv = document.createElement('div');
    playerDiv.style.cssText = 'flex-shrink:0; display:flex; align-items:center;';
    playerDiv.innerHTML = playerHTML;
    blackBar.insertBefore(playerDiv, blackBar.firstChild);

    // DROITE → Réseaux sociaux
    var socialDiv = document.createElement('div');
    socialDiv.style.cssText = 'flex-shrink:0; display:flex; align-items:center; gap:6px;';
    socialDiv.innerHTML = socialHTML;
    blackBar.appendChild(socialDiv);

// ============================================================
    // LOGIQUE PLAY / PAUSE
    // ============================================================
    var playBtn   = document.getElementById('trePlayBtn');
    var volSlider = document.getElementById('treVolume');

    // Précharger le stream dès le chargement de la page → réduit le délai
    audio.src = radioUrl;
    audio.load();

    if (playBtn) {
        playBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            if (isPlaying) {
                audio.pause();
                // Ne pas vider src pour garder le buffer
                playBtn.textContent = '▶';
                isPlaying = false;
            } else {
                audio.volume = volSlider ? parseFloat(volSlider.value) : 0.8;
                var playPromise = audio.play();
                if (playPromise !== undefined) {
                    playPromise.then(function() {
                        playBtn.textContent = '⏸';
                        isPlaying = true;
                    }).catch(function() {
                        // Retry avec nouvelle src si erreur
                        audio.src = radioUrl;
                        audio.load();
                        audio.play().then(function() {
                            playBtn.textContent = '⏸';
                            isPlaying = true;
                        });
                    });
                }
            }
        });
    }

    // FIX VOLUME : stopper la propagation pour éviter le play/pause
    if (volSlider) {
        volSlider.addEventListener('click', function(e) {
            e.stopPropagation(); // ← empêche le clic de déclencher play/pause
        });
        volSlider.addEventListener('mousedown', function(e) {
            e.stopPropagation();
        });
        volSlider.addEventListener('touchstart', function(e) {
            e.stopPropagation();
        });
        volSlider.addEventListener('input', function(e) {
            e.stopPropagation();
            audio.volume = parseFloat(this.value);
            var volIcon = document.querySelector('.tre-vol-icon');
            if (volIcon) {
                volIcon.textContent = this.value == 0 ? '🔇' : this.value < 0.5 ? '🔉' : '🔊';
            }
        });
    }

    var player = document.getElementById('treRadioPlayer');
    if (player) {
        player.addEventListener('click', function(e) {
            // Ne déclencher que si clic direct sur le player (pas sur slider)
            if (e.target.tagName !== 'INPUT') {
                if (playBtn) playBtn.click();
            }
        });
    }
});
</script>
<?php
}
add_action('wp_footer', 'tre_header_radio_social');


// =============================================
// PAGE PROFIL TRE RADIO - COLONNES EXACTES DB
// =============================================

/**
 * Shortcode : [profil_membre]
 * Avec upload d'avatar via clic sur le badge 📷
 */

// ─── Handler AJAX upload avatar ───────────────────────────────────────────────
add_action('wp_ajax_trp_update_avatar', 'trp_handle_avatar_upload');
function trp_handle_avatar_upload() {
    check_ajax_referer('trp_avatar_nonce', 'nonce');

    $user_id = get_current_user_id();
    if (!$user_id) wp_send_json_error('Non autorisé.');

    if (empty($_FILES['avatar']['tmp_name'])) wp_send_json_error('Aucun fichier reçu.');

    require_once ABSPATH . 'wp-admin/includes/image.php';
    require_once ABSPATH . 'wp-admin/includes/file.php';
    require_once ABSPATH . 'wp-admin/includes/media.php';

    $attachment_id = media_handle_upload('avatar', 0);

    if (is_wp_error($attachment_id)) {
        wp_send_json_error($attachment_id->get_error_message());
    }

    $url = wp_get_attachment_url($attachment_id);
    update_user_meta($user_id, 'trp_avatar', $url);
    update_user_meta($user_id, 'trp_avatar_id', $attachment_id);

    wp_send_json_success(['url' => $url]);
}

// ─── Shortcode principal ───────────────────────────────────────────────────────
function tre_profil_shortcode() {
    if (!is_user_logged_in()) {
        return '<div style="text-align:center;padding:40px"><p>Veuillez <a href="' . home_url('/login') . '" style="color:#e74c3c;font-weight:700">vous connecter</a>.</p></div>';
    }

    global $wpdb;
    $user_id = get_current_user_id();
    $user    = wp_get_current_user();

    // Avatar : priorité à la meta trp_avatar, sinon Gravatar
    $custom_avatar = get_user_meta($user_id, 'trp_avatar', true);
    $avatar        = $custom_avatar ?: get_avatar_url($user_id, ['size' => 200]);

    // Récupérer les données des 3 tables
    $membre       = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$wpdb->prefix}tre_membre WHERE user_id=%d", $user_id));
    $partenaire   = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$wpdb->prefix}tre_partenaire WHERE user_id=%d", $user_id));
    $investisseur = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$wpdb->prefix}tre_investisseur WHERE user_id=%d", $user_id));

    // Infos communes
    $nom       = $membre->nom               ?? $investisseur->nom              ?? $user->display_name;
    $prenom    = $membre->prenom            ?? $investisseur->prenom            ?? '';
    $pays      = $membre->pays              ?? $investisseur->pays_residence    ?? '';
    $ville     = $membre->ville             ?? '';
    $tel       = $membre->telephone         ?? $investisseur->telephone         ?? $partenaire->telephone ?? '';
    $email     = $membre->email             ?? $investisseur->email             ?? $partenaire->email     ?? $user->user_email;
    $situation = $membre->situation         ?? '';
    $secteur   = $membre->secteur_activite  ?? '';

    ob_start(); ?>
    <style>
    .trp-wrap { max-width:100%; margin:0; font-family:'Segoe UI',sans-serif; background:#f0f2f5; min-height:100vh; padding-bottom:40px; }
    .trp-header { background:#fff; border-radius:0 0 12px 12px; padding:24px 32px 0; box-shadow:0 2px 12px rgba(0,0,0,0.08); }
    .trp-avatar-wrap { position:relative; display:inline-block; }
    .trp-avatar { width:120px; height:120px; border-radius:50%; border:4px solid #e74c3c; object-fit:cover; box-shadow:0 2px 16px rgba(0,0,0,0.2); display:block; transition:opacity 0.3s; }
    .trp-avatar-wrap:hover .trp-avatar { opacity:0.85; }
    .trp-avatar-badge {
        position:absolute; bottom:6px; right:6px;
        width:32px; height:32px; border-radius:50%;
        background:#e74c3c; border:3px solid #fff;
        display:flex; align-items:center; justify-content:center;
        font-size:14px; cursor:pointer;
        box-shadow:0 2px 8px rgba(0,0,0,0.2);
        transition:transform 0.2s, background 0.2s;
    }
    .trp-avatar-badge:hover { transform:scale(1.15); background:#c0392b; }
    .trp-avatar-uploading { animation:trp-spin 1s linear infinite; }
    @keyframes trp-spin { to { transform:rotate(360deg); } }
    .trp-avatar-toast {
        position:fixed; bottom:24px; left:50%; transform:translateX(-50%);
        background:#1c1e21; color:#fff; padding:12px 24px; border-radius:30px;
        font-size:14px; font-weight:600; z-index:9999;
        opacity:0; transition:opacity 0.3s; pointer-events:none;
    }
    .trp-avatar-toast.show { opacity:1; }
    .trp-avatar-toast.success { background:#27ae60; }
    .trp-avatar-toast.error   { background:#e74c3c; }
    .trp-header-top { display:flex; align-items:center; gap:20px; padding-bottom:16px; flex-wrap:wrap; }
    .trp-header-info { display:flex; justify-content:space-between; align-items:flex-start; flex:1; flex-wrap:wrap; gap:12px; }
    .trp-name { font-size:26px; font-weight:900; color:#1c1e21; margin:0 0 4px; }
    .trp-username { font-size:14px; color:#65676b; margin:0 0 8px; }
    .trp-badges { display:flex; gap:8px; flex-wrap:wrap; }
    .trp-badge { padding:4px 12px; border-radius:20px; font-size:12px; font-weight:700; }
    .trp-badge-membre  { background:#e8f4fd; color:#0d6efd; }
    .trp-badge-part    { background:#e8f8f0; color:#198754; }
    .trp-badge-invest  { background:#fff3e0; color:#e65100; }
    .trp-btn-edit { background:#e74c3c; color:#fff; border:none; padding:10px 20px; border-radius:8px; font-weight:700; font-size:14px; cursor:pointer; text-decoration:none; display:inline-flex; align-items:center; gap:6px; }
    .trp-btn-edit:hover { background:#c0392b; color:#fff; }
    .trp-tabs { border-top:1px solid #e4e6eb; margin-top:16px; display:flex; gap:0; overflow-x:auto; }
    .trp-tab { padding:14px 20px; font-size:15px; font-weight:600; color:#65676b; cursor:pointer; border:none; background:none; border-bottom:3px solid transparent; white-space:nowrap; transition:all 0.2s; }
    .trp-tab:hover { color:#e74c3c; background:#f5f5f5; border-radius:8px 8px 0 0; }
    .trp-tab.active { color:#e74c3c; border-bottom-color:#e74c3c; }
    .trp-tab-content { display:none; padding:20px; }
    .trp-tab-content.active { display:grid; grid-template-columns:360px 1fr; gap:20px; }
    .trp-col-left, .trp-col-right { display:flex; flex-direction:column; gap:16px; }
    .trp-card { background:#fff; border-radius:12px; padding:20px; box-shadow:0 2px 8px rgba(0,0,0,0.06); }
    .trp-card-title { font-size:18px; font-weight:800; color:#1c1e21; margin:0 0 16px; display:flex; justify-content:space-between; align-items:center; }
    .trp-card-edit { font-size:13px; color:#e74c3c; font-weight:600; text-decoration:none; cursor:pointer; }
    .trp-info-row { display:flex; align-items:center; gap:12px; padding:10px 0; border-bottom:1px solid #f0f2f5; font-size:14px; color:#1c1e21; }
    .trp-info-row:last-child { border-bottom:none; }
    .trp-info-icon { font-size:20px; width:28px; text-align:center; flex-shrink:0; }
    .trp-info-label { color:#65676b; font-size:12px; display:block; }
    .trp-info-val { font-weight:600; }
    .trp-grid-2 { display:grid; grid-template-columns:1fr 1fr; gap:12px; }
    .trp-field-box { background:#f8f9fa; border-radius:10px; padding:12px 16px; }
    .trp-field-label { font-size:11px; color:#65676b; font-weight:700; text-transform:uppercase; letter-spacing:0.5px; margin-bottom:4px; }
    .trp-field-val { font-size:14px; font-weight:600; color:#1c1e21; }
    .trp-text-box { margin-top:10px; padding:14px; background:#f8f9fa; border-radius:10px; font-size:14px; color:#1c1e21; line-height:1.6; }
    .trp-section-sep { margin:16px 0 8px; padding-top:16px; border-top:2px solid #f0f2f5; font-size:13px; font-weight:800; color:#1c1e21; }
    .trp-tags { display:flex; flex-wrap:wrap; gap:8px; margin-top:8px; }
    .trp-tag { background:#fff0f0; color:#e74c3c; border:1px solid #fcc; padding:4px 12px; border-radius:20px; font-size:12px; font-weight:600; }
    .trp-empty { text-align:center; padding:32px 20px; color:#65676b; }
    .trp-empty-icon { font-size:48px; margin-bottom:12px; }
    .trp-empty p { margin:0 0 16px; font-size:14px; }
    .trp-empty a { background:#e74c3c; color:#fff; padding:10px 24px; border-radius:8px; font-weight:700; text-decoration:none; font-size:13px; }
    @media(max-width:768px) {
        .trp-tab-content.active { grid-template-columns:1fr; }
        .trp-header { padding:16px 16px 0; }
        .trp-name { font-size:20px; }
        .trp-grid-2 { grid-template-columns:1fr; }
        .trp-avatar { width:90px; height:90px; }
    }
    </style>

    <!-- Toast notification -->
    <div class="trp-avatar-toast" id="trp-toast"></div>

    <div class="trp-wrap">

        <!-- HEADER -->
        <div class="trp-header">
            <div class="trp-header-top">
                <div class="trp-avatar-wrap">
                    <img src="<?php echo esc_url($avatar); ?>"
                         alt="<?php echo esc_attr($nom); ?>"
                         class="trp-avatar"
                         id="trp-avatar-preview">

                    <!-- Input file caché -->
                    <input type="file"
                           id="trp-avatar-input"
                           accept="image/jpeg,image/png,image/gif,image/webp"
                           style="display:none;">

                    <!-- Badge caméra -->
                    <div class="trp-avatar-badge"
                         id="trp-avatar-trigger"
                         title="Modifier la photo de profil">📷</div>
                </div>

                <div class="trp-header-info">
                    <div>
                        <h1 class="trp-name"><?php echo esc_html(trim($prenom . ' ' . $nom)); ?></h1>
                        <p class="trp-username">@<?php echo esc_html($user->user_login); ?> · Membre TRE Radio</p>
                        <div class="trp-badges">
                            <?php if ($membre)       echo '<span class="trp-badge trp-badge-membre">👤 Membre</span>'; ?>
                            <?php if ($partenaire)   echo '<span class="trp-badge trp-badge-part">🏢 Partenaire</span>'; ?>
                            <?php if ($investisseur) echo '<span class="trp-badge trp-badge-invest">💼 Investisseur</span>'; ?>
                        </div>
                    </div>
                    <div>
                        <a href="<?php echo home_url('/espace-membre'); ?>" class="trp-btn-edit">✏️ Modifier le profil</a>
                    </div>
                </div>
            </div>
            <div class="trp-tabs">
                <button class="trp-tab active" data-tab="apercu">Aperçu</button>
                <?php if ($membre)       : ?><button class="trp-tab" data-tab="membre">👤 Fiche Membre</button><?php endif; ?>
                <?php if ($partenaire)   : ?><button class="trp-tab" data-tab="partenaire">🏢 Fiche Partenaire</button><?php endif; ?>
                <?php if ($investisseur) : ?><button class="trp-tab" data-tab="investisseur">💼 Fiche Investisseur</button><?php endif; ?>
            </div>
        </div>

        <!-- ====== ONGLET APERÇU ====== -->
        <div class="trp-tab-content active" id="tab-apercu">
            <div class="trp-col-left">
                <div class="trp-card">
                    <div class="trp-card-title">Infos personnelles <a class="trp-card-edit" href="<?php echo home_url('/espace-membre'); ?>">Modifier</a></div>
                    <?php if ($prenom || $nom) : ?>
                    <div class="trp-info-row"><span class="trp-info-icon">👤</span><div><span class="trp-info-label">Nom complet</span><span class="trp-info-val"><?php echo esc_html(trim($prenom . ' ' . $nom)); ?></span></div></div>
                    <?php endif; ?>
                    <?php if ($email) : ?>
                    <div class="trp-info-row"><span class="trp-info-icon">📧</span><div><span class="trp-info-label">Email</span><span class="trp-info-val"><?php echo esc_html($email); ?></span></div></div>
                    <?php endif; ?>
                    <?php if ($tel) : ?>
                    <div class="trp-info-row"><span class="trp-info-icon">📞</span><div><span class="trp-info-label">Téléphone</span><span class="trp-info-val"><?php echo esc_html($tel); ?></span></div></div>
                    <?php endif; ?>
                    <?php if ($pays) : ?>
                    <div class="trp-info-row"><span class="trp-info-icon">🌍</span><div><span class="trp-info-label">Pays</span><span class="trp-info-val"><?php echo esc_html($pays); ?></span></div></div>
                    <?php endif; ?>
                    <?php if ($ville) : ?>
                    <div class="trp-info-row"><span class="trp-info-icon">📍</span><div><span class="trp-info-label">Ville</span><span class="trp-info-val"><?php echo esc_html($ville); ?></span></div></div>
                    <?php endif; ?>
                    <?php if ($situation) : ?>
                    <div class="trp-info-row"><span class="trp-info-icon">💼</span><div><span class="trp-info-label">Situation</span><span class="trp-info-val"><?php echo esc_html($situation); ?></span></div></div>
                    <?php endif; ?>
                    <?php if ($secteur) : ?>
                    <div class="trp-info-row"><span class="trp-info-icon">🏭</span><div><span class="trp-info-label">Secteur d'activité</span><span class="trp-info-val"><?php echo esc_html($secteur); ?></span></div></div>
                    <?php endif; ?>
                    <?php if (!$email && !$tel && !$pays && !$ville && !$situation) : ?>
                    <div class="trp-empty"><div class="trp-empty-icon">👤</div><p>Aucune information renseignée</p><a href="<?php echo home_url('/espace-membre'); ?>">Compléter le profil</a></div>
                    <?php endif; ?>
                </div>

                <div class="trp-card">
                    <div class="trp-card-title">Mes espaces</div>
                    <div style="display:flex;flex-direction:column;gap:10px;">
                        <a href="<?php echo home_url('/espace-membre'); ?>" style="display:flex;align-items:center;gap:12px;padding:12px;background:#f8f9fa;border-radius:10px;text-decoration:none;color:#1c1e21;">
                            <span style="font-size:24px;">👤</span><div><div style="font-weight:700;font-size:14px;">Espace Membre</div><div style="font-size:12px;color:#65676b;"><?php echo $membre ? '✅ Fiche complétée' : '⚠️ À compléter'; ?></div></div>
                        </a>
                        <a href="<?php echo home_url('/espace-partenaire'); ?>" style="display:flex;align-items:center;gap:12px;padding:12px;background:#f8f9fa;border-radius:10px;text-decoration:none;color:#1c1e21;">
                            <span style="font-size:24px;">🏢</span><div><div style="font-weight:700;font-size:14px;">Espace Partenaire</div><div style="font-size:12px;color:#65676b;"><?php echo $partenaire ? '✅ Fiche complétée' : '⚠️ À compléter'; ?></div></div>
                        </a>
                        <a href="<?php echo home_url('/espace-investisseur'); ?>" style="display:flex;align-items:center;gap:12px;padding:12px;background:#f8f9fa;border-radius:10px;text-decoration:none;color:#1c1e21;">
                            <span style="font-size:24px;">💼</span><div><div style="font-weight:700;font-size:14px;">Espace Investisseur</div><div style="font-size:12px;color:#65676b;"><?php echo $investisseur ? '✅ Fiche complétée' : '⚠️ À compléter'; ?></div></div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="trp-col-right">
                <?php if ($membre && $membre->type_projet) : ?>
                <div class="trp-card">
                    <div class="trp-card-title">📋 Projet en cours <a class="trp-card-edit" href="<?php echo home_url('/espace-membre'); ?>">Modifier</a></div>
                    <div class="trp-grid-2">
                        <div class="trp-field-box"><div class="trp-field-label">Type de projet</div><div class="trp-field-val"><?php echo esc_html($membre->type_projet ?: '—'); ?></div></div>
                        <div class="trp-field-box"><div class="trp-field-label">Secteur projet</div><div class="trp-field-val"><?php echo esc_html($membre->secteur_projet ?: '—'); ?></div></div>
                        <div class="trp-field-box"><div class="trp-field-label">Région Tunisie</div><div class="trp-field-val"><?php echo esc_html($membre->region_tunisie ?: '—'); ?></div></div>
                        <div class="trp-field-box"><div class="trp-field-label">Délai</div><div class="trp-field-val"><?php echo esc_html($membre->delai_projet ?: '—'); ?></div></div>
                        <div class="trp-field-box"><div class="trp-field-label">Budget</div><div class="trp-field-val"><?php echo esc_html($membre->budget ?: '—'); ?></div></div>
                        <div class="trp-field-box"><div class="trp-field-label">Type entreprise</div><div class="trp-field-val"><?php echo esc_html($membre->type_entreprise ?: '—'); ?></div></div>
                    </div>
                    <?php if ($membre->description_projet) : ?>
                    <div class="trp-text-box"><?php echo nl2br(esc_html($membre->description_projet)); ?></div>
                    <?php endif; ?>
                </div>
                <?php endif; ?>

                <?php if ($investisseur) : ?>
                <div class="trp-card">
                    <div class="trp-card-title">💼 Profil Investisseur <a class="trp-card-edit" href="<?php echo home_url('/espace-investisseur'); ?>">Modifier</a></div>
                    <div class="trp-grid-2">
                        <div class="trp-field-box"><div class="trp-field-label">Type</div><div class="trp-field-val"><?php echo esc_html($investisseur->type_investisseur ?: '—'); ?></div></div>
                        <div class="trp-field-box"><div class="trp-field-label">Budget</div><div class="trp-field-val"><?php echo esc_html($investisseur->budget_investissement ?: '—'); ?></div></div>
                        <div class="trp-field-box"><div class="trp-field-label">Horizon</div><div class="trp-field-val"><?php echo esc_html($investisseur->horizon_investissement ?: '—'); ?></div></div>
                        <div class="trp-field-box"><div class="trp-field-label">Participation</div><div class="trp-field-val"><?php echo esc_html($investisseur->niveau_participation ?: '—'); ?></div></div>
                    </div>
                    <?php if ($investisseur->secteurs_recherches) : ?>
                    <div style="margin-top:12px;"><div class="trp-field-label" style="margin-bottom:8px;">Secteurs recherchés</div>
                    <div class="trp-tags"><?php foreach(explode(',', $investisseur->secteurs_recherches) as $s) echo '<span class="trp-tag">'.esc_html(trim($s)).'</span>'; ?></div></div>
                    <?php endif; ?>
                </div>
                <?php endif; ?>

                <?php if ($partenaire) : ?>
                <div class="trp-card">
                    <div class="trp-card-title">🏢 Profil Partenaire <a class="trp-card-edit" href="<?php echo home_url('/espace-partenaire'); ?>">Modifier</a></div>
                    <div class="trp-grid-2">
                        <div class="trp-field-box"><div class="trp-field-label">Entreprise</div><div class="trp-field-val"><?php echo esc_html($partenaire->nom_entreprise ?: '—'); ?></div></div>
                        <div class="trp-field-box"><div class="trp-field-label">Type de service</div><div class="trp-field-val"><?php echo esc_html($partenaire->type_service ?: '—'); ?></div></div>
                        <div class="trp-field-box"><div class="trp-field-label">Zone</div><div class="trp-field-val"><?php echo esc_html($partenaire->zone_intervention ?: '—'); ?></div></div>
                        <div class="trp-field-box"><div class="trp-field-label">Type d'offre</div><div class="trp-field-val"><?php echo esc_html($partenaire->type_offre ?: '—'); ?></div></div>
                    </div>
                </div>
                <?php endif; ?>

                <?php if (!$membre && !$partenaire && !$investisseur) : ?>
                <div class="trp-card">
                    <div class="trp-empty"><div class="trp-empty-icon">📋</div>
                    <p>Votre profil est vide. Complétez vos fiches pour apparaître dans l'annuaire TRE Radio.</p>
                    <a href="<?php echo home_url('/espace-membre'); ?>">Compléter maintenant</a></div>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- ====== ONGLET FICHE MEMBRE ====== -->
        <?php if ($membre) : ?>
        <div class="trp-tab-content" id="tab-membre">
            <div class="trp-col-left">
                <div class="trp-card">
                    <div class="trp-card-title">📇 Coordonnées <a class="trp-card-edit" href="<?php echo home_url('/espace-membre'); ?>">Modifier</a></div>
                    <?php if ($prenom || $nom) : ?>
                    <div class="trp-info-row"><span class="trp-info-icon">👤</span><div><span class="trp-info-label">Nom complet</span><span class="trp-info-val"><?php echo esc_html(trim($prenom . ' ' . $nom)); ?></span></div></div>
                    <?php endif; ?>
                    <?php if ($email) : ?>
                    <div class="trp-info-row"><span class="trp-info-icon">📧</span><div><span class="trp-info-label">Email</span><span class="trp-info-val"><?php echo esc_html($email); ?></span></div></div>
                    <?php endif; ?>
                    <?php if ($tel) : ?>
                    <div class="trp-info-row"><span class="trp-info-icon">📞</span><div><span class="trp-info-label">Téléphone</span><span class="trp-info-val"><?php echo esc_html($tel); ?></span></div></div>
                    <?php endif; ?>
                    <?php if ($pays) : ?>
                    <div class="trp-info-row"><span class="trp-info-icon">🌍</span><div><span class="trp-info-label">Pays</span><span class="trp-info-val"><?php echo esc_html($pays); ?></span></div></div>
                    <?php endif; ?>
                    <?php if ($ville) : ?>
                    <div class="trp-info-row"><span class="trp-info-icon">📍</span><div><span class="trp-info-label">Ville</span><span class="trp-info-val"><?php echo esc_html($ville); ?></span></div></div>
                    <?php endif; ?>
                    <?php if ($situation) : ?>
                    <div class="trp-info-row"><span class="trp-info-icon">💼</span><div><span class="trp-info-label">Situation professionnelle</span><span class="trp-info-val"><?php echo esc_html($situation); ?></span></div></div>
                    <?php endif; ?>
                    <?php if ($secteur) : ?>
                    <div class="trp-info-row"><span class="trp-info-icon">🏭</span><div><span class="trp-info-label">Secteur d'activité</span><span class="trp-info-val"><?php echo esc_html($secteur); ?></span></div></div>
                    <?php endif; ?>
                    <?php if ($membre->profil_investisseur) : ?>
                    <div class="trp-info-row"><span class="trp-info-icon">📊</span><div><span class="trp-info-label">Profil investisseur</span><span class="trp-info-val"><?php echo esc_html($membre->profil_investisseur); ?></span></div></div>
                    <?php endif; ?>
                    <?php if ($membre->secteur_cible) : ?>
                    <div class="trp-info-row"><span class="trp-info-icon">🎯</span><div><span class="trp-info-label">Secteur cible</span><span class="trp-info-val"><?php echo esc_html($membre->secteur_cible); ?></span></div></div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="trp-col-right">
                <div class="trp-card">
                    <div class="trp-card-title">📋 Projet <a class="trp-card-edit" href="<?php echo home_url('/espace-membre'); ?>">Modifier</a></div>
                    <?php if ($membre->type_projet) : ?>
                    <div class="trp-grid-2">
                        <div class="trp-field-box"><div class="trp-field-label">Type de projet</div><div class="trp-field-val"><?php echo esc_html($membre->type_projet ?: '—'); ?></div></div>
                        <div class="trp-field-box"><div class="trp-field-label">Secteur projet</div><div class="trp-field-val"><?php echo esc_html($membre->secteur_projet ?: '—'); ?></div></div>
                        <div class="trp-field-box"><div class="trp-field-label">Région Tunisie</div><div class="trp-field-val"><?php echo esc_html($membre->region_tunisie ?: '—'); ?></div></div>
                        <div class="trp-field-box"><div class="trp-field-label">Délai</div><div class="trp-field-val"><?php echo esc_html($membre->delai_projet ?: '—'); ?></div></div>
                        <div class="trp-field-box"><div class="trp-field-label">Budget</div><div class="trp-field-val"><?php echo esc_html($membre->budget ?: '—'); ?></div></div>
                        <div class="trp-field-box"><div class="trp-field-label">Type d'entreprise</div><div class="trp-field-val"><?php echo esc_html($membre->type_entreprise ?: '—'); ?></div></div>
                    </div>
                    <?php if ($membre->description_projet) : ?>
                    <div style="margin-top:12px;"><div class="trp-field-label" style="margin-bottom:6px;">Description</div>
                    <div class="trp-text-box"><?php echo nl2br(esc_html($membre->description_projet)); ?></div></div>
                    <?php endif; ?>
                    <?php else : ?>
                    <div class="trp-empty"><div class="trp-empty-icon">📋</div><p>Aucun projet renseigné.</p><a href="<?php echo home_url('/espace-membre'); ?>">Ajouter un projet</a></div>
                    <?php endif; ?>
                </div>

                <?php if ($membre->services || $membre->type_partenaire) : ?>
                <div class="trp-card">
                    <div class="trp-card-title">🤝 Services & Partenariat <a class="trp-card-edit" href="<?php echo home_url('/espace-membre'); ?>">Modifier</a></div>
                    <?php if ($membre->services) : ?>
                    <div class="trp-section-sep">Services proposés</div>
                    <div class="trp-text-box"><?php echo nl2br(esc_html($membre->services)); ?></div>
                    <?php endif; ?>
                    <?php if ($membre->type_partenaire) : ?>
                    <div class="trp-section-sep">Type de partenariat</div>
                    <div class="trp-text-box"><?php echo nl2br(esc_html($membre->type_partenaire)); ?></div>
                    <?php endif; ?>
                </div>
                <?php endif; ?>

                <?php if ($membre->details_admin) : ?>
                <div class="trp-card">
                    <div class="trp-card-title">🗂️ Détails administratifs<a class="trp-card-edit" href="<?php echo home_url('/espace-membre'); ?>">Modifier</a></div>
                    <div class="trp-text-box"><?php echo nl2br(esc_html($membre->details_admin)); ?></div>
                </div>
                <?php endif; ?>

                <?php if ($membre->message) : ?>
                <div class="trp-card">
                    <div class="trp-card-title">💬 Message<a class="trp-card-edit" href="<?php echo home_url('/espace-membre'); ?>">Modifier</a></div>
                    <div class="trp-text-box"><?php echo nl2br(esc_html($membre->message)); ?></div>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <?php endif; ?>

        <!-- ====== ONGLET FICHE PARTENAIRE ====== -->
        <?php if ($partenaire) : ?>
        <div class="trp-tab-content" id="tab-partenaire">
            <div class="trp-col-left">
                <div class="trp-card">
                    <div class="trp-card-title">📇 Contact <a class="trp-card-edit" href="<?php echo home_url('/espace-partenaire'); ?>">Modifier</a></div>
                    <?php if ($partenaire->nom_contact) : ?>
                    <div class="trp-info-row"><span class="trp-info-icon">👤</span><div><span class="trp-info-label">Contact</span><span class="trp-info-val"><?php echo esc_html($partenaire->nom_contact); ?></span></div></div>
                    <?php endif; ?>
                    <?php if ($partenaire->fonction) : ?>
                    <div class="trp-info-row"><span class="trp-info-icon">🏷️</span><div><span class="trp-info-label">Fonction</span><span class="trp-info-val"><?php echo esc_html($partenaire->fonction); ?></span></div></div>
                    <?php endif; ?>
                    <?php if ($partenaire->nom_entreprise) : ?>
                    <div class="trp-info-row"><span class="trp-info-icon">🏢</span><div><span class="trp-info-label">Entreprise</span><span class="trp-info-val"><?php echo esc_html($partenaire->nom_entreprise); ?></span></div></div>
                    <?php endif; ?>
                    <?php if ($partenaire->email) : ?>
                    <div class="trp-info-row"><span class="trp-info-icon">📧</span><div><span class="trp-info-label">Email</span><span class="trp-info-val"><?php echo esc_html($partenaire->email); ?></span></div></div>
                    <?php endif; ?>
                    <?php if ($partenaire->telephone) : ?>
                    <div class="trp-info-row"><span class="trp-info-icon">📞</span><div><span class="trp-info-label">Téléphone</span><span class="trp-info-val"><?php echo esc_html($partenaire->telephone); ?></span></div></div>
                    <?php endif; ?>
                    <?php if ($partenaire->pays) : ?>
                    <div class="trp-info-row"><span class="trp-info-icon">🌍</span><div><span class="trp-info-label">Pays</span><span class="trp-info-val"><?php echo esc_html($partenaire->pays); ?></span></div></div>
                    <?php endif; ?>
                </div>

            <div style="flex-shrink:0;">
                <button class="tre-btn-publier" id="tre-btn-publier-direct">
                    🚀 Publier mon offre
                </button>
                <div class="tre-offre-feedback" id="tre-publish-feedback"></div>
            </div>

            </div>
            <div class="trp-col-right">
                <div class="trp-card">
                    <div class="trp-card-title">🏢 Détails Partenaire<a class="trp-card-edit" href="<?php echo home_url('/espace-partenaire'); ?>">Modifier</a></div>
                    <div class="trp-grid-2">
                        <div class="trp-field-box"><div class="trp-field-label">Type de service</div><div class="trp-field-val"><?php echo esc_html($partenaire->type_service ?: '—'); ?></div></div>
                        <div class="trp-field-box"><div class="trp-field-label">Type d'offre</div><div class="trp-field-val"><?php echo esc_html($partenaire->type_offre ?: '—'); ?></div></div>
                        <div class="trp-field-box"><div class="trp-field-label">Zone d'intervention</div><div class="trp-field-val"><?php echo esc_html($partenaire->zone_intervention ?: '—'); ?></div></div>
                        <div class="trp-field-box"><div class="trp-field-label">Type de partenariat</div><div class="trp-field-val"><?php echo esc_html($partenaire->type_partenariat ?: '—'); ?></div></div>
                    </div>
                    <?php if ($partenaire->description_service) : ?>
                    <div style="margin-top:12px;"><div class="trp-field-label" style="margin-bottom:6px;">Description du service</div>
                    <div class="trp-text-box"><?php echo nl2br(esc_html($partenaire->description_service)); ?></div></div>
                    <?php endif; ?>
                    <?php if ($partenaire->secteurs_cibles) : ?>
                    <div style="margin-top:12px;"><div class="trp-field-label" style="margin-bottom:8px;">Secteurs ciblés</div>
                    <div class="trp-tags"><?php foreach(explode(',', $partenaire->secteurs_cibles) as $s) echo '<span class="trp-tag">'.esc_html(trim($s)).'</span>'; ?></div></div>
                    <?php endif; ?>
                    <?php if ($partenaire->public_cible) : ?>
                    <div style="margin-top:12px;"><div class="trp-field-label" style="margin-bottom:6px;">Public cible</div>
                    <div class="trp-text-box"><?php echo nl2br(esc_html($partenaire->public_cible)); ?></div></div>
                    <?php endif; ?>
                    <?php if ($partenaire->conditions) : ?>
                    <div style="margin-top:12px;"><div class="trp-field-label" style="margin-bottom:6px;">Conditions</div>
                    <div class="trp-text-box"><?php echo nl2br(esc_html($partenaire->conditions)); ?></div></div>
                    <?php endif; ?>
                    <?php if ($partenaire->message_partenariat) : ?>
                    <div style="margin-top:12px;"><div class="trp-field-label" style="margin-bottom:6px;">Message de partenariat</div>
                    <div class="trp-text-box"><?php echo nl2br(esc_html($partenaire->message_partenariat)); ?></div></div>
                    <?php endif; ?>
                    <?php if ($partenaire->type_demande) : ?>
                    <div style="margin-top:12px;"><div class="trp-field-label" style="margin-bottom:6px;">Type de demande</div>
                    <div class="trp-text-box"><?php echo nl2br(esc_html($partenaire->type_demande)); ?></div></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <!-- ====== ONGLET FICHE INVESTISSEUR ====== -->
        <?php if ($investisseur) : ?>
        <div class="trp-tab-content" id="tab-investisseur">
            <div class="trp-col-left">
                <div class="trp-card">
                    <div class="trp-card-title">📇 Coordonnées <a class="trp-card-edit" href="<?php echo home_url('/espace-investisseur'); ?>">Modifier</a></div>
                    <?php if ($investisseur->prenom || $investisseur->nom) : ?>
                    <div class="trp-info-row"><span class="trp-info-icon">👤</span><div><span class="trp-info-label">Nom complet</span><span class="trp-info-val"><?php echo esc_html(trim($investisseur->prenom . ' ' . $investisseur->nom)); ?></span></div></div>
                    <?php endif; ?>
                    <?php if ($investisseur->email) : ?>
                    <div class="trp-info-row"><span class="trp-info-icon">📧</span><div><span class="trp-info-label">Email</span><span class="trp-info-val"><?php echo esc_html($investisseur->email); ?></span></div></div>
                    <?php endif; ?>
                    <?php if ($investisseur->telephone) : ?>
                    <div class="trp-info-row"><span class="trp-info-icon">📞</span><div><span class="trp-info-label">Téléphone</span><span class="trp-info-val"><?php echo esc_html($investisseur->telephone); ?></span></div></div>
                    <?php endif; ?>
                    <?php if ($investisseur->pays_residence) : ?>
                    <div class="trp-info-row"><span class="trp-info-icon">🌍</span><div><span class="trp-info-label">Pays de résidence</span><span class="trp-info-val"><?php echo esc_html($investisseur->pays_residence); ?></span></div></div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="trp-col-right">
                <div class="trp-card">
                    <div class="trp-card-title">💼 Profil Investisseur<a class="trp-card-edit" href="<?php echo home_url('/espace-partenaire'); ?>">Modifier</a></div>
                    <div class="trp-grid-2">
                        <div class="trp-field-box"><div class="trp-field-label">Type d'investisseur</div><div class="trp-field-val"><?php echo esc_html($investisseur->type_investisseur ?: '—'); ?></div></div>
                        <div class="trp-field-box"><div class="trp-field-label">Budget</div><div class="trp-field-val"><?php echo esc_html($investisseur->budget_investissement ?: '—'); ?></div></div>
                        <div class="trp-field-box"><div class="trp-field-label">Horizon</div><div class="trp-field-val"><?php echo esc_html($investisseur->horizon_investissement ?: '—'); ?></div></div>
                        <div class="trp-field-box"><div class="trp-field-label">Niveau de participation</div><div class="trp-field-val"><?php echo esc_html($investisseur->niveau_participation ?: '—'); ?></div></div>
                        <div class="trp-field-box"><div class="trp-field-label">Région cible</div><div class="trp-field-val"><?php echo esc_html($investisseur->region_cible ?: '—'); ?></div></div>
                    </div>
                    <?php if ($investisseur->secteurs_recherches) : ?>
                    <div style="margin-top:12px;"><div class="trp-field-label" style="margin-bottom:8px;">Secteurs recherchés</div>
                    <div class="trp-tags"><?php foreach(explode(',', $investisseur->secteurs_recherches) as $s) echo '<span class="trp-tag">'.esc_html(trim($s)).'</span>'; ?></div></div>
                    <?php endif; ?>
                    <?php if ($investisseur->type_projet_invest) : ?>
                    <div style="margin-top:12px;"><div class="trp-field-label" style="margin-bottom:6px;">Type de projet recherché</div>
                    <div class="trp-text-box"><?php echo nl2br(esc_html($investisseur->type_projet_invest)); ?></div></div>
                    <?php endif; ?>
                    <?php if ($investisseur->projets_recherches) : ?>
                    <div style="margin-top:12px;"><div class="trp-field-label" style="margin-bottom:6px;">Projets recherchés</div>
                    <div class="trp-text-box"><?php echo nl2br(esc_html($investisseur->projets_recherches)); ?></div></div>
                    <?php endif; ?>
                    <?php if ($investisseur->entrepreneurs_recherches) : ?>
                    <div style="margin-top:12px;"><div class="trp-field-label" style="margin-bottom:6px;">Entrepreneurs recherchés</div>
                    <div class="trp-text-box"><?php echo nl2br(esc_html($investisseur->entrepreneurs_recherches)); ?></div></div>
                    <?php endif; ?>
                    <?php if ($investisseur->partenaires_financiers) : ?>
                    <div style="margin-top:12px;"><div class="trp-field-label" style="margin-bottom:6px;">Partenaires financiers</div>
                    <div class="trp-text-box"><?php echo nl2br(esc_html($investisseur->partenaires_financiers)); ?></div></div>
                    <?php endif; ?>
                    <?php if ($investisseur->institutions_banques) : ?>
                    <div style="margin-top:12px;"><div class="trp-field-label" style="margin-bottom:6px;">Institutions / Banques</div>
                    <div class="trp-text-box"><?php echo nl2br(esc_html($investisseur->institutions_banques)); ?></div></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endif; ?>

    </div><!-- .trp-wrap -->

    <script>
    (function() {
        // ── Onglets ──────────────────────────────────────────────────────────
        document.querySelectorAll('.trp-tab').forEach(function(tab) {
            tab.addEventListener('click', function() {
                document.querySelectorAll('.trp-tab').forEach(function(t) { t.classList.remove('active'); });
                document.querySelectorAll('.trp-tab-content').forEach(function(c) { c.classList.remove('active'); });
                this.classList.add('active');
                var target = document.getElementById('tab-' + this.getAttribute('data-tab'));
                if (target) target.classList.add('active');
            });
        });

        // ── Toast helper ─────────────────────────────────────────────────────
        function showToast(msg, type) {
            var toast = document.getElementById('trp-toast');
            toast.textContent = msg;
            toast.className = 'trp-avatar-toast ' + type + ' show';
            setTimeout(function() { toast.classList.remove('show'); }, 3000);
        }

        // ── Upload avatar ─────────────────────────────────────────────────────
        var trigger = document.getElementById('trp-avatar-trigger');
        var input   = document.getElementById('trp-avatar-input');
        var preview = document.getElementById('trp-avatar-preview');

        if (trigger && input && preview) {
            // Sauvegarder l'URL originale pour rollback en cas d'erreur
            preview.dataset.original = preview.src;

            // Clic sur 📷 → ouvre le sélecteur de fichier
            trigger.addEventListener('click', function() {
                input.click();
            });

            input.addEventListener('change', function() {
                var file = this.files[0];
                if (!file) return;

                // Validation côté client
                if (!file.type.match(/^image\/(jpeg|png|gif|webp)$/)) {
                    showToast('❌ Format non supporté (JPG, PNG, GIF, WEBP)', 'error');
                    return;
                }
                if (file.size > 2 * 1024 * 1024) {
                    showToast('❌ Image trop lourde (2 Mo maximum)', 'error');
                    return;
                }

                // Aperçu immédiat
                var reader = new FileReader();
                reader.onload = function(e) { preview.src = e.target.result; };
                reader.readAsDataURL(file);

                // Spinner
                trigger.textContent = '⏳';
                trigger.classList.add('trp-avatar-uploading');
                trigger.style.pointerEvents = 'none';

                // Envoi AJAX
                var formData = new FormData();
                formData.append('action', 'trp_update_avatar');
                formData.append('nonce',  '<?php echo wp_create_nonce('trp_avatar_nonce'); ?>');
                formData.append('avatar', file);

                fetch('<?php echo esc_url(admin_url('admin-ajax.php')); ?>', {
                    method: 'POST',
                    body:   formData
                })
                .then(function(r) { return r.json(); })
                .then(function(data) {
                    trigger.textContent = '📷';
                    trigger.classList.remove('trp-avatar-uploading');
                    trigger.style.pointerEvents = '';

                    if (data.success) {
                        preview.src = data.data.url;
                        showToast('✅ Photo mise à jour !', 'success');
                    } else {
                        preview.src = preview.dataset.original;
                        showToast('❌ ' + (data.data || 'Erreur lors de l\'upload'), 'error');
                    }
                })
                .catch(function() {
                    trigger.textContent = '📷';
                    trigger.classList.remove('trp-avatar-uploading');
                    trigger.style.pointerEvents = '';
                    preview.src = preview.dataset.original;
                    showToast('❌ Erreur réseau, réessayez.', 'error');
                });

                // Réinitialiser l'input pour permettre re-sélection du même fichier
                input.value = '';
            });
        }
    })();
    </script>
    <?php
    return ob_get_clean();
}
add_shortcode('profil_membre', 'tre_profil_shortcode');


// ================================================================
// SYSTÈME DE PUBLICATION D'OFFRES PARTENAIRES
// À coller dans functions.php APRÈS le code existant
// ================================================================

// ── 1. Créer la table des offres ─────────────────────────────────
function tre_create_offres_table() {
    global $wpdb;
    $charset = $wpdb->get_charset_collate();
    $table   = $wpdb->prefix . 'tre_offres';
    $wpdb->query("CREATE TABLE IF NOT EXISTS $table (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        nom_entreprise VARCHAR(150),
        logo_url VARCHAR(500),
        logo_id INT DEFAULT 0,
        description TEXT,
        type_offre VARCHAR(100),
        secteur VARCHAR(100),
        lien_externe VARCHAR(500),
        statut VARCHAR(20) DEFAULT 'en_attente',
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) $charset");
}
add_action('init', 'tre_create_offres_table');


// ── 2. Handler AJAX : upload logo de l'offre ─────────────────────
add_action('wp_ajax_tre_upload_logo_offre', 'tre_handle_logo_upload');
function tre_handle_logo_upload() {
    check_ajax_referer('tre_offre_nonce', 'nonce');
    $user_id = get_current_user_id();
    if (!$user_id) wp_send_json_error('Non autorisé.');
    if (empty($_FILES['logo']['tmp_name'])) wp_send_json_error('Aucun fichier reçu.');

    require_once ABSPATH . 'wp-admin/includes/image.php';
    require_once ABSPATH . 'wp-admin/includes/file.php';
    require_once ABSPATH . 'wp-admin/includes/media.php';

    $attachment_id = media_handle_upload('logo', 0);
    if (is_wp_error($attachment_id)) wp_send_json_error($attachment_id->get_error_message());

    wp_send_json_success([
        'url' => wp_get_attachment_url($attachment_id),
        'id'  => $attachment_id,
    ]);
}


// ── 3. Handler AJAX : sauvegarder l'offre ────────────────────────
add_action('wp_ajax_tre_save_offre', 'tre_save_offre');
function tre_save_offre() {
    check_ajax_referer('tre_offre_nonce', 'nonce');
    if (!is_user_logged_in()) { wp_send_json_error('Non connecté.'); return; }

    global $wpdb;
    $user_id = get_current_user_id();
    $table   = $wpdb->prefix . 'tre_offres';

    $data = [
        'user_id'        => $user_id,
        'nom_entreprise' => sanitize_text_field($_POST['nom_entreprise'] ?? ''),
        'logo_url'       => esc_url_raw($_POST['logo_url'] ?? ''),
        'logo_id'        => intval($_POST['logo_id'] ?? 0),
        'description'    => sanitize_textarea_field($_POST['description'] ?? ''),
        'type_offre'     => sanitize_text_field($_POST['type_offre'] ?? ''),
        'secteur'        => sanitize_text_field($_POST['secteur'] ?? ''),
        'lien_externe'   => esc_url_raw($_POST['lien_externe'] ?? ''),
        'statut'         => 'publiee',
    ];

    $offre_id = intval($_POST['offre_id'] ?? 0);
    if ($offre_id) {
        // Vérifier que l'offre appartient à cet utilisateur
        $existing = $wpdb->get_row($wpdb->prepare("SELECT id FROM $table WHERE id=%d AND user_id=%d", $offre_id, $user_id));
        if ($existing) {
            $wpdb->update($table, $data, ['id' => $offre_id]);
            wp_send_json_success(['msg' => 'Offre mise à jour avec succès.', 'id' => $offre_id]);
        } else {
            wp_send_json_error('Offre introuvable.');
        }
    } else {
        $wpdb->insert($table, $data);
        wp_send_json_success(['msg' => 'Votre offre a été publiée avec succès !', 'id' => $wpdb->insert_id]);
    }
}


// ── 4. Handler AJAX : supprimer une offre ────────────────────────
add_action('wp_ajax_tre_delete_offre', 'tre_delete_offre');
function tre_delete_offre() {
    check_ajax_referer('tre_offre_nonce', 'nonce');
    if (!is_user_logged_in()) { wp_send_json_error('Non connecté.'); return; }

    global $wpdb;
    $user_id  = get_current_user_id();
    $offre_id = intval($_POST['offre_id'] ?? 0);
    $table    = $wpdb->prefix . 'tre_offres';

    $existing = $wpdb->get_row($wpdb->prepare("SELECT id FROM $table WHERE id=%d AND user_id=%d", $offre_id, $user_id));
    if (!$existing) { wp_send_json_error('Non autorisé.'); return; }

    $wpdb->delete($table, ['id' => $offre_id]);
    wp_send_json_success('Offre supprimée.');
}


// ── 5. Shortcode [publier_offre] : formulaire de publication ─────
// À utiliser dans l'espace partenaire ou sur une page dédiée
// ── 5. Shortcode [publier_offre] : publication directe depuis wp_tre_partenaire ─────
function tre_publier_offre_shortcode() {
    if (!is_user_logged_in()) {
        return '<div style="text-align:center;padding:40px"><p>Veuillez <a href="' . home_url('/login') . '" style="color:#e74c3c;font-weight:700">vous connecter</a> pour publier une offre.</p></div>';
    }

    global $wpdb;
    $user_id    = get_current_user_id();
    $table      = $wpdb->prefix . 'tre_offres';
    $table_p    = $wpdb->prefix . 'tre_partenaire';

    // Récupérer le profil partenaire
    $partenaire = $wpdb->get_row($wpdb->prepare(
        "SELECT * FROM $table_p WHERE user_id = %d", $user_id
    ));

    // Offres existantes de cet utilisateur
    $mes_offres = $wpdb->get_results($wpdb->prepare(
        "SELECT * FROM $table WHERE user_id = %d ORDER BY created_at DESC", $user_id
    ));

    ob_start(); ?>
    <style>
    .tre-publier-wrap { font-family: 'Segoe UI', sans-serif; }

    /* Bouton déclencheur */
    .tre-btn-publier {
        display: inline-flex; align-items: center; gap: 8px;
        background: #e74c3c; color: #fff;
        padding: 11px 22px; border-radius: 8px;
        font-size: 14px; font-weight: 700;
        border: none; cursor: pointer;
        transition: background 0.2s, transform 0.15s;
        margin-top: 16px;
    }
    .tre-btn-publier:hover { background: #c0392b; transform: translateY(-1px); }
    .tre-btn-publier:disabled { background: #ccc; cursor: not-allowed; }

    .tre-offre-feedback {
        margin-top: 14px; padding: 12px 16px;
        border-radius: 8px; font-size: 14px; font-weight: 600;
        display: none;
    }
    .tre-offre-feedback.success { background: #f0fff4; color: #27ae60; border: 1px solid #b2dfdb; }
    .tre-offre-feedback.error   { background: #fff5f5; color: #e74c3c; border: 1px solid #fcc; }

    /* Aperçu des données partenaire */
    .tre-partenaire-preview {
        display: flex; align-items: center; gap: 18px;
        background: #f8f9fa; border: 1px solid #eee;
        border-radius: 12px; padding: 16px 20px;
        margin-top: 16px; margin-bottom: 6px;
    }
    .tre-partenaire-preview-logo {
        width: 80px; height: 54px; flex-shrink: 0;
        display: flex; align-items: center; justify-content: center;
        border-right: 1px solid #e0e0e0; padding-right: 18px;
        font-size: 36px;
    }
    .tre-partenaire-preview-logo img {
        max-width: 76px; max-height: 50px; object-fit: contain;
    }
    .tre-partenaire-preview-body { flex: 1; min-width: 0; }
    .tre-partenaire-preview-name {
        font-size: 15px; font-weight: 800; color: #1c1e21; margin: 0 0 4px;
    }
    .tre-partenaire-preview-desc {
        font-size: 12px; color: #65676b; margin: 0 0 8px;
        line-height: 1.5;
    }
    .tre-partenaire-preview-tags { display: flex; gap: 6px; flex-wrap: wrap; }
    .tre-preview-tag {
        padding: 2px 10px; border-radius: 20px;
        font-size: 11px; font-weight: 600;
    }
    .tre-tag-type    { background: #e8f4fd; color: #0d6efd; }
    .tre-tag-secteur { background: #e8f8f0; color: #198754; }

    /* Liste des offres existantes */
    .tre-mes-offres { margin-top: 28px; }
.tre-mes-offres-title {
    font-size: 15px;
    font-weight: 800;
    color: #1c1e21;
    margin: 0 0 14px;
    padding-bottom: 10px;
    border-bottom: 2px solid #f0f2f5;
    text-align: left;        /* 🔥 AJOUT */
}
    .tre-offre-item {
        display: flex; align-items: center; gap: 14px;
        padding: 14px; background: #fff;
        border: 1px solid #eee; border-radius: 10px;
        margin-bottom: 10px; box-shadow: 0 1px 6px rgba(0,0,0,0.05);
        max-width: 500px;   /* 🔥 ajuste (400 / 450 / 600 selon ton goût) */
        width: 100%;
        margin-left: 0;     /* 🔥 reste collé à gauche */
        margin-right: auto; /* important pour éviter centrage */

    }
    .tre-offre-item-logo {
        width: 72px; height: 48px;
        border-radius: 6px; border: 1px solid #f0f0f0;
        background: #f8f9fa; flex-shrink: 0;
        display: flex; align-items: center; justify-content: center;
        font-size: 22px; overflow: hidden;
    }
    .tre-offre-item-logo img { width: 100%; height: 100%; object-fit: contain; }
    .tre-offre-item-body { flex: 1; min-width: 0; }
    .tre-offre-item-name { font-size: 14px; font-weight: 700; color: #1c1e21; margin: 0 0 3px; }
    .tre-offre-item-desc {
        font-size: 12px; color: #65676b; margin: 0 0 6px;
        white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
    }
    .tre-offre-item-statut {
        display: inline-block; padding: 2px 10px; border-radius: 20px;
        font-size: 11px; font-weight: 700;
    }
    .statut-en_attente { background: #fff3e0; color: #e65100; }
    .statut-publiee    { background: #e8f8f0; color: #198754; }
    .statut-rejetee    { background: #fff5f5; color: #e74c3c; }
    .tre-offre-item-actions { display: flex; gap: 8px; flex-shrink: 0; }
    .tre-offre-del {
        background: none; border: 1.5px solid #fcc; color: #e74c3c;
        padding: 6px 12px; border-radius: 6px; font-size: 12px;
        font-weight: 600; cursor: pointer; transition: all 0.2s;
    }
    .tre-offre-del:hover { background: #fff5f5; }
    </style>

    <div class="tre-publier-wrap">

    <?php if (!$partenaire) : ?>
        <div style="text-align:center;padding:40px;">
            <p style="color:#e74c3c;font-weight:700;font-family:'Segoe UI',sans-serif;">
                ⚠️ Aucun profil partenaire trouvé.<br>
                <a href="<?php echo home_url('/devenir-partenaire'); ?>" style="color:#e74c3c;">
                    Complétez d'abord votre profil partenaire.
                </a>
            </p>
        </div>
    <?php else : ?>

       <!-- BOUTON PUBLIER DIRECT -->
        <!-- LAYOUT : bouton à droite, offres à gauche -->
    <div style="display:flex; align-items:flex-start; gap:24px; margin-top:16px; flex-wrap:wrap;">

    <!-- MES OFFRES EXISTANTES — colonne gauche -->
    <div style="flex:1; min-width:260px; text-align:left;">
        <?php if (!empty($mes_offres)) : ?>
        <div class="tre-mes-offres">
            <p class="tre-mes-offres-title">📋 Mes offres publiées</p>
            <?php foreach ($mes_offres as $offre) : ?>
            <div class="tre-offre-item" id="offre-item-<?php echo $offre->id; ?>">

                <!-- Logo -->
                <div class="tre-offre-item-logo">
                    <?php if ($offre->logo_url) : ?>
                        <img src="<?php echo esc_url($offre->logo_url); ?>" alt="logo">
                    <?php else : echo '🏢'; endif; ?>
                </div>

                <!-- Infos -->
                <div class="tre-offre-item-body">
                    <p class="tre-offre-item-name"><?php echo esc_html($offre->nom_entreprise ?: '—'); ?></p>
                    <p class="tre-offre-item-desc"><?php echo esc_html(wp_trim_words($offre->description, 12, '...')); ?></p>
                    <span class="tre-offre-item-statut statut-<?php echo esc_attr($offre->statut); ?>">
                        <?php echo $offre->statut === 'publiee' ? '✅ Publiée' : ($offre->statut === 'rejetee' ? '❌ Rejetée' : '⏳ En attente'); ?>
                    </span>
                </div>

                <!-- Bouton Supprimer — poussé à droite -->
                <div class="tre-offre-item-actions">
                    <button class="tre-offre-del" onclick="treDeleteOffre(<?php echo $offre->id; ?>)">
                        🗑️ Supprimer
                    </button>
                </div>

            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>

    <!-- BOUTON PUBLIER — colonne droite -->

    </div>

<style>
.tre-offre-item {
    display: flex;
    flex-direction: row;       /* Logo → Infos → Supprimer */
    align-items: center;
    gap: 12px;
    padding: 10px 14px;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    margin-bottom: 8px;
    background: #fff;
}

.tre-offre-item-logo {
    flex-shrink: 0;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
}

.tre-offre-item-logo img {
    width: 40px;
    height: 40px;
    object-fit: contain;
    border-radius: 4px;
}

.tre-offre-item-body {
    flex: 1;                   /* prend tout l'espace disponible */
    min-width: 0;
}

.tre-offre-item-name {
    margin: 0 0 2px 0;
    font-weight: 600;
    font-size: 14px;
    color: #111827;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.tre-offre-item-desc {
    margin: 0 0 4px 0;
    font-size: 12px;
    color: #6b7280;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.tre-offre-item-statut {
    display: inline-block;
    font-size: 11px;
    padding: 2px 8px;
    border-radius: 999px;
    font-weight: 500;
}

.statut-publiee  { background: #d1fae5; color: #065f46; }
.statut-rejetee  { background: #fee2e2; color: #991b1b; }
.statut-attente  { background: #fef3c7; color: #92400e; }

.tre-offre-item-actions {
    flex-shrink: 0;
    margin-left: auto;         /* pousse le bouton tout à droite */
}

.tre-offre-del {
    display: flex;
    align-items: center;
    gap: 4px;
    background: #fff;
    border: 1px solid #ef4444;
    color: #ef4444;
    padding: 5px 10px;
    border-radius: 6px;
    font-size: 12px;
    cursor: pointer;
    white-space: nowrap;
    transition: background 0.15s, color 0.15s;
}

.tre-offre-del:hover {
    background: #ef4444;
    color: #fff;
}
</style>

        <script>
        (function() {
            var nonce   = '<?php echo wp_create_nonce('tre_offre_nonce'); ?>';
            var ajaxUrl = '<?php echo esc_url(admin_url('admin-ajax.php')); ?>';
            var btn     = document.getElementById('tre-btn-publier-direct');
            var fb      = document.getElementById('tre-publish-feedback');

            btn.addEventListener('click', function() {
                if (!confirm('Publier votre offre avec les données de votre profil partenaire ?')) return;

                btn.disabled     = true;
                btn.textContent  = '⏳ Publication en cours...';
                fb.style.display = 'none';

                var fd = new FormData();
                fd.append('action', 'tre_publish_from_partenaire');
                fd.append('nonce',  nonce);

                fetch(ajaxUrl, { method: 'POST', body: fd })
                .then(function(r) { return r.json(); })
                .then(function(res) {
                    btn.disabled    = false;
                    btn.textContent = '🚀 Publier mon offre';
                    if (res.success) {
                        fb.textContent   = '✅ ' + res.data.msg;
                        fb.className     = 'tre-offre-feedback success';
                        fb.style.display = 'block';
                        setTimeout(function() { location.reload(); }, 1800);
                    } else {
                        fb.textContent   = '❌ ' + (res.data || 'Erreur.');
                        fb.className     = 'tre-offre-feedback error';
                        fb.style.display = 'block';
                    }
                })
                .catch(function() {
                    btn.disabled    = false;
                    btn.textContent = '🚀 Publier mon offre';
                    fb.textContent   = '❌ Erreur réseau.';
                    fb.className     = 'tre-offre-feedback error';
                    fb.style.display = 'block';
                });
            });
        })();

        function treDeleteOffre(offreId) {
            if (!confirm('Supprimer cette offre ?')) return;
            var fd = new FormData();
            fd.append('action',   'tre_delete_offre');
            fd.append('nonce',    '<?php echo wp_create_nonce('tre_offre_nonce'); ?>');
            fd.append('offre_id', offreId);
            fetch('<?php echo esc_url(admin_url('admin-ajax.php')); ?>', { method: 'POST', body: fd })
            .then(function(r) { return r.json(); })
            .then(function(res) {
                if (res.success) {
                    var el = document.getElementById('offre-item-' + offreId);
                    if (el) el.remove();
                } else {
                    alert('Erreur : ' + (res.data || ''));
                }
            });
        }
        </script>

    <?php endif; ?>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('publier_offre', 'tre_publier_offre_shortcode');


// ── Handler AJAX : publier directement depuis wp_tre_partenaire ──
add_action('wp_ajax_tre_publish_from_partenaire', 'tre_publish_from_partenaire');
function tre_publish_from_partenaire() {
    check_ajax_referer('tre_offre_nonce', 'nonce');
    if (!is_user_logged_in()) { wp_send_json_error('Non connecté.'); return; }

    global $wpdb;
    $user_id = get_current_user_id();
    $table   = $wpdb->prefix . 'tre_offres';
    $table_p = $wpdb->prefix . 'tre_partenaire';

    // Récupérer le profil partenaire
    $p = $wpdb->get_row($wpdb->prepare(
        "SELECT * FROM $table_p WHERE user_id = %d", $user_id
    ));
    if (!$p) { wp_send_json_error('Profil partenaire introuvable.'); return; }

    // Récupérer le logo
    $logo_url = '';
    $logo_id  = intval(get_user_meta($user_id, 'tre_logo_id', true));
    if ($logo_id) {
        $logo_url = wp_get_attachment_url($logo_id) ?: '';
    }
    // Fallback : champ logo_url dans la table partenaire
    if (!$logo_url && !empty($p->logo_url)) {
        $logo_url = $p->logo_url;
    }

    // Déterminer le type_offre et le secteur
    $type_offre = sanitize_text_field($p->type_offre ?: $p->type_service ?? '');
    $secteur    = sanitize_text_field($p->secteurs_cibles ?? '');

    // Mapper les champs partenaire → offre
    $data = [
        'user_id'        => $user_id,
        'nom_entreprise' => sanitize_text_field($p->nom_entreprise ?? ''),
        'logo_url'       => esc_url_raw($logo_url),
        'logo_id'        => $logo_id,
        'description'    => sanitize_textarea_field($p->description_service ?? ''),
        'type_offre'     => $type_offre,
        'secteur'        => $secteur,
        'lien_externe'   => esc_url_raw($p->lien_externe ?? ''),
        'statut'         => 'publiee',
    ];

    // Update si offre existante, sinon insert
    $existing = $wpdb->get_row($wpdb->prepare(
        "SELECT id FROM $table WHERE user_id = %d", $user_id
    ));

    if ($existing) {
        $wpdb->update($table, $data, ['user_id' => $user_id]);
        wp_send_json_success(['msg' => 'Votre offre a été mise à jour et publiée !', 'id' => $existing->id]);
    } else {
        $wpdb->insert($table, $data);
        wp_send_json_success(['msg' => 'Votre offre est publiée avec succès !', 'id' => $wpdb->insert_id]);
    }
}
add_shortcode('publier_offre', 'tre_publier_offre_shortcode');


// ── 6. Shortcode [tre_offres_partenaires] : affichage public ─────
// À placer sur la page : /category/services/services-dedies/
function tre_offres_partenaires_shortcode($atts) {
    $atts = shortcode_atts([
        'secteur'    => '',
        'type_offre' => '',
        'limit'      => 20,
    ], $atts);

    global $wpdb;
    $table      = $wpdb->prefix . 'tre_offres';
    $t_part     = $wpdb->prefix . 'tre_partenaire';

    $where  = "WHERE o.statut = 'publiee'";
    $params = [];

    if (!empty($atts['secteur'])) {
        $where   .= " AND o.secteur = %s";
        $params[] = $atts['secteur'];
    }
    if (!empty($atts['type_offre'])) {
        $where   .= " AND o.type_offre = %s";
        $params[] = $atts['type_offre'];
    }

    $limit    = intval($atts['limit']);
    $sql      = "SELECT o.*, u.display_name,
                    p.nom_entreprise   AS p_nom_entreprise,
                    p.nom_contact      AS p_nom_contact,
                    p.fonction         AS p_fonction,
                    p.pays             AS p_pays,
                    p.telephone        AS p_telephone,
                    p.email            AS p_email,
                    p.type_service     AS p_type_service,
                    p.type_offre       AS p_type_offre,
                    p.description_service AS p_description_service,
                    p.public_cible     AS p_public_cible,
                    p.conditions       AS p_conditions,
                    p.type_partenariat AS p_type_partenariat,
                    p.zone_intervention AS p_zone_intervention,
                    p.secteurs_cibles  AS p_secteurs_cibles,
                    p.message_partenariat AS p_message_partenariat,
                    p.membres_interesses AS p_membres_interesses,
                    p.type_demande     AS p_type_demande
                 FROM $table o
                 LEFT JOIN {$wpdb->users} u  ON o.user_id = u.ID
                 LEFT JOIN $t_part p         ON o.user_id = p.user_id
                 $where ORDER BY o.created_at DESC LIMIT %d";
    $params[] = $limit;

    $offres = $wpdb->get_results($wpdb->prepare($sql, ...$params));

    ob_start(); ?>
    <style>
    /* =============================================
       FIX RTL GLOBAL
       ============================================= */
    .tro-wrap,
    .tro-wrap * {
        direction: ltr !important;
        text-align: left !important;
    }

    .tro-wrap {
        max-width: 860px;
        margin: 0 auto;
        font-family: 'Segoe UI', sans-serif;
    }
    .tro-header {
        display: flex; align-items: center;
        justify-content: space-between; flex-wrap: wrap;
        gap: 12px; margin-bottom: 28px;
    }
    .tro-title {
        font-size: 22px; font-weight: 900; color: #1c1e21;
        margin: 0; border-left: 4px solid #e74c3c; padding-left: 14px;
    }

    /* Filtres */
    .tro-filters { display: flex; gap: 8px; flex-wrap: wrap; margin-bottom: 20px; }
    .tro-filter-btn {
        padding: 7px 16px; border-radius: 20px;
        border: 1.5px solid #ddd; background: #fafafa;
        font-size: 13px; font-weight: 600; color: #555;
        cursor: pointer; transition: all 0.2s;
    }
    .tro-filter-btn:hover  { border-color: #e74c3c; color: #e74c3c; }
    .tro-filter-btn.active { background: #e74c3c; color: #fff; border-color: #e74c3c; }

    /* ── CARTE ── */
    .tro-offre-card {
        background: #fff;
        border: 1px solid #eee;
        border-radius: 12px;
        margin-bottom: 12px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        overflow: hidden;
        transition: box-shadow 0.2s;
    }
    .tro-offre-card:hover { box-shadow: 0 6px 24px rgba(0,0,0,0.10); }

    /* ── RÉSUMÉ (ligne principale) ── */
    .tro-offre-summary {
        display: flex !important;
        flex-direction: row !important;
        align-items: center !important;
        gap: 20px;
        padding: 18px 24px;
        cursor: pointer;
        user-select: none;
    }

    /* Logo */
    .tro-offre-logo {
        width: 110px; min-width: 110px; height: 64px;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        border-right: 1px solid #f0f0f0;
        padding-right: 20px;
        flex-shrink: 0;
        order: 1 !important;
    }
    .tro-offre-logo img { max-width: 100px; max-height: 56px; object-fit: contain; display: block; }
    .tro-no-logo { font-size: 36px; color: #ddd; }

    /* Infos résumé */
    .tro-offre-body { flex: 1 !important; min-width: 0; order: 2 !important; }
    .tro-offre-name { font-size: 15px; font-weight: 800; color: #1c1e21; margin: 0 0 4px; }
    .tro-offre-sub  { font-size: 12px; color: #888; margin: 0 0 8px; }
    .tro-offre-meta { display: flex !important; flex-direction: row !important; gap: 6px; flex-wrap: wrap; align-items: center; }
    .tro-offre-tag  { padding: 3px 10px; border-radius: 20px; font-size: 11px; font-weight: 600; }
    .tro-tag-type    { background: #e8f4fd; color: #0d6efd; }
    .tro-tag-secteur { background: #e8f8f0; color: #198754; }

    /* Chevron */
    .tro-chevron {
        flex-shrink: 0;
        order: 3 !important;
        width: 28px; height: 28px;
        border-radius: 50%;
        background: #f5f5f5;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        font-size: 13px;
        color: #888;
        transition: transform 0.25s, background 0.2s;
    }
    .tro-offre-card.open .tro-chevron {
        transform: rotate(180deg);
        background: #e74c3c;
        color: #fff;
    }

    /* ── DÉTAILS (expand) ── */
    .tro-offre-details {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.35s ease, padding 0.25s ease;
        border-top: 0px solid #f0f0f0;
        background: #fafbfc;
        padding: 0 24px;
    }
    .tro-offre-card.open .tro-offre-details {
        max-height: 1200px;
        padding: 20px 24px 24px;
        border-top: 1px solid #f0f0f0;
    }

    /* Sections dans les détails */
    .tro-detail-section {
        margin-bottom: 20px;
    }
    .tro-detail-section:last-child { margin-bottom: 0; }

    .tro-detail-section-title {
        font-size: 12px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        color: #e74c3c;
        margin: 0 0 10px;
        padding-bottom: 6px;
        border-bottom: 1px solid #f0f0f0;
    }

    .tro-detail-grid {
        display: grid !important;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 10px 20px;
    }

    .tro-detail-field label {
        display: block;
        font-size: 11px;
        font-weight: 700;
        color: #aaa;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 2px;
    }
    .tro-detail-field p {
        margin: 0;
        font-size: 13px;
        color: #222;
        line-height: 1.5;
    }

    /* Tags inline dans détails */
    .tro-detail-tags { display: flex !important; flex-wrap: wrap; gap: 6px; }
    .tro-detail-tag {
        padding: 3px 10px; border-radius: 20px;
        font-size: 11px; font-weight: 600;
        background: #f0f0f0; color: #555;
    }

    /* Lien externe */
    .tro-offre-link {
        display: inline-block;
        margin-top: 14px;
        color: #fff;
        background: #e74c3c;
        font-size: 13px; font-weight: 700;
        text-decoration: none;
        padding: 8px 18px;
        border-radius: 6px;
        transition: background 0.2s;
    }
    .tro-offre-link:hover { background: #c0392b; color: #fff; }

    .tro-empty {
        text-align: center !important; padding: 48px 20px;
        color: #65676b; font-size: 15px;
    }
    .tro-empty-icon { font-size: 52px; margin-bottom: 16px; }

    @media(max-width: 600px) {
        .tro-offre-summary { flex-wrap: wrap; gap: 14px; padding: 14px 16px; }
        .tro-offre-logo { border-right: none; border-bottom: 1px solid #f0f0f0; padding-right: 0; padding-bottom: 14px; width: 100%; }
        .tro-offre-details { padding: 0 16px; }
        .tro-offre-card.open .tro-offre-details { padding: 16px; }
        .tro-detail-grid { grid-template-columns: 1fr 1fr; }
    }
    </style>

    <div class="tro-wrap">
        <div class="tro-header">
            <h2 class="tro-title">🏢 Services dédiés à la diaspora</h2>
        </div>

        <!-- Filtres secteur -->
 <?php
/* 🔥 EXTRAIRE les types depuis les offres affichées */
$types_dispo = [];

foreach ($offres as $offre) {
    $type = $offre->p_type_service ?: $offre->type_offre ?: '';
    
    if (!empty($type) && !in_array($type, $types_dispo)) {
        $types_dispo[] = $type;
    }
}

sort($types_dispo);

if (!empty($types_dispo)) : ?>
<div class="tro-filters" id="tro-filters">
    <button class="tro-filter-btn active" data-type="">Tous</button>

    <?php foreach ($types_dispo as $type) : ?>
        <button class="tro-filter-btn" data-type="<?php echo esc_attr($type); ?>">
            <?php echo esc_html($type); ?>
        </button>
    <?php endforeach; ?>
</div>
<?php endif; ?>

        <!-- Liste des offres -->
        <div id="tro-offres-list">
        <?php if (empty($offres)) : ?>
            <div class="tro-empty">
                <div class="tro-empty-icon">🏢</div>
                <p>Aucune offre disponible pour le moment.</p>
            </div>
        <?php else : ?>
        <?php foreach ($offres as $offre) :
            // Nom entreprise : priorité à la table partenaire, sinon table offres
            $nom_ent  = $offre->p_nom_entreprise ?: $offre->nom_entreprise ?: 'Partenaire TRE Radio';
            $contact  = $offre->p_nom_contact   ?: '';
            $fonction = $offre->p_fonction       ?: '';
            $pays     = $offre->p_pays           ?: '';
            $tel      = $offre->p_telephone      ?: '';
            $email    = $offre->p_email          ?: '';
            $type_svc = $offre->p_type_service   ?: $offre->type_offre ?: '';

            $type_offre_detail = $offre->p_type_offre         ?: $offre->type_offre ?: '';
            $desc_svc          = $offre->p_description_service ?: $offre->description ?: '';
            $public_cible      = $offre->p_public_cible        ?: '';
            $conditions        = $offre->p_conditions          ?: '';

            $type_part   = $offre->p_type_partenariat   ?: '';
            $zone_inter  = $offre->p_zone_intervention  ?: '';
            $sect_cibles = $offre->p_secteurs_cibles    ?: '';
            $msg_part    = $offre->p_message_partenariat ?: '';

            $membres_int = $offre->p_membres_interesses ?: '';
            $type_dem    = $offre->p_type_demande       ?: '';
        ?>
        <div class="tro-offre-card"
     data-type="<?php echo esc_attr($type_svc); ?>"
     data-secteur="<?php echo esc_attr($offre->secteur); ?>">

            <!-- ══ RÉSUMÉ (toujours visible) ══ -->
            <div class="tro-offre-summary">

                <!-- Logo -->
                <div class="tro-offre-logo">
                    <?php if ($offre->logo_url) : ?>
                    <img src="<?php echo esc_url($offre->logo_url); ?>"
                         alt="<?php echo esc_attr($nom_ent); ?>">
                    <?php else : ?>
                    <span class="tro-no-logo">🏢</span>
                    <?php endif; ?>
                </div>

                <!-- Infos principales -->
                <div class="tro-offre-body">
                    <p class="tro-offre-name">Nom de l'entreprise : <?php echo esc_html($nom_ent); ?></p>
                    <?php if ($contact) : ?>
                        <p class="tro-offre-sub">
                            <?php if ($contact) : ?>
                                <span><strong>Nom du contact :</strong> <?php echo esc_html($contact); ?></span><br>
                            <?php endif; ?>

                            <?php if ($fonction) : ?>
                                <span><strong>Fonction :</strong> <?php echo esc_html($fonction); ?></span><br>
                            <?php endif; ?>

                            <?php if ($pays) : ?>
                                <span><strong>Pays :</strong> <?php echo esc_html($pays); ?></span>
                            <?php endif; ?>
                        </p>
                    <?php endif; ?>
                    <div class="tro-offre-meta">
                        <?php if ($type_svc) : ?>
                        <span class="tro-offre-tag tro-tag-type"><?php echo esc_html($type_svc); ?></span>
                        <?php endif; ?>
                        <?php if ($offre->secteur) : ?>
                        <span class="tro-offre-tag tro-tag-secteur"><?php echo esc_html($offre->secteur); ?></span>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Chevron -->
                <div class="tro-chevron">▼</div>
            </div>

            <!-- ══ DÉTAILS (expand au clic) ══ -->
            <div class="tro-offre-details">

                <!-- Section 1 : Profil Partenaire -->
                <div class="tro-detail-section">
                    <p class="tro-detail-section-title">🏢 Profil Partenaire</p>
                    <div class="tro-detail-grid">
                        <?php if ($nom_ent) : ?>
                        <div class="tro-detail-field">
                            <label>Nom de l'entreprise</label>
                            <p><?php echo esc_html($nom_ent); ?></p>
                        </div>
                        <?php endif; ?>
                        <?php if ($contact) : ?>
                        <div class="tro-detail-field">
                            <label>Nom du contact</label>
                            <p><?php echo esc_html($contact); ?></p>
                        </div>
                        <?php endif; ?>
                        <?php if ($fonction) : ?>
                        <div class="tro-detail-field">
                            <label>Fonction</label>
                            <p><?php echo esc_html($fonction); ?></p>
                        </div>
                        <?php endif; ?>
                        <?php if ($pays) : ?>
                        <div class="tro-detail-field">
                            <label>Pays</label>
                            <p><?php echo esc_html($pays); ?></p>
                        </div>
                        <?php endif; ?>
                        <?php if ($tel) : ?>
                        <div class="tro-detail-field">
                            <label>Téléphone</label>
                            <p><a href="tel:<?php echo esc_attr($tel); ?>" style="color:#e74c3c;text-decoration:none;"><?php echo esc_html($tel); ?></a></p>
                        </div>
                        <?php endif; ?>
                        <?php if ($email) : ?>
                        <div class="tro-detail-field">
                            <label>Email</label>
                            <p><a href="mailto:<?php echo esc_attr($email); ?>" style="color:#e74c3c;text-decoration:none;"><?php echo esc_html($email); ?></a></p>
                        </div>
                        <?php endif; ?>
                        <?php if ($type_svc) : ?>
                        <div class="tro-detail-field">
                            <label>Type de service</label>
                            <p><?php echo esc_html($type_svc); ?></p>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Section 2 : Offres -->
                <?php if ($type_offre_detail || $desc_svc || $public_cible || $conditions) : ?>
                <div class="tro-detail-section">
                    <p class="tro-detail-section-title">📦 Fiche Offres</p>
                    <div class="tro-detail-grid">
                        <?php if ($type_offre_detail) : ?>
                        <div class="tro-detail-field">
                            <label>Type d'offre</label>
                            <p><?php echo esc_html($type_offre_detail); ?></p>
                        </div>
                        <?php endif; ?>
                        <?php if ($public_cible) : ?>
                        <div class="tro-detail-field">
                            <label>Public cible</label>
                            <div class="tro-detail-tags">
                                <?php foreach (explode(', ', $public_cible) as $pc) : ?>
                                <span class="tro-detail-tag"><?php echo esc_html(trim($pc)); ?></span>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                    <?php if ($desc_svc) : ?>
                    <div class="tro-detail-field" style="margin-top:10px;">
                        <label>Description du service</label>
                        <p><?php echo nl2br(esc_html($desc_svc)); ?></p>
                    </div>
                    <?php endif; ?>
                    <?php if ($conditions) : ?>
                    <div class="tro-detail-field" style="margin-top:10px;">
                        <label>Conditions</label>
                        <p><?php echo nl2br(esc_html($conditions)); ?></p>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endif; ?>

                <!-- Section 3 : Partenariat -->
                <?php if ($type_part || $zone_inter || $sect_cibles || $msg_part) : ?>
                <div class="tro-detail-section">
                    <p class="tro-detail-section-title">🤝 Fiche Partenariat</p>
                    <div class="tro-detail-grid">
                        <?php if ($zone_inter) : ?>
                        <div class="tro-detail-field">
                            <label>Zone d'intervention</label>
                            <p><?php echo esc_html($zone_inter); ?></p>
                        </div>
                        <?php endif; ?>
                        <?php if ($type_part) : ?>
                        <div class="tro-detail-field">
                            <label>Type de partenariat</label>
                            <div class="tro-detail-tags">
                                <?php foreach (explode(', ', $type_part) as $tp) : ?>
                                <span class="tro-detail-tag"><?php echo esc_html(trim($tp)); ?></span>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php if ($sect_cibles) : ?>
                        <div class="tro-detail-field">
                            <label>Secteurs cibles</label>
                            <div class="tro-detail-tags">
                                <?php foreach (explode(', ', $sect_cibles) as $sc) : ?>
                                <span class="tro-detail-tag"><?php echo esc_html(trim($sc)); ?></span>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                    <?php if ($msg_part) : ?>
                    <div class="tro-detail-field" style="margin-top:10px;">
                        <label>Message</label>
                        <p><?php echo nl2br(esc_html($msg_part)); ?></p>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endif; ?>

                <!-- Section 4 : Demandes reçues -->
                <?php if ($membres_int || $type_dem) : ?>
                <div class="tro-detail-section">
                    <p class="tro-detail-section-title">📬 Demandes Reçues</p>
                    <div class="tro-detail-grid">
                        <?php if ($membres_int) : ?>
                        <div class="tro-detail-field">
                            <label>Membres intéressés</label>
                            <p><?php echo nl2br(esc_html($membres_int)); ?></p>
                        </div>
                        <?php endif; ?>
                        <?php if ($type_dem) : ?>
                        <div class="tro-detail-field">
                            <label>Type de demande</label>
                            <p><?php echo nl2br(esc_html($type_dem)); ?></p>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Lien externe -->
                <?php if ($offre->lien_externe) : ?>
                <a href="<?php echo esc_url($offre->lien_externe); ?>"
                   target="_blank" rel="noopener"
                   class="tro-offre-link">En savoir plus →</a>
                <?php endif; ?>

            </div><!-- /.tro-offre-details -->
        </div><!-- /.tro-offre-card -->
        <?php endforeach; ?>
        <?php endif; ?>
        </div><!-- /#tro-offres-list -->
    </div><!-- /.tro-wrap -->

    <script>
    (function() {

        /* ── Expand / Collapse ── */
        document.querySelectorAll('.tro-offre-summary').forEach(function(summary) {
            summary.addEventListener('click', function() {
                var card = this.closest('.tro-offre-card');
                card.classList.toggle('open');
            });
        });

        /* ── FILTRE PAR TYPE ── */
        var filterBtns = document.querySelectorAll('#tro-filters .tro-filter-btn');
        var cards      = document.querySelectorAll('#tro-offres-list .tro-offre-card');

        filterBtns.forEach(function(btn) {
            btn.addEventListener('click', function() {

                filterBtns.forEach(function(b) {
                    b.classList.remove('active');
                });

                this.classList.add('active');

                var type = this.getAttribute('data-type');

                cards.forEach(function(card) {
                    var cardType = card.getAttribute('data-type');

                    if (!type || cardType === type) {
                        card.style.display = '';
                    } else {
                        card.style.display = 'none';
                    }
                });

            });
        });

    })();
    </script>
    <?php
    return ob_get_clean();
}
add_shortcode('tre_offres_partenaires', 'tre_offres_partenaires_shortcode');


// ── 7. Admin : valider / rejeter les offres ───────────────────────
// Ajoute une colonne "Offres partenaires" dans le menu admin
add_action('admin_menu', function() {
    add_menu_page(
        'Offres partenaires',
        '🏢 Offres',
        'manage_options',
        'tre-offres',
        'tre_admin_offres_page',
        'dashicons-store',
        26
    );
});

function tre_admin_offres_page() {
    global $wpdb;
    $table = $wpdb->prefix . 'tre_offres';

    // Actions admin
    if (isset($_GET['action']) && isset($_GET['id']) && current_user_can('manage_options')) {
        $id = intval($_GET['id']);
        if ($_GET['action'] === 'publier') {
            $wpdb->update($table, ['statut' => 'publiee'],  ['id' => $id]);
            echo '<div class="notice notice-success"><p>✅ Offre publiée.</p></div>';
        } elseif ($_GET['action'] === 'rejeter') {
            $wpdb->update($table, ['statut' => 'rejetee'],  ['id' => $id]);
            echo '<div class="notice notice-error"><p>❌ Offre rejetée.</p></div>';
        } elseif ($_GET['action'] === 'supprimer') {
            $wpdb->delete($table, ['id' => $id]);
            echo '<div class="notice notice-warning"><p>🗑️ Offre supprimée.</p></div>';
        }
    }

    $offres = $wpdb->get_results("SELECT o.*, u.display_name, u.user_email
        FROM $table o LEFT JOIN {$wpdb->users} u ON o.user_id = u.ID
        ORDER BY o.created_at DESC");
    ?>
    <div class="wrap">
        <h1>🏢 Offres partenaires</h1>
        <table class="wp-list-table widefat fixed striped">
            <thead>
                <tr>
                    <th>Logo</th><th>Entreprise</th><th>Description</th>
                    <th>Type</th><th>Secteur</th><th>Membre</th>
                    <th>Statut</th><th>Date</th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($offres as $o) :
                $url = admin_url('admin.php?page=tre-offres');
            ?>
            <tr>
                <td><?php if ($o->logo_url) echo '<img src="'.esc_url($o->logo_url).'" style="height:36px;max-width:80px;object-fit:contain">'; else echo '—'; ?></td>
                <td><strong><?php echo esc_html($o->nom_entreprise); ?></strong></td>
                <td style="max-width:200px;word-break:break-word;"><?php echo esc_html(wp_trim_words($o->description, 15)); ?></td>
                <td><?php echo esc_html($o->type_offre); ?></td>
                <td><?php echo esc_html($o->secteur); ?></td>
                <td><?php echo esc_html($o->display_name . ' <' . $o->user_email . '>'); ?></td>
                <td>
                    <?php
                    $badges = ['publiee' => '<span style="color:#27ae60;font-weight:700">✅ Publiée</span>',
                               'rejetee' => '<span style="color:#e74c3c;font-weight:700">❌ Rejetée</span>',
                               'en_attente' => '<span style="color:#e65100;font-weight:700">⏳ En attente</span>'];
                    echo $badges[$o->statut] ?? esc_html($o->statut);
                    ?>
                </td>
                <td><?php echo esc_html(date('d/m/Y', strtotime($o->created_at))); ?></td>
                <td>
                    <a href="<?php echo esc_url(add_query_arg(['action' => 'publier', 'id' => $o->id], $url)); ?>"
                       style="color:#27ae60;margin-right:8px;font-weight:600;">✅ Publier</a>
                    <a href="<?php echo esc_url(add_query_arg(['action' => 'rejeter', 'id' => $o->id], $url)); ?>"
                       style="color:#e74c3c;margin-right:8px;font-weight:600;">❌ Rejeter</a>
                    <a href="<?php echo esc_url(add_query_arg(['action' => 'supprimer', 'id' => $o->id], $url)); ?>"
                       style="color:#888;font-weight:600;"
                       onclick="return confirm('Supprimer cette offre ?')">🗑️ Suppr.</a>
                    <?php if ($o->lien_externe) : ?>
                    <a href="<?php echo esc_url($o->lien_externe); ?>" target="_blank"
                       style="color:#0d6efd;margin-left:8px;font-weight:600;">🔗</a>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php
}


// ================================================================
// SHORTCODE [tre_tous_partenaires]
// Affiche tous les partenaires avec pagination + profil au clic
// ================================================================

function tre_tous_partenaires_shortcode($atts) {

    // ── Accès réservé aux administrateurs connectés ──
    if ( ! is_user_logged_in() || ! current_user_can('administrator') ) {
        return '<div style="text-align:center;padding:40px;font-family:\'Segoe UI\',sans-serif;">
            <p style="font-size:15px;color:#e74c3c;font-weight:700;">⛔ Accès réservé aux administrateurs.</p>
        </div>';
    }

    $atts = shortcode_atts([
        'par_page' => 5,
    ], $atts);

    global $wpdb;
    $table   = $wpdb->prefix . 'tre_partenaire';
    $t_offre = $wpdb->prefix . 'tre_offres';

    $par_page      = intval($atts['par_page']);
    $total         = $wpdb->get_var("SELECT COUNT(*) FROM $table");
    $nb_pages      = max(1, ceil($total / $par_page));
    $page_actuelle = isset($_GET['part_page']) ? max(1, intval($_GET['part_page'])) : 1;
    $offset        = ($page_actuelle - 1) * $par_page;

    // Récupérer les partenaires de cette page
    $partenaires = $wpdb->get_results($wpdb->prepare(
        "SELECT p.*, u.display_name, um.meta_value AS avatar_url
         FROM $table p
         LEFT JOIN {$wpdb->users} u ON p.user_id = u.ID
         LEFT JOIN {$wpdb->usermeta} um ON um.user_id = p.user_id AND um.meta_key = 'trp_avatar'
         ORDER BY p.created_at DESC
         LIMIT %d OFFSET %d",
        $par_page, $offset
    ));

    // Récupérer le logo de l'offre pour chaque partenaire
    $logos = [];
    if (!empty($partenaires)) {
        $ids = array_map(function($p) { return intval($p->user_id); }, $partenaires);
        $placeholders = implode(',', array_fill(0, count($ids), '%d'));
        $offres = $wpdb->get_results($wpdb->prepare(
            "SELECT user_id, logo_url FROM $t_offre WHERE user_id IN ($placeholders)",
            ...$ids
        ));
        foreach ($offres as $o) {
            $logos[$o->user_id] = $o->logo_url;
        }
    }

    ob_start(); ?>
    <style>
    /* ── Reset RTL pour ce bloc ── */
    .trp-wrap,
    .trp-wrap * {
        direction: ltr !important;
        text-align: left !important;
    }

    /* ── Conteneur ── */
    .trp-part-wrap {
        max-width: 860px;
        margin: 0 auto;
        font-family: 'Segoe UI', sans-serif;
    }

    .trp-part-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
        margin-bottom: 28px;
    }

    .trp-part-title {
        font-size: 22px;
        font-weight: 900;
        color: #1c1e21;
        margin: 0;
        border-left: 4px solid #e74c3c;
        padding-left: 14px;
    }

    .trp-part-count {
        font-size: 13px;
        color: #888;
        margin: 0;
    }

    /* ── Carte partenaire ── */
    .trp-part-card {
        background: #fff;
        border: 1px solid #eee;
        border-radius: 12px;
        margin-bottom: 12px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        overflow: hidden;
        transition: box-shadow 0.2s;
    }
    .trp-part-card:hover { box-shadow: 0 6px 24px rgba(0,0,0,0.10); }

    /* ── Résumé (toujours visible) ── */
    .trp-part-summary {
        display: flex !important;
        flex-direction: row !important;
        align-items: center !important;
        gap: 20px;
        padding: 18px 24px;
        cursor: pointer;
        user-select: none;
    }

    /* Logo */
    .trp-part-logo {
        width: 110px;
        min-width: 110px;
        height: 64px;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        border-right: 1px solid #f0f0f0;
        padding-right: 20px;
        flex-shrink: 0;
    }
    .trp-part-logo img {
        max-width: 100px;
        max-height: 56px;
        object-fit: contain;
        display: block;
    }
    .trp-part-no-logo { font-size: 36px; color: #ddd; }

    /* Corps résumé */
    .trp-part-body { flex: 1 !important; min-width: 0; }
    .trp-part-name { font-size: 15px; font-weight: 800; color: #1c1e21; margin: 0 0 4px; }
    .trp-part-sub  { font-size: 12px; color: #888; margin: 0 0 8px; }
    .trp-part-meta {
        display: flex !important;
        flex-direction: row !important;
        gap: 6px;
        flex-wrap: wrap;
        align-items: center;
    }
    .trp-part-tag  { padding: 3px 10px; border-radius: 20px; font-size: 11px; font-weight: 600; }
    .trp-tag-type    { background: #e8f4fd; color: #0d6efd; }
    .trp-tag-zone    { background: #e8f8f0; color: #198754; }

    /* Chevron */
    .trp-part-chevron {
        flex-shrink: 0;
        width: 28px; height: 28px;
        border-radius: 50%;
        background: #f5f5f5;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        font-size: 13px;
        color: #888;
        transition: transform 0.25s, background 0.2s;
    }
    .trp-part-card.open .trp-part-chevron {
        transform: rotate(180deg);
        background: #e74c3c;
        color: #fff;
    }

    /* ── Détails (expand) ── */
    .trp-part-details {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.35s ease, padding 0.25s ease;
        background: #fafbfc;
        padding: 0 24px;
        border-top: 0px solid #f0f0f0;
    }
    .trp-part-card.open .trp-part-details {
        max-height: 1600px;
        padding: 20px 24px 24px;
        border-top: 1px solid #f0f0f0;
    }

    /* Grille détails */
    .trp-part-grid {
        display: grid !important;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 10px 20px;
        margin-bottom: 16px;
    }
    .trp-part-field label {
        display: block;
        font-size: 11px;
        font-weight: 700;
        color: #aaa;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 2px;
    }
    .trp-part-field p {
        margin: 0;
        font-size: 13px;
        color: #222;
        line-height: 1.5;
    }
    .trp-part-field a {
        color: #e74c3c;
        text-decoration: none;
    }

    .trp-part-section-title {
        font-size: 12px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        color: #e74c3c;
        margin: 16px 0 10px;
        padding-bottom: 6px;
        border-bottom: 1px solid #f0f0f0;
    }

    .trp-part-tags { display: flex !important; flex-wrap: wrap; gap: 6px; }
    .trp-part-tag-item {
        padding: 3px 10px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
        background: #f0f0f0;
        color: #555;
    }

    /* ── Pagination ── */
    .trp-part-pagination {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        margin-top: 32px;
        flex-wrap: wrap;
    }
    .trp-part-page-num {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 38px; height: 38px;
        border-radius: 8px;
        background: #f5f5f5;
        color: #444;
        font-weight: 700;
        font-size: 14px;
        text-decoration: none;
        border: 1.5px solid #eee;
        transition: all 0.2s;
    }
    .trp-part-page-num:hover,
    .trp-part-page-num.active {
        background: #e74c3c;
        color: #fff;
        border-color: #e74c3c;
    }
    .trp-part-page-btn {
        display: inline-flex;
        align-items: center;
        padding: 8px 18px;
        border-radius: 8px;
        background: #222;
        color: #fff;
        font-weight: 700;
        font-size: 13px;
        text-decoration: none;
        transition: background 0.2s;
    }
    .trp-part-page-btn:hover {
        background: #e74c3c;
        color: #fff;
    }

    .trp-part-empty {
        text-align: center !important;
        padding: 48px 20px;
        color: #65676b;
        font-size: 15px;
    }
    .trp-part-empty-icon { font-size: 52px; margin-bottom: 16px; }

    @media(max-width: 600px) {
        .trp-part-summary { flex-wrap: wrap; gap: 14px; padding: 14px 16px; }
        .trp-part-logo {
            border-right: none;
            border-bottom: 1px solid #f0f0f0;
            padding-right: 0;
            padding-bottom: 14px;
            width: 100%;
        }
        .trp-part-details { padding: 0 16px; }
        .trp-part-card.open .trp-part-details { padding: 16px; }
        .trp-part-grid { grid-template-columns: 1fr; }
    }
    </style>

    <div class="trp-part-wrap">

        <div class="trp-part-header">
            <h2 class="trp-part-title">🏢 Tous les partenaires</h2>
            <p class="trp-part-count">
                <?php echo $total; ?> partenaire<?php echo $total > 1 ? 's' : ''; ?> —
                Page <?php echo $page_actuelle; ?> / <?php echo $nb_pages; ?>
            </p>
        </div>

        <?php if (empty($partenaires)) : ?>
        <div class="trp-part-empty">
            <div class="trp-part-empty-icon">🏢</div>
            <p>Aucun partenaire inscrit pour le moment.</p>
        </div>
        <?php else : ?>

        <?php foreach ($partenaires as $p) :
            $logo    = $logos[$p->user_id] ?? '';
            $avatar  = $p->avatar_url ?: get_avatar_url($p->user_id, ['size' => 80]);
            $nom_ent = $p->nom_entreprise ?: $p->display_name ?: 'Partenaire TRE Radio';

            // Secteurs cibles sous forme de tableau
            $secteurs = $p->secteurs_cibles
                ? array_map('trim', explode(', ', $p->secteurs_cibles))
                : [];

            // Types de partenariat
            $types_part = $p->type_partenariat
                ? array_map('trim', explode(', ', $p->type_partenariat))
                : [];

            // Public cible
            $publics = $p->public_cible
                ? array_map('trim', explode(', ', $p->public_cible))
                : [];
        ?>
        <div class="trp-part-card">

            <!-- ══ RÉSUMÉ ══ -->
            <div class="trp-part-summary">

                <!-- Logo ou emoji -->
                <div class="trp-part-logo">
                    <?php if ($logo) : ?>
                        <img src="<?php echo esc_url($logo); ?>"
                             alt="<?php echo esc_attr($nom_ent); ?>">
                    <?php elseif ($avatar) : ?>
                        <img src="<?php echo esc_url($avatar); ?>"
                             alt="<?php echo esc_attr($nom_ent); ?>"
                             style="border-radius:50%;width:56px;height:56px;object-fit:cover;">
                    <?php else : ?>
                        <span class="trp-part-no-logo">🏢</span>
                    <?php endif; ?>
                </div>

                <!-- Infos -->
                <div class="trp-part-body">
                    <p class="trp-part-name"><?php echo esc_html($nom_ent); ?></p>
                    <p class="trp-part-sub">
                        <?php if ($p->nom_contact) : ?>
                            <strong><?php echo esc_html($p->nom_contact); ?></strong>
                            <?php if ($p->fonction) echo ' · ' . esc_html($p->fonction); ?>
                        <?php endif; ?>
                        <?php if ($p->pays) echo ' · 📍 ' . esc_html($p->pays); ?>
                    </p>
                    <div class="trp-part-meta">
                        <?php if ($p->type_service) : ?>
                        <span class="trp-part-tag trp-tag-type"><?php echo esc_html($p->type_service); ?></span>
                        <?php endif; ?>
                        <?php if ($p->zone_intervention) : ?>
                        <span class="trp-part-tag trp-tag-zone"><?php echo esc_html($p->zone_intervention); ?></span>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Chevron -->
                <div class="trp-part-chevron">▼</div>
            </div>

            <!-- ══ DÉTAILS ══ -->
            <div class="trp-part-details">

                <!-- Profil -->
                <p class="trp-part-section-title">🏢 Profil Partenaire</p>
                <div class="trp-part-grid">
                    <?php if ($p->nom_entreprise) : ?>
                    <div class="trp-part-field">
                        <label>Entreprise</label>
                        <p><?php echo esc_html($p->nom_entreprise); ?></p>
                    </div>
                    <?php endif; ?>
                    <?php if ($p->nom_contact) : ?>
                    <div class="trp-part-field">
                        <label>Contact</label>
                        <p><?php echo esc_html($p->nom_contact); ?></p>
                    </div>
                    <?php endif; ?>
                    <?php if ($p->fonction) : ?>
                    <div class="trp-part-field">
                        <label>Fonction</label>
                        <p><?php echo esc_html($p->fonction); ?></p>
                    </div>
                    <?php endif; ?>
                    <?php if ($p->pays) : ?>
                    <div class="trp-part-field">
                        <label>Pays</label>
                        <p><?php echo esc_html($p->pays); ?></p>
                    </div>
                    <?php endif; ?>
                    <?php if ($p->telephone) : ?>
                    <div class="trp-part-field">
                        <label>Téléphone</label>
                        <p><a href="tel:<?php echo esc_attr($p->telephone); ?>">
                            <?php echo esc_html($p->telephone); ?>
                        </a></p>
                    </div>
                    <?php endif; ?>
                    <?php if ($p->email) : ?>
                    <div class="trp-part-field">
                        <label>Email</label>
                        <p><a href="mailto:<?php echo esc_attr($p->email); ?>">
                            <?php echo esc_html($p->email); ?>
                        </a></p>
                    </div>
                    <?php endif; ?>
                    <?php if ($p->type_service) : ?>
                    <div class="trp-part-field">
                        <label>Type de service</label>
                        <p><?php echo esc_html($p->type_service); ?></p>
                    </div>
                    <?php endif; ?>
                </div>

                <!-- Offres -->
                <?php if ($p->type_offre || $p->description_service || $publics || $p->conditions) : ?>
                <p class="trp-part-section-title">📦 Offres</p>
                <div class="trp-part-grid">
                    <?php if ($p->type_offre) : ?>
                    <div class="trp-part-field">
                        <label>Type d'offre</label>
                        <p><?php echo esc_html($p->type_offre); ?></p>
                    </div>
                    <?php endif; ?>
                    <?php if (!empty($publics)) : ?>
                    <div class="trp-part-field">
                        <label>Public cible</label>
                        <div class="trp-part-tags">
                            <?php foreach ($publics as $pub) : ?>
                            <span class="trp-part-tag-item"><?php echo esc_html($pub); ?></span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
                <?php if ($p->description_service) : ?>
                <div class="trp-part-field" style="margin-bottom:10px;">
                    <label>Description</label>
                    <p><?php echo nl2br(esc_html($p->description_service)); ?></p>
                </div>
                <?php endif; ?>
                <?php if ($p->conditions) : ?>
                <div class="trp-part-field" style="margin-bottom:10px;">
                    <label>Conditions</label>
                    <p><?php echo nl2br(esc_html($p->conditions)); ?></p>
                </div>
                <?php endif; ?>
                <?php endif; ?>

                <!-- Partenariat -->
                <?php if (!empty($types_part) || $p->zone_intervention || !empty($secteurs) || $p->message_partenariat) : ?>
                <p class="trp-part-section-title">🤝 Partenariat</p>
                <div class="trp-part-grid">
                    <?php if ($p->zone_intervention) : ?>
                    <div class="trp-part-field">
                        <label>Zone d'intervention</label>
                        <p><?php echo esc_html($p->zone_intervention); ?></p>
                    </div>
                    <?php endif; ?>
                    <?php if (!empty($types_part)) : ?>
                    <div class="trp-part-field">
                        <label>Type de partenariat</label>
                        <div class="trp-part-tags">
                            <?php foreach ($types_part as $tp) : ?>
                            <span class="trp-part-tag-item"><?php echo esc_html($tp); ?></span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php if (!empty($secteurs)) : ?>
                    <div class="trp-part-field">
                        <label>Secteurs cibles</label>
                        <div class="trp-part-tags">
                            <?php foreach ($secteurs as $s) : ?>
                            <span class="trp-part-tag-item"><?php echo esc_html($s); ?></span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
                <?php if ($p->message_partenariat) : ?>
                <div class="trp-part-field" style="margin-bottom:10px;">
                    <label>Message</label>
                    <p><?php echo nl2br(esc_html($p->message_partenariat)); ?></p>
                </div>
                <?php endif; ?>
                <?php endif; ?>

            </div><!-- /.trp-part-details -->
        </div><!-- /.trp-part-card -->
        <?php endforeach; ?>

        <!-- ── PAGINATION ── -->
        <?php if ($nb_pages > 1) :
            $base_url = get_permalink();
        ?>
        <div class="trp-part-pagination">
            <?php if ($page_actuelle > 1) : ?>
            <a href="<?php echo esc_url(add_query_arg('part_page', $page_actuelle - 1, $base_url)); ?>"
               class="trp-part-page-btn">← Précédent</a>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $nb_pages; $i++) : ?>
            <a href="<?php echo esc_url(add_query_arg('part_page', $i, $base_url)); ?>"
               class="trp-part-page-num <?php echo $i === $page_actuelle ? 'active' : ''; ?>">
                <?php echo $i; ?>
            </a>
            <?php endfor; ?>

            <?php if ($page_actuelle < $nb_pages) : ?>
            <a href="<?php echo esc_url(add_query_arg('part_page', $page_actuelle + 1, $base_url)); ?>"
               class="trp-part-page-btn">Suivant →</a>
            <?php endif; ?>
        </div>
        <?php endif; ?>

        <?php endif; ?>
    </div><!-- /.trp-part-wrap -->

    <script>
    (function() {
        document.querySelectorAll('.trp-part-summary').forEach(function(summary) {
            summary.addEventListener('click', function() {
                var card = this.closest('.trp-part-card');
                // Fermer les autres
                document.querySelectorAll('.trp-part-card.open').forEach(function(c) {
                    if (c !== card) c.classList.remove('open');
                });
                card.classList.toggle('open');
            });
        });
    })();
    </script>
    <?php
    return ob_get_clean();
}
add_shortcode('tre_tous_partenaires', 'tre_tous_partenaires_shortcode');

// Masquer "Tous les partenaires" du menu pour les non-administrateurs
add_filter('wp_nav_menu_objects', 'tre_hide_partenaires_menu_item', 10, 2);
function tre_hide_partenaires_menu_item($items, $args) {
    if (current_user_can('administrator')) {
        return $items; // Admin → afficher tout
    }

    foreach ($items as $key => $item) {
        // Comparer avec le titre de la page dans le menu
        if ($item->title === 'Tous les partenaires') {
            unset($items[$key]);
        }
    }

    return $items;
}