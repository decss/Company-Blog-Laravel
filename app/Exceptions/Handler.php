<?php

namespace App\Exceptions;

use App\Http\Controllers\SiteController;
use App\Menu;
use App\Repositories\MenusRepository;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Log;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $e
     * @return void
     */
    public function report(Exception $e)
    {
        return parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     * @retur \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        if ($this->isHttpException($e)) {
            $statusCode = $e->getStatusCode();

            switch ($statusCode) {
                case '404' :
                    $theme = config('config.theme');
                    $obj = new SiteController(new MenusRepository(new Menu));
                    $navigation = view($theme . '.navigation')->with('menu', $obj->getMenu())->render();

                    Log::alert('Страница не найдена: ' . $request->url());

                    return response(view($theme . '.404', [
                        'bar' => 'no',
                        'heads' => ['title' => 'Страница не найдена'],
                        'navigation' => $navigation,
                    ]));
            }
        }

        return parent::render($request, $e);
    }
}
