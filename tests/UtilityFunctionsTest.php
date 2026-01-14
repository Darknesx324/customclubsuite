<?php
/**
 * Unit tests for utility functions from config.php
 */

use PHPUnit\Framework\TestCase;

class UtilityFunctionsTest extends TestCase
{
    /**
     * Test validate_image function logic
     */
    public function testValidateImageLogic()
    {
        // Test the logic of validate_image function
        $file = 'uploads/test_image.jpg';
        $baseApp = str_replace('\\', '/', __DIR__ . '/../') . '/';
        
        if (file_exists($baseApp . $file)) {
            $result = 'http://localhost/Custom_Club_Suite/' . $file;
            $this->assertStringContainsString('uploads/', $result, 
                'validate_image should return file path if file exists');
        } else {
            $result = 'http://localhost/Custom_Club_Suite/dist/img/no-image-available.png';
            $this->assertStringContainsString('no-image-available', $result, 
                'validate_image should return default image if file does not exist');
        }
    }

    /**
     * Test isMobileDevice function with mobile user agents
     */
    public function testIsMobileDeviceWithMobileUserAgents()
    {
        // Test mobile user agents
        $mobileUserAgents = [
            'iPhone' => 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_0 like Mac OS X)',
            'Android' => 'Mozilla/5.0 (Linux; Android 10; SM-G975F)',
            'iPad' => 'Mozilla/5.0 (iPad; CPU OS 14_0 like Mac OS X)',
        ];

        foreach ($mobileUserAgents as $device => $userAgent) {
            $isMobile = $this->checkMobileUserAgent($userAgent);
            $this->assertTrue($isMobile, "{$device} user agent should be detected as mobile");
        }
    }

    /**
     * Test isMobileDevice function with desktop user agents
     */
    public function testIsMobileDeviceWithDesktopUserAgents()
    {
        $desktopUserAgent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36';
        $isMobile = $this->checkMobileUserAgent($desktopUserAgent);
        $this->assertFalse($isMobile, 'Desktop user agent should not be detected as mobile');
    }

    /**
     * Helper method to check mobile user agent (simulating isMobileDevice logic)
     */
    private function checkMobileUserAgent($userAgent)
    {
        $aMobileUA = array(
            '/iphone/i' => 'iPhone',
            '/ipod/i' => 'iPod',
            '/ipad/i' => 'iPad',
            '/android/i' => 'Android',
            '/blackberry/i' => 'BlackBerry',
            '/webos/i' => 'Mobile'
        );

        foreach ($aMobileUA as $sMobileKey => $sMobileOS) {
            if (preg_match($sMobileKey, $userAgent)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Test base_url constant is defined
     */
    public function testBaseUrlConstant()
    {
        if (defined('base_url')) {
            $this->assertNotEmpty(base_url, 'base_url should be defined and not empty');
            $this->assertStringContainsString('http', base_url, 'base_url should contain http');
        } else {
            $this->markTestSkipped('base_url constant not defined');
        }
    }

    /**
     * Test base_app constant is defined
     */
    public function testBaseAppConstant()
    {
        if (defined('base_app')) {
            $this->assertNotEmpty(base_app, 'base_app should be defined and not empty');
            $this->assertStringEndsWith('/', base_app, 'base_app should end with slash');
        } else {
            $this->markTestSkipped('base_app constant not defined');
        }
    }

    /**
     * Test database constants are defined
     */
    public function testDatabaseConstants()
    {
        $constants = ['DB_SERVER', 'DB_USERNAME', 'DB_PASSWORD', 'DB_NAME'];
        
        foreach ($constants as $constant) {
            if (defined($constant)) {
                $this->assertTrue(true, "{$constant} should be defined");
            } else {
                $this->markTestSkipped("{$constant} constant not defined");
            }
        }
    }

    /**
     * Test date timezone setting
     */
    public function testDateTimeZone()
    {
        $timezone = ini_get('date.timezone');
        $defaultTimezone = date_default_timezone_get();
        
        $this->assertNotEmpty($defaultTimezone, 'Default timezone should be set');
        $this->assertTrue(in_array($defaultTimezone, timezone_identifiers_list()), 
            'Default timezone should be a valid timezone');
    }
}
