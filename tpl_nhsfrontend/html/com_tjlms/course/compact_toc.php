<?php
/**
 * @package     Shika
 * @subpackage  com_tjlms
 *
 * @author      Techjoomla <extensions@techjoomla.com>
 * @copyright   Copyright (C) 2009 - 2019 Techjoomla. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
defined('_JEXEC') or die;

/*layout for Image & text ads only (ie. title & img & decrip)
this will be the default layout for the module/zone
*/
jimport('joomla.html.html');
jimport('joomla.utilities.string');

use Joomla\CMS\Uri\Uri;
use Joomla\CMS\Language\Text;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Plugin\PluginHelper;
?>

<!--<div class="tjlms-course-toc pt-10">
	<h4> <?php echo Text::_("COM_TJLMS_TOC_HEAD_CAPTION");?></h4>
	<hr class="tjlms-hr-dark mt-10">-->

<?php
if ($this->lesson_count == 0)
{
?>
	<div class="alert alert-warning">
		<?php echo Text::_('TJLMS_NO_LESSON_PRESENT'); ?>
	</div>
<?php
}
?>

<?php $modules_data = $this->item->toc; ?>

<ol class="app-task-list" >

<?php foreach ($modules_data as $module_data)
{
	if ($this->modules_present > 1 && !empty($module_data->lessons))
	{
	?>
	<li class="" id="modlist_<?php	echo $module_data->id;?>">
		<!--<div class="cursor-pointer panel-heading collapsed border-0" data-jstoggle="collapse"
		data-target="#collapse_<?php echo $module_data->id;?>" aria-expanded="false">
			<h5 class="panel-title accordion-toggle">
				<a class="d-inline-block">
					<i class="fa fa-book" aria-hidden="true"></i>-->
					<h2 class="app-task-list__section" style="font-size:1.375rem;line-height:1.45455;font-weight:600;"><?php echo $module_data->name; ?></h2><!--
					<?php
					if ($module_data->completedLessonsCount == count($module_data->lessons))
					{
						?>
							<small class="pull-right">
							<i class="fa fa-check-circle"></i>
							<span class="hasTooltip" title="<?php echo HTMLHelper::_('date', $module_data->moduleLastaccessedon, Text::_('DATE_FORMAT_LC6')); ?>">
								<?php echo HTMLHelper::_('date.relative', $module_data->moduleLastaccessedon); ?>
							</span>
							</small>
						<?php
					}
					?>
				</a>
			</h5>
		</div>-->
		<!-- <id="collapse_<?php	echo $module_data->id;?>" class="panel-collapse collapse">-->
			<ul class="app-task-list__items" style="margin-bottom:60px;">
	<?php
	//}

	$report_link = 'index.php?option=com_tjlms&view=reports&layout=attempts&tmpl=component&course_id=' . $this->item->id;

	foreach ($module_data->lessons as $m_index => $m_lesson)
	{
        $lessonUrl = "index.php?option=com_tjlms&view=lesson&lesson_id=" . $m_lesson->id . "&tmpl=component&cid=" . $this->course_id;

        $lessonUrl  = $this->tjlmshelperObj->tjlmsRoute($lessonUrl, false);

        $lessonType = $m_lesson->free_lesson ? $m_lesson->free_lesson : 0;
        $courseId   = $this->canAutoEnroll ? $this->course_id : 0;
        $onclick    = "open_lessonforattempt('" . addslashes(htmlspecialchars($lessonUrl)) . "','"
        . $this->launch_lesson_full_screen . "' , '" . $courseId . "', '" . $lessonType . "');";
	?>

	    <li id="<?php echo $m_lesson->alias; ?>" class="app-task-list__item">

            <span class="app-task-list__task-name">
                    <a href="<?php echo $lessonUrl; ?>" target="_blank" aria-describedby="#">
                    <?php echo $m_lesson->title; ?>
                    </a>
                </span>
            <?php
                if ($m_lesson->userStatus['status'] == 'completed' || $m_lesson->userStatus['status'] == 'passed')
                {
                    echo '<strong class="nhsuk-tag app-task-list__tag" >Completed</strong>';
                }
                elseif ($m_lesson->userStatus['status'] == 'incomplete' || $m_lesson->userStatus['status'] == 'started')
                {
                    echo '<strong class="nhsuk-tag nhsuk-tag--blue app-task-list__tag" id="#">In progress</strong>';
                }
                elseif ($m_lesson->userStatus['status'] == 'failed')
                {
                    echo '<strong class="nhsuk-tag nhsuk-tag--blue app-task-list__tag" id="#">Failed</strong>';
                }
		elseif ($m_lesson->userStatus['status'] == 'not_started')
                {
                    echo '<strong class="nhsuk-tag nhsuk-tag--grey app-task-list__tag" id="#">Not started</strong>';
                }

                else {
                    echo '<strong class="nhsuk-tag nhsuk-tag--grey app-task-list__tag" id="#">Cannot start yet</strong>';
                }

                if (isset($m_lesson->scorm_toc_tree) && !empty($m_lesson->scorm_toc_tree))
                {
                    $multiscorm = 1;
                }
                $usercanAccess = $this->lessonModel->canUserLaunchFromCourse($this->item, $m_lesson, $this->oluser_id);
                //echo "<span style='padding-left:20px;'>access=".$usercanAccess['access'].", status=".$m_lesson->userStatus['status']."</span>";

            ?>
            

		<!--<div class="row">
			<?php
			if ($launchButton && isset($launchButton['html']))
			{
				//echo $launchButton['html'];

				if ($launchButton['supress_lms_launch'] == 0)
				{
					$tjlms_launch = 1;
				}
			}
			else
			{
				$tjlms_launch = 1;
			}
			?>

			<div class="tjlms_toc__lesson-title <?php echo $lessonTitleClass; ?>">
				<img class="d-inline" alt="<?php echo $m_lesson->format; ?>"
				title="<?php echo ucfirst($m_lesson->format); ?>"
				src="<?php echo Uri::root(true) . '/media/com_tjlms/images/default/icons/' . $m_lesson->format . '.png';?>"/>
				<span class="pl-10">
					<span class="d-inline fs-15"><?php echo ucfirst($m_lesson->title);?></span>
				</span>
				<?php if ($this->oluser_id) : ?>
					<span class="label <?php echo $m_lesson->userStatus['status'] == 'not_started' ? 'label-default' : $completionClass; ?> ml-10">
						<?php echo Text::_("COM_TJLMS_LESSON_STATUS_" . strtoupper($m_lesson->userStatus['status'])); ?>
					</span>
				<?php endif; ?>
			</div>

			<?php
			if ($tjlms_launch == 1 && empty($m_lesson->userStatus['viewed']))
			{
				?>
				<div class="col-xs-3">
					<button <?php echo $hovertitle; ?>
					class="br-0 btn <?php echo $activeBtnClass; ?>"
					onclick="<?php echo $onclick?>"><?php echo $lockIcon; ?>
						<span class="lesson_attempt_action hidden-xs hidden-sm">
							<?php echo $btnTitle; ?>
						</span>
						<span class="glyphicon glyphicon-play hidden-md hidden-lg"></span>
					</button>
				</div>-->
				<?php
			}
			?>
		<!--tjlms_toc__lesson-title-->

		<?php if (!empty($m_lesson->userStatus['viewed']))
		{
			$btnTitle = Text::_("COM_TJLMS_START_OVER");

			if ($tjlms_launch == 1)
			{
				?>
				<!--<div class="col-xs-3">
					<button <?php echo $hovertitle; ?>
					class="br-0 btn <?php echo $activeBtnClass; ?>"
					onclick="<?php echo $onclick?>">
						<?php echo $lockIcon; ?>
						<span class="lesson_attempt_action hidden-sm hidden-xs">
							<?php echo $btnTitle; ?>
						</span>
						<span class="glyphicon glyphicon-play glyphicon glyphicon-play hidden-md hidden-lg"></span>
					</button>
				</div>-->
				<?php
			}
		}
		?>
		</li>
	
	<?php
	}
	if ($this->modules_present > 1 && !empty($module_data->lessons))
	{
	?>
				<!--</div>
			</div>
    </div>-->
	<?php
	}?>
    </ul>
    <?php }?>
    </li>
<?php 
}
?>

