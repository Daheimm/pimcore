<?php

namespace App\PimCore\Admin\SettingQueries\Infrastructure\Controllers\MenuSettings;

use App\PimCore\Admin\SettingQueries\Application\Dto\Settings\SettingsRequestDto;
use App\PimCore\Admin\SettingQueries\Application\Services\Interfaces\SettingQueriesServiceInterface;
use App\PimCore\Admin\SettingQueries\Infrastructure\Controllers\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin-custom/setting-queries', name: 'setting-queries')]
class SettingsController extends Controller
{
    public function __construct(private readonly SettingQueriesServiceInterface $queriesService)
    {
    }

    #[Route('/', name: 'setting-queries_get', methods: 'GET')]
    public function index(): JsonResponse
    {
        return $this->response($this->queriesService->getAll());
    }

    #[Route('/show', name: 'setting-queries_get_by_id', methods: 'GET')]
    public function show(Request $request)
    {
        return $this->response($this->queriesService->getById($request->get('id')));
    }

    #[Route('', name: 'setting-queries_save', methods: 'PUT')]
    public function update(Request $request)
    {
        $request = $this->serializer->deserialize($request->get('data'), SettingsRequestDto::class, 'json');

        $this->validation($request);

        return $this->response($this->queriesService->update($request));

    }
}
