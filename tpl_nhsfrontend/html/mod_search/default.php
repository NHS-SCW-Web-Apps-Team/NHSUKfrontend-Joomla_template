<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_search
 *
 * @copyright   Copyright (C) 2005 - 2020 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Including fallback code for the placeholder attribute in the search field.
JHtml::_('jquery.framework');
JHtml::_('script', 'system/html5fallback.js', array('version' => 'auto', 'relative' => true, 'conditional' => 'lt IE 9'));

if ($width)
{
	$moduleclass_sfx .= ' ' . 'mod_search' . $module->id;
	$css = 'div.mod_search' . $module->id . ' input[type="search"]{ width:auto; }';
	JFactory::getDocument()->addStyleDeclaration($css);
	$width = ' size="' . $width . '"';
}
else
{
	$width = '';
}
?>




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

            <form class="nhsuk-header__search-form" id="search" action="<?php echo JRoute::_('index.php'); ?>" method="post" role="search">
                <label class="nhsuk-u-visually-hidden" for="mod-search-searchword">Search the NHS website</label>
                <input name="searchword" class="nhsuk-search__input search-query" id="mod-search-searchword" type="search" placeholder="Search" autocomplete="off">
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
                <input type="hidden" name="task" value="search" />
                <input type="hidden" name="option" value="com_search" />
                <input type="hidden" name="Itemid" value="<?php echo $mitemid; ?>" />
            </form>

        </div>

    </div>

</div>


<?php /*

<div class="search<?php echo $moduleclass_sfx; ?>">
<form action="<?php echo JRoute::_('index.php'); ?>" method="post" class="form-inline" role="search">
    <?php
			$output = '<label for="mod-search-searchword' . $module->id . '" class="element-invisible">' . $label . '</label> ';
			$output .= '<input name="searchword" id="mod-search-searchword' . $module->id . '" maxlength="' . $maxlength . '"  class="inputbox search-query input-medium" type="search"' . $width;
			$output .= ' placeholder="' . $text . '" />';

			if ($button) :
				if ($imagebutton) :
					$btn_output = ' <input type="image" alt="' . $button_text . '" class="button" src="' . $img . '" onclick="this.form.searchword.focus();"/>';
				else :
					$btn_output = ' <button class="button btn btn-primary" onclick="this.form.searchword.focus();">' . $button_text . '</button>';
				endif;

				switch ($button_pos) :
					case 'top' :
						$output = $btn_output . '<br />' . $output;
						break;

					case 'bottom' :
						$output .= '<br />' . $btn_output;
						break;

					case 'right' :
						$output .= $btn_output;
						break;

					case 'left' :
					default :
						$output = $btn_output . $output;
						break;
				endswitch;
			endif;

			echo $output;
		?>
    <input type="hidden" name="task" value="search" />
    <input type="hidden" name="option" value="com_search" />
    <input type="hidden" name="Itemid" value="<?php echo $mitemid; ?>" />
</form>
</div>

*/
?>