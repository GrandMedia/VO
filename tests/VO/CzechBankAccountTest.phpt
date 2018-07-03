<?php declare(strict_types = 1);

namespace GrandMediaTests\VO;

use Assert\Assertion;
use Assert\InvalidArgumentException;
use GrandMedia\VO\CzechBankAccountNumber;
use Tester\Assert;

require_once __DIR__ . '/../bootstrap.php';

/**
 * @testCase
 */
final class CzechBankAccountTest extends \Tester\TestCase
{

	private const VALID_PREFIX = '1234';
	private const INVALID_PREFIX = 'not prefix';
	private const VALID_NUMBER = '123456';
	private const INVALID_NUMBER = 'not number';
	private const VALID_BANK_CODE = '1234';
	private const INVALID_BANK_CODE = 'not bank code';
	private const VALID_BANK_ACCOUNT_NUMBER = '1234-123456/1234';

	public function testValid(): void
	{
		$number = CzechBankAccountNumber::fromValues(self::VALID_PREFIX, self::VALID_NUMBER, self::VALID_BANK_CODE);

		Assert::same(self::VALID_BANK_ACCOUNT_NUMBER, (string) $number);
	}

	public function testInvalidPrefix(): void
	{
		Assert::exception(
			function (): void {
				CzechBankAccountNumber::fromValues(self::INVALID_PREFIX, self::VALID_NUMBER, self::VALID_BANK_CODE);
			},
			InvalidArgumentException::class,
			null,
			Assertion::INVALID_REGEX
		);
	}

	public function testInvalidNumber(): void
	{
		Assert::exception(
			function (): void {
				CzechBankAccountNumber::fromValues(self::VALID_PREFIX, self::INVALID_NUMBER, self::VALID_BANK_CODE);
			},
			InvalidArgumentException::class,
			null,
			Assertion::INVALID_REGEX
		);
	}

	public function testInvalidBankCode(): void
	{
		Assert::exception(
			function (): void {
				CzechBankAccountNumber::fromValues(self::VALID_PREFIX, self::VALID_NUMBER, self::INVALID_BANK_CODE);
			},
			InvalidArgumentException::class,
			null,
			Assertion::INVALID_REGEX
		);
	}

}

(new CzechBankAccountTest())->run();
