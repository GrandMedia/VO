<?php declare(strict_types = 1);

namespace GrandMedia\VO;

use Assert\Assertion;

final class Address
{

	/** @var string */
	private $street;

	/** @var string */
	private $city;

	/** @var string */
	private $postCode;

	/** @var \GrandMedia\VO\Country */
	private $country;

	private function __construct(string $street, string $city, string $postCode, Country $country)
	{
		Assertion::notBlank($street);
		Assertion::notBlank($city);
		Assertion::notBlank($postCode);

		$this->street = $street;
		$this->city = $city;
		$this->postCode = $postCode;
		$this->country = $country;
	}

	public static function from(string $street, string $city, string $postCode, Country $country): self
	{
		return new self($street, $city, $postCode, $country);
	}

	public function getStreet(): string
	{
		return $this->street;
	}

	public function getCity(): string
	{
		return $this->city;
	}

	public function getPostCode(): string
	{
		return $this->postCode;
	}

	public function getCountry(): Country
	{
		return $this->country;
	}

}
