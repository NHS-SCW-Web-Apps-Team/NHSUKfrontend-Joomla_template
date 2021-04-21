<?php
/**
 * @package    Joomla.Site
 * @subpackage Template.nhsfrontend
 *
 * @author     NHS South, Central and West <webteam.scwcsu@nhs.net>
 * @copyright  Copyright (C) 2021 NHS South Central and West. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * @link       https://www.scwcsu.nhs.uk
 */

defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;

require_once JPATH_THEMES . '/' . $this->template . '/helper.php';

tplNhsfrontendHelper::loadCss();
tplNhsfrontendHelper::loadJs();
tplNhsfrontendHelper::setMetadata();
$pageclass=tplNhsfrontendHelper::getPageClass();
$base = JUri::base(); ;
?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>

	<link rel="preload" as="font" href="https://assets.nhs.uk/fonts/FrutigerLTW01-55Roman.woff2" type="font/woff2" crossorigin>
  <link rel="preload" as="font" href="https://assets.nhs.uk/fonts/FrutigerLTW01-65Bold.woff2" type="font/woff2" crossorigin>
  <link rel="preconnect  dns-prefetch" href="https://www.nhs.uk/">
  <link rel="preconnect  dns-prefetch" href="https://assets.nhs.uk/" crossorigin>
  
  <jdoc:include type="head" />

  <link rel="shortcut icon" href="<?php echo $base ;?>templates/nhsfrontend/assets/favicons/favicon.ico" type="image/x-icon">
  <link rel="apple-touch-icon" href="<?php echo $base ;?>templates/nhsfrontend/assets/favicons/apple-touch-icon-180x180.png">
  <link rel="mask-icon" href="<?php echo $base ;?>templates/nhsfrontend/assets/favicons/favicon.svg" color="#005eb8">
  <link rel="icon" sizes="192x192" href="<?php echo $base ;?>templates/nhsfrontend/assets/favicons/favicon-192x192.png">
  <meta name="msapplication-TileImage" content="/assets/favicons/mediumtile-144x144.png">
  <meta name="msapplication-TileColor" content="#005eb8">
  <meta name="msapplication-square70x70logo" content="/assets/favicons/smalltile-70x70.png">
  <meta name="msapplication-square150x150logo" content="/assets/favicons/mediumtile-150x150.png">
  <meta name="msapplication-wide310x150logo" content="/assets/favicons/widetile-310x150.png">
  <meta name="msapplication-square310x310logo" content="/assets/favicons/largetile-310x310.png">

    <!-- Open Graph -->
    <meta property="og:url" content="https://www.nhs.uk">
    <meta property="og:title" content="NHS.UK">
    <meta property="og:description" content="Helping you take control of your health and wellbeing.">
    <meta property="og:type" content="website">
    <meta property="og:image" content="<?php echo $base ;?>/assets/logos/open-graph.png">
    <meta property="og:image:alt" content="nhs.uk">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@nhsuk">
    <meta name="twitter:creator" content="@nhsuk">
    <meta name="twitter:image:alt" content="nhs.uk">

</head>
<body class="<?php echo tplNhsfrontendHelper::setBodySuffix(); ?>">
<script>
    document.body.className = ((document.body.className) ? document.body.className + ' js-enabled' : 'js-enabled');
</script>

<a href="#maincontent" class="sr-only sr-only-focusable"><?php echo Text::_('TPL_NHSFRONTEND_SKIP_LINK_LABEL'); ?></a>

<?php echo tplNhsfrontendHelper::setAnalytics(0, 'your-analytics-id'); ?>

