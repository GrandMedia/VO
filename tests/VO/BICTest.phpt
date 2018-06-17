<?php declare(strict_types = 1);

namespace GrandMediaTests\VO;

use Assert\Assertion;
use Assert\InvalidArgumentException;
use GrandMedia\VO\BIC;
use Tester\Assert;

require_once __DIR__ . '/../bootstrap.php';

/**
 * @testCase
 */
final class BICTest extends \Tester\TestCase
{

	private const VALID_BIC = 'CITICZPXXXX  ';
	private const INVALID_BIC = 'not BIC';

	public function testValidBIC(): void
	{
		$number = BIC::from(self::VALID_BIC);

		Assert::same(\preg_replace('/\s+/', '', self::VALID_BIC), (string) $number);
	}

	public function testInvalidBIC(): void
	{
		Assert::exception(
			function (): void {
				BIC::from(self::INVALID_BIC);
			},
			InvalidArgumentException::class,
			null,
			Assertion::INVALID_REGEX
		);
	}

}

(new BICTest())->run();
