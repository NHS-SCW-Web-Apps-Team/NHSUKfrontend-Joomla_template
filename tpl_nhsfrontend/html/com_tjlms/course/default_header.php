<?php
/**
 * @package     Shika
 * @subpackage  com_tjlms
 *
 * @author      Techjoomla <extensions@techjoomla.com>
 * @copyright   Copyright (C) 2009 - 2020 Techjoomla. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Layout\FileLayout;
use Joomla\CMS\Plugin\PluginHelper;

HTMLHelper::_('behavior.tooltip');
$document = Factory::getDocument();
$course   = $this->item;

$descShown = 0;

$dispatcher = JDispatcher::getInstance();
PluginHelper::importPlugin('content');

$jlikeresult = $dispatcher->trigger('OnAftercourseTitle', array('com_tjlms.course', $this->course_id, $course->title));

?>
<div class="tjlms-course-header">
	<div class="container-fluid">
		<div class="row">

			<!--Course message and desc -->

			<?php
				echo $this->loadTemplate('message');
			?>
			<!--Course message and desc ends -->

			<div >
				<!--<img itemprop="image" alt="<?php echo $course->title;?>" src="<?php echo $course->image;?>" id="<?php echo 'img'.$course->id;?>" />-->
			</div>
			<div >
				<h1 itemprop="name" class="nhsuk-heading-xl" style="font-size:3em;font-weight:600;margin:0px;">
					<?php echo $this->escape($course->title);	?>
				</h1>
				<!--<div class="small hidden-xs"><?php  echo Text::_('TJLMS_COURSE_NAME'). implode(" > ", $this->course_categories); ?></div>-->

		<?php if (!empty($jlikeresult[0])): ?>

				<div class="tjcourse-likes" id="jlike-container">
						<?php	echo $jlikeresult[0]; ?>
				</div>

		<?php  endif;	?>

		<!-- <?php if (!empty($this->courseTrack['status'])) { ?>
			<li class="">
				<div class="label label-success">
				<?php
				// Display course status, if course status updated through backend the display status as 'Manually Completed'
				if (($this->courseTrack['totalLessons'] != $this->courseTrack['completedLessons']) && $this->courseTrack['status'] == 'C') {
					echo Text::_('COM_TJLMS_VIEW_COURSE_TRACK_MANUALLY_STATUS');
				}

				echo Text::_('COM_TJLMS_VIEW_COURSE_TRACK_' . $this->courseTrack['status']);
				?>
				</div>
			</li>
		<?php } ?> -->

		

					</div>

		</div>
	</div>

	<?php if ($this->tjlmsparams->get('enable_tags') == 1 && !empty($course->course_tags->itemTags)) : ?>
	<div class="row">
		<div class="col-xs-12">
			<div class="mt-15">
				<?php
					$course->tagLayout = new FileLayout('course.tags', JPATH_SITE . '/components/com_tjlms/layouts');
					echo $course->tagLayout->render($course->course_tags->itemTags);
				?>
			</div>
		</div>
	</div>

	<?php endif; ?>

	<div class="container-fluid">
		<div itemprop="description" class="row tjlms-course-header__desc">

			<div class="long_desc text-break">
				<?php
				if ($course->description)
				{
					if(strlen(strip_tags($course->description)) > 150 )
						echo $this->tjlmshelperObj->html_substr($course->description, 0, 150 ).'<a href="javascript:" class="r-more">' . Text::_("COM_TJLMS_TOC_COURSE_DESC_MORE") . '</a>';
					else
						echo '<div class="nhsuk-inset-text">
      							<span class="nhsuk-u-visually-hidden">Information: </span>
      								<p>'.$course->description.'</p>
    								</div>';

					//$this->tjlmshelperObj->html_substr($course->description, 0);
				}
				else
				{
					if(strlen($course->short_desc) > 150 )
						echo $this->tjlmshelperObj->html_substr($this->escape($course->short_desc), 0, 150 ).'<a href="javascript:" class="r-more">' . Text::_("COM_TJLMS_TOC_COURSE_DESC_MORE") . '</a>';
					else
						//echo $this->tjlmshelperObj->html_substr($this->escape($course->short_desc), 0);
						echo '<div class="nhsuk-inset-text">
      							<span class="nhsuk-u-visually-hidden">Information: </span>
      								<p>'.$course->short_desc.'</p>
    								</div>';

				}
				?>
			</div>
			<div class="long_desc_extend no-margin" style="display:none;">
					<?php
					if (!empty($course->description))
					{
						//echo $course->description.'<a href="javascript:" class="r-less">' . Text::_("COM_TJLMS_TOC_COURSE_DESC_LESS") . '</a>';
					}
					else
					{
						//echo $this->escape($course->short_desc).'<a href="javascript:" class="r-less">' . Text::_("COM_TJLMS_TOC_COURSE_DESC_LESS") . '</a>';
					}
					?>
				</div>

		</div>
	</div>
	<?php
			if (($this->item->userOrder->status == "C" || $this->item->userEnrollment->id) && !empty($this->item->toc))
			{
				echo $this->loadTemplate('resume');

			}
		?>
</div>
