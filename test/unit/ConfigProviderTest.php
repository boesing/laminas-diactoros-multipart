<?php

declare(strict_types=1);

namespace Boesing\Psr\Http\Message\Multipart;

use Boesing\Psr\Http\Message\Multipart\ConfigProvider;
use PHPUnit\Framework\TestCase;

use function array_keys;

final class ConfigProviderTest extends TestCase
{
    use DependenciesFromConfigProviderExtractionTrait;

    public function testReturnsExpectedServiceDependencies(): void
    {
        /** @psalm-suppress InvalidArgument Psalm seems to a bug, I might report that once I got some feedback. */
        $dependencies = $this->extractDependenciesFromConfigProvider(new ConfigProvider());

        self::assertArrayHasKey('factories', $dependencies);
        self::assertIsArray($dependencies['factories']);
        self::assertEquals([
            MimeTypeGuesserInterface::class,
            MultipartStreamFactoryInterface::class,
            PartOfMultipartStreamFactoryInterface::class,
        ], array_keys($dependencies['factories']));
    }
}
