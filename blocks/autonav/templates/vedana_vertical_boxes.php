<?php defined('C5_EXECUTE') or die("Access Denied.");

$navItems = $controller->getNavItems();
foreach ($navItems as $ni) {
	$classes = array();

	if ($ni->isCurrent || $ni->inPath) {
		$classes[] = 'active';
	}

	$ni->classes = implode(" ", $classes);
}



echo '<ul class="vlist vertical-boxes">'; 

foreach ($navItems as $ni) {

	echo '<li>'; //opens a nav item
	$name = (isset($translate) && $translate == true) ? t($ni->name) : $ni->name;
	echo '<a href="' . $ni->url . '" target="' . $ni->target . '" class="' . $ni->classes . ' box primary full-width">' . $name . '</a>';

	echo '</li>'; //closes a nav item
//		echo str_repeat('</ul></li>', $ni->subDepth); //closes dropdown sub-menu(s) and their top-level nav item(s)

}

 echo '</ul>'; //closes the top-level menu
