<?php
namespace App\Http\Controllers\LineBot;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\Request;
use Log;
use App\Service\Resource\LineBot;
use App\Service\AccountingService;
use Illuminate\Support\Collection;

/**
 * Line bot controller
 */
class LinebotController extends BaseController
{
    /**
     * line bot construct
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function accountingAction(Request $request)
    {
        $LineBot = new LineBot(env('LINE_ACCESS_TOKEN'), env('LINE_SECRET'));
        $AccountingService = new AccountingService();

        $webhook = $request->all();
        Log::info(json_encode($webhook, JSON_UNESCAPED_UNICODE));

        $userMessage = $AccountingService->getUserMessage($webhook);
        $userName = $AccountingService->getUserInfo($userMessage['userId'], $LineBot);
        // TODO

        $replyToken = $webhook['events'][0]['replyToken'];
        $LineBot->textResponse($replyToken);
    }

    public function test(Request $request, AccountingService $AccountingService)
    {
        var_export($AccountingService->getUserInfo(1));

        // $lineRequest = $request->all();
        // $response = $AccountingService->getResponse($lineRequest);
        // echo $response;

        // $LineBot = new LineBot(env('LINE_ACCESS_TOKEN'), env('LINE_SECRET'));
        // $res = $LineBot->getProfile('U413f23aa7880f3f4d149f908e3f59bbd');
    }
}
