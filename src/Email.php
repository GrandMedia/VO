<?php declare(strict_types = 1);

namespace GrandMedia\VO;

use Assert\Assertion;

final class Email
{

	/**
	 * @var string
	 */
	private $value;

	private function __construct()
	{
	}

	public static function from(string $value): self
	{
		Assertion::email($value);

		$email = new self();
		$email->value = $value;

		return $email;
	}

	public function __toString(): string
	{
		return $this->value;
	}

}
