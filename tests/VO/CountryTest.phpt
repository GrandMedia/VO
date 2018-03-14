<?php declare(strict_types = 1);

namespace GrandMediaTests\VO;

use Assert\Assertion;
use Assert\InvalidArgumentException;
use GrandMedia\VO\Country;
use Tester\Assert;

require_once __DIR__ . '/../bootstrap.php';

/**
 * @testCase
 */
final class CountryTest extends \Tester\TestCase
{

	private const VALID_CODE = 'CZ';
	private const INVALID_CODE = 'A';

	public function testValidCode(): void
	{
		$country = Country::fromCode(self::VALID_CODE);

		Assert::same(self::VALID_CODE, $country->getCode());
	}

	public function testInvalidCode(): void
	{
		Assert::exception(
			function (): void {
				Country::fromCode(self::INVALID_CODE);
			},
			InvalidArgumentException::class,
			null,
			Assertion::INVALID_LENGTH
		);
	}

	public function testToString(): void
	{
		$country = Country::fromCode(self::VALID_CODE);

		Assert::same(self::VALID_CODE, (string) $country);
	}

}

(new CountryTest())->run();
