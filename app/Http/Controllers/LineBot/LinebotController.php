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
        $webhook = $request->all();
        Log::info(json_encode($webhook, JSON_UNESCAPED_UNICODE));
        # 提早設定以免發生 exception
        $replyToken = $webhook['events'][0]['replyToken'];

        $LineBot = new LineBot(env('LINE_ACCESS_TOKEN'), env('LINE_SECRET'));
        $AccountingService = new AccountingService($LineBot);

        # 取得回應 message
        $message = $AccountingService->getMessage($webhook, $LineBot);
        $LineBot->textResponse($replyToken, $message);
    }

    public function test(Request $request, AccountingService $AccountingService)
    {
        throw new \Exception('test');
        var_export($AccountingService->getUserInfo(1));

        // $lineRequest = $request->all();
        // $response = $AccountingService->getResponse($lineRequest);
        // echo $response;

        // $LineBot = new LineBot(env('LINE_ACCESS_TOKEN'), env('LINE_SECRET'));
        // $res = $LineBot->getProfile('U413f23aa7880f3f4d149f908e3f59bbd');
    }
}
