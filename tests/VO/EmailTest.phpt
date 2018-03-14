<?php declare(strict_types = 1);

namespace GrandMediaTests\VO;

use Assert\Assertion;
use Assert\InvalidArgumentException;
use GrandMedia\VO\Email;
use Tester\Assert;

require_once __DIR__ . '/../bootstrap.php';

/**
 * @testCase
 */
final class EmailTest extends \Tester\TestCase
{

	private const VALID_EMAIL = 'foo@bar.cz';
	private const INVALID_EMAIL = 'not email';

	public function testValidEmail(): void
	{
		$email = Email::from(self::VALID_EMAIL);

		Assert::same(self::VALID_EMAIL, (string) $email);
	}

	public function testInvalidEmail(): void
	{
		Assert::exception(
			function (): void {
				Email::from(self::INVALID_EMAIL);
			},
			InvalidArgumentException::class,
			null,
			Assertion::INVALID_EMAIL
		);
	}

}

(new EmailTest())->run();
