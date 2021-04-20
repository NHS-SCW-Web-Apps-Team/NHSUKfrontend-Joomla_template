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

?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>

	<jdoc:include type="head" />
	
  <link rel="shortcut icon" href="/assets/favicons/favicon.ico" type="image/x-icon">
  <link rel="apple-touch-icon" href="/assets/favicons/apple-touch-icon-180x180.png">
  <link rel="mask-icon" href="/assets/favicons/favicon.svg" color="#005eb8">
  <link rel="icon" sizes="192x192" href="/assets/favicons/favicon-192x192.png">
  <meta name="msapplication-TileImage" content="/assets/favicons/mediumtile-144x144.png">
  <meta name="msapplication-TileColor" content="#005eb8">
  <meta name="msapplication-square70x70logo" content="/assets/favicons/smalltile-70x70.png">
  <meta name="msapplication-square150x150logo" content="/assets/favicons/mediumtile-150x150.png">
  <meta name="msapplication-wide310x150logo" content="/assets/favicons/widetile-310x150.png">
  <meta name="msapplication-square310x310logo" content="/assets/favicons/largetile-310x310.png">

</head>
<body class="<?php echo tplNhsfrontendHelper::setBodySuffix(); ?>">
<?php echo tplNhsfrontendHelper::setAnalytics(0, 'your-analytics-id'); ?>

<a href="#main" class="sr-only sr-only-focusable"><?php echo Text::_('TPL_NHSFRONTEND_SKIP_LINK_LABEL'); ?></a>

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

<nhsfrontendter>
	<jdoc:include type="modules" name="nhsfrontendter" style="none" />
	<p>
		&copy; <?php echo date('Y'); ?> <?php echo tplNhsfrontendHelper::getSitename(); ?>
	</p>
</nhsfrontendter>
<jdoc:include type="modules" name="debug" style="none" />
</body>
</html>

