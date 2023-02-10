<?php

namespace App\Http\Controllers;

use InfyOm\Generator\Utils\ResponseUtil;
use Illuminate\Contracts\View\Factory as ViewFactory;
use Response;

/**
 * @SWG\Swagger(
 *   basePath="/api/v1",
 *   @SWG\Info(
 *     title="Laravel Generator APIs",
 *     version="1.0.0",
 *   )
 * )
 * This class should be parent class for other API controllers
 * Class AppBaseController
 */
class AppBaseController extends Controller
{
	public function sendResponse($result, $message)
	{
		return Response::json(ResponseUtil::makeResponse($message, $result));
	}

	public function sendError($error, $code = 404)
	{
		return Response::json(ResponseUtil::makeError($error), $code);
	}

	public function sendSuccess($data, $message = "")
	{
		return Response::json([
			'success' => true,
			'message' => $message,
			'data' => $data
		], 200);
	}

	public function loadView($view = null, $data = [], $mergeData = [])
	{
		$factory = app(ViewFactory::class);

		if (func_num_args() === 0) {
			return $factory;
		}

		if (\FuncLib::isMobile()) {
			$view = 'mobile.' . $view;
		} else {
			$view = 'web.' . $view;
		}

		return $factory->make($view, $data, $mergeData);
	}
}
