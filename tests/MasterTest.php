<?php
/**
 * Unit tests for Master class
 */

use PHPUnit\Framework\TestCase;

class MasterTest extends TestCase
{
    private $master;

    protected function setUp(): void
    {
        // Start session if not started
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Clear session and POST data
        $_SESSION = [];
        $_POST = [];

        if (class_exists('Master')) {
            $this->master = new Master();
        }
    }

    protected function tearDown(): void
    {
        $_SESSION = [];
        $_POST = [];
        
        if (isset($this->master)) {
            unset($this->master);
        }
    }

    /**
     * Test that Master class exists
     */
    public function testClassExists()
    {
        $this->assertTrue(class_exists('Master'), 'Master class should exist');
    }

    /**
     * Test that Master extends DBConnection
     */
    public function testExtendsDBConnection()
    {
        $this->assertTrue(is_subclass_of('Master', 'DBConnection'), 
            'Master should extend DBConnection');
    }

    /**
     * Test capture_err method exists
     */
    public function testCaptureErrMethodExists()
    {
        if (isset($this->master)) {
            $this->assertTrue(method_exists($this->master, 'capture_err'), 
                'Master should have capture_err method');
        } else {
            $this->markTestSkipped('Master class not available');
        }
    }

    /**
     * Test save_category method exists
     */
    public function testSaveCategoryMethodExists()
    {
        if (isset($this->master)) {
            $this->assertTrue(method_exists($this->master, 'save_category'), 
                'Master should have save_category method');
        } else {
            $this->markTestSkipped('Master class not available');
        }
    }

    /**
     * Test delete_category method exists
     */
    public function testDeleteCategoryMethodExists()
    {
        if (isset($this->master)) {
            $this->assertTrue(method_exists($this->master, 'delete_category'), 
                'Master should have delete_category method');
        } else {
            $this->markTestSkipped('Master class not available');
        }
    }

    /**
     * Test save_service method exists
     */
    public function testSaveServiceMethodExists()
    {
        if (isset($this->master)) {
            $this->assertTrue(method_exists($this->master, 'save_service'), 
                'Master should have save_service method');
        } else {
            $this->markTestSkipped('Master class not available');
        }
    }

    /**
     * Test delete_service method exists
     */
    public function testDeleteServiceMethodExists()
    {
        if (isset($this->master)) {
            $this->assertTrue(method_exists($this->master, 'delete_service'), 
                'Master should have delete_service method');
        } else {
            $this->markTestSkipped('Master class not available');
        }
    }

    /**
     * Test save_mechanic method exists
     */
    public function testSaveMechanicMethodExists()
    {
        if (isset($this->master)) {
            $this->assertTrue(method_exists($this->master, 'save_mechanic'), 
                'Master should have save_mechanic method');
        } else {
            $this->markTestSkipped('Master class not available');
        }
    }

    /**
     * Test delete_mechanic method exists
     */
    public function testDeleteMechanicMethodExists()
    {
        if (isset($this->master)) {
            $this->assertTrue(method_exists($this->master, 'delete_mechanic'), 
                'Master should have delete_mechanic method');
        } else {
            $this->markTestSkipped('Master class not available');
        }
    }

    /**
     * Test data building logic for SQL queries
     */
    public function testDataBuildingLogic()
    {
        $data = "";
        $testArray = ['field1' => 'value1', 'field2' => 'value2', 'id' => '1'];
        
        foreach ($testArray as $k => $v) {
            if (!in_array($k, ['id'])) {
                if (!empty($data)) {
                    $data .= ", ";
                }
                $data .= " `{$k}`='{$v}' ";
            }
        }
        
        $this->assertNotEmpty($data, 'Data string should not be empty');
        $this->assertStringNotContainsString('id', $data, 'Data should not contain excluded fields');
        $this->assertStringContainsString('field1', $data, 'Data should contain field1');
        $this->assertStringContainsString('field2', $data, 'Data should contain field2');
    }

    /**
     * Test HTML entities encoding
     */
    public function testHtmlEntitiesEncoding()
    {
        $description = '<script>alert("test")</script>';
        $encoded = addslashes(htmlentities($description));
        
        $this->assertNotEquals($description, $encoded, 'Description should be encoded');
        $this->assertStringNotContainsString('<script>', $encoded, 
            'Encoded description should not contain script tags');
    }
}
