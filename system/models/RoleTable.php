<?php

/**
 * System_Model_RoleTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class System_Model_RoleTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object System_Model_RoleTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('System_Model_Role');
    }
}