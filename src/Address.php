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

	private function __construct()
	{
	}

	public static function from(string $street, string $city, string $postCode, Country $country): self
	{
		Assertion::notBlank($street);
		Assertion::notBlank($city);
		Assertion::notBlank($postCode);

		$address = new self();
		$address->street = $street;
		$address->city = $city;
		$address->postCode = $postCode;
		$address->country = $country;

		return $address;
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
