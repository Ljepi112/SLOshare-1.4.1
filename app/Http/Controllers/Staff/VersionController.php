<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;

/**
 * @see \Tests\Todo\Feature\Http\Controllers\Staff\VersionControllerTest
 */
class VersionController extends Controller
{
    private readonly mixed $versionController;

    public function __construct()
    {
        $this->versionController = \config('sloshare.version');
    }

    /**
     * Check the latest release of SLOshare and compare them to the local version.
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \JsonException
     */
    public function checkVersion(): \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
    {
        $client = new Client();
        $response = \json_decode((string) $client->get('//api.github.com/repos/SLODovInnovations/SLOshare/releases')->getBody(), true, 512, JSON_THROW_ON_ERROR);
        $lastestVersion = $response[0]['tag_name'];

        return \response([
            'updated'       => ! \version_compare($this->versionController, $lastestVersion, '<'),
            'latestversion' => $lastestVersion,
        ]);
    }
}
