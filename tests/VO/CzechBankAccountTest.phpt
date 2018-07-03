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
	private const BANK_ACCOUNT_NUMBER_FORMAT = '%s-%s/%s';

	public function testValidFromValues(): void
	{
		$number = CzechBankAccountNumber::fromValues(self::VALID_PREFIX, self::VALID_NUMBER, self::VALID_BANK_CODE);

		Assert::same(
			\sprintf(
				self::BANK_ACCOUNT_NUMBER_FORMAT,
				self::VALID_PREFIX,
				self::VALID_NUMBER,
				self::VALID_BANK_CODE
			),
			(string) $number
		);
	}

	public function testValidFromString(): void
	{
		$string = \sprintf(
			self::BANK_ACCOUNT_NUMBER_FORMAT,
			self::VALID_PREFIX,
			self::VALID_NUMBER,
			self::VALID_BANK_CODE
		);
		$number = CzechBankAccountNumber::fromString($string);

		Assert::same(self::VALID_PREFIX, $number->getPrefix());
		Assert::same(self::VALID_NUMBER, $number->getNumber());
		Assert::same(self::VALID_BANK_CODE, $number->getBankCode());
		Assert::same($string, (string) $number);
	}

	public function testInvalidPrefixFromValues(): void
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

	public function testInvalidPrefixFromString(): void
	{
		Assert::exception(
			function (): void {
				CzechBankAccountNumber::fromString(
					\sprintf(
						self::BANK_ACCOUNT_NUMBER_FORMAT,
						self::INVALID_PREFIX,
						self::VALID_NUMBER,
						self::VALID_BANK_CODE
					)
				);
			},
			InvalidArgumentException::class,
			null,
			Assertion::INVALID_REGEX
		);
	}

	public function testInvalidNumberFromValues(): void
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

	public function testInvalidNumberFromString(): void
	{
		Assert::exception(
			function (): void {
				CzechBankAccountNumber::fromString(
					\sprintf(
						self::BANK_ACCOUNT_NUMBER_FORMAT,
						self::VALID_PREFIX,
						self::INVALID_NUMBER,
						self::VALID_BANK_CODE
					)
				);
			},
			InvalidArgumentException::class,
			null,
			Assertion::INVALID_REGEX
		);
	}

	public function testInvalidBankCodeFromValues(): void
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

	public function testInvalidBankCodeFromString(): void
	{
		Assert::exception(
			function (): void {
				CzechBankAccountNumber::fromString(
					\sprintf(
						self::BANK_ACCOUNT_NUMBER_FORMAT,
						self::VALID_PREFIX,
						self::VALID_NUMBER,
						self::INVALID_BANK_CODE
					)
				);
			},
			InvalidArgumentException::class,
			null,
			Assertion::INVALID_REGEX
		);
	}

}

(new CzechBankAccountTest())->run();