<!--</div>-->

</ol>



<!-- css ------------------------------------------------------------------------------------------------  -->

<style type="text/css">

@media (max-width: 61.865em) {
.nhsuk-header__service-name {
  max-width: 210px;
}
.nhsuk-header__service-name {
  font-weight: 400;
  font-size: 16px;
  font-size: 1rem;
  line-height: 1.5;
  color: #fff;
  display: inline-block;
  padding-left: 0;
  padding-right: 0;
  margin-left: 8px;
}
}


.govuk-tag {
    display: inline-block;
    outline: 2px solid transparent;
    outline-offset: -2px;
    color: #fff;
    background-color: #1d70b8;
    letter-spacing: 1px;
    text-decoration: none;
    text-transform: uppercase;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    font-weight: 700;
    font-size: 14px;
    font-size: .875rem;
    line-height: 1;
    padding-top: 5px;
    padding-right: 8px;
    padding-bottom: 4px;
    padding-left: 8px;
}
.govuk-phase-banner__content {
  font-size: .9rem;
  margin-top: 16px!important;
  margin-left: 0px!important;
}

.nhsuk-footer-categories h2 {
    padding: 10px 0 0;
}



.nhsuk-footer-categories ul {
    list-style: none;
    padding: 0;
    margin: 0;
      font-size: 0.875rem;
}



.nhsuk-footer-categories a {
    color: #454a4c;
}



.nhsuk-footer-categories hr {
    clear: both;
    margin: 0 15px 30px;
    border: 1px solid #b1b4b6;
    border-width: 1px 0 0;
}



@media (min-width: 40.0625em) {
    .nhsuk-footer-categories {
        padding-bottom: 30px;
    }



    .nhsuk-footer-categories h2 {
        margin: 0 0 15px 0;
        padding: 0 0 20px;
        border-bottom: 1px solid #b1b4b6;
    }



    .nhsuk-footer-categories ul {
          padding-bottom: 60px;
        font-size: 16px;
          font-size: 1rem;
        line-height: 1.25;
    }



    .nhsuk-footer-categories ul li {
        padding: 20px 0 0;
        margin-bottom: 0;
    }
}



/* Added by Abdus Samad, August 2021
========================================================================== */
/* login/sign in and out link on pages */
.nhsuk-login-link { text-align: right; }

