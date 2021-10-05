<?php
/**
 * @package     Shika
 * @subpackage  com_tjlms
 *
 * @author      Techjoomla <extensions@techjoomla.com>
 * @copyright   Copyright (C) 2009 - 2020 Techjoomla. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die('Restricted access');

use Joomla\CMS\Uri\Uri;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Language\Text;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Layout\LayoutHelper;

if ($this->oluser->id && $this->checkIfUserEnroled && !$this->item->userEnrollment->expired)
{

?>
<div class="container-fluid">
	<div class="row after-enroll">
		<div class="col-xs-12 pd-0">
			<div class="row">
				<div class="col-xs-10">
					<!--<div class="progress course-progress">
						<div class="progress-bar progress-bar-success progress-bar-striped"
							role="progressbar" aria-valuenow="<?php echo $this->courseProgress['completionPercent']; ?>" aria-valuemin="0"
							aria-valuemax="100" style="width: <?php echo $this->courseProgress['completionPercent']; ?>%">
						</div>
					</div>-->
				</div>
				<!--<span><?php echo $this->courseProgress['completionPercent'] . ' % '; ?></span>-->
			</div>

			<div class="course-lesson-progress row">
				<?php if (!empty($this->moduleData['currentLesson'])) { ?>
					<div class="col-xs-12">
						<?php if (count($this->item->toc) > 1)
						{
						?>
						<div class="mb-5 p-relative">
							<!--<i class="fa fa-book"></i>-->

							<?php if ($this->courseProgress['completionPercent'] == 100){
								echo '<h2 class="nhsuk-heading-s nhsuk-u-margin-bottom-2 nhsuk-u-margin-top-2" style="font-size:1.375rem;line-height:1.45455;font-weight:600;">Course complete</h2>';
							} else {
								echo '<h2 class="nhsuk-heading-s nhsuk-u-margin-bottom-2 nhsuk-u-margin-top-2" style="font-size:1.375rem;line-height:1.45455;font-weight:600;">Course incomplete</h2>';
							}?>
							<div class="d-inline-block">
								<p class="nhsuk-body">You have completed <?php echo (array_search($this->moduleData['currentModule']->id,array_keys($this->item->toc)) ) ;?> of <?php echo count($this->item->toc); ?> sections</p>
								<!--<span class="font-600 module-count "><?php echo Text::sprintf('COM_TJLMS_COURSEPROGRESS_MODULE_STAT',(array_search($this->moduleData['currentModule']->id,array_keys($this->item->toc)) + 1), count($this->item->toc)); ?>
								</span> - <span
									class="module-current-name"><?php echo $this->moduleData['currentModule']->name; ?></span>-->
							</div>
						</div>
						<?php } ?>
						<!--<div class="mb-15 p-relative">
							<img class="d-inline" alt="<?php echo $this->moduleData['currentLesson']->format; ?>" width="15"
							title="<?php echo $this->moduleData['currentLesson']->title; ?>"
							src="<?php echo Uri::root(true) . '/media/com_tjlms/images/default/icons/' . $this->moduleData['currentLesson']->format . '.png';?>" />-->

							<div class="ml-20 d-inline-block">
								<!--<span class="font-600 nugget-count"><?php echo Text::sprintf("COM_TJLMS_COURSEPROGRESS_LESSON_STAT", $this->lessonCompletionData->totalCompletedLessons, $this->lessonCompletionData->totalModuleLessons);?></span> -
								<span class="nugget-current-name"><?php echo $this->moduleData['currentLesson']->title; ?></span>
							</div>
						</div>-->
					</div>
				<?php  } ?>
				<div class="col-xs-12 pull-left">
				<?php

				if ($this->courseProgress['completionPercent'] == 100)
				{
					if ($this->item->certificate_term != 0 && !$this->modCourseBlocksParams['progress'])
					{
						// Check for certificate expired
						if (!$this->certificateExpired && isset($this->certficateId)):

							// Get TJcertificate url for display certificate
							$urlOpts = array ();
							$certificateLink = TJCERT::Certificate($this->certficateId)->getUrl($urlOpts, false);
							?>
							<a href="<?php echo $certificateLink?>">
								<button class="btn btn-large btn-success tjlms-btn-flat">
									<?php echo Text::_('COM_TJLMS_GET_CERTIFICATE');?>
								</button>
							</a>
						<?php elseif($this->certificateExpired):
						?>
						<div class="cert_expired_title center">
							<strong>
								<?php echo JText::_('MOD_LMS_COURSE_CERTIFICATES_EXPIRED') ;?>
							</strong>
						</div>
					<?php endif; ?>
					<?php
					}
				}
				else
				{
					$lessonUrl = $this->tjlmshelperObj->tjlmsRoute("index.php?option=com_tjlms&view=lesson&lesson_id=" . $this->moduleData['currentLesson']->id . "&tmpl=component", false);
					$onclick = "open_lessonforattempt('" . addslashes(htmlspecialchars($lessonUrl)) . "','" . $this->launch_lesson_full_screen ."');";
					?>
						<!--<button title=""
						class="btn un-btn-primary un-big-btn"
						type="button" onclick="<?php echo $onclick; ?>"><?php echo Text::_('COM_TJLMS_COURSEPROGRESS_COURSE_CONTINUE'); ?></button>-->
					<?php
				}
?>
				</div>
			</div>
		</div>
	</div>
</div>

<?php }?>
