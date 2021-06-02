<?php declare(strict_types=1);

namespace Hradigital\Tests\Datatypes\Unit\Web;

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
            $email->__toString(),
            'Loaded state does not match inital value.'
        );
        $this->assertEquals(
            $emailString,
            $email->address(),
            'Addresses do not match.'
        );
        $this->assertEquals(
            'user',
            $email->username(),
            'Usernames do not match.'
        );
        $this->assertEquals(
            'domain',
            $email->domain(),
            'Domains do not match.'
        );
        $this->assertEquals(
            'tld',
            $email->tld(),
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
            $email->__toString(),
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
        $this->expectException(\InvalidArgumentException::class);

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
        $this->expectException(\InvalidArgumentException::class);

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
            $email1->__toString(),
            $email2->__toString(),
            'Addresses do not match.'
        );
        $this->assertNotEquals(
            $serialized,
            $email2->__toString(),
            'Addresses do not match.'
        );
    }
}
