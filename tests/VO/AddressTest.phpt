<?php declare(strict_types = 1);

namespace GrandMediaTests\VO;

use Assert\Assertion;
use Assert\InvalidArgumentException;
use GrandMedia\VO\Address;
use GrandMedia\VO\Country;
use Tester\Assert;

require_once __DIR__ . '/../bootstrap.php';

/**
 * @testCase
 */
final class AddressTest extends \Tester\TestCase
{

	private const VALID_NAME = 'name';
	private const VALID_STREET = 'street';
	private const VALID_CITY = 'city';
	private const VALID_POST_CODE = '12356';
	private const VALID_COUNTRY = 'CZ';

	public function testValid(): void
	{
		$country = Country::fromCode(self::VALID_COUNTRY);
		$address = Address::from(
			self::VALID_NAME,
			self::VALID_STREET,
			self::VALID_CITY,
			self::VALID_POST_CODE,
			$country
		);

		Assert::same(self::VALID_NAME, $address->getName());
		Assert::same(self::VALID_STREET, $address->getStreet());
		Assert::same(self::VALID_CITY, $address->getCity());
		Assert::same(self::VALID_POST_CODE, $address->getPostCode());
		Assert::same($country, $address->getCountry());
	}

	public function testBlankName(): void
	{
		Assert::exception(
			function (): void {
				Address::from(
					'',
					self::VALID_STREET,
					self::VALID_CITY,
					self::VALID_POST_CODE,
					Country::fromCode(self::VALID_COUNTRY)
				);
			},
			InvalidArgumentException::class,
			null,
			Assertion::INVALID_NOT_BLANK
		);
	}

	public function testBlankStreet(): void
	{
		Assert::exception(
			function (): void {
				Address::from(
					self::VALID_NAME,
					'',
					self::VALID_CITY,
					self::VALID_POST_CODE,
					Country::fromCode(self::VALID_COUNTRY)
				);
			},
			InvalidArgumentException::class,
			null,
			Assertion::INVALID_NOT_BLANK
		);
	}

	public function testBlankCity(): void
	{
		Assert::exception(
			function (): void {
				Address::from(
					self::VALID_NAME,
					self::VALID_STREET,
					'',
					self::VALID_POST_CODE,
					Country::fromCode(self::VALID_COUNTRY)
				);
			},
			InvalidArgumentException::class,
			null,
			Assertion::INVALID_NOT_BLANK
		);
	}

	public function testBlankPostCode(): void
	{
		Assert::exception(
			function (): void {
				Address::from(
					self::VALID_NAME,
					self::VALID_STREET,
					self::VALID_CITY,
					'',
					Country::fromCode(self::VALID_COUNTRY)
				);
			},
			InvalidArgumentException::class,
			null,
			Assertion::INVALID_NOT_BLANK
		);
	}

}

(new AddressTest())->run();
