<?php

if (!defined('BASE_PATH'))
    exit('No direct script access allowed');
/**
 * Kebab Framework
 *
 * LICENSE
 *
 * This source file is subject to the  Dual Licensing Model that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.kebab-project.com/licensing
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to info@lab2023.com so we can send you a copy immediately.
 *
 * @category   Kebab (kebab-reloaded)
 * @package    Controllers
 * @subpackage Default
 * @author	   lab2023 Dev Team
 * @copyright  Copyright (c) 2010-2011 lab2023 - internet technologies TURKEY Inc. (http://www.lab2023.com)
 * @license    http://www.kebab-project.com/licensing
 * @version    1.5.0
 */

/**
 * Kebab Application Main Controller
 *
 * @category   Kebab (kebab-reloaded)
 * @package    Controllers
 * @subpackage Default
 * @author	   lab2023 Dev Team
 * @copyright  Copyright (c) 2010-2011 lab2023 - internet technologies TURKEY Inc. (http://www.lab2023.com)
 * @license    http://www.kebab-project.com/licensing
 * @version    1.5.0
 */
class MainController extends Kebab_Controller_Action
{
    /**
     * indexAction
     */    
    public function indexAction()
    {
        $auth = Zend_Auth::getInstance();
        if ($auth->hasIdentity()) {
            $this->view->user = $auth->getIdentity();
            $this->view->applications = $this->_getApplicationsByPermission(); 
            
            //TODO
            /*
                return : {
                    identity: "aboutMe-application",
                    class: "KebabOS.applications.preferences.AboutMe",
                    name: "about-me",
                    type: "kebab-os-applications-aboutMe",
                    department: "kebab-os-applications-aboutMe",
                    version: "kebab-os-applications-aboutMe",
                    permissions: [
                        {id, name}
                    ]
                }
             */
            
        }
    }

    /**
     * _getApplicationsByPermission()
     * 
     * <p>This function return applications and their stories which are allowed in ACL.</p>
     * 
     * @return array
     */
    private function _getApplicationsByPermission()
    {
        //KBBTODO Move this function Model_Application
        //KBBTODO If ACL system is off, should return all applications
        if (Zend_Registry::get('config')->plugins->kebabAcl) {
            $rolesWithAncestor = Zend_Auth::getInstance()->getIdentity()->rolesWithAncestor;
            $query = Doctrine_Query::create()
                    ->from('Model_Application a')
                    ->leftJoin('a.StoryApplication sa')
                    ->leftJoin('sa.Story s')
                    ->leftJoin('s.Permission p')
                    ->leftJoin('p.Role r')
                    ->whereIn('r.name', $rolesWithAncestor)
                    ->andWhere('a.status = ?', array('active'))
                    ->andWhere('s.status = ?', array('active'));
            $applications = $query->execute();

            $stack = array();
            foreach ($applications as $application) {
                $stack[$application->name]['name'] = $application->name;
                foreach ($application->StoryApplication as $storyApplication) {
                    $stack[$application->name]['permissions'][] = $storyApplication->Story->name;
                }
            }
            return $stack;
        }
    }
}
