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

    public function testGet(): void
    {
        $this->assertSame('mail@example.com', $this->email->get());
    }

    public function testGetUsername(): void
    {
        $this->assertSame('mail', $this->email->getUsername());
    }

    public function testGetHostname(): void
    {
        $this->assertSame('example.com', $this->email->getHostname());
    }

    public function testToString(): void
    {
        $this->assertSame('mail@example.com', (string) $this->email);
    }

    public function testIsEquals(): void
    {
        $this->assertTrue($this->email->isEquals(new EmailAddress('mail@example.com')));
        $this->assertFalse($this->email->isEquals(new EmailAddress('email@example.com')));
    }

    /**
     * @dataProvider invalidEmailDataProvider
     * @param string $email
     */
    public function testConstructInvalidEmail(string $email): void
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
