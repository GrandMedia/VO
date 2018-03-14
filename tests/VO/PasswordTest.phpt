<?php declare(strict_types = 1);

namespace GrandMediaTests\VO;

use Assert\Assertion;
use Assert\InvalidArgumentException;
use GrandMedia\VO\Password;
use Tester\Assert;

require_once __DIR__ . '/../bootstrap.php';

/**
 * @testCase
 */
final class PasswordTest extends \Tester\TestCase
{

	private const PASSWORD = 'test';
	private const HASH = '$2y$10$x2hMwCGimcCr5Vp5jT.uD.6SEOXCWQPoY1h6R387S5sK90T6CdrDC';

	public function testBlankHash(): void
	{
		Assert::exception(
			function (): void {
				Password::fromHash('');
			},
			InvalidArgumentException::class,
			null,
			Assertion::INVALID_NOT_BLANK
		);
	}

	public function testFromHash(): void
	{
		$password = Password::fromHash(self::HASH);

		Assert::true($password->verify(self::PASSWORD));
	}

	public function testFromPlainText(): void
	{
		$password = Password::fromPlainText(self::PASSWORD);

		Assert::true($password->verify(self::PASSWORD));
	}

}

(new PasswordTest())->run();
