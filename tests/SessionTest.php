<?php
/**
 * Unit tests for session management functionality
 */

use PHPUnit\Framework\TestCase;

class SessionTest extends TestCase
{
    protected function setUp(): void
    {
        // Start session if not started
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        // Clear session data
        $_SESSION = [];
    }

    protected function tearDown(): void
    {
        // Clean up session
        $_SESSION = [];
    }

    /**
     * Test session is started
     */
    public function testSessionStarted()
    {
        $this->assertEquals(PHP_SESSION_ACTIVE, session_status(), 
            'Session should be active');
    }

    /**
     * Test session data can be set
     */
    public function testSessionDataCanBeSet()
    {
        $_SESSION['test_key'] = 'test_value';
        $this->assertEquals('test_value', $_SESSION['test_key'], 
            'Session data should be settable');
    }

    /**
     * Test session data can be retrieved
     */
    public function testSessionDataCanBeRetrieved()
    {
        $_SESSION['userdata']['id'] = 1;
        $_SESSION['userdata']['username'] = 'testuser';
        
        $this->assertEquals(1, $_SESSION['userdata']['id'], 
            'Session userdata should be retrievable');
        $this->assertEquals('testuser', $_SESSION['userdata']['username'], 
            'Session userdata username should be retrievable');
    }

    /**
     * Test session flashdata functionality
     */
    public function testSessionFlashdata()
    {
        $_SESSION['flashdata']['success'] = 'Operation successful';
        $_SESSION['flashdata']['error'] = 'Operation failed';
        
        $this->assertTrue(isset($_SESSION['flashdata']['success']), 
            'Flashdata success should be set');
        $this->assertTrue(isset($_SESSION['flashdata']['error']), 
            'Flashdata error should be set');
        $this->assertEquals('Operation successful', $_SESSION['flashdata']['success'], 
            'Flashdata success value should be correct');
    }

    /**
     * Test session system_info functionality
     */
    public function testSessionSystemInfo()
    {
        $_SESSION['system_info']['name'] = 'Test System';
        $_SESSION['system_info']['version'] = '1.0.0';
        
        $this->assertTrue(isset($_SESSION['system_info']['name']), 
            'System info name should be set');
        $this->assertEquals('Test System', $_SESSION['system_info']['name'], 
            'System info name value should be correct');
    }

    /**
     * Test session data can be unset
     */
    public function testSessionDataCanBeUnset()
    {
        $_SESSION['test_key'] = 'test_value';
        unset($_SESSION['test_key']);
        
        $this->assertFalse(isset($_SESSION['test_key']), 
            'Session data should be unsettable');
    }

    /**
     * Test session userdata structure
     */
    public function testSessionUserdataStructure()
    {
        $_SESSION['userdata'] = [
            'id' => 1,
            'username' => 'testuser',
            'firstname' => 'Test',
            'lastname' => 'User',
            'type' => 1
        ];
        
        $this->assertIsArray($_SESSION['userdata'], 
            'userdata should be an array');
        $this->assertArrayHasKey('id', $_SESSION['userdata'], 
            'userdata should have id key');
        $this->assertArrayHasKey('username', $_SESSION['userdata'], 
            'userdata should have username key');
    }

    /**
     * Test multiple session arrays can coexist
     */
    public function testMultipleSessionArrays()
    {
        $_SESSION['userdata']['id'] = 1;
        $_SESSION['flashdata']['success'] = 'Success';
        $_SESSION['system_info']['name'] = 'System';
        
        $this->assertTrue(isset($_SESSION['userdata']), 
            'userdata array should exist');
        $this->assertTrue(isset($_SESSION['flashdata']), 
            'flashdata array should exist');
        $this->assertTrue(isset($_SESSION['system_info']), 
            'system_info array should exist');
    }
}
