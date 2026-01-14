<?php
/**
 * Unit tests for DBConnection class
 */

use PHPUnit\Framework\TestCase;

class DBConnectionTest extends TestCase
{
    private $dbConnection;

    protected function setUp(): void
    {
        // Only test if database connection constants are defined
        if (defined('DB_SERVER') && defined('DB_USERNAME') && defined('DB_PASSWORD') && defined('DB_NAME')) {
            $this->dbConnection = new DBConnection();
        }
    }

    protected function tearDown(): void
    {
        if (isset($this->dbConnection)) {
            unset($this->dbConnection);
        }
    }

    /**
     * Test that DBConnection class exists
     */
    public function testClassExists()
    {
        $this->assertTrue(class_exists('DBConnection'), 'DBConnection class should exist');
    }

    /**
     * Test that DBConnection has a connection property
     */
    public function testHasConnectionProperty()
    {
        $this->assertClassHasAttribute('conn', 'DBConnection');
    }

    /**
     * Test that connection is established (if database is available)
     */
    public function testConnectionEstablished()
    {
        if (isset($this->dbConnection)) {
            $this->assertNotNull($this->dbConnection->conn, 'Connection should be established');
            $this->assertInstanceOf('mysqli', $this->dbConnection->conn, 'Connection should be mysqli instance');
        } else {
            $this->markTestSkipped('Database connection not available');
        }
    }

    /**
     * Test that connection properties are set correctly
     */
    public function testConnectionProperties()
    {
        $reflection = new ReflectionClass('DBConnection');
        
        $this->assertTrue($reflection->hasProperty('host'), 'DBConnection should have host property');
        $this->assertTrue($reflection->hasProperty('username'), 'DBConnection should have username property');
        $this->assertTrue($reflection->hasProperty('password'), 'DBConnection should have password property');
        $this->assertTrue($reflection->hasProperty('database'), 'DBConnection should have database property');
    }

    /**
     * Test constructor creates connection
     */
    public function testConstructorCreatesConnection()
    {
        if (isset($this->dbConnection)) {
            $this->assertNotNull($this->dbConnection->conn);
        } else {
            $this->markTestSkipped('Database connection not available');
        }
    }
}
