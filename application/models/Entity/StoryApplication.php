<?php

/**
 * Model_Entity_StoryApplication
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $story_id
 * @property integer $application_id
 * @property Model_Entity_Story $Story
 * @property Model_Entity_Application $Application
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     lab2023 - Dev. Team <info@lab2023.com>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Model_Entity_StoryApplication extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('system_story_application');
        $this->hasColumn('story_id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('application_id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));

        $this->option('type', 'INNODB');
        $this->option('collate', 'utf8_bin');
        $this->option('charset', 'utf8');
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Model_Entity_Story as Story', array(
             'local' => 'story_id',
             'foreign' => 'id'));

        $this->hasOne('Model_Entity_Application as Application', array(
             'local' => 'application_id',
             'foreign' => 'id'));
    }
}