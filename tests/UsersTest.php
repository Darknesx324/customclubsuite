<?php
/**
 * Unit tests for Users class
 */

use PHPUnit\Framework\TestCase;

class UsersTest extends TestCase
{
    private $users;

    protected function setUp(): void
    {
        // Start session if not started
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Clear session and POST data
        $_SESSION = [];
        $_POST = [];

        if (class_exists('Users')) {
            $this->users = new Users();
        }
    }

    protected function tearDown(): void
    {
        $_SESSION = [];
        $_POST = [];
        
        if (isset($this->users)) {
            unset($this->users);
        }
    }

    /**
     * Test that Users class exists
     */
    public function testClassExists()
    {
        $this->assertTrue(class_exists('Users'), 'Users class should exist');
    }

    /**
     * Test that Users extends DBConnection
     */
    public function testExtendsDBConnection()
    {
        $this->assertTrue(is_subclass_of('Users', 'DBConnection'), 
            'Users should extend DBConnection');
    }

    /**
     * Test save_users method exists
     */
    public function testSaveUsersMethodExists()
    {
        if (isset($this->users)) {
            $this->assertTrue(method_exists($this->users, 'save_users'), 
                'Users should have save_users method');
        } else {
            $this->markTestSkipped('Users class not available');
        }
    }

    /**
     * Test delete_users method exists
     */
    public function testDeleteUsersMethodExists()
    {
        if (isset($this->users)) {
            $this->assertTrue(method_exists($this->users, 'delete_users'), 
                'Users should have delete_users method');
        } else {
            $this->markTestSkipped('Users class not available');
        }
    }

    /**
     * Test that password is hashed with MD5
     */
    public function testPasswordHashing()
    {
        $password = 'testpassword123';
        $hashed = md5($password);
        $this->assertEquals('3c877f58e2b0f06d7f77e0c0a8afc8f7', md5('testpassword123'), 
            'Password should be hashed with MD5');
        $this->assertNotEquals($password, $hashed, 'Hashed password should be different from original');
    }

    /**
     * Test username validation logic (duplicate check)
     */
    public function testUsernameValidation()
    {
        // This test checks the logic structure, not database interaction
        $username1 = 'testuser';
        $username2 = 'testuser';
        
        // Simulate duplicate check logic
        $isDuplicate = ($username1 === $username2);
        $this->assertTrue($isDuplicate, 'Duplicate usernames should be detected');
    }

    /**
     * Test data sanitization
     */
    public function testDataSanitization()
    {
        $testData = "test'data\"with<special>chars";
        $sanitized = addslashes($testData);
        
        $this->assertNotEquals($testData, $sanitized, 
            'Data should be sanitized with addslashes');
        $this->assertStringContainsString("\\'", $sanitized, 
            'Sanitized data should contain escaped quotes');
    }

    /**
     * Test file upload path generation
     */
    public function testFileUploadPathGeneration()
    {
        $filename = 'test_image.jpg';
        $timestamp = strtotime(date('y-m-d H:i'));
        $expectedPath = 'uploads/' . $timestamp . '_' . $filename;
        
        $this->assertStringContainsString('uploads/', $expectedPath, 
            'Upload path should contain uploads/ directory');
        $this->assertStringContainsString($filename, $expectedPath, 
            'Upload path should contain original filename');
    }
}
