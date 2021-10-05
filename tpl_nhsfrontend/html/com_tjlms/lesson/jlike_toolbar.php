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

use Joomla\CMS\Language\Text;
use Joomla\CMS\Plugin\PluginHelper;

?>
<?php $format = array('quiz', 'exercise', 'feedback');?>
<?php $resumeWindowClass = ' '; ?>

<?php if (in_array($lesson_data->format, $format) || $this->askforinput	== 1):
		$resumeWindowClass = 'resumeWindowPage';
endif; ?>

<div id="jlikeToolbar" class="container-fluid <?php echo $resumeWindowClass;?>">
	<div class="row">
    
		<div class="">
		<?php if ($this->showPlaylist == 1 && $this->mode != 'preview') : ?>
			<span data-js-attr="tjlms-lesson__playlist-toggle" class="hidden-xs playlist-toggle toolbar_buttons text-center font-bold pull-left">
				<i class="playlist__close-icon fa fa-angle-double-right display-none" title="<?php echo Text::_('COM_TJLMS_LESSON_SHOW_PLAYLIST'); ?>" data-js-id="playlist-open"></i>
				<i class="playlist__open-icon fa fa-angle-double-left display-none" title="<?php echo Text::_('COM_TJLMS_LESSON_HIDE_PLAYLIST'); ?>" data-js-id="playlist-hide"></i>
			</span>
		<?php endif; ?>
			<div data-js-attr="tjlms-lesson__toolbar-container">
            
        <svg class="nhsuk-logo" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 40 16" style="height:32px;width:80px;float:left;margin-left:15px;margin-top:6px;">
                        <path class="nhsuk-logo__background" d="M0 0h40v16H0z" style="fill:white;"></path>
                        <path class="nhsuk-logo__text" d="M3.9 1.5h4.4l2.6 9h.1l1.8-9h3.3l-2.8 13H9l-2.7-9h-.1l-1.8 9H1.1M17.3 1.5h3.6l-1 4.9h4L25 1.5h3.5l-2.7 13h-3.5l1.1-5.6h-4.1l-1.2 5.6h-3.4M37.7 4.4c-.7-.3-1.6-.6-2.9-.6-1.4 0-2.5.2-2.5 1.3 0 1.8 5.1 1.2 5.1 5.1 0 3.6-3.3 4.5-6.4 4.5-1.3 0-2.9-.3-4-.7l.8-2.7c.7.4 2.1.7 3.2.7s2.8-.2 2.8-1.5c0-2.1-5.1-1.3-5.1-5 0-3.4 2.9-4.4 5.8-4.4 1.6 0 3.1.2 4 .6"  style="fill:#005eb8;"></path>
                    </svg>
				<span class="ml-10 pull-left font-bold jlike-container">
                    
					<?php if (!empty($this->jLikepluginParams) && $this->jLikepluginParams->get('allow_like') == 1){ ?>
						<?php
							$dispatcher = JDispatcher::getInstance();
							PluginHelper::importPlugin('content');
							$result =$dispatcher->trigger('showlikebuttonforlesson',array('com_tjlms.lesson',$lesson_data->id,$lesson_data->title));
							if(!empty($result))
							echo $result[0];
						?>
					<?php } ?>
				</span>

				<div class="text-right jlikeToolbar__buttons" id="jlike_toolbar_buttons">

					<div class="d-inline-block">
						<span data-ref="jliketoolbar-menu" class="hidden toolbar_buttons">
							<i class="fa fa-bars"></i>
						</span>

					<?php if (1 != $this->olUser->guest && $this->allowAssocFiles == 1){ ?>
						<button data-ref="associatefiles" class="assocfilesbtn toolbar_buttons" data-js-attr="toolbar_buttons" title="<?php echo Text::_('COM_JLIKE_ASSOCIATE_FILE_LABEL');?>" style="border:none;color:white;font-size:1rem;font-weight:400;">Resources
						<!--<i class="fa fa-download"></i>-->
                    </button>
					<?php } ?>

					<?php  if (!empty($this->jLikepluginParams) && $this->jLikepluginParams->get('allow_user_lables') == 1){ ?>
						<!--<span data-ref="lists" class="toolbar_buttons" data-js-attr="toolbar_buttons" title="<?php echo Text::_('COM_JLIKE_LIST_LABEL');?>">
							<i class="fa fa-bookmark-o"></i>
						</span>-->
					<?php } ?>

					<?php if (!empty($this->jLikepluginParams) && $this->jLikepluginParams->get('allow_annotation') == 1){ ?>
						<!--<span data-ref="notes" class="toolbar_buttons" data-js-attr="toolbar_buttons" title="<?php echo Text::_('COM_JLIKE_NOTES_LABEL');?>">
						  <i class="fa fa-file-text-o"></i>
						</span>-->
					<?php } ?>

					<?php if (!empty($this->jLikepluginParams) && $this->jLikepluginParams->get('allow_comments') == 1){ ?>
						<!--<span data-ref="comments" class="toolbar_buttons" data-js-attr="toolbar_buttons" title="<?php echo Text::_('COM_JLIKE_COMMENTS_LABEL');?>">
							<i class="fa fa-comments"></i>
							<?php
								if ($this->comments_count)
								{
									?>
									<small id="total_comments">
										<?php echo $this->comments_count; ?>
									</small>
									<?php
								}
							?>
						</span>-->
					<?php } ?>

					<?php
						if (!empty($jLikeInteractions))
						{
							foreach ($jLikeInteractions  as $jLikeInteraction)
							{
							?>
								<span data-ref="<?php echo $jLikeInteraction->ref;?>" class="toolbar_buttons" data-js-attr="toolbar_buttons"
								title="<?php echo Text::_('Show Interaction');?>">
									<i class="fa fa-dropbox"></i>
								</span>
							<?php
							}
						}
					?>
                        
						<button data-js-attr="jlikeToolbar-close" class="toolbar_buttons closeBtn"
						title="<?php echo Text::_('COM_TJLMS_CLOSE');?>" data-js-id="test-close"  style="border:none;color:white;font-size:1rem;font-weight:400;">
							<!--<i class="fa fa-close">-->Save &amp; close</i>
                    </button>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>
