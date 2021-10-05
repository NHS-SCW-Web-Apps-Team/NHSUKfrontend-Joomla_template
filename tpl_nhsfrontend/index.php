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
$base = JUri::base();
//kj, removing bootstrap and jCaption

$doc = JFactory::getDocument();
//JS
unset($doc->_scripts[$this->baseurl.'/media/jui/js/bootstrap.min.js']);
//unset($doc->_scripts[$this->baseurl.'/media/system/js/caption.js']); //wanted to remove this too but the problem is that joomla uses this in various places for some stupid reason so have to leave it in or the console gives errors.
unset($doc->_scripts[$this->baseurl.'/templates/nhsfrontend/media/jui/js/bootstrap.min.js']);

//CSS    
unset($doc->_stylesheets[$this->baseurl.'/media/jui/js/bootstrap.css']);

//grab this flag from the cookieconsent plugin so we can use it in the template should we wish. We don't use it at the moment as I have made the plugin do all the work. Just leaving this incase we need it in the the future.
$app =JFactory::getApplication();
$allowNonEssentialCookies = $app->getUserState( "cookieconsent.non_essential_cookie_consent_variable", "FALSE");

$fluid="";
if($this->params->get('templatewidth')==1){$fluid="-fluid";}

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
    
    
      if (!String.prototype.trim) {
          String.prototype.trim = function () {
                return this.replace(/^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g, '');
              };
      }
    
        if (!String.prototype.includes) {
            String.prototype.includes = function() {
                'use strict';
                return String.prototype.indexOf.apply(this, arguments) !== -1;
            };
        }
        
    </script>

    <a href="#maincontent" class="sr-only sr-only-focusable"><?php echo Text::_('TPL_NHSFRONTEND_SKIP_LINK_LABEL'); ?></a>
    <cookieholder></cookieholder>



    <?php if ($this->countModules('cookiestop')) : ?>
    <div class="nhsuk-width-container">
        <div class="nhsuk-grid-row">
            <div class="nhsuk-grid-column-full">
                <jdoc:include type="modules" name="cookiestop" style="none" />
            </div>
        </div>
    </div>
    <?php endif; ?>

    <header class="nhsuk-header" role="banner">
        <div class="nhsuk-width-container<?php echo $fluid; ?> nhsuk-header__container">
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

            <?php if (tplNhsfrontendHelper::getPageOption() !== "com_search") : ?>
            <?php if ($this->countModules('search')) : ?>
            <jdoc:include type="modules" name="search" style="none" />
            <?php endif; ?>
            <?php endif; ?>

        </div>

        <?php if ($this->countModules('position-0')) : ?>

        <nav class="nhsuk-header__navigation <?php echo $fluid ;?>" id="header-navigation" role="navigation" aria-label="Primary navigation" aria-labelledby="label-navigation">
            <div class="nhsuk-width-container<?php echo $fluid ;?>">
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

    <?php if ($this->countModules('breadcrumbs')) : ?>
    <jdoc:include type="modules" name="breadcrumbs" style="none" />
    <?php endif; ?>

    <?php if ($this->countModules('hero')) : ?>
    <jdoc:include type="modules" name="hero" style="none" />
    <?php endif; ?>


    <?php $split = "-full"; ?>
    <section class="nhsuk-section maincontent">
        <div class="nhsuk-width-container<?php echo $fluid." ".$pageclass ;?>">
            <main class="nhsuk-main-wrapper" id="maincontent" role="main">
                <jdoc:include type="message" />
                <div class="nhsuk-grid-row">
                    <?php if ($this->countModules('left')) : ?>
                    <?php $split = "-three-quarters"; ?>
                    <div class="nhsuk-grid-column-one-quarter">
                        <jdoc:include type="modules" name="left" style="none" />
                    </div>
                    <?php endif; ?>
                    <div class="nhsuk-grid-column<?php echo $split;?>">
                        <jdoc:include type="component" />
                    </div>
                </div>
            </main>
        </div>
    </section>
    <?php if ($this->countModules('position-4')) : ?>
    <section class="nhsuk-section">
        <div class="nhsuk-width-container-fluid">
            <div class="nhsuk-grid-row">
                <div class="nhsuk-grid-column-full">
                    <jdoc:include type="modules" name="position-4" style="none" />
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <?php if ($this->countModules('position-5')) : ?>
    <section class="nhsuk-section whitebg">
        <div class="nhsuk-width-container">
            <div class="nhsuk-grid-row">
                <div class="nhsuk-grid-column-full">
                    <jdoc:include type="modules" name="position-5" style="none" />
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>
    <?php if ($this->countModules('position-6')) : ?>
    <section class="nhsuk-section">
        <div class="nhsuk-width-container">
            <div class="nhsuk-grid-row">
                <div class="nhsuk-grid-column-full">
                    <jdoc:include type="modules" name="position-6" style="none" />
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>
    <?php if ($this->countModules('position-7')) : ?>
    <section class="nhsuk-section ">
        <div class="nhsuk-width-container">
            <div class="nhsuk-grid-row">
                <div class="nhsuk-grid-column-full">
                    <jdoc:include type="modules" name="position-7" style="none" />
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>
    <?php if ($this->countModules('position-8')) : ?>
    <section class="nhsuk-section">
        <div class="nhsuk-width-container">
            <div class="nhsuk-grid-row">
                <div class="nhsuk-grid-column-full">
                    <jdoc:include type="modules" name="position-8" style="none" />
                </div>
            </div>
        </div>
    </section>

    <?php endif; ?>



    <?php if ($this->countModules('footer')) : ?>
    <footer role="contentinfo">
        <div class="nhsuk-footer" id="nhsuk-footer">
            <div class="nhsuk-width-container<?php echo $fluid ;?>">
                <h2 class="nhsuk-u-visually-hidden">Support links</h2>
                <jdoc:include type="modules" name="footer" style="none" />
                <p class="nhsuk-footer__copyright">&copy; Crown copyright</p>
            </div>
        </div>
    </footer>
    <?php endif; ?>


    <?php if ($this->countModules('cookies')) : ?>
    <div class="nhsuk-width-container">
        <div class="nhsuk-grid-row">
            <div class="nhsuk-grid-column-full">
                <jdoc:include type="modules" name="cookies" style="none" />
            </div>
        </div>
    </div>
    <?php endif; ?>


    <jdoc:include type="modules" name="debug" style="none" />


</html>