<?php
namespace App\Http\Controllers\LineBot;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\Request;
use Log;
use App\Service\Resource\LineBot;
use App\Service\AccountingService;

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

        $lineRequest = $request->all();
        Log::info(json_encode($lineRequest, JSON_UNESCAPED_UNICODE));
        // $response = (new AccountingService())->getResponse($lineRequest);

        $LineBot->textResponse($lineRequest['events'][0]['replyToken']);
    }

    public function test(Request $request, AccountingService $AccountingService)
    {
        $lineRequest = $request->all();
        $response = $AccountingService->getResponse($lineRequest);

        echo $response;
    }
}