<header class="nhsuk-header" role="banner">
    <div class="nhsuk-width-container nhsuk-header__container">
      <div class="nhsuk-header__logo nhsuk-header__logo--only">
      <a class="nhsuk-header__link" href="<?php echo $this->baseurl; ?>/" aria-label="NHS homepage">
          <svg class="nhsuk-logo" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 40 16">
            <path class="nhsuk-logo__background" d="M0 0h40v16H0z"></path>
            <path class="nhsuk-logo__text" d="M3.9 1.5h4.4l2.6 9h.1l1.8-9h3.3l-2.8 13H9l-2.7-9h-.1l-1.8 9H1.1M17.3 1.5h3.6l-1 4.9h4L25 1.5h3.5l-2.7 13h-3.5l1.1-5.6h-4.1l-1.2 5.6h-3.4M37.7 4.4c-.7-.3-1.6-.6-2.9-.6-1.4 0-2.5.2-2.5 1.3 0 1.8 5.1 1.2 5.1 5.1 0 3.6-3.3 4.5-6.4 4.5-1.3 0-2.9-.3-4-.7l.8-2.7c.7.4 2.1.7 3.2.7s2.8-.2 2.8-1.5c0-2.1-5.1-1.3-5.1-5 0-3.4 2.9-4.4 5.8-4.4 1.6 0 3.1.2 4 .6"></path>
          </svg>
        </a>
      </div>

      <?php if ($this->params->get('sitedescription')) : ?>
        <div class="nhsuk-header__transactional-service-name">
          <a class="nhsuk-header__transactional-service-name--link" href="<?php echo $this->baseurl; ?>/">
          <?php echo htmlspecialchars($this->params->get('sitedescription'), ENT_COMPAT, 'UTF-8'); ?>
            </a>
        </div>
      <?php endif; ?>
      


      <div class="nhsuk-header__content" id="content-header">

        <div class="nhsuk-header__menu">
          <button class="nhsuk-header__menu-toggle" id="toggle-menu" aria-controls="header-navigation" aria-label="Open menu">Menu</button>
        </div>

        <div class="nhsuk-header__search">
          <button class="nhsuk-header__search-toggle" id="toggle-search" aria-controls="search" aria-label="Open search">
            <svg class="nhsuk-icon nhsuk-icon__search" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
              <path d="M19.71 18.29l-4.11-4.1a7 7 0 1 0-1.41 1.41l4.1 4.11a1 1 0 0 0 1.42 0 1 1 0 0 0 0-1.42zM5 10a5 5 0 1 1 5 5 5 5 0 0 1-5-5z"></path>
            </svg>
            <span class="nhsuk-u-visually-hidden">Search</span>
          </button>
          
          <div class="nhsuk-header__search-wrap" id="wrap-search">
          
            <form class="nhsuk-header__search-form" id="search" action="https://www.nhs.uk/search/" method="get" role="search">
              <label class="nhsuk-u-visually-hidden" for="search-field">Search the NHS website</label>
              <input class="nhsuk-search__input" id="search-field" name="q" type="search" placeholder="Search" autocomplete="off">
              <button class="nhsuk-search__submit" type="submit">
                <svg class="nhsuk-icon nhsuk-icon__search" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                  <path d="M19.71 18.29l-4.11-4.1a7 7 0 1 0-1.41 1.41l4.1 4.11a1 1 0 0 0 1.42 0 1 1 0 0 0 0-1.42zM5 10a5 5 0 1 1 5 5 5 5 0 0 1-5-5z"></path>
                </svg>
                <span class="nhsuk-u-visually-hidden">Search</span>
              </button>
              <button class="nhsuk-search__close" id="close-search">
                <svg class="nhsuk-icon nhsuk-icon__close" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                  <path d="M13.41 12l5.3-5.29a1 1 0 1 0-1.42-1.42L12 10.59l-5.29-5.3a1 1 0 0 0-1.42 1.42l5.3 5.29-5.3 5.29a1 1 0 0 0 0 1.42 1 1 0 0 0 1.42 0l5.29-5.3 5.29 5.3a1 1 0 0 0 1.42 0 1 1 0 0 0 0-1.42z"></path>
                </svg>
                <span class="nhsuk-u-visually-hidden">Close search</span>
              </button>
            </form>
          
          </div>

        </div>

      </div>

    </div>

    <?php if ($this->countModules('position-0')) : ?> 

    <nav class="nhsuk-header__navigation" id="header-navigation" role="navigation" aria-label="Primary navigation" aria-labelledby="label-navigation">
      <div class="nhsuk-width-container">
        <p class="nhsuk-header__navigation-title"><span id="label-navigation">Menu</span>
          <button class="nhsuk-header__navigation-close" id="close-menu">
            <svg class="nhsuk-icon nhsuk-icon__close" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
              <path d="M13.41 12l5.3-5.29a1 1 0 1 0-1.42-1.42L12 10.59l-5.29-5.3a1 1 0 0 0-1.42 1.42l5.3 5.29-5.3 5.29a1 1 0 0 0 0 1.42 1 1 0 0 0 1.42 0l5.29-5.3 5.29 5.3a1 1 0 0 0 1.42 0 1 1 0 0 0 0-1.42z"></path>
            </svg>
            <span class="nhsuk-u-visually-hidden">Close menu</span>
          </button>
        </p>
        <jdoc:include type="modules" name="position-0" style="none" />
      </div>
    </nav>

    <?php endif; ?>
</header>

<nav class="nhsuk-breadcrumb" aria-label="Breadcrumb">
      <div class="nhsuk-width-container">
        <ol class="nhsuk-breadcrumb__list">
          <li class="nhsuk-breadcrumb__item"><a class="nhsuk-breadcrumb__link" href="/level-one">Level one</a></li>
          <li class="nhsuk-breadcrumb__item"><a class="nhsuk-breadcrumb__link" href="/level-one/level-two">Level two</a></li>
          <li class="nhsuk-breadcrumb__item"><a class="nhsuk-breadcrumb__link" href="/level-one/level-two/level-three">Level three</a></li>
        </ol>
        <p class="nhsuk-breadcrumb__back"><a class="nhsuk-breadcrumb__backlink" href="/level-one/level-two/level-three">Back to Level three</a></p>
      </div>
