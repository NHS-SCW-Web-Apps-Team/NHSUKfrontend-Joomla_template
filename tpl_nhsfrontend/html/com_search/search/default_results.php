<?php
/**
 * @package Helix Ultimate Framework
 * @author JoomShaper https://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2018 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
*/

defined ('_JEXEC') or die();

?>
<div class="nhsuk-grid-column-full">
    <article>
        <div class="nhsuk-grid-row">
            <div class="nhsuk-grid-column-full">
                <ul class="nhsuk-list ">
                    <?php foreach ($this->results as $result) : ?>
                    <li class="nhsuk-list--border">

                        <?php //echo $this->pagination->limitstart + $result->count . '. '; ?>
                        <?php if ($result->href) : ?>
                        <a href="<?php echo JRoute::_($result->href); ?>" <?php if ($result->browsernav == 1) : ?> target="_blank" <?php endif; ?>>
                            <?php // $result->title should not be escaped in this case, as it may ?>
                            <?php // contain span HTML tags wrapping the searched terms, if present ?>
                            <?php // in the title. ?>
                            <?php echo $result->title; ?>
                        </a>
                        <?php else : ?>
                        <?php // see above comment: do not escape $result->title ?>
                        <?php echo $result->title; ?>
                        <?php endif; ?>

                        <?php /*if ($result->section) : ?>
                        <dd class="result-category">
                            <span class="small">
                                (<?php echo $this->escape($result->section); ?>)
                            </span>
                        </dd>
                        <?php endif; */?>
                        <p class="nhsuk-body-s nhsuk-u-margin-top-1">
                            <?php echo $result->text; ?>
                        </p>
                        <?php /*if ($this->params->get('show_date')) : ?>
                        <dd class="result-created">
                            <?php echo JText::sprintf('JGLOBAL_CREATED_DATE_ON', $result->created); ?>
                        </dd>
                        <?php endif; */?>
                    </li>
                    <?php endforeach; ?>
                    <nav class="nhsuk-pagination" role="navigation" aria-label="Pagination">
                        <?php echo $this->pagination->getPagesLinks(); ?>
                    </nav>
                </ul>
            </div>
        </div>
    </article>
</div>


<?php /*

//taken from the service manul website search page itself 
<ul class="nhsuk-list nhsuk-list--border">

    <li>
        <span class="app-search-results-category">Components</span>
        <a href="/design-system/components/contents-list" class="app-search-results-item">Contents list</a>
        <p class="nhsuk-body-s nhsuk-u-margin-top-1">Use contents lists to allow users to navigate between related pages, for example about a single condition.</p>
    </li>

    <li>
        <span class="app-search-results-category">Home</span>
        <a href="/content" class="app-search-results-item">Content style guide</a>
        <p class="nhsuk-body-s nhsuk-u-margin-top-1">How to write for digital NHS services.</p>
    </li>

    <li>
        <span class="app-search-results-category">Accessibility</span>
        <a href="/accessibility/content" class="app-search-results-item">Content</a>
        <p class="nhsuk-body-s nhsuk-u-margin-top-1">What content designers, writers and editors need to do to make digital services accessible.</p>
    </li>

    <li>
        <span class="app-search-results-category">How to write good questions for forms</span>
        <a href="/content/how-to-write-good-questions-for-forms/write-the-supporting-content-for-your-form" class="app-search-results-item">Write the supporting content for your form</a>
        <p class="nhsuk-body-s nhsuk-u-margin-top-1">As well as questions, your form or service may need an introduction, help text, error messages and a confirmation or thank you page. Think about content across other channels too.</p>
    </li>

    <li>
        <span class="app-search-results-category">Styles</span>
        <a href="/design-system/styles/page-template" class="app-search-results-item">Page template</a>
        <p class="nhsuk-body-s nhsuk-u-margin-top-1">Use this template to keep your pages consistent with other NHS services.</p>
    </li>

    <li>
        <span class="app-search-results-category">Design system</span>
        <a href="/design-system/components" class="app-search-results-item">Components</a>
        <p class="nhsuk-body-s nhsuk-u-margin-top-1">Components are reusable elements of the user interface.</p>
    </li>

    <li>
        <span class="app-search-results-category">Components</span>
        <a href="/design-system/components/checkboxes" class="app-search-results-item">Checkboxes</a>
        <p class="nhsuk-body-s nhsuk-u-margin-top-1">Use checkboxes to let users select 1 or more options on a form.</p>
    </li>

    <li>
        <span class="app-search-results-category">Components</span>
        <a href="/design-system/components/radios" class="app-search-results-item">Radios</a>
        <p class="nhsuk-body-s nhsuk-u-margin-top-1">Use radios when you want users to select only 1 option from a list.</p>
    </li>

    <li>
        <span class="app-search-results-category">Components</span>
        <a href="/design-system/components/skip-link" class="app-search-results-item">Skip link</a>
        <p class="nhsuk-body-s nhsuk-u-margin-top-1">Use a skip link to help keyboard-only users skip to the main content on a page.</p>
    </li>

    <li>
        <span class="app-search-results-category">Components</span>
        <a href="/design-system/components/hint-text" class="app-search-results-item">Hint text</a>
        <p class="nhsuk-body-s nhsuk-u-margin-top-1">Use hint text to help users understand a question.</p>
    </li>

</ul>

*/ ?>