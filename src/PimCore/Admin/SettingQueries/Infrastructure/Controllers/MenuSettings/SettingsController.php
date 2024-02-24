<?php

namespace App\PimCore\Admin\SettingQueries\Infrastructure\Controllers\MenuSettings;

use App\PimCore\Admin\SettingQueries\Application\Services\Interfaces\SettingQueriesServiceInterface;
use App\PimCore\Admin\SettingQueries\Infrastructure\Controllers\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin-custom/setting-queries', name: 'setting-queries')]
class SettingsController extends Controller
{
    public function __construct(private readonly SettingQueriesServiceInterface $queriesService)
    {
    }

    #[Route('/', name: 'setting-queries', methods: 'GET')]
    public function index(): JsonResponse
    {
        return $this->response($this->queriesService->getAll());
    }
}