</nav>

<div class="nhsuk-width-container<?php echo $pageclass ;?>">

    <main class="nhsuk-main-wrapper" id="maincontent" role="main">
    <jdoc:include type="message" />
  <!--    <div class="nhsuk-grid-row">
        <div class="nhsuk-grid-column-two-thirds">
          <h1>
            Content page template
          </h1>
        </div>
      </div>-->


        

	      <jdoc:include type="component" />
<!--      
<section class="nhsuk-hero">
  <div class="nhsuk-width-container nhsuk-hero--border">
    <div class="nhsuk-grid-row">
      <div class="nhsuk-grid-column-two-thirds">
        <div class="nhsuk-hero__wrapper">
          <h1 class="nhsuk-u-margin-bottom-3">We’re here for you</h1>
          <p class="nhsuk-body-l nhsuk-u-margin-bottom-0">Helping you take control of your health and wellbeing.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="nhsuk-hero nhsuk-hero--image nhsuk-hero--image-description" style="background-image: url(&quot;https://assets.nhs.uk/nhsuk-cms/images/IS_0818_homepage_hero_3_913783962.width-1000.jpg&quot;);">
    <script>
      function randomImage() {
          var images =[ 
            
                
                "https://assets.nhs.uk/nhsuk-cms/images/IS_0818_homepage_hero_2_831416400.width-1000.jpg",
            
                
                "https://assets.nhs.uk/nhsuk-cms/images/IS_0818_homepage_hero_3_913783962.width-1000.jpg",
            
                
                "https://assets.nhs.uk/nhsuk-cms/images/AS_0818_homepage_hero_4_169974765.width-1000.jpg",
            
                
                "https://assets.nhs.uk/nhsuk-cms/images/A_0818_homepage_hero_5_KRK6T6.width-1000.jpg",
            
                
                "https://assets.nhs.uk/nhsuk-cms/images/S_0818_homepage_hero_1_F0147446.width-1000.jpg",
             
          ]; 

          var size = images.length;
          var x = Math.floor(size * Math.random());
          var element = document.getElementsByClassName('nhsuk-hero--image');
          if (element.length > 0) {
              element[0].style["background-image"] = "url(" + images[x] + ")";
          }
      }

      document.addEventListener("DOMContentLoaded", randomImage);
  </script>
  <div class="nhsuk-hero__overlay">
    <div class="nhsuk-width-container">
      <div class="nhsuk-grid-row">
        <div class="nhsuk-grid-column-two-thirds">
          <div class="nhsuk-hero-content">
            <h1 class="nhsuk-u-margin-bottom-3">We’re here for you</h1>
            <p class="nhsuk-body-l nhsuk-u-margin-bottom-0">Helping you take control of your health and wellbeing.</p>
            <span class="nhsuk-hero__arrow" aria-hidden="true"></span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

-->
    </main>
</div>

<aside>
    <?php if ($this->countModules('position-3')) : ?>
		<jdoc:include type="modules" name="position-3" style="none" />
	<?php endif; ?>
</aside>


<?php if ($this->countModules('footer')) : ?>
  <footer role="contentinfo">
    <div class="nhsuk-footer" id="nhsuk-footer">
      <div class="nhsuk-width-container">
        <h2 class="nhsuk-u-visually-hidden">Support links</h2>
        <jdoc:include type="modules" name="footer" style="none" />
          <p class="nhsuk-footer__copyright">&copy; Crown copyright</p>
      </div>
    </div>
  </footer>
  <?php endif; ?>
</html>


<!--

<a href="<?php echo $this->baseurl; ?>/">
    <?php if ($this->params->get('sitedescription')) : ?>
        <?php echo '<div class="site-description">' . htmlspecialchars($this->params->get('sitedescription'), ENT_COMPAT, 'UTF-8') . '</div>'; ?>
    <?php endif; ?>
</a>

<nav role="navigation" >
	<jdoc:include type="modules" name="position-0" style="none" />
</nav>

<main id="main">
	<jdoc:include type="message" />
	<jdoc:include type="component" />
</main>

<aside>
    <?php if ($this->countModules('position-1')) : ?>
		<jdoc:include type="modules" name="position-1" style="none" />
	<?php endif; ?>
</aside>

<footer>
	<jdoc:include type="modules" name="nhsfrontendter" style="none" />
	<p>
		&copy; <?php echo date('Y'); ?> <?php echo tplNhsfrontendHelper::getSitename(); ?>
	</p>
</footer>
<jdoc:include type="modules" name="debug" style="none" />
</body>
</html>
-->
