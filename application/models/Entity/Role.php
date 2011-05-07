<?php

/**
 * Model_Entity_Role
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $name
 * @property string $title
 * @property clob $description
 * @property enum $status
 * @property boolean $active
 * @property Doctrine_Collection $Users
 * @property Doctrine_Collection $Stories
 * @property Doctrine_Collection $Permission
 * @property Doctrine_Collection $UserRole
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     lab2023 - Dev. Team <info@lab2023.com>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Model_Entity_Role extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('system_role');
        $this->hasColumn('id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('name', 'string', 255, array(
             'type' => 'string',
             'unique' => true,
             'length' => '255',
             ));
        $this->hasColumn('title', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             ));
        $this->hasColumn('description', 'clob', null, array(
             'type' => 'clob',
             ));
        $this->hasColumn('status', 'enum', 7, array(
             'type' => 'enum',
             'length' => 7,
             'values' => 
             array(
              0 => 'active',
              1 => 'passive',
             ),
             ));
        $this->hasColumn('active', 'boolean', 5, array(
             'type' => 'boolean',
             'length' => 5,
             'default' => true,
             ));

        $this->option('type', 'INNODB');
        $this->option('collate', 'utf8_bin');
        $this->option('charset', 'utf8');
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Model_Entity_User as Users', array(
             'refClass' => 'Model_Entity_UserRole',
             'local' => 'role_id',
             'foreign' => 'user_id'));

        $this->hasMany('Model_Entity_Story as Stories', array(
             'refClass' => 'Model_Entity_Permission',
             'local' => 'role_id',
             'foreign' => 'story_id'));

        $this->hasMany('Model_Entity_Permission as Permission', array(
             'local' => 'id',
             'foreign' => 'role_id'));

        $this->hasMany('Model_Entity_UserRole as UserRole', array(
             'local' => 'id',
             'foreign' => 'role_id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $softdelete0 = new Doctrine_Template_SoftDelete();
        $blameable0 = new Doctrine_Template_Blameable();
        $nestedset0 = new Doctrine_Template_NestedSet(array(
             'hasManyRoots' => true,
             'rootColumnName' => 'root_id',
             ));
        $i18n0 = new Doctrine_Template_I18n(array(
             'fields' => 
             array(
              0 => 'title',
              1 => 'description',
             ),
             'className' => 'RoleTranslation',
             'length' => 5,
             ));
        $searchable1 = new Doctrine_Template_Searchable(array(
             'fields' => 
             array(
              0 => 'title',
             ),
             'className' => 'SystemRoleSearch',
             ));
        $i18n0->addChild($searchable1);
        $this->actAs($timestampable0);
        $this->actAs($softdelete0);
        $this->actAs($blameable0);
        $this->actAs($nestedset0);
        $this->actAs($i18n0);
    }
}