<?php declare(strict_types = 1);

namespace GrandMedia\VO;

use Assert\Assertion;

final class IBAN
{

	public const FORMAT = '[A-Z]{2}\d{2}[A-Z\d]{1,30}';

	/**
	 * @var string
	 */
	private $value;

	private function __construct()
	{
	}

	public static function from(string $value): self
	{
		$value = \preg_replace('/\s+/', '', $value);

		Assertion::regex($value, \sprintf('/^%s$/', self::FORMAT));

		$number = new self();
		$number->value = $value;

		return $number;
	}

	public function toReadable(): string
	{
		return \implode(' ', \str_split($this->value, 4));
	}

	public function __toString(): string
	{
		return $this->value;
	}

}
