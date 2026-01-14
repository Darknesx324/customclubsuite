<?php
/**
 * Unit tests for SystemSettings class
 */

use PHPUnit\Framework\TestCase;

class SystemSettingsTest extends TestCase
{
    private $systemSettings;

    protected function setUp(): void
    {
        // Start session if not started
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Clear session data for testing
        $_SESSION = [];

        if (class_exists('SystemSettings')) {
            $this->systemSettings = new SystemSettings();
        }
    }

    protected function tearDown(): void
    {
        // Clean up session
        $_SESSION = [];
        
        if (isset($this->systemSettings)) {
            unset($this->systemSettings);
        }
    }

    /**
     * Test that SystemSettings class exists
     */
    public function testClassExists()
    {
        $this->assertTrue(class_exists('SystemSettings'), 'SystemSettings class should exist');
    }

    /**
     * Test that SystemSettings extends DBConnection
     */
    public function testExtendsDBConnection()
    {
        $this->assertTrue(is_subclass_of('SystemSettings', 'DBConnection'), 
            'SystemSettings should extend DBConnection');
    }

    /**
     * Test check_connection method exists
     */
    public function testCheckConnectionMethodExists()
    {
        if (isset($this->systemSettings)) {
            $this->assertTrue(method_exists($this->systemSettings, 'check_connection'), 
                'SystemSettings should have check_connection method');
        } else {
            $this->markTestSkipped('SystemSettings class not available');
        }
    }

    /**
     * Test set_userdata method
     */
    public function testSetUserdata()
    {
        if (isset($this->systemSettings)) {
            $this->systemSettings->set_userdata('test_field', 'test_value');
            $this->assertEquals('test_value', $_SESSION['userdata']['test_field'], 
                'set_userdata should set session value');
        } else {
            $this->markTestSkipped('SystemSettings class not available');
        }
    }

    /**
     * Test userdata method retrieves value
     */
    public function testUserdataRetrievesValue()
    {
        if (isset($this->systemSettings)) {
            $_SESSION['userdata']['test_field'] = 'test_value';
            $result = $this->systemSettings->userdata('test_field');
            $this->assertEquals('test_value', $result, 'userdata should retrieve session value');
        } else {
            $this->markTestSkipped('SystemSettings class not available');
        }
    }

    /**
     * Test userdata method returns null for non-existent field
     */
    public function testUserdataReturnsNullForNonExistentField()
    {
        if (isset($this->systemSettings)) {
            $result = $this->systemSettings->userdata('non_existent_field');
            $this->assertNull($result, 'userdata should return null for non-existent field');
        } else {
            $this->markTestSkipped('SystemSettings class not available');
        }
    }

    /**
     * Test set_flashdata method
     */
    public function testSetFlashdata()
    {
        if (isset($this->systemSettings)) {
            $result = $this->systemSettings->set_flashdata('success', 'Test message');
            $this->assertTrue($result, 'set_flashdata should return true');
            $this->assertTrue(isset($_SESSION['flashdata']['success']), 
                'set_flashdata should set session flash data');
        } else {
            $this->markTestSkipped('SystemSettings class not available');
        }
    }

    /**
     * Test chk_flashdata method
     */
    public function testChkFlashdata()
    {
        if (isset($this->systemSettings)) {
            $_SESSION['flashdata']['success'] = 'Test message';
            $result = $this->systemSettings->chk_flashdata('success');
            $this->assertTrue($result, 'chk_flashdata should return true if flashdata exists');
            
            $result = $this->systemSettings->chk_flashdata('non_existent');
            $this->assertFalse($result, 'chk_flashdata should return false if flashdata does not exist');
        } else {
            $this->markTestSkipped('SystemSettings class not available');
        }
    }

    /**
     * Test sess_des method destroys session
     */
    public function testSessDes()
    {
        if (isset($this->systemSettings)) {
            $_SESSION['userdata']['test'] = 'value';
            $result = $this->systemSettings->sess_des();
            $this->assertTrue($result, 'sess_des should return true');
            $this->assertFalse(isset($_SESSION['userdata']), 'sess_des should unset userdata');
        } else {
            $this->markTestSkipped('SystemSettings class not available');
        }
    }
}
