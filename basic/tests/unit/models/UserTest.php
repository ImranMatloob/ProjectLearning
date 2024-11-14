<?php

namespace tests\unit\models;

use app\models\backendUsers;

class UserTest extends \Codeception\Test\Unit
{
    public function testFindUserById()
    {
        verify($user = backendUsers::findIdentity(100))->notEmpty();
        verify($user->username)->equals('admin');

        verify(backendUsers::findIdentity(999))->empty();
    }

    public function testFindUserByAccessToken()
    {
        verify($user = backendUsers::findIdentityByAccessToken('100-token'))->notEmpty();
        verify($user->username)->equals('admin');

        verify(backendUsers::findIdentityByAccessToken('non-existing'))->empty();
    }

    public function testFindUserByUsername()
    {
        verify($user = backendUsers::findByUsername('admin'))->notEmpty();
        verify(backendUsers::findByUsername('not-admin'))->empty();
    }

    /**
     * @depends testFindUserByUsername
     */
    public function testValidateUser()
    {
        $user = backendUsers::findByUsername('admin');
        verify($user->validateAuthKey('test100key'))->notEmpty();
        verify($user->validateAuthKey('test102key'))->empty();

        verify($user->validatePassword('admin'))->notEmpty();
        verify($user->validatePassword('123456'))->empty();        
    }

}
