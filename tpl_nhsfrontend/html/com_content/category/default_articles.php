<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   (C) 2009 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\Language\Multilanguage;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');

// Create some shortcuts.
$n          = count($this->items);
$listOrder  = $this->escape($this->state->get('list.ordering'));
$listDirn   = $this->escape($this->state->get('list.direction'));
$langFilter = false;

// Tags filtering based on language filter
if (($this->params->get('filter_field') === 'tag') && (Multilanguage::isEnabled()))
{
	$tagfilter = ComponentHelper::getParams('com_tags')->get('tag_list_language_filter');

	switch ($tagfilter)
	{
		case 'current_language' :
			$langFilter = JFactory::getApplication()->getLanguage()->getTag();
			break;

		case 'all' :
			$langFilter = false;
			break;

		default :
			$langFilter = $tagfilter;
	}
}

// Check for at least one editable article
$isEditable = false;

if (!empty($this->items))
{
	foreach ($this->items as $article)
	{
		if ($article->params->get('access-edit'))
		{
			$isEditable = true;
			break;
		}
	}
}

// For B/C we also add the css classes inline. This will be removed in 4.0.
JFactory::getDocument()->addStyleDeclaration('
.hide { display: none; }
.table-noheader { border-collapse: collapse; }
.table-noheader thead { display: none; }
');

$tableClass = $this->params->get('show_headings') != 1 ? ' table-noheader' : '';

$nullDate    = JFactory::getDbo()->getNullDate();
$currentDate = JFactory::getDate()->format('Y-m-d H:i:s');

?>

  
    

<nav class="nhsuk-contents-list">
<h2 class="nhsuk-heading-m">Sections:</h2>
<ol class="nhsuk-contents-list__list">
  <?php foreach ($this->items as $i => $article) : ?>
    
    <?php if (in_array($article->access, $this->user->getAuthorisedViewLevels())) : ?>
      
     <li class="nhsuk-contents-list__item"> 
      	<a class="nhsuk-contents-list__link" href="<?php echo JRoute::_(ContentHelperRoute::getArticleRoute($article->slug, $article->catid, $article->language)); ?>">
		<?php echo $this->escape($article->title); ?>
		</a>
      </li>
 
    <?php endif; ?>
    
    
      <?php endforeach; ?>
</ol>
</nav>

  

