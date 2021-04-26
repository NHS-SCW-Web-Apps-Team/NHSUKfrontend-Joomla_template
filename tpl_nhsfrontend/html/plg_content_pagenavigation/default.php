<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  Content.pagenavigation
 *
 * @copyright   Copyright (C) 2005 - 2020 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::_('bootstrap.tooltip');

$lang = JFactory::getLanguage();

?>
<?php /* 

//commented out original plugin
<ul class="pager pagenav">
    <?php if ($row->prev) :
	$direction = $lang->isRtl() ? 'right' : 'left'; ?>
<li class="previous">
    <a class="hasTooltip" title="<?php echo htmlspecialchars($rows[$location-1]->title); ?>" aria-label="<?php echo JText::sprintf('JPREVIOUS_TITLE', htmlspecialchars($rows[$location-1]->title)); ?>" href="<?php echo $row->prev; ?>" rel="prev">
        <?php echo '<span class="icon-chevron-' . $direction . '" aria-hidden="true"></span> <span aria-hidden="true">' . $row->prev_label . '</span>'; ?>
    </a>
</li>
<?php endif; ?>
<?php if ($row->next) :
	$direction = $lang->isRtl() ? 'left' : 'right'; ?>
<li class="next">
    <a class="hasTooltip" title="<?php echo htmlspecialchars($rows[$location+1]->title); ?>" aria-label="<?php echo JText::sprintf('JNEXT_TITLE', htmlspecialchars($rows[$location+1]->title)); ?>" href="<?php echo $row->next; ?>" rel="next">
        <?php echo '<span aria-hidden="true">' . $row->next_label . '</span> <span class="icon-chevron-' . $direction . '" aria-hidden="true"></span>'; ?>
    </a>
</li>
<?php endif; ?>
</ul>
*/?>

<nav class="nhsuk-pagination" role="navigation" aria-label="Pagination">
    <ul class="nhsuk-list nhsuk-pagination__list">
        <?php if ($row->prev) :
		$direction = $lang->isRtl() ? 'right' : 'left'; ?>
        <li class="nhsuk-pagination-item--previous">
            <a class="nhsuk-pagination__link nhsuk-pagination__link--prev" href="<?php echo $row->prev; ?>">
                <span class="nhsuk-pagination__title">Previous</span>
                <span class="nhsuk-u-visually-hidden">:</span>
                <span class="nhsuk-pagination__page"><?php echo$rows[$location-1]->title;?></span>
                <svg class="nhsuk-icon nhsuk-icon__arrow-left" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M4.1 12.3l2.7 3c.2.2.5.2.7 0 .1-.1.1-.2.1-.3v-2h11c.6 0 1-.4 1-1s-.4-1-1-1h-11V9c0-.2-.1-.4-.3-.5h-.2c-.1 0-.3.1-.4.2l-2.7 3c0 .2 0 .4.1.6z"></path>
                </svg>
            </a>
        </li>
        <?php endif; ?>
        <?php if ($row->next) :
		$direction = $lang->isRtl() ? 'left' : 'right'; ?>
        <li class="nhsuk-pagination-item--next">
            <a class="nhsuk-pagination__link nhsuk-pagination__link--next" href="<?php echo $row->next; ?>">
                <span class="nhsuk-pagination__title">Next</span>
                <span class="nhsuk-u-visually-hidden">:</span>
                <span class="nhsuk-pagination__page"><?php echo$rows[$location+1]->title;?></span>
                <svg class="nhsuk-icon nhsuk-icon__arrow-right" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M19.6 11.66l-2.73-3A.51.51 0 0 0 16 9v2H5a1 1 0 0 0 0 2h11v2a.5.5 0 0 0 .32.46.39.39 0 0 0 .18 0 .52.52 0 0 0 .37-.16l2.73-3a.5.5 0 0 0 0-.64z"></path>
                </svg>
            </a>
        </li>
        <?php endif; ?>
    </ul>
</nav>