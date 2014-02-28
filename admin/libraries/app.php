<?php
/**
 * @package     Social-Manager.Administrator
 * @subpackage  com_socialman
 * @author 		Mohit Agrawal
 * @since 		Social-Manager 1.0
 * @copyright   Copyright (C) 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die('Unauthorized Access');

//base class for plugin that need to be extende
if(SOCIALMAN_NEW_JOOMLA)
{
	abstract class SocialmanAppBase extends JViewLegacy
	{
	}
}
else
{
	jimport( 'joomla.application.component.view' );	
	abstract class SocialmanAppBase extends JViewBase
	{
	}
}

class SocialmanApp extends SocialmanAppBase
{

}