/* table - even row */
 .nhsuk-table__row-even { background: #fff; }

 /* table - sortable table
https://hmcts-design-system.herokuapp.com/components/sortable-table */
  [aria-sort] button,
 [aria-sort] button:hover {
   background-color: transparent;
   border-width: 0;
   -webkit-box-shadow: 0 0 0 0;
   -moz-box-shadow: 0 0 0 0;
   box-shadow: 0 0 0 0;
   color: #005ea5;
   cursor: pointer;
   font-family: inherit;
   font-size: inherit;
   font-weight: inherit;
   padding: 0 10px 0 0;
   position: relative;
   text-align: inherit;
   font-size: 1em;
   margin: 0;
 }

 [aria-sort] button:focus {
   outline: 3px solid transparent;
   color: #0b0c0c;
   background-color: #ffdd00;
   box-shadow: 0 -2px #ffdd00, 0 4px #0b0c0c;
   text-decoration: none;
   position: relative;
   z-index: 1;
 }

 [aria-sort]:first-child button {
   right: auto;
 }

 [aria-sort] button:before {
   content: " \25bc";
   position: absolute;
   right: -1px;
   top: 9px;
   font-size: 0.5em;
 }

 [aria-sort] button:after {
   content: " \25b2";
   position: absolute;
   right: -1px;
   top: 1px;
   font-size: 0.5em;
 }

 [aria-sort="ascending"] button:before,
 [aria-sort="descending"] button:before {
   content: none;
 }

 [aria-sort="ascending"] button:after {
   content: " \25b2";
   font-size: .8em;
   position: absolute;
   right: -5px;
   top: 2px;
 }

 [aria-sort="descending"] button:after {
   content: " \25bc";
   font-size: .8em;
   position: absolute;
   right: -5px;
   top: 2px;
 }

 /* pagination
 https://hmcts-design-system.herokuapp.com/components/pagination */
 @media (min-width: 48.0625em) {
   .nhsuk-pagination {
     margin-left: -5px;
     margin-right: -5px;
     font-size: 0;
     text-align: justify;
   }
   .nhsuk-pagination:after {
     content: '';
     display: inline-block;
     width: 100%;
   }
 }

 .nhsuk-pagination__list {
   list-style: none;
   margin: 0;
   padding: 0;
 }

 @media (min-width: 48.0625em) {
   .nhsuk-pagination__list {
     display: inline-block;
     margin-bottom: 0;
     vertical-align: middle;
   }
 }

 @media (min-width: 48.0625em) {
   .nhsuk-pagination__results {
     display: inline-block;
     margin-bottom: 0;
     vertical-align: middle;
   }
 }

 .nhsuk-pagination__item {
   font-family: "GDS Transport", arial, sans-serif;
   -webkit-font-smoothing: antialiased;
   -moz-osx-font-smoothing: grayscale;
   font-weight: 400;
   font-size: 16px;
   font-size: 1rem;
   line-height: 1.25;
   display: inline-block;
 }

 @media print {
   .nhsuk-pagination__item {
     font-family: sans-serif;
   }
 }

 @media (min-width: 40.0625em) {
   .nhsuk-pagination__item {
     font-size: 19px;
     font-size: 1.1875rem;
     line-height: 1.31579;
   }
 }

 @media print {
   .nhsuk-pagination__item {
     font-size: 14pt;
     line-height: 1.15;
   }
 }

 .nhsuk-pagination__item--active,
 .nhsuk-pagination__item--dots {
   font-weight: bold;
   height: 25px;
   padding: 5px 10px;
   text-align: center;
 }

 .nhsuk-pagination__item--dots {
   padding-left: 0;
   padding-right: 0;
 }

 .nhsuk-pagination__item--prev .nhsuk-pagination__link:before, .nhsuk-pagination__item--prev .nhsuk-pagination__link:after,
 .nhsuk-pagination__item--next .nhsuk-pagination__link:before,
 .nhsuk-pagination__item--next .nhsuk-pagination__link:after {
   background-image: url(/images/icon-pagination.svg);
   background-repeat: no-repeat;
   background-size: 22px 36px;
   background-position: 0 0;
   display: inline-block;
   height: 18px;
   vertical-align: middle;
   position: relative;
   top: -1px;
   width: 11px;
 }

 .nhsuk-pagination__item--prev .nhsuk-pagination__link:before {
   background-position: 0 0;
   content: "";
   margin-right: 10px;
 }

 .nhsuk-pagination__item--next .nhsuk-pagination__link:after {
   background-position: -11px -18px;
   content: "";
   margin-left: 10px;
 }

 .nhsuk-pagination__link {
   display: block;
   padding: 5px;
   text-align: center;
   text-decoration: none;
   min-width: 25px;
 }

 .nhsuk-pagination__link:link, .nhsuk-pagination__link:visited {
   color: #1d70b8;
 }

 .nhsuk-pagination__link:hover {
   color: #5694ca;
 }

 .nhsuk-pagination__link:focus {
   color: #0b0c0c;
 }

 .nhsuk-pagination__results {
   padding: 5px;
 }

/* accordion
https://design-system.service.gov.uk/components/accordion/ */

  .nhsuk-accordion{margin-bottom:20px}
  @media (min-width: 40.0625em){.nhsuk-accordion{margin-bottom:30px}}
  .nhsuk-accordion__section{padding-top:15px}
  .nhsuk-accordion__section-header{padding-top:15px;padding-bottom:15px}
  .nhsuk-accordion__section-heading{font-family: Frutiger, "Frutiger W01", arial, sans-serif;-webkit-font-smoothing:antialiased;
  -moz-osx-font-smoothing:grayscale;font-weight:400;font-size:18px;font-size:1.125rem;line-height:1.11111;margin-top:0;
  margin-bottom:0}
  @media print{.nhsuk-accordion__section-heading{font-family:Frutiger, "Frutiger W01", arial, sans-serif}}
  @media (min-width: 40.0625em){.nhsuk-accordion__section-heading{font-size:24px;font-size:1.5rem;line-height:1.25}}
  @media print{.nhsuk-accordion__section-heading{font-size:18pt;line-height:1.15}}
  .nhsuk-accordion__section-button{font-family:Frutiger, "Frutiger W01", arial, sans-serif;-webkit-font-smoothing:antialiased;
  -moz-osx-font-smoothing:grayscale;font-weight:700;font-size:18px;font-size:1.125rem;line-height:1.11111;
  display:inline-block;margin-bottom:0;padding-top:15px}
  @media print{.nhsuk-accordion__section-button{font-family:Frutiger, "Frutiger W01", arial, sans-serif}}
  @media (min-width: 40.0625em){.nhsuk-accordion__section-button{font-size:24px;font-size:1.5rem;line-height:1.25}}
  @media print{.nhsuk-accordion__section-button{font-size:18pt;line-height:1.15}}
  .nhsuk-accordion__section-summary{margin-top:10px;margin-bottom:0}
  .nhsuk-accordion__section-content>:last-child{margin-bottom:0}
  .js-enabled .nhsuk-accordion{border-bottom:1px solid #b1b4b6}
  .js-enabled .nhsuk-accordion__section{padding-top:0}
  .js-enabled .nhsuk-accordion__section-content{display:none;padding-top:15px;padding-bottom:15px}
  @media (min-width: 40.0625em){.js-enabled .nhsuk-accordion__section-content{padding-top:15px}}
  @media (min-width: 40.0625em){.js-enabled .nhsuk-accordion__section-content{padding-bottom:15px}}
  .js-enabled .nhsuk-accordion__section--expanded .nhsuk-accordion__section-content{display:block}
  .js-enabled .nhsuk-accordion__open-all{font-family:Frutiger, "Frutiger W01", arial, sans-serif;
  -webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale;font-weight:400;font-size:14px;
  font-size:.875rem;line-height:1.14286;position:relative;z-index:1;margin:0;padding:0;border-width:0;
  color:#005eb8;background:none;cursor:pointer;-webkit-appearance:none;
  font-family:Frutiger, "Frutiger W01", arial, sans-serif;-webkit-font-smoothing:antialiased;
  -moz-osx-font-smoothing:grayscale;text-decoration:underline;text-decoration-thickness:max(1px, .0625rem);
  text-underline-offset:.1em}
  @media print{.js-enabled .nhsuk-accordion__open-all{font-family:Frutiger, "Frutiger W01", arial, sans-serif}}
  @media (min-width: 40.0625em){.js-enabled .nhsuk-accordion__open-all{font-size:16px;font-size:1rem;line-height:1.25}}
  @media print{.js-enabled .nhsuk-accordion__open-all{font-size:14pt;line-height:1.2}}
  @media print{.js-enabled .nhsuk-accordion__open-all{font-family:Frutiger, "Frutiger W01", arial, sans-serif}}
  .js-enabled .nhsuk-accordion__open-all:hover{text-decoration-thickness:max(3px, .1875rem, .12em);
    -webkit-text-decoration-skip-ink:none;text-decoration-skip-ink:none;-webkit-text-decoration-skip:none;
    text-decoration-skip:none}
  .js-enabled .nhsuk-accordion__open-all:focus{outline:3px solid transparent;color:#0b0c0c;background-color:#fd0;
    -webkit-box-shadow:0 -2px #fd0,0 4px #0b0c0c;box-shadow:0 -2px #fd0,0 4px #0b0c0c;text-decoration:none}
  .js-enabled .nhsuk-accordion__open-all:link{color:#005eb8}
  .js-enabled .nhsuk-accordion__open-all:visited{color:#4c2c92}
  .js-enabled .nhsuk-accordion__open-all:hover{color:#003078}
  .js-enabled .nhsuk-accordion__open-all:active{color:#0b0c0c}
  .js-enabled .nhsuk-accordion__open-all:focus{color:#0b0c0c}
  .js-enabled .nhsuk-accordion__open-all::-moz-focus-inner{padding:0;border:0}
  .js-enabled .nhsuk-accordion__section-header{position:relative;padding-right:40px;border-top:1px solid #b1b4b6;
    cursor:pointer}
  .js-enabled .nhsuk-accordion__section-button{font-family:Frutiger, "Frutiger W01", arial, sans-serif;
  -webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale;margin-top:0;margin-bottom:0;margin-left:0;
  padding:0;border-width:0;color:#005eb8;background:none;text-align:left;cursor:pointer;-webkit-appearance:none}
  @media print{.js-enabled .nhsuk-accordion__section-button{font-family:Frutiger, "Frutiger W01", arial, sans-serif}}
  .js-enabled .nhsuk-accordion__section-button:focus{outline:3px solid transparent;color:#0b0c0c;background-color:#fd0;
    -webkit-box-shadow:0 -2px #fd0,0 4px #0b0c0c;box-shadow:0 -2px #fd0,0 4px #0b0c0c;text-decoration:none}
  .js-enabled .nhsuk-accordion__section-button::-moz-focus-inner{padding:0;border:0}
  .js-enabled .nhsuk-accordion__section-button:after{content:"";position:absolute;top:0;right:0;bottom:0;left:0}
  .js-enabled .nhsuk-accordion__section-button:hover:not(:focus){color:#003078;text-decoration:underline;
    text-decoration-thickness:max(3px, .1875rem, .12em);-webkit-text-decoration-skip-ink:none;
    text-decoration-skip-ink:none;-webkit-text-decoration-skip:none;text-decoration-skip:none;text-underline-offset:.1em}
  @media (hover: none){.js-enabled .nhsuk-accordion__section-button:hover{text-decoration:none}}
  .js-enabled .nhsuk-accordion__controls{text-align:right}
  .js-enabled .nhsuk-accordion__icon{position:absolute;top:50%;right:15px;width:16px;height:16px;margin-top:-8px}
  .js-enabled .nhsuk-accordion__icon:after,.js-enabled .nhsuk-accordion__icon:before{content:"";
  -webkit-box-sizing:border-box;box-sizing:border-box;position:absolute;top:0;right:0;bottom:0;left:0;width:25%;
  height:25%;margin:auto;border:2px solid transparent;background-color:#0b0c0c}
  .js-enabled .nhsuk-accordion__icon:before{width:100%}.js-enabled .nhsuk-accordion__icon:after{height:100%}
  .js-enabled .nhsuk-accordion__section--expanded .nhsuk-accordion__icon:after{content:" ";display:none}


  .nhsuk-accordion{margin-bottom:20px}
  @media (min-width: 40.0625em){.nhsuk-accordion{margin-bottom:30px}}
  .nhsuk-accordion__section{padding-top:15px}.nhsuk-accordion__section-header{padding-top:15px;padding-bottom:15px}
  .nhsuk-accordion__section-heading{font-family:"GDS Transport",arial,sans-serif;-webkit-font-smoothing:antialiased;
  -moz-osx-font-smoothing:grayscale;font-weight:400;font-size:18px;font-size:1.125rem;line-height:1.11111;
  margin-top:0;margin-bottom:0}
  @media print{.nhsuk-accordion__section-heading{font-family:sans-serif}}
  @media (min-width: 40.0625em){.nhsuk-accordion__section-heading{font-size:24px;font-size:1.5rem;line-height:1.25}}
  @media print{.nhsuk-accordion__section-heading{font-size:18pt;line-height:1.15}}
  .nhsuk-accordion__section-button{font-family:"GDS Transport",arial,sans-serif;-webkit-font-smoothing:antialiased;
  -moz-osx-font-smoothing:grayscale;font-weight:700;font-size:18px;font-size:1.125rem;line-height:1.11111;
  display:inline-block;margin-bottom:0;padding-top:15px}
  @media print{.nhsuk-accordion__section-button{font-family:sans-serif}}
  @media (min-width: 40.0625em){.nhsuk-accordion__section-button{font-size:24px;font-size:1.5rem;line-height:1.25}}
  @media print{.nhsuk-accordion__section-button{font-size:18pt;line-height:1.15}}
  .nhsuk-accordion__section-summary{margin-top:10px;margin-bottom:0}
  .nhsuk-accordion__section-content>:last-child{margin-bottom:0}
  .js-enabled .nhsuk-accordion{border-bottom:1px solid #b1b4b6}.js-enabled .nhsuk-accordion__section{padding-top:0}
  .js-enabled .nhsuk-accordion__section-content{display:none;padding-top:15px;padding-bottom:15px}
  @media (min-width: 40.0625em){.js-enabled .nhsuk-accordion__section-content{padding-top:15px}}
  @media (min-width: 40.0625em){.js-enabled .nhsuk-accordion__section-content{padding-bottom:15px}}
  .js-enabled .nhsuk-accordion__section--expanded .nhsuk-accordion__section-content{display:block}
  .js-enabled .nhsuk-accordion__open-all{font-family:"GDS Transport",arial,sans-serif;-webkit-font-smoothing:antialiased;
  -moz-osx-font-smoothing:grayscale;font-weight:400;font-size:14px;font-size:.875rem;line-height:1.14286;
  position:relative;z-index:1;margin:0;padding:0;border-width:0;color:#1d70b8;background:none;cursor:pointer;
  -webkit-appearance:none;font-family:"GDS Transport",arial,sans-serif;-webkit-font-smoothing:antialiased;
  -moz-osx-font-smoothing:grayscale;text-decoration:underline;text-decoration-thickness:max(1px, .0625rem);
  text-underline-offset:.1em}
  @media print{.js-enabled .nhsuk-accordion__open-all{font-family:sans-serif}}
  @media (min-width: 40.0625em){.js-enabled .nhsuk-accordion__open-all{font-size:16px;font-size:1rem;line-height:1.25}}
  @media print{.js-enabled .nhsuk-accordion__open-all{font-size:14pt;line-height:1.2}}
  @media print{.js-enabled .nhsuk-accordion__open-all{font-family:sans-serif}}
  .js-enabled .nhsuk-accordion__open-all:hover{text-decoration-thickness:max(3px, .1875rem, .12em);
    -webkit-text-decoration-skip-ink:none;text-decoration-skip-ink:none;-webkit-text-decoration-skip:none;text-decoration-skip:none}
    .js-enabled .nhsuk-accordion__open-all:focus{outline:3px solid transparent;color:#0b0c0c;background-color:#fd0;
      -webkit-box-shadow:0 -2px #fd0,0 4px #0b0c0c;
      box-shadow:0 -2px #fd0,0 4px #0b0c0c;text-decoration:none}.js-enabled .nhsuk-accordion__open-all:link{color:#1d70b8}
  .js-enabled .nhsuk-accordion__open-all:visited{color:#4c2c92}
  .js-enabled .nhsuk-accordion__open-all:hover{color:#003078}
  .js-enabled .nhsuk-accordion__open-all:active{color:#0b0c0c}
  .js-enabled .nhsuk-accordion__open-all:focus{color:#0b0c0c}
  .js-enabled .nhsuk-accordion__open-all::-moz-focus-inner{padding:0;border:0}
  .js-enabled .nhsuk-accordion__section-header{position:relative;padding-right:40px;border-top:1px solid #b1b4b6;
    cursor:pointer}
    .js-enabled .nhsuk-accordion__section-button{font-family:"GDS Transport",arial,sans-serif;
    -webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale;margin-top:0;margin-bottom:0;margin-left:0;
    padding:0;border-width:0;color:#1d70b8;background:none;text-align:left;cursor:pointer;-webkit-appearance:none}
  @media print{.js-enabled .nhsuk-accordion__section-button{font-family:sans-serif}}
  .js-enabled .nhsuk-accordion__section-button:focus{outline:3px solid transparent;color:#0b0c0c;background-color:#fd0;
    -webkit-box-shadow:0 -2px #fd0,0 4px #0b0c0c;box-shadow:0 -2px #fd0,0 4px #0b0c0c;text-decoration:none}
    .js-enabled .nhsuk-accordion__section-button::-moz-focus-inner{padding:0;border:0}
    .js-enabled .nhsuk-accordion__section-button:after{content:"";position:absolute;top:0;right:0;bottom:0;left:0}
    .js-enabled .nhsuk-accordion__section-button:hover:not(:focus){color:#003078;text-decoration:underline;
      text-decoration-thickness:max(3px, .1875rem, .12em);
      -webkit-text-decoration-skip-ink:none;text-decoration-skip-ink:none;-webkit-text-decoration-skip:none;
      text-decoration-skip:none;text-underline-offset:.1em}
    @media (hover: none){.js-enabled .nhsuk-accordion__section-button:hover{text-decoration:none}}
    .js-enabled .nhsuk-accordion__controls{text-align:right}.js-enabled .nhsuk-accordion__icon{position:absolute;top:50%;
      right:15px;width:16px;height:16px;margin-top:-8px}
      .js-enabled .nhsuk-accordion__icon:after,.js-enabled .nhsuk-accordion__icon:before{content:"";
      -webkit-box-sizing:border-box;box-sizing:border-box;position:absolute;top:0;right:0;bottom:0;left:0;width:25%;height:25%;
      margin:auto;border:2px solid transparent;background-color:#0b0c0c}
      .js-enabled .nhsuk-accordion__icon:before{width:100%}.js-enabled .nhsuk-accordion__icon:after{height:100%}
    .js-enabled .nhsuk-accordion__section--expanded .nhsuk-accordion__icon:after{content:" ";display:none}


/* check your answers
https://design-system.service.gov.uk/patterns/check-answers/ */
  .nhsuk-summary-list{font-family:Frutiger, "Frutiger W01", arial, sans-serif;-webkit-font-smoothing:antialiased;
  -moz-osx-font-smoothing:grayscale;font-weight:400;font-size:16px;font-size:1rem;line-height:1.25;color:#0b0c0c;margin:0;margin-bottom:20px}
  @media print{.nhsuk-summary-list{font-family:Frutiger, "Frutiger W01", arial, sans-serif}}
  @media (min-width: 40.0625em){.nhsuk-summary-list{font-size:19px;font-size:1.1875rem;line-height:1.31579}}
  @media print{.nhsuk-summary-list{font-size:14pt;line-height:1.15}}
  @media print{.nhsuk-summary-list{color:#000}}
  @media (min-width: 40.0625em){.nhsuk-summary-list{display:table;width:100%;table-layout:fixed}}
  @media (min-width: 40.0625em){.nhsuk-summary-list{margin-bottom:30px}}
  @media (max-width: 40.0525em){.nhsuk-summary-list__row{margin-bottom:15px;border-bottom:1px solid #b1b4b6}}
  @media (min-width: 40.0625em){.nhsuk-summary-list__row{display:table-row}}
  .nhsuk-summary-list__key,.nhsuk-summary-list__value{margin:0}
  @media (min-width: 40.0625em){
    .nhsuk-summary-list__key,.nhsuk-summary-list__value{display:table-cell;padding-top:10px;
      padding-right:20px;padding-bottom:10px;border-bottom:1px solid #b1b4b6}}
  .nhsuk-summary-list__actions{margin-bottom:15px}
  .nhsuk-summary-list__key,.nhsuk-summary-list__value{word-wrap:break-word;overflow-wrap:break-word}
  .nhsuk-summary-list__key{margin-bottom:5px;font-weight:700}
  @media (min-width: 40.0625em){.nhsuk-summary-list__key{width:50%}} /* original .gov value is 30% */
  @media (max-width: 40.0525em){.nhsuk-summary-list__value{margin-bottom:15px}}
  @media (min-width: 40.0625em){.nhsuk-summary-list__value{width:50%}}
  @media (min-width: 40.0625em){.nhsuk-summary-list__value:last-child{width:50%}} /* original .gov value is 70% */
  .nhsuk-summary-list__value>p{margin-bottom:10px}
  .nhsuk-summary-list__value>:last-child{margin-bottom:0}
  @media (max-width: 40.0525em){.nhsuk-summary-list--no-border .nhsuk-summary-list__row{border:0}}
  @media (min-width: 40.0625em){.nhsuk-summary-list--no-border .nhsuk-summary-list__key,.nhsuk-summary-list--no-border
  .nhsuk-summary-list__value{padding-bottom:11px;border:0}}
  @media (max-width: 40.0525em){.nhsuk-summary-list__row--no-border{border:0}}
  @media (min-width: 40.0625em){.nhsuk-summary-list__row--no-border .nhsuk-summary-list__key,.nhsuk-summary-list__row--no-border
  .nhsuk-summary-list__value{padding-bottom:11px;border:0}}


/* print page / entire notification */
.gem-c-print-link{display:none}
.gem-c-print-link.gem-c-print-link--show-without-js{display:block}
.js-enabled .gem-c-print-link{display:block}
.gem-c-print-link__link,.gem-c-print-link__button{background:url(/images/icon-print.png) no-repeat 10px 50%;
  background-size:16px 18px;padding:10px 10px 10px 36px;text-decoration:none}
  @media only screen and (-webkit-min-device-pixel-ratio: 2),only screen and (min-resolution: 192dpi),only screen and (min-resolution: 2dppx)
  {.gem-c-print-link__link,.gem-c-print-link__button{background-image:url(/images/icon-print.png)}}
  .gem-c-print-link__link:hover,.gem-c-print-link__button:hover{background-color:#f3f2f1}
  .gem-c-print-link__link{box-shadow:inset 0 0 0 1px #b1b4b6}
  .gem-c-print-link__link:focus{border:0;box-shadow:0 3px #0b0c0c}
  .gem-c-print-link__button{border:1px solid #b1b4b6;color:#1d70b8;cursor:pointer;margin:0}
  .gem-c-print-link__button:focus{outline:3px solid transparent;color:#0b0c0c;background-color:#fd0;box-shadow:0 -2px #fd0,0 4px #0b0c0c;text-decoration:none;background-color:#fd0;border-color:transparent}

/* back to top link */
.app-back-to-top{margin-top:20px;margin-bottom:30px}
/*
@media (min-width: 40.0625em){
.app-back-to-top{position:absolute;bottom:0;left:0;margin-top:auto;margin-bottom:50px}
.js-enabled .app-back-to-top--fixed{position:fixed;top:calc(100% - 50px);bottom:auto;left:auto}
.js-enabled .app-back-to-top--hidden .app-back-to-top__link{position:absolute !important;width:1px !important;
  height:1px !important;margin:0 !important;overflow:hidden !important;clip:rect(0 0 0 0) !important;
  -webkit-clip-path:inset(50%) !important;clip-path:inset(50%) !important;white-space:nowrap !important}
.js-enabled .app-back-to-top--hidden .app-back-to-top__link:active,.js-enabled .app-back-to-top--hidden
  .app-back-to-top__link:focus{position:static !important;width:auto !important;height:auto !important;
    margin:inherit !important;overflow:visible !important;clip:auto !important;-webkit-clip-path:none !important;
    clip-path:none !important;white-space:inherit !important}}
*/
.app-back-to-top__icon{display:inline-block;width:.8em;height:1em;margin-top:-5px;margin-right:10px;
  vertical-align:middle}


/* delete button, etc. */
.nhsuk-button--warning{background-color:#d4351c;-webkit-box-shadow:0 4px 0 #55150b;box-shadow:0 4px 0 #55150b}
.nhsuk-button--warning,.nhsuk-button--warning:link,.nhsuk-button--warning:visited,.nhsuk-button--warning:active,
.nhsuk-button--warning:hover{color:#fff}
.nhsuk-button--warning:hover{background-color:#aa2a16}
.nhsuk-button--warning:hover[disabled]{background-color:#d4351c}

/* error content e.g. number of errors count */
.nhsuk-error-content {
  color: #d5281b !important;
}

/* data table - collapsible row */
tr.shown, tr.hidden {
  background-color: #eee;
  display: table-row;
}

tr.hidden {
  display: none;
}

.cell button {
  font-size: 60%;
  color: #000;
  background-color: #005ea5;
  padding: 0.3em 0.2em 0 0.2em;
  border: 0.2em solid #005ea5;
  border-radius: 50%;
  line-height: 1;
  text-align: center;
  text-indent: 0;
  transform: rotate(270deg);
}

.cell button svg {
  width: 1.25em;
  height: 1.25em;
  fill: #fff;
  transition: transform 0.25s ease-in;
  transform-origin: center 45%;
}

.cell button:hover,
.cell button:focus {
  background-color: #fff;
  outline: none;
}

.cell button:hover svg,
.cell button:focus svg {
  fill: #005ea5;
}

/* Lean on programmatic state for styling */
.cell button[aria-expanded="true"] svg {
  transform: rotate(90deg);
}


/* Table of content (e.g. ELS course content)
https://design-system.service.gov.uk/patterns/task-list-pages/ */

.app-task-list {
  list-style-type: none;
  padding-left: 0;
  margin-top: 0;
  margin-bottom: 0;
}

@media (min-width: 40.0625em) {
.app-task-list {
    min-width: 550px;
}
.app-task-list__section {
    font-size: 24px;
    font-size: 1.5rem;
    line-height: 1.25;
}
.app-task-list__section-number {
  display: table-cell;
    padding-right: 0;
    min-width: 30px;
  }
  .app-task-list__items {
    padding-left: 30px;
    margin-bottom: 60px;
    font-size: 19px;
    font-size: 1.1875rem;
    line-height: 1.31579;
    list-style: none;
}
.nhsuk-tag {
    font-size: 16px;
    font-size: 1rem;
    line-height: 1;
}
}

.app-task-list__section {
  display: table;
}
.app-task-list__section-number {
    display: table-cell;
}

.app-task-list__item {
    border-bottom: 1px solid #b1b4b6;
    margin-bottom: 0 !important;
    padding-top: 10px;
    padding-bottom: 10px;
}

.app-task-list__item:after {
    content: "";
    display: block;
    clear: both;
}

.app-task-list__item:first-child {
    border-top: 1px solid #b1b4b6;
}

.app-task-list__task-name {
    display: block;
}

.nhsuk-tag {
    display: inline-block;
    outline: 2px solid transparent;
    outline-offset: -2px;
    color: #ffffff;
    background-color: #1d70b8;
    letter-spacing: 1px;
    text-decoration: none;
    text-transform: uppercase;
    font-family: "GDS Transport", arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    font-weight: 700;
    font-size: 14px;
    font-size: 0.875rem;
    line-height: 1;
    padding-top: 5px;
    padding-right: 8px;
    padding-bottom: 4px;
    padding-left: 8px;
}

@media (min-width: 28.125em) {
  .app-task-list__task-name {
    float: left;
}
.app-task-list__tag, .app-task-list__task-completed {
    float: right;
    margin-top: 0;
    margin-bottom: 0;
}
}

.nhsuk-tag--blue {
    color: #144e81;
    background: #d2e2f1;
}

.nhsuk-tag--grey {
    color: #383f43;
    background: #eeefef;
}


/* E-Learning (ELS) */
/* navigation */
.els-header nav {
  display: flex;
  justify-content: flex-end;
}

@media (min-width: 1024px) {
  .els-header nav .nhsuk-width-container { margin: 0; }
}

.els-header nav ul {
  border-top: none;
}

/* page title */
.els-wrapper--blue {
  background: #005eb8;
  color: #fff;
  padding: 16px;
}

.els-wrapper--grey {
  background: #ddd;
  padding: 16px;
  float: left;
  width: 100%;
}

/* pagination - previous and next link */
.els-pagination { 
  display: flex;
  justify-content: flex-end; 
}
.els-pagination nav { 
  margin-bottom: 0;  
}

/* sidebar (e.g. when Tools clicked) */
/* show and hide buttons */
.app-step-nav__button {
    color: #005eb8;
    cursor: pointer;
    background: none;
    border: 0;
    margin: 0;
}

.app-step-nav__button--controls {
    font-size: 14px;
    font-weight: normal;
    line-height: 1;
    text-decoration: underline;
    text-decoration-thickness: max(1px, .0625rem);
    text-underline-offset: 0.1em;
    position: relative;
    z-index: 1;
    padding: .5em 0;
}

/* sidebar content */
.els-sidebar h3 {
  font-size: 19px;
  line-height: 1.4;
  padding: 15px 0;
  margin-bottom: 0;
  border-top: 2px solid #b1b4b6;
}

.els-sidebar p, .els-sidebar li {
  font-size: 90%;
}

.els-sidebar p {
  margin-bottom: 15px;
}

.els-file-details {
  color: #999;
}

.els-sidebar-toc__current {
  font-weight: bold;
}

.centralise {
  text-align: center;
}

</style>


<!-- end css --------------------------------------------------------------------------------------------- -->
<script>
jQuery(document).ready(function() {
	/*var moduleId = <?php echo $this->openModuleId; ?>;*/
	var width = jQuery(window).width();
	var height = jQuery(window).height();
	jQuery('a.attempt_report').attr('rel','{handler: "iframe", size: {x: '+(width-(width*0.10))+', y: '+(height-(height*0.10))+'}}');

	/*if (moduleId){
		toggleModuleAccordion(moduleId);
	}*/
});
</script>
<script>
	jQuery(window).load(function () {

	jQuery('[rel="popover"]').on('click', function (e) {
		jQuery('[rel="popover"]').not(this).popover('hide');
	});

	jQuery('[rel="popover"]').popover({
		html: true,
		trigger: 'click',
		//container: this,
		placement: 'left',
		content: function () {
			return '<button type="button" id="close" class="close" onclick="popup_close(this);">&times;</button><div class="tjlms-toc-popover"><div class="tjlms-toc-content font-500">'+jQuery(this).attr('data-original-content')+'</div></div>';
		}
	});
});

function popup_close(btn)
{
	var div = jQuery(btn).closest('.popover').hide();
}
</script>
