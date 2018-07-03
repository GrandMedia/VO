<?php declare(strict_types = 1);

namespace GrandMedia\VO;

use Assert\Assertion;

final class CzechBankAccountNumber
{

	public const PREFIX_FORMAT = '\d{0,6}';
	public const NUMBER_FORMAT = '\d{1,10}';
	public const BANK_CODE_FORMAT = '\d{4}';
	public const ACCOUNT_NUMBER_FORMAT = '((' . self::PREFIX_FORMAT . ')-)?(' . self::NUMBER_FORMAT . ')/(' . self::BANK_CODE_FORMAT . ')';

	/**
	 * @var string
	 */
	private $prefix;

	/**
	 * @var string
	 */
	private $number;

	/**
	 * @var string
	 */
	private $bankCode;

	private function __construct()
	{
	}

	public static function fromString(string $string): self
	{
		$pattern = \sprintf('#^%s$#', self::ACCOUNT_NUMBER_FORMAT);

		Assertion::regex($string, $pattern);

		\preg_match($pattern, $string, $matches);

		$accountNumber = new self();

		$accountNumber->prefix = $matches[2];
		$accountNumber->number = $matches[3];
		$accountNumber->bankCode = $matches[4];

		return $accountNumber;
	}

	public static function fromValues(string $prefix, string $number, string $bankCode): self
	{
		Assertion::regex($prefix, \sprintf('/^%s$/', self::PREFIX_FORMAT));
		Assertion::regex($number, \sprintf('/^%s$/', self::NUMBER_FORMAT));
		Assertion::regex($bankCode, \sprintf('/^%s$/', self::BANK_CODE_FORMAT));

		$accountNumber = new self();

		$accountNumber->prefix = $prefix;
		$accountNumber->number = $number;
		$accountNumber->bankCode = $bankCode;

		return $accountNumber;
	}

	public function getPrefix(): string
	{
		return $this->prefix;
	}

	public function getNumber(): string
	{
		return $this->number;
	}

	public function getBankCode(): string
	{
		return $this->bankCode;
	}

	public function __toString(): string
	{
		return \sprintf(
			'%s%s/%s',
			($this->prefix === '' ? '' : \sprintf('%s-', $this->prefix)),
			$this->number,
			$this->bankCode
		);
	}

}
