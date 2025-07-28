protected $routeMiddleware = [
'auth' => \App\Http\Middleware\Authenticate::class,
'admin' => \App\Http\Middleware\AdminOnly::class,
// middleware lainnya...
];