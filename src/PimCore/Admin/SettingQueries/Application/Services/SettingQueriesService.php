<?php

namespace App\PimCore\Admin\SettingQueries\Application\Services;

use App\PimCore\Admin\SettingQueries\Application\Actions\PrepareClassesAction;
use App\PimCore\Admin\SettingQueries\Application\Dto\Settings\GraphQLPimCoreResponse;
use App\PimCore\Admin\SettingQueries\Application\Dto\Settings\SettingsRequestDto;
use App\PimCore\Admin\SettingQueries\Application\Services\Interfaces\ClassesPimCoreServiceInterface;
use App\PimCore\Admin\SettingQueries\Application\Services\Interfaces\SettingQueriesServiceInterface;
use App\PimCore\Admin\SettingQueries\Domain\Entity\GraphQl\GraphqlRequestsPimcore;
use App\PimCore\Admin\SettingQueries\Domain\Repositories\GraphQl\GraphqlRequestsPimcoreRepositoryInterface;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class SettingQueriesService implements SettingQueriesServiceInterface
{
    public function __construct(
        private readonly GraphqlRequestsPimcoreRepositoryInterface $graphqlRequestsPimcoreRepository,
        private readonly ClassesPimCoreServiceInterface            $classesPimCoreService)
    {
    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        return $this->graphqlRequestsPimcoreRepository->getAll();
    }

    public function showById(int $id): GraphQLPimCoreResponse
    {
        $entity = $this->graphqlRequestsPimcoreRepository->getById($id);
        $classses = $this->classesPimCoreService->getAll();

        $activeCalsses = PrepareClassesAction::run($classses, $entity->getTypeId());

        $prepareEntity = (new GraphQLPimCoreResponse())
            ->setXApiKey($entity->getXApiKey())
            ->setText($entity->getText())
            ->setQuery($entity->getQuery())
            ->setType($activeCalsses)
            ->setId($entity->getId())
            ->setEndpoint($entity->getEndpoint())
            ->setFolderPath($entity->getPath());

        return $prepareEntity;
    }

    public function getById(int $id): GraphqlRequestsPimcore
    {
        return $this->graphqlRequestsPimcoreRepository->getById($id);
    }

    public function update(SettingsRequestDto $settingsRequestDto): GraphqlRequestsPimcore
    {
        /**
         * @var GraphqlRequestsPimcore $entity
         */
        $entity = $this->getById($settingsRequestDto->getId());

        if (!$entity) {
            throw new BadRequestException('not entity');
        }

        $entity->setQuery($settingsRequestDto->getQuery())
            ->setText($settingsRequestDto->getText())
            ->setXApiKey($settingsRequestDto->getXApiKey())
            ->setTypeId($settingsRequestDto->getType())
            ->setEndpoint($settingsRequestDto->getEndpoint())
            ->setPath($settingsRequestDto->getFolderPath());

        return $this->graphqlRequestsPimcoreRepository->update($entity);

    }
}
