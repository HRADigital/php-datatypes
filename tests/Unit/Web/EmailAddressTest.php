<?php declare(strict_types=1);

namespace Hradigital\Tests\Datatypes\Unit\Web;

use Hradigital\Datatypes\Exceptions\Datatypes\InvalidEmailException;
use Hradigital\Datatypes\Exceptions\Datatypes\NonEmptyStringException;
use Hradigital\Datatypes\Web\EmailAddress;
use Hradigital\Tests\Datatypes\AbstractBaseTestCase;

/**
 * Email Address Unit testing.
 *
 * @package   Hradigital\Datatypes
 * @license   MIT
 */
class EmailAddressTest extends AbstractBaseTestCase
{
    /**
     * Tests an instance can be loaded successfully.
     *
     * @return void
     */
    public function testLoadsSuccessfully(): void
    {
        // Performs test.
        $emailString = 'user@domain.tld';
        $email = EmailAddress::create($emailString);

        // Performs assertions.
        $this->assertInstanceOf(
            EmailAddress::class,
            $email,
            'Returned instance is not of type EmailAddress.'
        );
        $this->assertEquals(
            $emailString,
            (string) $email,
            'Loaded state does not match inital value.'
        );
        $this->assertEquals(
            $emailString,
            (string) $email->address(),
            'Addresses do not match.'
        );
        $this->assertEquals(
            'user',
            (string) $email->username(),
            'Usernames do not match.'
        );
        $this->assertEquals(
            'domain',
            (string) $email->domain(),
            'Domains do not match.'
        );
        $this->assertEquals(
            'tld',
            (string) $email->tld(),
            'TLDs do not match.'
        );
    }

    /**
     * Tests supplied e-mail address is converted to lower case.
     *
     * @return void
     */
    public function testConvertsToLowerCase(): void
    {
        // Performs test.
        $emailString = 'User@DoMaiN.Tld';
        $email = EmailAddress::create($emailString);

        // Performs assertions.
        $this->assertEquals(
            \strtolower(\trim($emailString)),
            (string) $email,
            'Trimmed and lower cased strings do not match.'
        );
    }

    /**
     * Tests breaks instantiation, if invalid data is supplied.
     *
     * @return void
     */
    public function testBreaksIfEmptyAddressSupplied(): void
    {
        // Creates expectation.
        $this->expectException(NonEmptyStringException::class);

        // Performs test.
        EmailAddress::create('');
    }

    /**
     * Tests breaks instantiation, if invalid data is supplied.
     *
     * @return void
     */
    public function testBreaksIfInvalidAddressSupplied(): void
    {
        // Creates expectation.
        $this->expectException(InvalidEmailException::class);

        // Performs test.
        EmailAddress::create('This is not an email address');
    }

    /**
     * Tests instance can be serialized and deserialized correctly.
     *
     * @return void
     */
    public function testSerializesAndDeserializesCorrectly(): void
    {
        // Performs test.
        $emailString = 'user@domain.tld';
        $email1 = EmailAddress::create($emailString);

        $serialized = \serialize($email1);
        $email2 = \unserialize($serialized);

        // Performs assertions.
        $this->assertInstanceOf(
            EmailAddress::class,
            $email1,
            'Returned instance is not of type EmailAddress.'
        );
        $this->assertInstanceOf(
            EmailAddress::class,
            $email2,
            'Returned instance is not of type EmailAddress.'
        );
        $this->assertEquals(
            (string) $email1,
            (string) $email2,
            'Addresses do not match.'
        );
        $this->assertNotEquals(
            $serialized,
            (string) $email2,
            'Addresses do not match.'
        );
    }
}
