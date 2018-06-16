<?php declare(strict_types = 1);

namespace GrandMedia\VO;

use Assert\Assertion;

final class Country
{

	/**
	 * @var string
	 */
	private $code;

	private function __construct()
	{
	}

	public static function fromCode(string $code): self
	{
		Assertion::length($code, 2, 'Country code has to be exactly 2 characters long.');

		$country = new self();
		$country->code = $code;

		return $country;
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
