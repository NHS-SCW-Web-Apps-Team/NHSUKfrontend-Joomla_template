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
<ul class="nhsuk-grid-row nhsuk-card-group <?php echo $params->get('moduleclass_sfx'); ?>">
    <?php for ($i = 0, $n = count($list); $i < $n; $i ++) : ?>
    <?php $item = $list[$i]; ?>
    <li class="nhsuk-grid-column-one-third nhsuk-card-group__item">
        <?php require JModuleHelper::getLayoutPath('mod_articles_news', '_card_item'); ?>
    </li>
    <?php endfor; ?>
</ul>