<?php declare(strict_types = 1);

namespace GrandMediaTests\VO;

use Assert\Assertion;
use Assert\InvalidArgumentException;
use GrandMedia\VO\IBAN;
use Tester\Assert;

require_once __DIR__ . '/../bootstrap.php';

/**
 * @testCase
 */
final class IBANTest extends \Tester\TestCase
{

	private const VALID_IBAN = 'BH67 BMAG 0000 1299 1234 56';
	private const INVALID_IBAN = 'not IBAN';

	public function testValidIBAN(): void
	{
		$number = IBAN::from(self::VALID_IBAN);

		Assert::same(\preg_replace('/\s+/', '', self::VALID_IBAN), (string) $number);
		Assert::same(self::VALID_IBAN, $number->toReadable());
	}

	public function testInvalidIBAN(): void
	{
		Assert::exception(
			function (): void {
				IBAN::from(self::INVALID_IBAN);
			},
			InvalidArgumentException::class,
			null,
			Assertion::INVALID_REGEX
		);
	}

}

(new IBANTest())->run();
