<?php declare(strict_types = 1);

namespace GrandMedia\VO;

use Assert\Assertion;
use GrandMedia\VO\Exceptions\InvalidHash;

final class Password
{

	/** @var string */
	private $hash;

	private function __construct(string $hash)
	{
		Assertion::notBlank($hash);

		$this->hash = $hash;
	}

	public static function fromHash(string $hash): self
	{
		return new self($hash);
	}

	public static function fromPlainText(string $value): self
	{
		$hash = \password_hash($value, \PASSWORD_BCRYPT);

		if ($hash === false || strlen($hash) < 60) {
			throw new InvalidHash('Hash computed by password_hash is invalid.');
		}

		return new self($hash);
	}

	public function verify(string $value): bool
	{
		return \password_verify($value, $this->hash);
	}

}
