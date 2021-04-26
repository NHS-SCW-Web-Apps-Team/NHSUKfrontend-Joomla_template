<?php
/**
 * @package     Joomla.Site
 * @subpackage  Layout
 *
 * @copyright   Copyright (C) 2005 - 2020 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$list = $displayData['list'];
//dump($list['next']['data']);
$activeIndex = ""; //the current active page we are on

$getNextdata = $list['next']['data'];
$getPrevdata = $list['previous']['data'];
//dump($getNextdata);

/* ---------------------------

NOTES BY KJ....

1st option - DOMDocument

So i was going to use DOMDocument but then you need to install the necessary php extension for this! wasted. Don't want to have to bother installing new stuff on the server. - https://codingreflections.com/php-parse-html/
$dom = new DOMDocument();
$dom->loadHTML($getNextdata);
$url = $dom->getAttribute('href');
    $parsed_url = parse_url($url);
	dump($parsed_url);
	*/
/*

2nd option - SimpleXMLElement

//Was going to try SimpleXMLElement but again ran into the same problem with it not being installed so didnt want to have to worry about installing dependencies on the server just yet. 
//Same with this! Don't have the php extension installed by default
$a = new SimpleXMLElement('$getNextdata');// will echo www.something.com
dump($a['href']);
?>

3rd option
//So im going to have to revert to regex! ( not happy about that as I never fully trust my regex skills!)

REGEX SOLUTION
------------------------------*/

$nextlinkUnparsed = $getNextdata; //start off with what we get from the api
preg_match_all('/<a[^>]+href=([\'"])(?<href>.+?)\1[^>]*>/i', $nextlinkUnparsed, $result);

        if (!empty($result)) {
        # Found the link.
        //dump($result['href'][0]);
        $nextlink = $result['href'][0]; //update the link to just the href attribute
        }
        ?>
        <?php
        $prevlinkUnparsed = $getPrevdata; //start off with what we get from the api
        preg_match_all('/<a[^>]+href=([\'"])(?<href>.+?)\1[^>]*>/i', $prevlinkUnparsed, $result);

                if (!empty($result)) {
                # Found the link.
                //dump($result['href'][0]);
                $prevlink = $result['href'][0]; //update the link to just the href attribute
                }
				?>

        <?php foreach ($list['pages'] as $key => $value){
	if($value['active'] == FALSE){
		$activeIndex = $key; //update current active page we are on

	}
}	
//dump($nextlink);
//dump($prevlink);
?>

        <ul class="nhsuk-list nhsuk-pagination__list">
            <?php if ($activeIndex !== 1) : //look at the returned object/array from the api and you'll see what I'm checking?>
            <li class="nhsuk-pagination-item--previous">
                <a class="nhsuk-pagination__link nhsuk-pagination__link--prev" href="<?php echo $prevlink ;?>">
                    <span class="nhsuk-pagination__title">Previous</span>
                    <span class="nhsuk-u-visually-hidden">:</span>
                    <span class="nhsuk-pagination__page"><?php echo ($activeIndex - 1).' of '.count($list['pages']) ;?></span>
                    <svg class="nhsuk-icon nhsuk-icon__arrow-left" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M4.1 12.3l2.7 3c.2.2.5.2.7 0 .1-.1.1-.2.1-.3v-2h11c.6 0 1-.4 1-1s-.4-1-1-1h-11V9c0-.2-.1-.4-.3-.5h-.2c-.1 0-.3.1-.4.2l-2.7 3c0 .2 0 .4.1.6z"></path>
                    </svg>
                </a>
            </li>
            <?php endif; ?>
            <?php if ($nextlink !== null) : ?>
            <li class="nhsuk-pagination-item--next">
                <a class="nhsuk-pagination__link nhsuk-pagination__link--next" href="<?php echo $nextlink ;?>">
                    <span class="nhsuk-pagination__title">Next</span>
                    <span class="nhsuk-u-visually-hidden">:</span>
                    <span class="nhsuk-pagination__page"><?php echo ($activeIndex + 1).' of '.count($list['pages']) ;?></span>
                    <svg class="nhsuk-icon nhsuk-icon__arrow-right" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M19.6 11.66l-2.73-3A.51.51 0 0 0 16 9v2H5a1 1 0 0 0 0 2h11v2a.5.5 0 0 0 .32.46.39.39 0 0 0 .18 0 .52.52 0 0 0 .37-.16l2.73-3a.5.5 0 0 0 0-.64z">
                        </path>
                    </svg>
                </a>
            </li>
            <?php endif; ?>
        </ul>

        <?php /* //original pagination code from joomla. Not needed as its too basic and nothing like the NHS library
		<ul>
			<li class="pagination-start"><?php echo $list['start']['data']; ?></li>
        <li class="pagination-prev"><?php echo $list['previous']['data']; ?></li>
        <?php foreach ($list['pages'] as $page) : ?>
        <?php echo '<li>' . $page['data'] . '</li>'; ?>
        <?php endforeach; ?>
        <li class="pagination-next"><?php echo $list['next']['data']; ?></li>
        <li class="pagination-end"><?php echo $list['end']['data']; ?></li>
        </ul>
        */ ?>