<?php declare(strict_types = 1);

namespace GrandMedia\VO;

use Assert\Assertion;

final class Country
{

	/** @var string */
	private $code;

	private function __construct(string $code)
	{
		Assertion::length($code, 2, 'Country code has to be 2 exactly characters long');

		$this->code = $code;
	}

	public static function fromCode(string $code): self
	{
		return new self($code);
	}

	public function getCode(): string
	{
		return $this->code;
	}

	public function __toString(): string
	{
		return $this->code;
	}

}
