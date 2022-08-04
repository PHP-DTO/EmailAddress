<?php
/**
 * Created for email-address
 * Date: 23.01.2021
 * @author Timur Kasumov (XAKEPEHOK)
 */

namespace PhpDto\EmailAddress;


use JsonSerializable;
use PhpDto\EmailAddress\Exception\InvalidEmailAddressException;

class EmailAddress implements JsonSerializable
{

    /** @var string */
    protected $address;

    /**
     * Email constructor.
     * @param string $email
     * @throws InvalidEmailAddressException
     */
    public function __construct(string $email)
    {
        $email = strtolower(trim($email));
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidEmailAddressException("Invalid email address '{$email}'");
        }
        $this->address = $email;
    }

    public function get(): string
    {
        return $this->address;
    }

    public function getUsername(): string
    {
        return explode('@', $this->address)[0];
    }

    public function getHostname(): string
    {
        return explode('@', $this->address)[1];
    }

    public function __toString(): string
    {
        return $this->address;
    }

    public function isEquals(self $email): bool
    {
        return $this->address === $email->address;
    }

    public function jsonSerialize(): string
    {
        return $this->address;
    }
}