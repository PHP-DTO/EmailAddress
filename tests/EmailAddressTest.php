<?php
/**
 * Created for email-address
 * Date: 23.01.2021
 * @author Timur Kasumov (XAKEPEHOK)
 */

namespace PhpDto\EmailAddress;

use PHPUnit\Framework\TestCase;
use PhpDto\EmailAddress\Exception\InvalidEmailAddressException;

class EmailAddressTest extends TestCase
{

    /** @var EmailAddress */
    private $email;

    protected function setUp(): void
    {
        parent::setUp();
        $this->email = new EmailAddress(' mail@example.com ');
    }

    public function testGet()
    {
        $this->assertSame('mail@example.com', $this->email->get());
    }

    public function testGetUsername()
    {
        $this->assertSame('mail', $this->email->getUsername());
    }

    public function testGetHostname()
    {
        $this->assertSame('example.com', $this->email->getHostname());
    }

    public function testToString()
    {
        $this->assertSame('mail@example.com', (string) $this->email);
    }

    /**
     * @dataProvider invalidEmailDataProvider
     * @param string $email
     */
    public function testConstructInvalidEmail(string $email)
    {
        $this->expectException(InvalidEmailAddressException::class);
        new EmailAddress($email);
    }

    public function invalidEmailDataProvider(): array
    {
        $examples = [
            ['mail'],
            ['mail@'],
            ['mail@example'],
            ['@example.com'],
            ['привет@example.com'],
            [''],
        ];

        return array_combine(array_column($examples, 0), $examples);
    }

}
