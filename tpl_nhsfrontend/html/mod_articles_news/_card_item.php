<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_news
 *
 * @copyright   Copyright (C) 2005 - 2020 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>

<div class="nhsuk-card nhsuk-card--clickable">
    <?php if ($params->get('img_intro_full') !== 'none' && !empty($item->imageSrc)) : ?>
    <img class="nhsuk-card__img" src="<?php echo $item->imageSrc; ?>" alt="<?php echo $item->imageAlt; ?>">
    <?php endif; ?>
    <div class="nhsuk-card__content">
        <h2 class="nhsuk-card__heading nhsuk-heading-m">
            <?php if ($params->get('item_title')) : ?>
            <?php if ($item->link !== '' && $params->get('link_titles')) : ?>
            <a class="nhsuk-card__link" href="<?php echo $item->link; ?>">
                <?php echo $item->title; ?>
            </a>
            <?php else : ?>
            <?php echo $item->title; ?>
            <?php endif; ?>
            <?php endif; ?>
        </h2>
        <?php if ($params->get('show_introtext', 1)) : ?>
        <div class="nhsuk-card__description">
            <?php echo $item->introtext; ?>
        </div>
        <?php endif; ?>

    </div>
</div>


<?php /*
<?php if ($params->get('item_title')) : ?>
<?php $item_heading = $params->get('item_heading', 'h4'); ?>
<<?php echo $item_heading; ?> class="newsflash-title<?php echo $params->get('moduleclass_sfx'); ?>">
    <?php if ($item->link !== '' && $params->get('link_titles')) : ?>
    <a href="<?php echo $item->link; ?>">
        <?php echo $item->title; ?>
    </a>
    <?php else : ?>
    <?php echo $item->title; ?>
    <?php endif; ?>
</<?php echo $item_heading; ?>>
<?php endif; ?>

<?php if ($params->get('img_intro_full') !== 'none' && !empty($item->imageSrc)) : ?>
<figure class="newsflash-image">
    <img src="<?php echo $item->imageSrc; ?>" alt="<?php echo $item->imageAlt; ?>">
    <?php if (!empty($item->imageCaption)) : ?>
    <figcaption>
        <?php echo $item->imageCaption; ?>
    </figcaption>
    <?php endif; ?>
</figure>
<?php endif; ?>

<?php if (!$params->get('intro_only')) : ?>
<?php echo $item->afterDisplayTitle; ?>
<?php endif; ?>

<?php echo $item->beforeDisplayContent; ?>

<?php if ($params->get('show_introtext', 1)) : ?>
<?php echo $item->introtext; ?>
<?php endif; ?>

<?php echo $item->afterDisplayContent; ?>

<?php if (isset($item->link) && $item->readmore != 0 && $params->get('readmore')) : ?>
<?php echo '<a class="readmore" href="' . $item->link . '">' . $item->linkText . '</a>'; ?>
<?php endif; ?>

*/?>