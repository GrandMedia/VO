<?php declare(strict_types = 1);

namespace GrandMedia\VO;

use Assert\Assertion;

final class Email
{

	/** @var string */
	private $value;

	private function __construct(string $value)
	{
		Assertion::email($value);

		$this->value = $value;
	}

	public static function from(string $value): self
	{
		return new self($value);
	}

	public function getValue(): string
	{
		return $this->value;
	}

	public function __toString(): string
	{
		return $this->value;
	}

}
