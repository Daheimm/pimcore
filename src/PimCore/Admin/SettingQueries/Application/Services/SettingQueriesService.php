<?php

namespace App\PimCore\Admin\SettingQueries\Application\Services;

use App\PimCore\Admin\SettingQueries\Application\Dto\Settings\SettingsRequestDto;
use App\PimCore\Admin\SettingQueries\Application\Services\Interfaces\ClassesPimCoreServiceInterface;
use App\PimCore\Admin\SettingQueries\Application\Services\Interfaces\SettingQueriesServiceInterface;
use App\PimCore\Admin\SettingQueries\Domain\Entity\GraphQl\GraphqlRequestsPimcore;
use App\PimCore\Admin\SettingQueries\Domain\Reposutories\GraphQl\GraphqlRequestsPimcoreRepositoryInterface;
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

    public function getById(int $id): GraphqlRequestsPimcore
    {
        $entity = $this->graphqlRequestsPimcoreRepository->getById($id);

        return $entity;
    }

    public function update(SettingsRequestDto $settingsRequestDto): GraphqlRequestsPimcore
    {
        $entity = $this->getById($settingsRequestDto->getId());

        if (!$entity) {
            throw new BadRequestException('not entity');
        }

        $entity->setQuery($settingsRequestDto->getQuery())
            ->setText($settingsRequestDto->getText())
            ->setXApiKey($settingsRequestDto->getXApiKey())
            ->setType($settingsRequestDto->getType())
            ->setEndpoint($settingsRequestDto->getEndpoint());

        return $this->graphqlRequestsPimcoreRepository->update($entity);

    }
}
