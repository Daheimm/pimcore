<?php

namespace App\PimCore\Admin\SettingQueries\Infrastructure\Controllers\MenuSettings;

use App\PimCore\Admin\SettingQueries\Application\Services\Interfaces\SettingQueriesServiceInterface;
use App\PimCore\Admin\SettingQueries\Infrastructure\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/setting-queries', name: 'setting-queries')]
class SettingsController extends Controller
{
    public function __construct(private readonly SettingQueriesServiceInterface $queriesService)
    {
    }

    #[Route('/', name: 'setting-queries', methods: 'GET')]
    public function index(): Response
    {
        return $this->response($this->queriesService->getAll());
    }
}
